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
    public $selectedVariantId = null; // To store the ID of the selected variant
    public $quantity = 1;
    public $message = null;
    public $currentImage = null;

    public function mount(Product $product)
    {
        $this->product = $product->load('variants', 'images'); // Eager load variants and images
        $this->currentImage = $this->product->images->first()->image ?? null;
        // Optionally, preselect the first variant if available
        if ($this->product->variants->isNotEmpty()) {
            // $this->selectedVariantId = $this->product->variants->first()->id;
        }
    }

    public function setSelectedVariant($variantId)
    {
        $this->selectedVariantId = $variantId;
        $this->message = null; // Clear previous messages
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $this->validate([
            'selectedVariantId' => 'required',
        ], [
            'selectedVariantId.required' => 'Please select a variant.',
        ]);

        $selectedVariant = $this->product->variants->find($this->selectedVariantId);

        if (!$selectedVariant) {
            $this->message = 'Selected variant not found.';
            return;
        }

        if ($selectedVariant->stock < $this->quantity) {
            $this->message = "Not enough stock for {$selectedVariant->name}. Only {$selectedVariant->stock} items left.";
            return;
        }

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->where('variant_id', $this->selectedVariantId) // Assuming you add/rename a variant_id column in carts
            ->first();

        if ($existingCartItem) {
            if ($existingCartItem->quantity + $this->quantity > $selectedVariant->stock) {
                $this->message = "Not enough stock for {$selectedVariant->name} in cart. Only {$selectedVariant->stock} items total.";
                return;
            }
            $existingCartItem->increment('quantity', $this->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'variant_id' => $this->selectedVariantId, // Store variant_id
                'quantity' => $this->quantity,
                // 'size' => $selectedVariant->name, // Or store variant name if preferred over ID for display
            ]);
        }

        // Reload product and variants to reflect any stock changes if you were managing them here.
        // $this->product->load('variants');

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

    public function getSelectedVariantProperty()
    {
        if ($this->selectedVariantId) {
            return $this->product->variants->find($this->selectedVariantId);
        }
        return null;
    }

    public function getSimilarProducts()
    {
       
        $currentProductTags = $this->product->tags->pluck('name');
        // Ensure tags are loaded if not already
        if (!$this->product->relationLoaded('tags')) {
            $this->product->load('tags');
        }
        $tags = Tag::whereIn('name', $currentProductTags)->get(); // This could be simplified if tags table is small
        $products = Product::with('images', 'variants')->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('tags.id', $tags->pluck('id')); // Ensure distinct or group if product has multiple matching tags
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
