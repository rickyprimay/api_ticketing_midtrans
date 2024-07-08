<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbortController extends Controller
{
    public function index()
    {
        return view('landing.pages.abort');
    }
}
