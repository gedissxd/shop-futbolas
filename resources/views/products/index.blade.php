<x-layout title="Shop">

<div class="flex justify-end mt-5 mr-16">
    <flux:dropdown >
    <flux:button icon:trailing="chevron-down">Sort by</flux:button>
    <flux:menu>
        <flux:menu.radio.group wire:model="sortBy">
            <flux:menu.radio checked>Latest activity</flux:menu.radio>
            <flux:menu.radio>Date created</flux:menu.radio>
            <flux:menu.radio>Most popular</flux:menu.radio>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:grid-cols-4 lg:grid-cols-3 justify-center mx-auto mb-10 p-16"> 
        @foreach ($products as $product)
            <div x-data="{ shown: false }" 
                 x-intersect="shown = true"
                 :class="{ 'opacity-0 translate-y-8': !shown, 'opacity-100 translate-y-0': shown }"
                 class="transition-all duration-700 ease-in-out">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
</x-layout>

