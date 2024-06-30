<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Events;
use App\Services\Midtrans\CreatePaymentUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $tickets = Tickets::where('users_id', $userId)->get();

        return response()->json([
            'success' => true,
            'tickets' => $tickets
        ], 200);
    }


    public function store(Request $request)
{
    $userId = Auth::id();

    $request->validate([
        'events_id' => 'required|exists:events,event_id',
        'name_user' => 'required|string|max:255',
        'birth_date_user' => 'required|date',
        'email_user' => 'required|email|max:255',
        'gender_user' => 'required|in:Male,Female',
        'price' => 'required|numeric',
        'ticket_status' => 'nullable|integer',
        'payment_status' => 'required|integer',
        'qr_code_ticket' => 'nullable|string'
    ]);

    // Generate order_id
    $order_id = uniqid();

    $event = Events::find($request->events_id);
    if (!$event) {
        return response()->json(['message' => 'Event not found'], 404);
    }

    $price = $event->price;

    // Create ticket with a placeholder for payment_url
    $ticket = Tickets::create([
        'users_id' => $userId,
        'events_id' => $request->events_id,
        'name_user' => $request->name_user,
        'birth_date_user' => $request->birth_date_user,
        'email_user' => $request->email_user,
        'gender_user' => $request->gender_user,
        'price' => $price,
        'ticket_status' => 0,
        'payment_status' => $request->payment_status,
        'order_id' => $order_id,
        'payment_url' => '', // Placeholder value
    ]);

    // Check if ticket creation failed
    if (!$ticket) {
        Log::error('Failed to create ticket', ['data' => $request->all()]);
        return response()->json(['message' => 'Failed to create ticket'], 500);
    }

    // Create payment URL
    $midtrans = new CreatePaymentUrlService($ticket);
    $paymentUrl = $midtrans->getPaymentUrl($ticket->load('user'));

    // Update the ticket with the actual payment URL
    $ticket->update([
        'payment_url' => $paymentUrl,
    ]);

    return response()->json(['message' => 'success', 'data' => $ticket], 201);
}


    public function show($id)
    {
        $ticket = Tickets::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        return response()->json(['message' => 'success', 'data' => $ticket], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'users_id' => 'sometimes|required|exists:users,id',
            'events_id' => 'sometimes|required|exists:events,event_id',
            'name_user' => 'sometimes|required|string|max:255',
            'birth_date_user' => 'sometimes|required|date',
            'email_user' => 'sometimes|required|email|max:255',
            'gender_user' => 'sometimes|required|in:Male,Female',
            'price' => 'sometimes|required|numeric',
            'ticket_status' => 'nullable|integer',
            'payment_status' => 'sometimes|required|integer',
            'order_id' => time(),
        ]);

        $ticket = Tickets::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->update($validated);

        // Check if payment_status is 2 and QR code does not exist, generate QR code
        if ($ticket->payment_status == 2 && empty($ticket->qr_code_ticket)) {
            $this->generateQrCode($ticket);
        }

        return response()->json(['message' => 'success', 'data' => $ticket], 200);
    }

    public function destroy($id)
    {
        $ticket = Tickets::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        // Delete QR code from storage if exists
        if (!empty($ticket->qr_code_ticket)) {
            Storage::disk('public')->delete($ticket->qr_code_ticket);
        }

        $ticket->delete();

        return response()->json(['message' => 'success'], 200);
    }

    protected function generateQrCode(Tickets $ticket)
    {
        $qrCodePath = 'ticket_qr/ticket_' . md5($ticket->id) . '.png';
        $url = url('/api/tickets/' . $ticket->ticket_id . '/redeem');

        $qrCode = QrCode::format('png')
            ->size(312)
            ->format('png')
            ->merge(public_path('assets/logo/border-black.png'), 0.47, true)
            ->errorCorrection('Q')
            ->generate($url);

        Storage::disk('public')->put($qrCodePath, $qrCode);

        $ticket->qr_code_ticket = $qrCodePath;
        $ticket->save();
    }

    public function redeem($id)
    {
        $ticket = Tickets::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->ticket_status = 1;
        $ticket->save();

        return response()->json(['message' => 'success', 'data' => $ticket], 200);
    }
}
