@component('mail::message')
# Order #{{ $order->id }} Confirmed

Thank you for your order! We're pleased to confirm that your order has been received and is being processed.

@component('mail::panel')
## Order Summary
@foreach($order->items as $item)
{{ $item->product_name }}<br>
Quantity: {{ $item->quantity }}<br>
Size: {{ $item->size }}<br>

@endforeach

@endcomponent

## Next Steps
* We'll send you another email when your order ships

If you have any questions about your order, please don't hesitate to contact our customer service team.

@endcomponent
