<?php

namespace App\Http\Controllers;

use App\Models\Talents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TalentController extends Controller
{
    public function index()
    {
        $talents = Talents::all();
        return view('talents.index', ['talents' => $talents]);
    }

    public function create()
    {
        return view('talents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'talent_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'talent_description' => 'nullable|string',
            'event_id' => 'required|exists:events,id',
        ]);

        if ($request->hasFile('talent_image')) {
            $filePath = $request->file('talent_image')->store('talent', 'public');
            $validated['talent_image'] = $filePath;
        }

        $talent = Talents::create($validated);

        return redirect()->route('talents.index')->with('success', 'Talent created successfully');
    }

    public function show($id)
    {
        $talent = Talents::find($id);
        if (!$talent) {
            return redirect()->route('talents.index')->with('error', 'Talent not found');
        }

        return view('talents.show', ['talent' => $talent]);
    }

    public function edit($id)
    {
        $talent = Talents::find($id);
        if (!$talent) {
            return redirect()->route('talents.index')->with('error', 'Talent not found');
        }

        return view('talents.edit', ['talent' => $talent]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'talent_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'talent_description' => 'nullable|string',
            'event_id' => 'sometimes|required|exists:events,id',
        ]);

        $talent = Talents::find($id);
        if (!$talent) {
            return redirect()->route('talents.index')->with('error', 'Talent not found');
        }

        if ($request->hasFile('talent_image')) {
            if ($talent->talent_image) {
                Storage::disk('public')->delete($talent->talent_image);
            }
            $filePath = $request->file('talent_image')->store('talent', 'public');
            $talent->talent_image = $filePath;
        }

        $talent->update($request->except('talent_image'));

        return redirect()->route('talents.index')->with('success', 'Talent updated successfully');
    }

    public function destroy($id)
    {
        $talent = Talents::find($id);
        if (!$talent) {
            return redirect()->route('talents.index')->with('error', 'Talent not found');
        }

        if ($talent->talent_image) {
            Storage::disk('public')->delete($talent->talent_image);
        }

        $talent->delete();

        return redirect()->route('talents.index')->with('success', 'Talent deleted successfully');
    }
}
