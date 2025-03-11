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
    public $debug = '';

    public function mount($product)
    {
        $this->product = $product;
        $this->debug = 'Component mounted via standard Livewire';
    }

    public function incrementQuantity()
    {
        $this->quantity++;
        $this->debug = 'Quantity incremented to ' . $this->quantity;
    }

    public function addToCart()
    {
        $this->debug = 'addToCart method called at ' . now();
        
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
        session()->flash('message', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
