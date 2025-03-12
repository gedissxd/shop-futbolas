<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
class OrderController extends Controller
{
    public function index()
    {
        $cartItems = Cart::all();
        return view('dashboard.orders', compact('cartItems'));
    }
}
