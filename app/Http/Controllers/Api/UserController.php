<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'users' => $users,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:Male,Female',
            'phone_number' => 'nullable|string',
            'role' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'status_code' => 201,
            'user' => $user,
        ], 201);
    }

    public function show($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $id . ',users_id',
            'password' => 'sometimes|required|min:8',
            'birth_date' => 'nullable|date',
            'gender' => 'sometimes|required|in:Male,Female',
            'phone_number' => 'nullable|string',
            'role' => 'sometimes|required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
