<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Terminal;

class CartItem extends Component
{
    public $carts = [];
    public $terminals = [];

    public function mount()
    {
        $userId = auth()->id();
        $this->refreshCart();
        
        $this->terminals = Terminal::all();
    }

    private function refreshCart()
    {
        $this->carts = Cart::where('user_id', auth()->id())->with('product')->get();
    }

    public function increment($id)
    {
        $cart = Cart::find($id)?->increment('quantity');
        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }
    public function decrement($id)
    {
        $cart = Cart::find($id);
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        }
        
        $this->refreshCart();
        $this->dispatch('cartUpdated');
      
    }
    public function getCartTotal()
    {
        return $this->carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
    }
    public function getTerminals()
    {
        $terminals = Terminal::orderBy('name')->get();
        return $terminals;
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        $this->dispatch('cartUpdated');
        $this->refreshCart();
    }

   
    public function render()
    {
        return view('livewire.cart-item');
    }
}
