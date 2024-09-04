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
        if (Auth::check()) {
            $email = Auth::user()->email;

            $orders = Order::with(['event', 'event.tickets'])
                ->where(function ($query) use ($email) {
                    $query->whereNull('email_auth')->where('email_buyer', $email)->orWhere('email_auth', $email);
                })
                ->latest()
                ->get();

            // dd($orders);

            return view('landing.pages.history.index', compact('orders'));
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat riwayat pesanan.');
        }
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
            return redirect()
                ->route('event_details', ['event_id' => $event_id])
                ->with('error', 'Ticket not found');
        }

        $orders = Order::latest()->get();
        $user = Auth::user();

        $talents = Talents::where('event_id', $event_id)->get();

        return view('landing.pages.event.page.order', compact('event', 'ticket', 'talents', 'event_id', 'orders'));
    }

    public function createInvoice(Request $request)
{
    try {
        $email_buyer = $request->input('email');
        $event_id = $request->input('event_id');

        $existingOrder = Order::where('email_buyer', $email_buyer)
                                ->where('event_id', $event_id)
                                ->first();

        if ($existingOrder) {
            Alert::error('Pendaftaran Gagal', 'Email sudah digunakan');
            return redirect()->back()->with('error', 'Email ini sudah digunakan untuk memesan tiket di acara ini.');
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone_number = $request->input('phone_number');
        $gender = $request->input('gender');
        $birth_date = Carbon::createFromFormat('Y-m-d', $request->input('birth_date'))->format('Y-m-d');
        $nik = $request->input('nik');
        $blood_type = $request->input('blood_type');
        $bib = $request->input('bib');
        $community = $request->input('community');
        $size_shirt = $request->input('size_shirt');
        $urgen_contact = $request->input('urgen_contact');
        $number_urgen_contact = $request->input('number_urgen_contact');
        $relation_urgen_contact = $request->input('relation_urgen_contact');
        $field1 = $request->input('field1');
        $field2 = $request->input('field2');
        $field3 = $request->input('field3');
        $field4 = $request->input('field4');
        $field5 = $request->input('field5');

        $qty = $request->input('qty');
        $price = $request->input('price');
        $discountAmount = $request->input('discount_amount', 0);

        if ($discountAmount != 0) {
            $discountCode = $request->input('discount_code');
            $discount = \App\Models\Discount::where('code', $discountCode)->first();
            if ($discount && $discount->used > 0) {
                $discount->used -= 1;
                $discount->save();
            }
        }

        if ($price != 0) {
            $totalAmount = $qty * $price;
        } else {
            $totalAmount = $qty * $price;
        }

        if ($price != 0) {
            $internetFee = (5 / 100) * $totalAmount;
            $totalAmount += $internetFee;
        } else {
            $totalAmount = 0;
        }

        $no_transaction = 'Inv-' . (string) Str::uuid();
        $order = new Order();
        $order->no_transaction = $no_transaction;
        $order->event_id = $event_id;
        $order->external_id = $no_transaction;
        $order->name_buyer = $request->input('name');
        $order->email_buyer = $email_buyer;
        $order->qty = $qty;
        $order->price = $price;
        $order->ticket_type = $request->input('ticket_type');
        $order->event_name = $request->input('event_name');
        $order->total_amount = $totalAmount -= $discountAmount;
        $order->first_name = $first_name;
        $order->last_name = $last_name;
        if (Auth::check()) {
            $order->email_auth = Auth::user()->email;
        }
        $order->phone_number = $phone_number;
        $order->birth_date = $birth_date;
        $order->gender = $gender;
        $order->nik = $nik;
        $order->blood_type = $blood_type;
        $order->bib = $bib;
        $order->community = $community;
        $order->size_shirt = $size_shirt;
        $order->urgent_contact = $urgen_contact;
        $order->number_urgen_contact = $number_urgen_contact;
        $order->relation_urgen_contact = $relation_urgen_contact;
        $order->field1 = $field1;
        $order->field2 = $field2;
        $order->field3 = $field3;
        $order->field4 = $field4;
        $order->field5 = $field5;

        if ($price == 0) {
            $order->save();
            $this->generateTicketUsers($order, $order->name_buyer, $order->event_id, $order->email_buyer, $order->first_name, $order->last_name, $order->phone_number, $order->birth_date, $order->gender);
        } else {
            // Logika untuk menangani pembayaran dengan Xendit atau lainnya
            $fees = [
                [
                    'type' => 'Admin Fee',
                    'value' => $internetFee,
                ],
                [
                    'type' => 'Discount',
                    'value' => -$discountAmount,
                ],
            ];
            $items = new InvoiceItem([
                'name' => $request->input('ticket_type') . ' ' . $request->input('event_name'),
                'price' => $price,
                'quantity' => $request->input('qty'),
            ]);

            $createInvoice = new CreateInvoiceRequest([
                'external_id' => $no_transaction,
                'amount' => $totalAmount,
                'invoice_duration' => 172800,
                'items' => [$items],
                'fees' => $fees,
            ]);

            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);
            $order->invoice_url = $generateInvoice['invoice_url'];
            $order->save();

            // Kirim email konfirmasi dengan link invoice
            $details = [
                'name' => $order->name_buyer,
                'uniqueCode' => $no_transaction,
                'tipe_ticket' => $order->ticket_type,
                'total_payment' => 'Rp. ' . number_format($totalAmount, 0, ',', '.'),
                'invoice_url' => $generateInvoice['invoice_url'],
                'event_name' => $order->event_name,
                'event_date' => Carbon::parse($order->event->event_start)->translatedFormat('j F Y'),
                'event_location' => $order->event->event_location,
                'total_ticket' => $order->qty,
            ];
            Mail::to($order->email_buyer)->send(new \App\Mail\ReminderPayments($details, null));
        }

        if (Auth::check()) {
            return redirect(route('history'));
        } elseif ($price == 0) {
            Alert::success('Selamat!', 'Pendaftaran berhasil!, silahkan cek E-Mail anda');
            return redirect(route('index'));
        } else {
            return redirect($generateInvoice['invoice_url']);
        }
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

            $this->generateQrCode($ticketUser, $i, $order);
        }
    }

    protected function generateQrCode(TicketUsers $ticketUser, $index, Order $order)
    {
        // Menemukan event terkait berdasarkan ID di order
        $event = Events::find($ticketUser->events_id);
        $eventName = $event ? $event->event_name : 'Unknown Event';

        // Siapkan data QR code dalam bentuk JSON
        $qrData = [
            'unique_code' => $ticketUser->unique_code,
            'users_name' => $ticketUser->users_name,
            'users_email' => $ticketUser->users_email,
            'phone_number' => $ticketUser->phone_number,
            'event_yang_diikuti' => $eventName,
        ];

        $jsonQrData = json_encode($qrData);

        // Tentukan path penyimpanan QR code
        $qrCodePath = 'ticket_qr/ticket_' . md5($ticketUser->id . '_' . $index) . '.png';

        // Menghasilkan QR code dengan data JSON
        $qrCode = QrCode::format('png')->size(312)->merge(public_path('assets/logo/border-black.png'), 0.47, true)->errorCorrection('Q')->generate($jsonQrData);

        // Menyimpan QR code ke disk publik
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Simpan path QR code ke database
        $ticketUser->qr_code_ticket = $qrCodePath;
        $ticketUser->save();

        // Panggil metode untuk mengirim email dengan lampiran QR code
        $this->sendEmailWithAttachment($ticketUser, $order);
    }

    protected function sendEmailWithAttachment(TicketUsers $ticketUser, Order $order)
    {
        // Path QR Code
        $qrCodePath = storage_path('app/public/' . $ticketUser->qr_code_ticket);

        // Siapkan detail untuk email
        $details = [
            'title' => 'Mail from ticketify.id',
            'body' => 'Berikut Kode QR ticket anda',
            'qrCodePath' => $qrCodePath,
            'name' => $order->name_buyer,
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'email_buyer' => $order->email_buyer,
            'phone_number' => $order->phone_number,
            'birth_date' => $order->birth_date,
            'gender' => $order->gender,
            'ticket_type' => $order->ticket_type,
            'event_name' => $order->event_name,
            'total_amount' => $order->total_amount,
            'uniqueCode' => $ticketUser->unique_code,
            'nik' => $order->nik,
            'blood_type' => $order->blood_type,
            'bib' => $order->bib,
            'community' => $order->community,
            'size_shirt' => $order->size_shirt,
            'urgent_contact' => $order->urgent_contact,
            'number_urgen_contact' => $order->number_urgen_contact,
            'relation_urgen_contact' => $order->relation_urgen_contact,
            'field1' => $order->field1,
            'field2' => $order->field2,
            'field3' => $order->field3,
            'field4' => $order->field4,
            'field5' => $order->field5,
        ];

        // Kirim email dengan lampiran QR code
        Mail::to($order->email_buyer)->send(new \App\Mail\TicketQrMail($details, $qrCodePath));
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
