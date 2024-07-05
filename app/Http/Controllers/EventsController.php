<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Talents;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class EventsController extends Controller
{
    public function show($id)
    {
        $event = Events::find($id);

        if (!$event || $event->event_status != 1) {
            Alert::error('Gagal', 'Event Sudah selesai/tidak ada');
            return redirect()->route('index')->with('error', 'Event not found or not available');
        }

        $tickets = Tickets::where('events_id', $id)->get();
        $talents = Talents::where('event_id', $id)->get();

        return view('landing.pages.event.page.details', compact('event', 'tickets', 'talents'));
    }
}
