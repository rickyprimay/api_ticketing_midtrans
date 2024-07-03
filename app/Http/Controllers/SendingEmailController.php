<?php

namespace App\Http\Controllers;

use App\Mail\SendingEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendingEmailController extends Controller
{
    public function index(){
        Mail::to('111202214486@mhs.dinus.ac.id')->send(new SendingEmail());
        return '<h1>berikut kode mu</h1>';
    }
}
