<?php

namespace App\Http\Controllers;

use App\Models\Users; // Ensure the correct User model is used
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.page.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Registrasi gagal, silakan cek kembali data yang Anda masukkan.');
            return back()->withErrors($validator)->withInput();
        }

        $users_id = (string) Str::uuid();

        $user = new Users(); 
        $user->users_id = $users_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        Alert::success('Hore!', 'Register berhasil');
        return redirect()->route('index');
    }

    public function showLoginForm()
    {
        return view('auth.page.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Login gagal, silakan cek kembali data yang Anda masukkan.');
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Alert::success('Hore!', 'Login berhasil');
            return redirect()->route('index');
        }

        Alert::error('Gagal', 'Email atau password salah.');
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Alert::success('Berhasil', 'Anda telah logout.');
        return redirect()->route('auth.login');
    }
}
