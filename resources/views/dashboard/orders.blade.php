<x-layouts.app title="Orders">

    <div class="text-xl font-bold mb-4">Completed orders</div>

    @foreach ($orders as $order)
        <div class="mb-8 pb-4 border p-4 rounded-lg border-yellow-300">
            <h2 class="text-xl font-bold mb-4">Order: #{{ $order->id }} - {{ $order->created_at->format('Y-m-d H:i') }}</h2>
            <div class="mb-2">Customer: {{ $order->name }} ({{ $order->email }})</div>
            <div class="mb-2">Phone: {{ $order->phone }}</div>
            <div class="mb-2">Pickup: {{ $order->terminal }}</div>
            <div class="mb-2">Status: <span class="text-green-500">{{ $order->status }}</span></div>
            
            <div class="mt-4 pt-4 border-t border-zinc-700">
                <h3 class="font-medium mb-3">Items:</h3>
                
                @foreach ($order->items as $item)
                    <div class="border-b border-zinc-600 pb-3 mb-3 last:border-0 last:mb-0 last:pb-0">
                        <div class="flex justify-between">
                            <div>
                                <span class="font-medium">{{ $item['product_name'] }}</span>
                                <div class="text-sm text-zinc-400">Size: {{ $item['size'] }}</div>
                                <div class="text-sm text-zinc-400">Quantity: {{ $item['quantity'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-layouts.app>    

