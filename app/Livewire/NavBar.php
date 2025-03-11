<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class NavBar extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cartUpdated')]
    public function updatedCart()
    {
        $this->updateCartCount();
    }

    private function updateCartCount()
    {
        if (Auth::check()) {

            $this->cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            
        } else {
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
