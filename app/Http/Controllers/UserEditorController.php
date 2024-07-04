<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users; 
use RealRashid\SweetAlert\Facades\Alert; 

class UserEditorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('landing.pages.users.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Users::find(Auth::id());

        if (!$user) {
            Alert::error('Error', 'User not found.');
            return redirect()->back();
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date_format:m-d-Y',
            'gender' => 'nullable|in:Male,Female',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->birth_date = $request->birth_date ? \Carbon\Carbon::createFromFormat('m-d-Y', $request->birth_date)->format('Y-m-d') : null;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->save();

        Alert::success('Success', 'Profile updated successfully.');
        return redirect()->back();
    }
}
