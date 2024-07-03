<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketQrMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $qrCodePath;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $qrCodePath)
    {
        $this->details = $details;
        $this->qrCodePath = $qrCodePath;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from ticketify.id')
                    ->view('emails.TicketQrMail');
    }
}