<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserEditorController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->users_id . ',users_id',
            'password' => 'sometimes|required|min:8',
            'birth_date' => 'nullable|date',
            'gender' => 'sometimes|required|in:Male,Female',
            'phone_number' => 'nullable|string',
            'role' => 'sometimes|required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->password)]);
        }

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }
}
