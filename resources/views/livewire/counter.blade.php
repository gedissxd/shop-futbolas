<?php

use Livewire\Volt\Component;
use App\Models\Cart;

new class extends Component {
    public $count = Cart::count();

    public function increment()
    {
        $this->count = Cart::count();
    }
    
}; ?>

<div>
    <button wire:click="increment">Increment</button>
    <p>Count: {{ $count }}</p>
</div>
