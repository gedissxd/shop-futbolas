<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartItem extends Component
{
    public $carts = [];

    public function mount()
    {
        $this->refreshCart();
    }

    private function refreshCart()
    {
        $this->carts = Cart::where('user_id', auth()->id())->with('product.images')->get();
    }


    public function increment($id)
    {
        $cart = Cart::with('product')->find($id);

        if (!$cart) {
            return;
        }

        if ($cart->quantity + 1 > $cart->product->stock) {
            session()->flash('error', __('Cannot add more of :product, only :stock available', ['product' => $cart->product->name, 'stock' => $cart->product->stock]));
            return;
        }

        $cart->quantity++;
        $cart->save();

        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function decrement($id)
    {
        $cart = Cart::with('product')->find($id);

        if (!$cart) {
            return;
        }

        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
            $this->refreshCart();
        }
        $this->dispatch('cartUpdated');
    }

    public function getCartTotal()
    {
        return $this->carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
    }
   

    public function delete($id)
    {
        $cart = $this->carts->firstWhere('id', $id);

        if (!$cart) {
            return;
        }

        $cart->delete();
        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

}
