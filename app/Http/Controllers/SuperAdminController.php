<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = Users::where('role', 0)->get();
        $committee = Users::where('role', 1)->get();
        $admin = Users::where('role', 2)->get();
        $event = Events::all();

        $totalUsers = $users->count();
        $totalCommittee = $committee->count();
        $totalAdmin = $admin->count();
        $totalEvent = $event->count();

        return view('superadmin.index', compact('totalUsers', 'totalCommittee', 'totalAdmin', 'totalEvent'));
    }
    public function user()
    {
        $users = Users::where('role', 0)->get();

        return view ('superadmin.page.user', compact('users'));
    }
    public function committee()
    {
        $committees = Users::where('role', 1)->get();

        return view ('superadmin.page.comitee', compact('committees'));
    }
    public function storeCommittee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Pembuatan panitia gagal, silahkan cek kembali data yang Anda masukkan.');
            return back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $user = new Users();
        $user->name = $name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 1;
        $user->is_verified = true;
        $user->save();

        Alert::success('Sukses', 'Data Panitia berhasil ditambahkan');
        return redirect()->back();
    }
    public function destroyCommittee($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        Alert::success('Sukses', 'Panitia berhasil dihapus.')->persistent(true);
        return redirect()->back();
    }
    public function admin()
    {
        $admins = Users::where('role', 2)->get();

        return view('superadmin.page.admin', compact('admins'));
    }
    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Pembuatan Admin gagal, silahkan cek kembali data yang Anda masukkan.');
            return back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $user = new Users();
        $user->name = $name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 2;
        $user->is_verified = true;
        $user->save();

        Alert::success('Sukses', 'Data Admin berhasil ditambahkan');
        return redirect()->back();
    }
    public function event()
    {
        $event = Events::all();
        return view('superadmin.page.event', com);
    }

}
