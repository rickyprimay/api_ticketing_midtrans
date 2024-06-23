<?php

namespace App\Services\Midtrans;

use App\Models\Tickets;
use App\Services\Midtrans\Midtrans;
use Midtrans\Notification;

class CallbackService extends Midtrans
{
    protected $notification;
    protected $ticket;
    protected $serverKey;

    public function __construct()
    {
        parent::__construct();

        $this->serverKey = config('midtrans.server_key');
        $this->_handleNotification();
    }

    public function isSignatureKeyVerified()
    {
        // Get local signature
        $localSignature = $this->_createLocalSignatureKey();
        // Get notification signature
        $notificationSignature = $this->notification->signature_key;
        
        return ($localSignature === $notificationSignature);
    }

    public function isSuccess()
    {
        $statusCode = $this->notification->status_code;
        $transactionStatus = $this->notification->transaction_status;
        $fraudStatus = !empty($this->notification->fraud_status) ? ($this->notification->fraud_status == 'accept') : true;

        return ($statusCode == 200 && $fraudStatus && ($transactionStatus == 'capture' || $transactionStatus == 'settlement'));
    }

    public function isExpire()
    {
        return ($this->notification->transaction_status == 'expire');
    }

    public function isCancelled()
    {
        return ($this->notification->transaction_status == 'cancel');
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    protected function _createLocalSignatureKey()
    {   
        if (!$this->ticket) {
            throw new \Exception('Ticket is null. Cannot create local signature key.');
        }
        $orderId = $this->ticket->order_id;
        $statusCode = $this->notification->status_code;
        $grossAmount = $this->ticket->price;
        $serverKey = $this->serverKey;
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = hash('sha512', $input);

        return $signature;
    }

    protected function _handleNotification()
    {
        // Create Notification object with $_POST contents
        $notification = new Notification();
        // Get order_id from notification
        $orderId = $notification->order_id; 
        // Find the ticket in the database
        $ticket = Tickets::where('order_id', $orderId)->first();
    
        if (!$ticket) {
            throw new \Exception('Ticket not found for order_id: ' . $orderId);
        }
    
        // Set notification and ticket properties
        $this->notification = $notification;
        $this->ticket = $ticket;
    }



}
