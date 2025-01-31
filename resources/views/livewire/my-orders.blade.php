<div>
    <x-widgets.seo-tags :data="[
        'title' => 'My Orders',
        'description' => 'Check the status of recent orders, manage returns, and discover similar products.',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="My Orders" :links="[['title' => 'Profile', 'slug' => '/profile']]" />
            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">My Orders</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Check the status of recent orders, manage returns, and discover similar products.
            </p>
        </div>
    </section>

    <section class="container md:px-6 lg:px-8 py-4">

        @foreach ($orders as $order)
            <div class="bg-white dark:bg-gray-800 rounded-md border dark:border-gray-700 relative mb-6">
                <div class="absolute top-4 right-4 px-3 py-2 rounded-md bg-primary/20 dark:text-white text-sm uppercase">
                    {{ $order->status }}
                </div>
                <div class="flex gap-4 md:gap-16 border-b dark:border-gray-700 p-8">
                    <div>
                        <h4 class="text-sm dark:text-white mb-2">Order Number</h4>
                        <span class="text-sm text-gray-600 dark:text-gray-400">TB00{{ $order->id }}</span>
                    </div>
                    <div>
                        <h4 class="text-sm dark:text-white mb-2">Date</h4>
                        <span
                            class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('d M Y : h:m') }}</span>
                    </div>
                    <div>
                        <h4 class="text-sm dark:text-white mb-2">Total</h4>
                        <span class="text-sm text-gray-600 dark:text-gray-400">$ {{ $order->total_amount }}</span>
                    </div>
                </div>
                <div class="w-full">
                    @foreach ($order->products as $product)
                        <div class="border-b last:border-b-0 dark:border-gray-700 p-8">

                            <div class="flex gap-4">
                                @if (count($product['images']) > 0)
                                    <img src="{{ $product['images'][0] }}" alt="" class="h-[120px] w-auto">
                                @endif
                                <div>
                                    <h4 class="text-base font-bold mb-2 dark:text-white">{{ $product['name'] }}</h4>
                                    <p class="text-sm dark:text-gray-400 mb-2">
                                        {{ substr($product['description'], 0, 200) }}...
                                    </p>
                                    <span class="dark:text-white">$ {{ $product['price'] }}</span>
                                </div>

                            </div>
                            <div class="mt-4 w-full flex justify-between">
                                <div class="flex gap-2 items-center">
                                    <x-icon-check class="size-5 text-green-500" />
                                    <span class="dark:text-gray-300">Delivered on
                                        {{ $order->created_at->format('d M Y') }}</span>
                                </div>

                                <div class="flex gap-4 items-center">
                                    <a href="{{ '/products' . '/' . kebabCase($product['name']) . '-' . $product['product_id'] }}"
                                        class="text-primary font-medium hover:underline">View Product</a>
                                    <div class="h-5 border-r dark:border-gray-700"></div>
                                    <button class="text-primary font-medium">Download</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
</div>
