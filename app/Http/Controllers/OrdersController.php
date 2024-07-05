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

        $orders = Order::with(['event', 'event.tickets'])
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
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $phone_number = $request->input('phone_number');
            $gender = $request->input('gender');
            $birth_date = $request->input('birth_date');
            $qty = $request->input('qty');
            $price = $request->input('price');
            $totalAmount = $qty * $price;

            $no_transaction = 'Inv-' . (string) Str::uuid();
            $order = new Order();
            $order->no_transaction = $no_transaction;
            $order->event_id = $request->input('event_id');
            $order->external_id = $no_transaction;
            $order->name_buyer = $request->input('name');
            $order->email_buyer = $request->input('email');
            $order->qty = $qty;
            $order->price = $price;
            $order->total_amount = $totalAmount;
            $order->first_name = $first_name;
            $order->last_name = $last_name;
            $order->phone_number = $phone_number;
            $order->birth_date = $birth_date;
            $order->gender = $gender;

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

            $order = Order::where('external_id', $request->external_id)->first();

            if ($order) {
                if ($request->status == 'PAID') {
                    $order->status = 'Success';
                    $order->save();
                    $this->generateTicketUsers($order, $order->name_buyer, $order->event_id, $order->email_buyer, $order->first_name, $order->last_name, $order->phone_number, $order->birth_date, $order->gender);

                    // Set session untuk redirect setelah callback berhasil
                    session(['payment_status' => 'success']);
                } else {
                    $order->status = 'Failed';
                    $order->save();

                    // Set session untuk redirect setelah callback gagal
                    session(['payment_status' => 'failed']);
                }
            }

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'callback sent',
                ],
                200,
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function redirectAfterPayment()
    {
        $paymentStatus = session('payment_status');

        if ($paymentStatus == 'success') {
            return redirect()->route('history')->with('message', 'Pembayaran berhasil!');
        } else {
            return redirect()->route('history')->with('message', 'Pembayaran gagal!');
        }
    }

    protected function generateTicketUsers(Order $order, $users_name, $event_id, $email_buyer, $first_name, $last_name, $phone_number, $birth_date, $gender)
    {
        $qty = $order->qty;

        for ($i = 0; $i < $qty; $i++) {
            $ticketUser = new TicketUsers();
            $ticketUser->users_name = $users_name;
            $ticketUser->events_id = $event_id;
            $ticketUser->users_email = $email_buyer;
            $ticketUser->first_name = $first_name;
            $ticketUser->last_name = $last_name;
            $ticketUser->phone_number = $phone_number;
            $ticketUser->birth_date = $birth_date;
            $ticketUser->gender = $gender;

            $ticketUser->save();

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
