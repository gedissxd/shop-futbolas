<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $price;
    public $description;
    public $image;

    public function save() 
    {
        $product = Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image
        ]);
 
        $this->dispatch('productCreated');

        
        session()->flash('message', 'Product created successfully!');
        
        return redirect()->to('/dashboard');
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
