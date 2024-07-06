<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Events;
use App\Models\Tickets;
use Illuminate\Console\Scheduling\Event;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {   
        $events = Events::where('users_id', Auth::id())->pluck('event_id');

        $event = Events::all();

        $tickets = Tickets::whereIn('events_id', $events)->get();

        $eventsa = Events::where('users_id', Auth::id())->get();
        $totalTickets = $tickets->count();
        $totalEventsa = $eventsa->count();

        return view('admin.index', compact('totalTickets', 'totalEventsa'));
    }

    public function ticket()
    {
        $events = Events::where('users_id', Auth::id())->pluck('event_id');

        $event = Events::all();

        $tickets = Tickets::whereIn('events_id', $events)->get();

        return view('admin.page.ticket', compact('tickets', 'event'));
    }
    public function storeTicket(Request $request)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'event_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Tickets::create([
            'ticket_type' => $request->ticket_type,
            'events_id' => $request->event_id,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Ticket created successfully.');
    }

    public function updateTicket(Request $request, $id)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'event_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $ticket = Tickets::findOrFail($id);
        $ticket->update([
            'ticket_type' => $request->ticket_type,
            'events_id' => $request->event_id, // Sesuaikan dengan 'events_id'
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }

    public function destroyTicket($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }

    public function event()
    {
        $events = Events::where('users_id', Auth::id())->get();
        return view('admin.page.event', compact('events'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'price' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start' => 'required|date',
            'event_ended' => 'required|date',
            'event_status' => 'required|in:2,3',
        ]);

        $event = Events::findOrFail($id);
        $event->update($validatedData);

        Alert::success('Berhasil', 'Event telah terupdate.');
        return redirect()->route('admin.event')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Events::findOrFail($id);
        $event->delete();

        Alert::success('Berhasil', 'Event telah terhapus');
        return redirect()->route('admin.event')->with('success', 'Event deleted successfully.');
    }

    public function createEvent()
    {
        return view('admin.page.addEvent');
    }

    public function storeEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'price' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start' => 'required|date',
            'event_ended' => 'required|date',
            'event_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $event = new Events();
            $event->users_id = Auth::id();
            $event->event_name = $request->event_name;
            $event->event_description = $request->event_description;
            $event->price = $request->price;
            $event->event_location = $request->event_location;
            $event->event_date = $request->event_date;
            $event->event_start = $request->event_start;
            $event->event_ended = $request->event_ended;
            $event->event_status = 0;

            if ($request->hasFile('event_picture')) {
                $image = $request->file('event_picture');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $path = $image->store('event_pictures', 'public');

                $event->event_picture = $path;
            }

            $event->save();

            Alert::success('Berhasil', 'Event telah dibuat.');
            return redirect()->route('admin.event')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Event gagal dibuat. ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to create event. ' . $e->getMessage())
                ->withInput();
        }
    }
    public function buyer(){
        return view('admin.page.buyer');
    }
}
