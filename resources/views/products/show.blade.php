<x-layout title="{{ $product->name }}">
    <flux:breadcrumbs class="mt-5 ml-8">
        <flux:breadcrumbs.item href="{{ route('products') }}" wire:navigate separator="slash">{{ __('Shop') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item separator="slash">{{ $product->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <livewire:add-to-cart :product="$product" />
</x-layout>