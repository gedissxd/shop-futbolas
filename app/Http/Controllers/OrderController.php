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
        $cartItems = Cart::all();
        $orders = Order::all();
        $orderItems = OrderItem::all();
        return view('dashboard.orders', compact('cartItems', 'orders', 'orderItems'));
    }
}
