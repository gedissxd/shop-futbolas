<?php

use Livewire\Volt\Component;


new class extends Component {

public $language = 'en';

public function mount()
{
    $this->language = session()->get('locale', 'en');
}

public function submit()
{
    session()->put('locale', $this->language);
    return redirect()->route('home');
}

};?>
<div>
<flux:dropdown>
    <flux:button variant="ghost">{{ __(strtoupper($language)) }}</flux:button>

    <flux:menu class="mt-8">
        <flux:radio.group wire:model="language" class="mt-2">
            <flux:radio value="en" label="{{ __('English') }}" checked />
            <flux:radio value="lt" label="{{ __('Lithuanian') }}" />
        </flux:radio.group>
        <flux:button class="mt-4" variant="primary" wire:click="submit" >{{ __('Save') }}</flux:button>
    </flux:menu>
</flux:dropdown>
</div>