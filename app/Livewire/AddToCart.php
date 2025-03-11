<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $size = '';
    public $quantity = 1;
    public $message = null;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
    
        $this->validate([
            'size' => 'required',
        ], [
            'size.required' => 'Please select a size before adding to cart',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->where('size', $this->size)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity', $this->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'size' => $this->size,
            ]);
        }

        $this->dispatch('cartUpdated');
        $this->message = 'Item added to cart';
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
