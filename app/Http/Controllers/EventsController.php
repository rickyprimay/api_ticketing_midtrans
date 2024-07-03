<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::all();
        return view('events.index', ['events' => $events]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_picture' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $eventData = $request->all();

        if ($request->hasFile('event_picture')) {
            $file = $request->file('event_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/event_pictures', $filename);

            $eventData['event_picture'] = $filename;
        }

        $event = Events::create($eventData);

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function show($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        $talents = $event->talents; 

        return view('events.show', ['event' => $event, 'talents' => $talents]);
    }

    public function edit($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Events::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        $request->validate([
            'event_picture' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        // Menghapus event_picture lama jika ada file baru yang diunggah
        if ($request->hasFile('event_picture')) {
            // Hapus event_picture lama
            if ($event->event_picture) {
                Storage::delete($event->event_picture);
            }

            // Unggah file event_picture baru
            $file = $request->file('event_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/event_pictures', $filename);

            $event->event_picture = $path;
        }

        $event->update($request->except('event_picture'));

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event not found');
        }

        // Hapus event_picture sebelum menghapus record dari database
        if ($event->event_picture) {
            Storage::delete($event->event_picture);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
