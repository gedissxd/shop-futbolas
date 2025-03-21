<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Terminal;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class CheckoutController extends Controller
{
    
    public function checkout(Request $request)
    {

        $validated = $request->validate([
            'phone' => 'required|phone:LT',
        ]);

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        
        // Check if all cart items have enough stock
        foreach ($carts as $cartItem) {
            if ($cartItem->quantity > $cartItem->product->stock) {
                return redirect()->route('cart')->with('error', 
                    "Sorry, '{$cartItem->product->name}' doesn't have enough stock. Only {$cartItem->product->stock} available.");
            }
        }
        
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

        // Start a database transaction to ensure stock reduction and order creation happen together
        DB::beginTransaction();
        
        try {
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
                // Create order item
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $cartItem->product->name,
                    'size' => $cartItem->size,
                    'quantity' => $cartItem->quantity,
                ]);
                
                // Reduce stock
                $product = Product::find($cartItem->product->id);
                if ($product) {
                    $product->stock = max(0, $product->stock - $cartItem->quantity);
                    $product->save();
                }
            }
            
            Cart::where('user_id', $user->id)->delete();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception - log it and show an error message
            return redirect()->route('cart')->with('error', 'An error occurred while processing your order. Please try again.');
        }
        
        return view('checkout.success', compact('order'));
    }
}
