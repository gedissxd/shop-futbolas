<?php

use Livewire\Volt\Component;
use App\Models\Order;

new class extends Component {
    public $orders = [];

    public function mount($orders)
    {
        $this->orders = $orders;
    }

    public function status($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        
        // Update the local state to reflect the change
        foreach ($this->orders as $key => $orderItem) {
            if ($orderItem->id === $id) {
                $this->orders[$key]->status = 'completed';
            }
        }
    }

}; ?>

<div>
    <div class="text-xl font-bold mb-4"> {{ __('Completed orders') }} </div>

    @foreach ($orders as $order)
        <div class="mb-8 pb-4 border p-4 rounded-lg border-yellow-300">
            <h2 class="text-xl font-bold mb-4">{{ __('Order') }}: #{{ $order->id }} - {{ $order->created_at->format('Y-m-d H:i') }}</h2>
            <div class="mb-2">{{ __('Customer') }}: {{ $order->name }} ({{ $order->email }})</div>
            <div class="mb-2">{{ __('Phone') }}: {{ $order->phone }}</div>
            <div class="mb-2">
                {{ __('Pickup Method') }}:
                @if($order->pickup_method == 'shop')
                    {{ __('Shop') }}
                @elseif($order->pickup_method == 'terminal')
                    {{ __('LP Express Terminal') }}
                @elseif($order->pickup_method == 'omniva')
                    {{ __('Omniva Terminal') }}
                @else
                    {{ $order->pickup_method ?? __('Not specified') }}
                @endif
            </div>
            @if ($order->pickup_method == 'terminal' || $order->pickup_method == 'omniva')
                <div class="mb-2">{{ __('Pickup Location') }}: {{ $order->terminal ?? __('Not specified') }}</div>
            @endif
            <div class="mb-2">{{ __('Status') }}: <span class="text-green-500">{{ __($order->status) }}</span></div>
            <flux:button wire:click="status({{ $order->id }})" wire:confirm="Are you sure you want to mark this order as completed?" :disabled="$order->status == 'completed'">{{ __('Send') }}</flux:button>

            <div class="mt-4 pt-4 border-t border-zinc-700">
                <h3 class="font-medium mb-3">{{ __('Items') }}:</h3>

                @foreach ($order->items as $item)
                    <div class="border-b border-zinc-600 pb-3 mb-3 last:border-0 last:mb-0 last:pb-0">
                        <div class="flex justify-between">
                            <div>
                                <span class="font-medium">{{ $item['product_name'] }}</span>
                                
                                <div class="text-sm text-zinc-400">{{ __('Size') }}: {{ $item['size'] }}</div>
                                <div class="text-sm text-zinc-400">{{ __('Quantity') }}: {{ $item['quantity'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    </div>
