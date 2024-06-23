<?php

namespace App\Http\Controllers\Api;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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
                'token'   => $token
            ], 201);           
        }

        return response()->json([
            'success' => false,
            'status_code' => 409,
        ], 409);
    }
}
