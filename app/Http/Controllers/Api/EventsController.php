<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::all();
        return response()->json(['message' => 'success', 'data' => $events], 200);
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

            $eventData['event_picture'] = $path;
        }

        $event = Events::create($eventData);

        return response()->json(['message' => 'success', 'data' => $event], 201);
    }

    public function show($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json(['message' => 'success', 'data' => $event], 200);
    }

    public function update(Request $request, $id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
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

        return response()->json(['message' => 'success', 'data' => $event], 200);
    }

    public function destroy($id)
    {
        $event = Events::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Hapus event_picture sebelum menghapus record dari database
        if ($event->event_picture) {
            Storage::delete($event->event_picture);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted'], 200);
    }
}
