<?php

namespace App\Http\Controllers;

use App\Models\Users; // Ensure the correct User model is used
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
        
        $name = $request->name;

        $user = new Users();
        $user->name = $name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
            
        $otp = Users::generateOTP();
        $user->otp = $otp;
        $user->otp_sent_at = Carbon::now();
        $user->save();
            
        $details = [
            'title' => 'Mail from ticketify.id',
            'body' => 'Berikut Kode OTP untuk verifikasi email anda',
            'otp' => $otp,
            'name' => $name,
        ];
        
        Mail::to($user->email)->send(new \App\Mail\VerificationCodeMail($details));
        
        session(['email' => $user->email]);
        
        return redirect()->route('auth.verify.form')->with('email', $user->email);
    }

    public function showVerifyForm(Request $request)
    {
        return view('auth.page.verify');
    }

    public function resendOTP(Request $request)
    {
        $user = Users::where('email', $request->email)->first();

        if (!$user) {
            Alert::error('Gagal', 'User tidak ditemukan.');
            return back();
        }

        $lastSent = $user->otp_sent_at ? Carbon::parse($user->otp_sent_at) : null;
        $now = Carbon::now();

        if ($lastSent && $lastSent->diffInSeconds($now) < 60) {
            $waitTime = 60 - $lastSent->diffInSeconds($now);
            $waitTime = intval($waitTime);
            Alert::error('Gagal', 'Anda harus menunggu ' . $waitTime . ' detik sebelum mengirim ulang OTP.');
            return back();
        }

        $otp = Users::generateOTP();
        $user->otp = $otp;
        $user->otp_sent_at = $now;
        $user->save();

        $details = [
            'title' => 'Mail from ticketify.id',
            'body' => 'Berikut Kode OTP untuk verifikasi email anda',
            'otp' => $otp
        ];

        Mail::to($user->email)->send(new \App\Mail\VerificationCodeMail($details));

        Alert::success('Berhasil', 'Kode OTP baru telah dikirim.');
        return back();
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = Users::where('email', $request->email)->first();

        if (!$user) {
            Alert::error('Gagal', 'User tidak ditemukan.');
            return back();
        }

        if ($user->otp != $request->otp) {
            Alert::error('Gagal', 'OTP yang Anda masukkan salah.');
            return back();
        }

        $user->is_verified = true;
        $user->otp = null;
        $user->save();

        Alert::success('Berhasil', 'Verifikasi berhasil');
        Auth::login($user);
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

        $user = Users::where('email', $credentials['email'])->first();

        if (!$user) {
            Alert::error('Gagal', 'Email atau password salah.');
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        if (!$user->is_verified) {
            session(['email' => $user->email]); 
            return redirect()->route('auth.verify.form')->with('email', $user->email);
        }

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
