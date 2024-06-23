<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        $users = Users::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        if($users) {
            $token = JWTAuth::fromUser($users);

            return response()->json([
                'success' => true,
                'status_code' => 201,
                'user'    => $users,
                'token'   => $token,
                'token_type' => 'bearer',
            ], 201);           
        }

        return response()->json([
            'success' => false,
            'status_code' => 409,
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
