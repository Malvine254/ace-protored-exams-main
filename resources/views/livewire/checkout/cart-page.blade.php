<div class="max-w-7xl container md:px-6 lg:px-8">
    <x-widgets.seo-tags :data="[
        'title' => 'Cart',
        'description' => 'Checkout your products.',
        'image' => asset('images/logo.png'),
    ]" />
    <h1 class="my-6 text-3xl font-bold dark:text-white">
        Shopping Cart
    </h1>
    <div class="w-full grid md:grid-cols-[1fr_280px] gap-6 mb-6">
        <section class="w-full">
            <div class="bg-white dark:bg-gray-800 dark dark:text-white rounded-md pb-8">
                @if (count($cart['products']) > 0)
                    <table class="hidden md:block text-left w-full border-collapse ">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light dark:border-gray-700">
                                    Name</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light dark:border-gray-700">
                                    Amount</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light dark:border-gray-700 ">
                                    Price</th>
                                <th
                                    class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light dark:border-gray-700">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart['products'] as $product)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light dark:border-gray-700">
                                        <p class="truncate md:max-w-[400px]">{{ $product->name }}</p>
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light dark:border-gray-700">
                                        {{ $product->amount }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light dark:border-gray-700">
                                        {{ $product->price }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light dark:border-gray-700">
                                        <a wire:click="removeFromCart({{ $product->id }})"
                                            class="text-green-600 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark cursor-pointer">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="block md:hidden p-4">
                        @foreach ($cart['products'] as $item)
                            <li class="text-xs block py-6 border-b dark:border-b-gray-600">
                                <p class="mb-4">{{ $item->name }}</p>
                                <div class="flex gap-4 items-center">
                                    <span class="text-xs">$ {{ $item->price }}</span>
                                    <a wire:click="removeFromCart({{ $product->id }})"
                                        class="text-red-600 font-bold py-1 rounded text-xs bg-green hover:bg-green-dark cursor-pointer">Remove</a>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <x-widgets.empty title="Your cart is empty" />
                @endif
            </div>
        </section>

        <section class="w-full">
            <div class="bg-white dark:bg-gray-800 dark dark:text-white rounded-md p-4">
                <h2 class="dark:text-white mb-4">Order Summary</h2>

                <div class="mb-4">
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
                <button wire:click="checkout()"
                    class="bg-primary w-full hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-md">
                    Checkout
                </button>
            </div>
        </section>
    </div>
</div>
