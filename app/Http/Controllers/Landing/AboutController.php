<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        return view('landing.pages.about');
    }
    public function refund() {
        return view('landing.pages.refund');
    }
    public function tos() {
        return view('landing.pages.tos');
    }
}
