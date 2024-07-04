<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Order;
use App\Models\Talents;
use App\Models\Tickets;
use App\Models\TicketUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Str;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    protected $users_name;

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }
    public function index()
    {
        $email = Auth::user()->email;

        $orders = Order::with(['event', 'event.tickets']) // Load events and their tickets
            ->where('email_buyer', $email)
            ->latest()
            ->get();

        return view('landing.pages.history.index', compact('orders'));
    }

    public function order($event_id, $price)
    {
        $event = Events::find($event_id);
        $orders = Order::latest()->get();
        $user = Auth::user();

        $tickets = Tickets::where('events_id', $event_id)->get();
        $talents = Talents::where('event_id', $event_id)->get();

        return view('landing.pages.event.page.order', compact('event', 'tickets', 'talents', 'event_id', 'price', 'orders'));
    }

    public function createInvoice(Request $request)
    {
        $this->users_name = Auth::user()->name;
        try {
            $qty = $request->input('qty');
            $price = $request->input('price');
            $totalAmount = $qty * $price;

            $no_transaction = 'Inv-' . (string) Str::uuid();
            $order = new Order();
            $order->no_transaction = $no_transaction;
            $order->event_id = $request->input('event_id');
            $order->external_id = $no_transaction;
            $order->name_buyer = Auth::user()->name;
            $order->email_buyer = Auth::user()->email;
            $order->qty = $qty;
            $order->price = $price;
            $order->total_amount = $totalAmount;

            $items = new InvoiceItem([
                'name' => Auth::user()->name,
                'price' => $price,
                'quantity' => $request->input('qty'),
            ]);

            $createInvoice = new CreateInvoiceRequest([
                'external_id' => $no_transaction,
                'amount' => $totalAmount,
                'invoice_duration' => 172800,
                'items' => [$items],
            ]);

            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);
            $order->invoice_url = $generateInvoice['invoice_url'];
            $order->save();

            return redirect(route('history'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function notificationCallback(Request $request)
    {
        $getToken = $request->headers->get('x-callback-token');
        $callbackToken = env('XENDIT_CALLBACK_TOKEN');

        try {
            if (!$callbackToken) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'callback token not exist',
                    ],
                    404,
                );
            }

            $response = response()->json(
                [
                    'status' => 'success',
                    'message' => 'callback sent',
                ],
                200,
            );

            $order = Order::where('external_id', $request->external_id)->first();

            if ($order) {
                if ($request->status == 'PAID') {
                    $order->status = 'Success';
                    $order->save();
                    $this->generateTicketUsers($order, $order->name_buyer, $order->event_id, $order->email_buyer);
                } else {
                    $order->status = 'Failed';
                    $order->save();
                }
            }

            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    protected function generateTicketUsers(Order $order, $users_name, $event_id, $email_buyer)
    {
        $qty = $order->qty;

        for ($i = 0; $i < $qty; $i++) {
            $ticketUser = new TicketUsers();
            $ticketUser->users_name = $users_name;
            $ticketUser->events_id = $event_id;
            $ticketUser->users_email = $email_buyer;

            // Simpan ticketUser untuk mendapatkan ID
            $ticketUser->save();

            // Generate QR Code setelah menyimpan untuk mendapatkan ID
            $this->generateQrCode($ticketUser, $i, $email_buyer, $users_name);
        }
    }

    protected function generateQrCode(TicketUsers $ticketUser, $index, $email_buyer, $users_name)
    {
        $ticketUserId = $ticketUser->id;

        $qrCodePath = 'ticket_qr/ticket_' . md5($ticketUserId . '_' . $index) . '.png';
        $url = url('/tickets/' . $ticketUserId . '/redeem');
        $qrCode = QrCode::format('png')->size(312)->merge(public_path('assets/logo/border-black.png'), 0.47, true)->errorCorrection('Q')->generate($url);

        Storage::disk('public')->put($qrCodePath, $qrCode);

        $ticketUser->qr_code_ticket = $qrCodePath;
        $ticketUser->save();

        $this->sendEmailWithAttachment($ticketUser, $email_buyer, $users_name);
    }

    protected function sendEmailWithAttachment(TicketUsers $ticketUser, $email_buyer, $users_name)
    {
        $userEmail = $email_buyer;
        $qrCodePath = storage_path('app/public/' . $ticketUser->qr_code_ticket);

        $details = [
            'title' => 'Mail from ticketify.id',
            'body' => 'Berikut Kode QR ticket anda',
            'qrCodePath' => $qrCodePath,
            'name' => $users_name,
        ];

        Mail::to($email_buyer)->send(new \App\Mail\TicketQrMail($details, $qrCodePath));
    }
}
