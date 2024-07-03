<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function index(){

	$details = [
    'title' => 'Mail from ticketify.id',
    'body' => 'This is for testing email using smtp'
    ];
   
    Mail::to('rickyprima30@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email sudah terkirim.");

	}
}