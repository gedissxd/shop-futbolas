<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartItem extends Component
{
    public $carts;

    public function increment($id)
    {
        $cart = Cart::find($id);
        $cart->quantity++;
        $cart->save();
        $this->dispatch('cartUpdated');
    }
    public function decrement($id)
    {
        $cart = Cart::find($id);
        if ($cart->quantity > 1) {
            
            $cart->quantity--;
            $cart->save();
        }
        $this->dispatch('cartUpdated');
    }
    public function getCartTotal()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
    }
    

    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        $this->carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('livewire.cart-item', [
            'carts' => $this->carts
        ]);
    }
}
