<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class ProductList extends Component
{
    public $products = [];
    public $sortBy = 'latest';

    public function mount()
    {
        $this->loadProducts();
    }

    #[On('sort-changed')]
    public function sortChanged($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->loadProducts();
    }
    #[Computed]
    private function loadProducts()
    {
        if ($this->sortBy === 'latest') {
            $this->products = Product::latest()->get();
        } elseif ($this->sortBy === 'oldest') {
            $this->products = Product::oldest()->get();
        } else {
            $this->products = Product::all();
        }
    }

    public function render()
    {
        return view('livewire.product-list');
    }
} 