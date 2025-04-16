<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
class OrderController extends Controller
{
    public function index()
    {
      
        $orders = Order::latest()->get();
      
        return view('dashboard.orders', compact( 'orders'));
    }

}
