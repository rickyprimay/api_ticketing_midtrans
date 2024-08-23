<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use App\Models\Events;
use App\Models\Tickets;

class DiscountController extends Controller
{
    public function index () {
        $discounts = Discount::with('event', 'ticket')->get();
        $events = Events::where('users_id', Auth::id())->get();

        return view('admin.page.discount', compact('discounts', 'events'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'ticket_id' => 'required|exists:tickets,ticket_id',
            'total_discount' => 'required|integer|min:0',
            'code' => 'required|string|max:255',
            'used' => 'required|integer|min:0',
        ]);

        Discount::create([
            'event_id' => $validated['event_id'],
            'ticket_id' => $validated['ticket_id'],
            'total_discount' => $validated['total_discount'],
            'code' => $validated['code'],
            'used' => $validated['used'],
        ]);

        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil dibuat.');
    }
    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'ticket_id' => 'required|exists:tickets,ticket_id',
            'total_discount' => 'required|integer|min:0',
            'code' => 'required|string|max:255',
            'used' => 'required|integer|min:0',
        ]);

        $discount = Discount::findOrFail($id);

        $discount->update([
            'event_id' => $validatedData['event_id'],
            'ticket_id' => $validatedData['ticket_id'],
            'total_discount' => $validatedData['total_discount'],
            'code' => $validatedData['code'],
            'used' => $validatedData['used'],
        ]);

        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
    
        // Hapus diskon
        $discount->delete();
    
        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil dihapus.');
    }
    public function getTicketsByEvent($eventId)
    {
        $tickets = Tickets::where('events_id', $eventId)->get();
        return response()->json($tickets);
    }
}
