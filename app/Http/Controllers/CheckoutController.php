<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Terminal;
use App\Models\OrderItem;
use App\Models\Order;
class CheckoutController extends Controller
{
    
    public function checkout(Request $request)
    {

        $validated = $request->validate([
            'phone' => 'required|phone:LT',
        ]);

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        
        
        $lineItems = [];
        
        foreach ($carts as $cartItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $cartItem->product->name . ' (' . $cartItem->size . ')',
                    ],
                    'unit_amount' => $cartItem->product->price * 100,
                ],
                'quantity' => $cartItem->quantity,
            ];
        }
        
        
        $checkout = $user->checkout($lineItems, 
        [
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart'),
            'metadata' => [
                'user_id' => $user->id,
                'phone' => $request->phone,
                'pickup_method' => $request->pickupMethod,
                'terminal_id' => $request->pickupMethod === 'terminal' ? $request->terminal_id : null,
            ],
        ]);
        
        return redirect($checkout->url);
    }
    
    public function success(Request $request)
    {
        $user = auth()->user();
        

        $sessionId = $request->get('session_id');
        $checkout = $user->stripe()->checkout->sessions->retrieve($sessionId);

        $carts = Cart::where('user_id', $user->id)->with('product')->get();

    

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $checkout->metadata->phone ?? '',
            'payment' => 'stripe',
            'status' => 'paid',
            'terminal' => $checkout->metadata->terminal_id ?? '',
            'pickup_method' => $checkout->metadata->pickup_method ?? '',
        ]);
        
        
        foreach ($carts as $cartItem) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $cartItem->product->name,
                'size' => $cartItem->size,
                'quantity' => $cartItem->quantity,
            ]);
        }
        
        Cart::where('user_id', $user->id)->delete();
        
        return view('checkout.success', compact('order'));
    }
}
