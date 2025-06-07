<x-layout title="{{ $product->name }}">
    <flux:breadcrumbs class="max-w-[1210px] mx-auto mt-4">
        <flux:breadcrumbs.item href="{{ route('home') }}">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('products') }}">{{ __('Shop') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $product->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <livewire:add-to-cart :product="$product" />
</x-layout>