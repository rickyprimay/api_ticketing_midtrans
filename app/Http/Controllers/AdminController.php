<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Events;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    
    public function ticket()
    {
        return view('admin.page.ticket');
    }
    
    public function event()
    {
        $events = Events::where('users_id', Auth::id())->get();
        return view('admin.page.event', compact('events'));
    }

    public function update(Request $request, $id)
{
    try {
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


        // dd($validatedData['event_ended']);   
        // Temukan dan perbarui data event
        $event = Events::findOrFail($id);
        $event->update($validatedData);

        // dd($event);


        Alert::success('Berhasil', 'Event telah terupdate.');
        return redirect()->route('admin.event')->with('success', 'Event updated successfully.');
    } catch (\Throwable $th) {
        dd($th);
    }
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
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
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
            return redirect()->back()->with('error', 'Failed to create event. ' . $e->getMessage())->withInput();
        }
    }
}
