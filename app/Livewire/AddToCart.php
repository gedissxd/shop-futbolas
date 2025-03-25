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
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        if ($this->product->stock <= 0) {
            $this->message = 'This product is out of stock';
            return;
        }
    
        $this->validate([
            'size' => 'required',
        ], [
            'size.required' => 'Please select a size before adding to cart',
        ]);

       

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->where('size', $this->size)
            ->first();

        $totalQuantity = $this->quantity;
        if ($existingCartItem) {
            $totalQuantity += $existingCartItem->quantity;
        }

        
        if ($totalQuantity > $this->product->stock) {
            $this->message = "Not enough stock available. Only {$this->product->stock} items left.";
            return;
        }

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

        $this->product = Product::find($this->product->id);
        
        $this->dispatch('cartUpdated');
        $this->message = 'Item added to cart';
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
