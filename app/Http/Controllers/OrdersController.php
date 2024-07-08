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
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function order($event_id, $ticket_id)
{
    $event = Events::find($event_id);

    if (!$event || $event->event_status != 1) {
        Alert::error('Gagal', 'Event sudah selesai/tidak tersedia');
        return redirect()->route('index')->with('error', 'Event not found or not available');
    }
    $ticket = Tickets::find($ticket_id);
    if (!$ticket) {
        Alert::error('Gagal', 'Ticket tidak tersedia');
        return redirect()->route('event_details', ['event_id' => $event_id])->with('error', 'Ticket not found');
    }

    $orders = Order::latest()->get();
    $user = Auth::user();

    $talents = Talents::where('event_id', $event_id)->get();

    return view('landing.pages.event.page.order', compact('event', 'ticket', 'talents', 'event_id', 'orders'));
}

    public function createInvoice(Request $request)
    {
        $this->users_name = Auth::user()->name;
        try {
            // dd($request);
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $phone_number = $request->input('phone_number');
            $gender = $request->input('gender');
            $birth_date = Carbon::createFromFormat('Y-m-d', $request->input('birth_date'))->format('Y-m-d');
            // if event_type = health
            $nik = $request->input('nik');
            $blood_type = $request->input('blood_type');
            $bib = $request->input('bib');
            $community = $request->input('community');
            $size_shirt = $request->input('size_shirt');
            $urgen_contact = $request->input('urgen_contact');
            $number_urgen_contact = $request->input('number_urgen_contact');
            $relation_urgen_contact = $request->input('relation_urgen_contact');

            $qty = $request->input('qty');
            $price = $request->input('price');
            $totalAmount = $qty * $price;

            $internetFee = 4500;
            $totalAmount += $internetFee;

            $no_transaction = 'Inv-' . (string) Str::uuid();
            $order = new Order();
            $order->no_transaction = $no_transaction;
            $order->event_id = $request->input('event_id');
            $order->external_id = $no_transaction;
            $order->name_buyer = $request->input('name');
            $order->email_buyer = Auth::user()->email;
            $order->qty = $qty;
            $order->price = $price;
            $order->ticket_type = $request->input('ticket_type');
            $order->event_name = $request->input('event_name');
            $order->total_amount = $totalAmount;
            $order->first_name = $first_name;
            $order->last_name = $last_name;
            $order->phone_number = $phone_number;
            $order->birth_date = $birth_date;
            $order->gender = $gender;
            // if event_type = health
            $order->nik = $nik;
            $order->blood_type = $blood_type;
            $order->bib = $bib;
            $order->community = $community;
            $order->size_shirt = $size_shirt;
            $order->urgent_contact = $urgen_contact;
            $order->number_urgen_contact = $number_urgen_contact;
            $order->relation_urgen_contact = $relation_urgen_contact;

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

                } else {
                    $order->status = 'Failed';
                    $order->save();

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


    protected function generateTicketUsers(Order $order, $users_name, $event_id, $email_buyer, $first_name, $last_name, $phone_number, $birth_date, $gender)
    {
        $qty = $order->qty;

        for ($i = 0; $i < $qty; $i++) {
            $ticketUser = new TicketUsers();
            $ticketUser->users_name = $users_name;
            $ticketUser->unique_code = rand();
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

        $event = Events::find($ticketUser->events_id);
        $eventName = $event ? $event->event_name : 'Unknown Event';

        // $qrData = [
        //     'unique_code' => $ticketUser->unique_code,
        //     'users_name' => $ticketUser->users_name,
        //     'users_email' => $ticketUser->users_email,
        //     'phone_number' => $ticketUser->phone_number,
        //     'event_yang_diikuti' => $eventName,
        // ];

        $qrCodeContent = $ticketUser->unique_code;

        // Generate QR code dengan konten JSON
        $qrCodePath = 'ticket_qr/ticket_' . md5($ticketUser->id . '_' . $index) . '.png';
        $qrCode = QrCode::format('png')->size(312)->merge(public_path('assets/logo/border-black.png'), 0.47, true)->errorCorrection('Q')->generate($qrCodeContent);

        // Simpan QR code ke storage
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Update path QR code di ticketUser
        $ticketUser->qr_code_ticket = $qrCodePath;
        $ticketUser->save();

        // Kirim email dengan lampiran QR code
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
            'uniqueCode' => $ticketUser->unique_code
        ];

        Mail::to($email_buyer)->send(new \App\Mail\TicketQrMail($details, $qrCodePath));
    }
    public function redeemQR(Request $request)
{
    $request->validate([
        'qr_id' => 'required|string',
        'ticket_status' => 'required|integer',
    ]);

    $ticketUser = TicketUsers::where('unique_code', $request->qr_id)->first();

    if ($ticketUser->ticket_status == 1) {
        return response()->json(['message' => 'Ticket has already been redeemed'], 400);
    }

    $ticketUser->ticket_status = 1;
    $ticketUser->save();

    return response()->json(['message' => 'Ticket redeemed successfully'], 200);
}

}
