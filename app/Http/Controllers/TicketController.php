<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Tickets;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $event_id = $request->query('event_id');
        $eventId = $request->input('event_id');
        $tickets = Tickets::where('events_id', $eventId)->get();
        $event = Events::find($eventId);

        if ($event_id) {
            $tickets = Tickets::where('events_id', $event_id)->get();
        } else {
            $tickets = Tickets::all();
        }

        return view('users.page.ticket', compact('tickets', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = new Tickets();
        $ticket->users_id = $request->users_id;
        $ticket->events_id = $request->events_id;
        $ticket->ticket_type = $request->ticket_type;
        $ticket->price = $request->price;
        $ticket->save();

        return redirect()->route('tickets.index', ['event_id' => $ticket->events_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tickets $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tickets $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tickets $ticket)
    {
        $ticket->update([
            'users_id' => $request->users_id,
            'events_id' => $request->events_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
        ]);

        return redirect()->route('tickets.index', ['event_id' => $ticket->events_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
