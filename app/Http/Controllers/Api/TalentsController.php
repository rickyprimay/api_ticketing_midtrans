<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Talents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TalentsController extends Controller
{
    public function index()
    {
        $talents = Talents::all();
        $params = ['message' => 'success', 'data' => $talents];
        return response()->json($params, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'talent_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'talent_description' => 'nullable|string',
            'event_id' => 'required|exists:events,event_id',
        ]);

        if ($request->hasFile('talent_image')) {
            $filePath = $request->file('talent_image')->store('talent', 'public');
            $validated['talent_image'] = $filePath;
        }

        $talent = Talents::create($validated);

        $params = ['message' => 'success', 'data' => $talent];
        return response()->json($params, 201);
    }

    public function show($id)
    {
        $talent = Talents::find($id);
        if (!$talent) {
            $params = ['message' => 'Talent not found'];
            return response()->json($params, 404);
        }

        $params = ['message' => 'success', 'data' => $talent];
        return response()->json($params, 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'talent_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'talent_description' => 'nullable|string',
            'event_id' => 'sometimes|required|exists:events,event_id',
        ]);

        $talent = Talents::find($id);
        if (!$talent) {
            $params = ['message' => 'Talent not found'];
            return response()->json($params, 404);
        }

        if ($request->hasFile('talent_image')) {
            if ($talent->talent_image) {
                Storage::disk('public')->delete($talent->talent_image);
            }
            $filePath = $request->file('talent_image')->store('talent', 'public');
            $talent->talent_image = $filePath;
        }

        $talent->name = $request->get('name', $talent->name);
        $talent->talent_description = $request->get('talent_description', $talent->talent_description);
        $talent->event_id = $request->get('event_id', $talent->event_id);

        $talent->save();

        $params = ['message' => 'success', 'data' => $talent];
        return response()->json($params, 200);
    }

    public function destroy($id)
    {
        $talent = Talents::find($id);
        if (!$talent) {
            $params = ['message' => 'Talent not found'];
            return response()->json($params, 404);
        }

        if ($talent->talent_image) {
            Storage::disk('public')->delete($talent->talent_image);
        }

        $talent->delete();

        $params = ['message' => 'success'];
        return response()->json($params, 200);
    }
}
