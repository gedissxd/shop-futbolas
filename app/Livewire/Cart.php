<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public function increment($id)
    {
        $cart = CartModel::find($id);
        $cart->quantity++;
        $cart->save();
        $this->dispatch('cartUpdated');
    }
    public function decrement($id)
    {
        $cart = CartModel::find($id);
        if ($cart->quantity > 1) {
            
            $cart->quantity--;
            $cart->save();
        }
        $this->dispatch('cartUpdated');
    }
    public function delete($id)
    {
        $cart = CartModel::find($id);
        $cart->delete();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        $carts = CartModel::where('user_id', Auth::id())->with('product')->get();
        return view('livewire.cart', compact('carts'));
    }
}
