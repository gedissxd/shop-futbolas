<?php

use Livewire\Volt\Component;

new class extends Component {
    public $sortBy = 'latest';

    public function updatedSortBy() 
    {   
        $this->dispatch('sort-changed', $this->sortBy);
    }
}; ?>

<div>
    <div class="flex justify-end mt-5 mr-16">
        <flux:dropdown >
        <flux:button>Sort by</flux:button>
        <flux:menu>
            <flux:menu.radio.group wire:model.live="sortBy">
                <flux:menu.radio value="latest">Latest</flux:menu.radio>
                <flux:menu.radio value="oldest">Oldest</flux:menu.radio>
            </flux:menu.radio.group>
        </flux:menu>
    </flux:dropdown>
</div>
</div>
