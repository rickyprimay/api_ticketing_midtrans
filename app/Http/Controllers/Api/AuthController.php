<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Generate UUID
        $users_id = (string) Str::uuid();

        // Create new user with UUID assigned
        $user = new Users();
        $user->users_id = $users_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // Save the user
        if ($user->save()) {
            // Generate JWT token
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'status_code' => 201,
                'user'    => $user,
                'token'   => $token,
                'token_type' => 'bearer',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'status_code' => 409,
            'message' => 'Failed to create account',
        ], 409);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah',
                'status_code' => 401,
            ], 401);
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'user'    => auth()->guard('api')->user(),    
            'token'   => $token,
            'token_type' => 'bearer',
        ], 200);
    }
    public function logout(Request $request)
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!',
                'status_code' => 200,
            ]);
        }
    }
}
