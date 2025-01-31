<x-app-layout>

    <div class="container pt-4 md:px-6 lg:px-8">
        <x-widgets.breadcrumbs title="Checkout" :links="[['title' => 'Cart', 'slug' => '/cart']]" />
        <div class="w-full mt-4 p-8 rounded-md bg-white dark:bg-gray-800 dark:text-white">
            <div class="max-w-2xl mx-auto bg-gray-200 dark:bg-gray-700 mb-6 dark:text-white rounded-md p-4">
                <h2 class="dark:text-white mb-4 uppercase text-gray-600">Order Summary</h2>

                <div class="w-full">
                    <div class="flex items-center justify-between py-3 border-b last:border-b-0 dark:border-b-gray-700">
                        <span>Subtotal</span>
                        <span>$ {{ number_format($total_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b last:border-b-0 dark:border-b-gray-700">
                        <span>Shipping</span>
                        <span>$ 0.00</span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b last:border-b-0 dark:border-b-gray-700">
                        <span>Discount</span>
                        <span>$ 0.00</span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b last:border-b-0 dark:border-b-gray-700">
                        <b>Total</b>
                        <span>$ {{ number_format($total_amount, 2) }}</span>
                    </div>
                </div>


            </div>

            <div class="px-4 border-l-2 border-primary mb-6 max-w-2xl mx-auto">
                <span class="block mb-4 uppercase text-gray-600 text-sm">Products</span>
                <ul class="block text-start">
                    @foreach ($products as $product)
                        <li class="block mb-2 text-start">
                            {{ $product['name'] }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <form class="max-w-2xl mx-auto flex flex-col gap-2" action="{{ route('process.payment') }}" method="POST">
                @csrf
                <label for="name">Name</label>
                <input class="w-full dark:bg-gray-900 mb-4 rounded disabled:border-transparent" type="text"
                    id="name" name="name" required @auth
value="{{ auth()->user()->name }}" disabled @endauth>

                <label for="email">Email</label>
                <input class="w-full dark:bg-gray-900 mb-4 rounded disabled:border-transparent" type="email"
                    id="email" name="email" required @auth
value="{{ auth()->user()->email }}" disabled @endauth>

                <label for="phone">Phone (Optional)</label>
                <input class="w-full dark:bg-gray-900 rounded" type="text" id="phone" name="phone">
                <div class="hidden">
                    <label for="payment_method">Payment Method</label>
                    <label
                        class="flex p-3 rounded items-center gap-4 border has-[:checked]:bg-blue-100 has-[:checked]:ring-2 ring-blue-600 hover:border-blue-600">
                        <img src="/img/icons/credit-card.png" alt="" class="h-4 w-auto">
                        <span>Credit/Debit Card</span>
                        <div class="flex-grow"></div>
                        <input type="radio" name="payment_method" id="stripe" value="stripe">
                    </label>
                    <label
                        class="flex p-3 rounded items-center gap-4 border has-[:checked]:bg-blue-100 has-[:checked]:ring-2 ring-blue-600 hover:border-blue-600">
                        <img src="/img/icons/paypal.png" alt="" class="h-4 w-auto">
                        <span>Paypal</span>
                        <div class="flex-grow"></div>
                        <input type="radio" checked name="payment_method" id="paypal" value="paypal">
                    </label>
                </div>

                <label class="flex gap-2 items-center my-4">
                    <x-input id="accepted_terms" type="checkbox" class="mt-1" required /> I have read and accepted the
                    T&Cs
                </label>


                <button type="submit" class="block bg-primary text-white px-6 py-3 rounded-md">Pay</button>
            </form>
        </div>


    </div>
    <x-home.benefits />

    @push('head')
        <script src="https://js.stripe.com/v3"></script>

        <script>
            document.addEventListener('DOMContentLoaded', async () => {
                // Load the publishable key from the server. The publishable key
                // is set in your .env file.

                const stripe = Stripe('{{ config('services.stripe.public_key') }}', {
                    apiVersion: '2020-08-27',
                });

                const elements = stripe.elements();
                const card = elements.create('card');
                card.mount('#card-element');


            });
        </script>
    @endpush
</x-app-layout>
