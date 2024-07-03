<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Events;
use App\Services\Midtrans\CreatePaymentUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $tickets = Tickets::where('users_id', $userId)->get();

        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Tickets::find($id);
        if (!$ticket) {
            return redirect()->route('tickets.index')->with('error', 'Ticket not found');
        }

        return view('tickets.show', compact('ticket'));
    }

    protected function generateQrCode(Tickets $ticket)
    {
        $qrCodePath = 'ticket_qr/ticket_' . md5($ticket->id) . '.png';
        $url = url('/tickets/' . $ticket->ticket_id . '/redeem');

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
            return redirect()->route('tickets.index')->with('error', 'Ticket not found');
        }

        $ticket->ticket_status = 1;
        $ticket->save();

        return redirect()->route('tickets.show', $ticket->ticket_id)->with('success', 'Ticket redeemed successfully');
    }
}
