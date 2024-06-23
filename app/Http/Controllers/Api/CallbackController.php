<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class CallbackController extends Controller
{
    public function callback()
    {
        $callback = new CallbackService;
    
        $notification = $callback->getNotification();
        $ticket = $callback->getTicket();
    
        if ($callback->isSuccess()) {
            Tickets::where('order_id', $ticket->order_id)->update([
                'payment_status' => 2,
                
            ]);
            $this->generateQrCode($ticket);
        }
    
        if ($callback->isExpire()) {
            Tickets::where('order_id', $ticket->order_id)->update([
                'payment_status' => 0,
            ]);
        }
    
        if ($callback->isCancelled()) {
            Tickets::where('order_id', $ticket->order_id)->update([
                'payment_status' => 0,
            ]);
        }

        $params = [
            'success' => true,
            'status code ' => 200,
            'message' => 'Notification successfully processed',
        ];
        
        return response()->json($params, 200);
        
    }
    protected function generateQrCode(Tickets $ticket)
    {
        $qrCodePath = 'ticket_qr/'.$ticket->order_id.'.png';
        $url = url('/api/tickets/'.$ticket->order_id.'/redeem');

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

    public function redeem($order_id)
    {
        $ticket = Tickets::where('order_id', $order_id)->first();

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        if ($ticket->ticket_status == 1) {
            return response()->json(['message' => 'Ticket has already been redeemed'], 400);
        }

        if ($ticket->payment_status != 2) {
            return response()->json(['message' => 'Ticket payment not successful'], 400);
        }

        $ticket->ticket_status = 1;
        $ticket->save();

        return response()->json(['message' => 'success', 'data' => $ticket], 200);
    }

}
