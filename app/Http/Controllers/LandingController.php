<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class LandingController extends Controller
{
    public function index()
    {
        $events = Events::where('event_status', 1)->get();
        return view('landing.index', ['events' => $events]);
    }

    public function index_events()
    {
        $events = Events::all();
        return view('landing.pages.events', ['events' => $events]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $events = Events::where('event_name', 'like', '%' . $search . '%')->get();

        return view('landing.index', ['events' => $events]);
    }
}
