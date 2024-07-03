<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }
    public function index_events()
    {
        $events = Events::all();
        return view('landing.pages.events', ['events' => $events]);
    }

}
