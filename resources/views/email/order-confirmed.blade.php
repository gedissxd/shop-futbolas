@component('mail::message')
# Order #{{ $order->id }} Confirmed

Thank you for your order! We're pleased to confirm that your order has been received and is being processed.

@component('mail::panel')
## Order Summary
Product: {{ $order->items->product_name }}
Quantity: {{ $order->items->quantity }}
Size: {{ $order->items->size }}
Total: {{ $order->items->total }}
@endcomponent

## Next Steps
* We'll send you another email when your order ships
* You can track your order status in your account

If you have any questions about your order, please don't hesitate to contact our customer service team.


@endcomponent
