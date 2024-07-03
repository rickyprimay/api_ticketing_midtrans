<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class LandingController extends Controller
{
    public function index()
    {
        $events = Events::all();
        return view('landing.index', ['events' => $events]);
    }
    public function index_events()
    {
        $events = Events::all();
        return view('landing.pages.events', ['events' => $events]);
    }

}
