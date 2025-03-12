<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
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
            ],
        ]);
        
        return redirect($checkout->url);
    }
    
    public function success(Request $request)
    {
        
        $user = auth()->user();
        Cart::where('user_id', $user->id)->delete();
        
        return view('checkout.success');
    }
}
