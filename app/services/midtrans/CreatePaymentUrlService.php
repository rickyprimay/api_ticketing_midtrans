<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Tickets;

class CreatePaymentUrlService extends Midtrans
{
    protected $ticket;

    public function __construct(Tickets $ticket)
    {
        parent::__construct();

        $this->ticket = $ticket;
    }

    public function getOrderId()
    {
        return $this->ticket->order_id;
    }

    public function getPaymentUrl($ticket)
    {
        // Pastikan $ticket adalah instance dari Tickets
        if (!($ticket instanceof Tickets)) {
            throw new \InvalidArgumentException('$ticket harus merupakan instance dari Tickets.');
        }

        $item_details = new Collection();

        // Asumsikan $ticket memiliki relasi 'user' dan 'event'
        $item_details->push([
            "users_id" => $ticket->users_id,
            "events_id" => $ticket->events_id,
            "name" => $ticket->name_user,
            "birth_date_user" => $ticket->birth_date_user,
            "email_user" => $ticket->email_user,
            "gender_user" => $ticket->gender_user,
            "price" => $ticket->price,
            "quantity" => 1,
            "payment_status" => $ticket->payment_status,
            "id" => $ticket->ticket_id,
        ]);
        // $order_id = uniqid();
        // var_dump($this->getOrderId());

        $params = [
            'transaction_details' => [
                'order_id' => $this->getOrderId(), // Gunakan metode getOrderId() untuk mendapatkan order_id yang konsisten
                'gross_amount' => (float) $ticket->price,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $ticket->name_user,
                'email' => $ticket->email_user,
                'phone' => $ticket->phone_number ?? '',
            ],
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return $paymentUrl;
    }
}

