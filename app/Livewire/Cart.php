<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart as CartModel;

class Cart extends Component
{
    public function render()
    {
        $carts = CartModel::where('user_id', Auth::id())->with('product')->get();
        return view('livewire.cart', compact('carts'));
    }
}
