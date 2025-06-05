<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    #[Validate('required')]
    public $size = '';
    #[Validate('required')]
    public $quantity = 1;
    public $message = null;
    public $currentImage = null;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->currentImage = $product->images->first()->image ?? null;
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

    public function changeImage($imagePath)
    {
        $this->currentImage = $imagePath;
    }

    public function getCurrentImageUrl()
    {
        if (!$this->currentImage) {
            return '';
        }
        
        return Storage::disk('s3')->url($this->currentImage);
    }

    public function getSimilarProducts()
    {
       
        $currentProductTags = $this->product->tags->pluck('name');
        $tags = Tag::whereIn('name', $currentProductTags)->get();
        $products = Product::with('images')->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('id', $tags->pluck('id'));
        })
        ->where('id', '!=', $this->product->id)
        ->limit(4)->get();
        return $products;
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
