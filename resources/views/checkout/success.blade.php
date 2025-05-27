<x-layout>
    <div class="mx-auto p-6 text-white w-full md:w-3/4 mt-12 mb-20">
        <div class="bg-zinc-800 p-8 rounded-lg shadow-sm text-center">
            <flux:icon.check-circle class="w-16 h-16 mx-auto text-green-400 mb-4" />
            <h1 class="text-2xl font-bold mb-4">{{ __('Order Completed Successfully!') }}</h1>
            <p class="mb-6">{{ __('Order number:') }} #{{ isset($existingOrder) ? $existingOrder->id : $order->id }}</p>
            <flux:button href="{{ route('products') }}" variant="primary" wire:navigate>{{ __('Continue Shopping') }}</flux:button>
        </div>
    </div>
</x-layout>