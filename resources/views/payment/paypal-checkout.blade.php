<x-app-layout>
    <div class="container py-4 md:px-6 lg:px-8">
        <x-widgets.breadcrumbs title="Complete Payment" :links="[]" />
        <div class="w-full mt-4 p-8 rounded-md bg-white dark:bg-gray-800 dark:text-white">

            <div class="container w-full max-w-2xl">
                <div class="mb-6">
                    <span class="block mb-4 uppercase text-gray-600">Complete Payment</span>
                    <h1 class="text-2xl font-bold mb-2">Order #{{ $order->id }}</h1>
                    <span class="text-lg block mb-4">$ {{ $order->total_amount }}</span>

                    <div class="px-4 border-l-2 border-primary">
                        <span class="block mb-4 uppercase text-gray-600 text-sm">Products</span>
                        <ul class="block text-start">
                            @foreach ($order->products as $product)
                                <li class="block mb-2 text-start">
                                    {{ $product['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="paypal-button-container"></div>
            </div>




        </div>
    </div>


    @push('scripts')
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.live.client_id') }}&currency=USD"></script>

        <script>
            const orderId = {{ $order->id ?? 'null' }};

            paypal.Buttons({
                createOrder: function() {
                    return fetch('/payment/paypal/create-order', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: orderId
                            })
                        })
                        .then(response => response.json())
                        .then(data => data.id);
                },
                onApprove: function(data) {
                    return fetch('/payment/paypal/success', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                paypal_order_id: data.orderID
                            })
                        })
                        .then(response => response.json())
                        .then(() => {
                            window.location.href = "/payment/success";
                        });
                },
                onError: function(err) {
                    console.error(err);
                    alert('An error occurred during payment.');
                }
            }).render('#paypal-button-container');
        </script>
    @endpush

</x-app-layout>
