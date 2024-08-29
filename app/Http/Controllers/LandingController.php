<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class LandingController extends Controller
{
    public function index()
    {
        $events = Events::where('event_status', 1)->paginate(4);
        return view('landing.index', ['events' => $events]);
    }

    public function loadMore(Request $request)
    {
        if ($request->ajax()) {
            $events = Events::where('event_status', 1)->paginate(3, ['*'], 'page', $request->page);
            return view('landing.components.events', ['events' => $events])->render();
        }
    }

    public function index_events()
    {
        $events = Events::all();
        return view('landing.pages.events', ['events' => $events]);
    }
    public function search(Request $request)
{
    $search = $request->input('search');
    $events = Events::where('event_name', 'like', '%' . $search . '%')
                    ->orWhere('event_location', 'like', '%' . $search . '%')
                    ->paginate(3); // Same pagination as in the index method

    return view('landing.index', ['events' => $events]);
}

}
