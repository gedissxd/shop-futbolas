<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Terminal;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;

class CheckoutController extends Controller
{
    
    public function checkout(Request $request)
    {
        
            $validated = $request->validate([
                
                'phone' => 'required|phone:LT',
                'pickupMethod' => 'required|in:shop,terminal,omniva',
            ]);

            if ($request->pickupMethod === 'terminal' && !$request->has('terminal_id')) {
                return redirect()->route('cart')->with('error', 'Please select a terminal for pickup.');
            }

            if ($request->pickupMethod === 'omniva' && !$request->has('terminal_id')) {
                return redirect()->route('cart')->with('error', 'Please select a terminal for pickup.');
            }

            $user = auth()->user();
            $carts = Cart::where('user_id', $user->id)->with('product')->get();
            
            // Check if cart is empty
            if ($carts->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Your cart is empty.');
            }
            
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
            
            
            $checkout = $user->allowPromotionCodes()->checkout($lineItems, 
            [
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart'),
                'metadata' => [
                    'user_id' => $user->id,
                    'phone' => $request->phone,
                    'pickup_method' => $request->pickupMethod,
                    'terminal_id' => $request->terminal_id ?? null,
                ],
            ]);
            
            return redirect($checkout->url);
    }
    
    public function success(Request $request)
    {
        $user = auth()->user();
        
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('cart')->with('error', 'Invalid checkout session.');
        }

        $checkout = $user->stripe()->checkout->sessions->retrieve($sessionId);
        $paymentIntentId = $checkout->payment_intent;

        // Check if an order with this payment intent already exists
        $existingOrder = Order::where('payment_intent_id', $paymentIntentId)->first();
        if ($existingOrder) {
            return view('checkout.success', compact('existingOrder'));
        }

        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        
        // Get terminal details if necessary
        $terminal = null;
        if ($checkout->metadata->pickup_method === 'terminal' && $checkout->metadata->terminal_id) {
            $terminalData = Terminal::find($checkout->metadata->terminal_id);
            if ($terminalData) {
                $terminal = $terminalData->city . ': ' . $terminalData->address . ' ' . $terminalData->name;
            }
        }
        
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $checkout->metadata->phone ?? '',
            'payment' => 'stripe',
            'status' => 'paid',
            'terminal' => $terminal ?? $checkout->metadata->terminal_id ?? '',
            'pickup_method' => $checkout->metadata->pickup_method ?? 'shop',
            'payment_intent_id' => $paymentIntentId,
        ]);

        foreach ($carts as $cartItem) {
            // Create order item
            OrderItem::create([
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
        Mail::to($user->email)->queue(new OrderConfirmed($order));

        return view('checkout.success', compact('order'));
    }
}
