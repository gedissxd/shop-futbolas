<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateProduct extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $price;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $image;

    public function save() 
    {
        $this->validate();
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
