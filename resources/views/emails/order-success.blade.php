<p>Dear {{ $order->customer_name }},</p>

<p>Thank You for Your Purchase!</p>

<p>Your order ID is: #{{ $order->id }}</p>
<p>You can download your products using the links below:</p>
<ul>
    @foreach ($order->products as $product)
        <li>
            <a
                href="{{ URL::route('download.link', ['orderId' => $order->id, 'productId' => $product['product_id']]) }}">
                {{ $product['name'] }}
            </a>
        </li>
    @endforeach
</ul>


<p>
    We appreciate your order. If you are having troubles with the direct download link, feel free to reach out via
    WhatsApp at +1
    (564) 544-6478 or reply directly to this email.
</p>

<p>Thank you for choosing us!</p>
<p>Yours, RN Student Resources</p>
