<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Users;
use Illuminate\Http\Request;

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
}
