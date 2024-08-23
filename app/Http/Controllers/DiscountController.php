<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index () {
        $discounts = Discount::with('event', 'ticket')->get();

        return view('admin.page.discount', compact('discounts'));
    }
}
