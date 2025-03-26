<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Terminal;
use Livewire\Attributes\On;

class CartItem extends Component
{
    public $carts = [];
    public $terminals = [];
    public $pickupMethod = 'shop';


    public function mount()
    {
        $userId = auth()->id();
        $this->refreshCart();
        
        $this->terminals = Terminal::all();
        $this->pickupMethod = request()->input('pickupMethod', 'shop');

    }

    private function refreshCart()
    {
        $this->carts = Cart::where('user_id', auth()->id())->with('product')->get();
    }

    #[On('cartUpdated')]
    public function refreshCartData()
    {
        $this->refreshCart();
    }

    public function increment($id)
    {
        $cart = Cart::find($id);
        
        if (!$cart) {
            return;
        }
        
        if ($this->carts->sum('quantity') >= $this->carts->sum('product.stock')) {  
            session()->flash('error', 'You have reached the maximum stock limit');
            return;
        }
        
        $cart->increment('quantity');
        $this->dispatch('cartUpdated');
    }
    
    public function decrement($id)
    {
        $cart = Cart::find($id);
        
        if (!$cart) {
            return;
        }
        
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        }
        
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
        return Terminal::orderBy('city')->get(['id', 'city', 'name', 'address']);

    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        
        if (!$cart) {
            return;
        }
        
        $cart->delete();
        $this->dispatch('cartUpdated');
    }

    public function setPickupMethod($method)
    {
        $this->pickupMethod = $method;
        session(['pickupMethod' => $method]);
        return $this->pickupMethod;
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
