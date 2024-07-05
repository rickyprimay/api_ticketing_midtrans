<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function ticket()
    {
        return view('admin.page.ticket');
    }
    public function event()
    {
        return view('admin.page.event');
    }
}
