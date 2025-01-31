<div>
    <section class="container md:px-6 lg:px-8 py-4">
        <x-widgets.breadcrumbs title="View Order" :links="[['title' => 'Orders', 'slug' => '/admin/orders']]" />

        <div class="w-full grid md:grid-cols-[1fr_280px] mt-4 gap-6">
            <section class="w-full">
                <div class="bg-white rounded p-6">

                    <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">Order #{{ $order->id }}</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">

                    </p>

                    <x-info-card title="Date" :value="$order->created_at" />
                    <x-info-card title="Customer Name" :value="$order->customer_name" />
                    <x-info-card title="Customer Email" :value="$order->customer_email" />
                    <x-info-card title="Customer Phone" :value="$order->customer_phone" />
                    <div class="h-6"></div>
                    <x-info-card title="Status" :value="$order->status" />
                    <x-info-card title="Payment Method" :value="$order->payment_method" />
                    <x-info-card title="Amount" :value="$order->total_amount" />
                    <x-info-card title="Source" :value="$order->source" />
                    <div class="h-6"></div>
                    <x-info-card title="Download Email Sent" :value="$order->email_sent ? 'Yes' : 'No'" />
                </div>
                <div class="mt-6">
                    <h2 class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Products
                    </h2>
                    <div class="bg-white rounded">
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


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Download history
                    </h2>
                    @empty($download_logs)
                        <x-widgets.empty title="O downloads" />
                    @endempty
                    @foreach ($download_logs as $item)
                        <div class="p-4 bg-white mb-1 rounded flex items-center gap-4">
                            <x-icon-file /> <span>{{ $item->created_at }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
            <section class="w-full">
                <div class="rounded p-6 bg-white">
                    <span class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Actions</span>
                    <a href="mailto:{{ $order->customer_email }}"
                        class="w-full hover:text-blue-700 flex mb-4 justify-between items-center">
                        <span class="uppercase">Email customer</span>
                        <x-icon-chevron-right />
                    </a>
                    <button class="w-full hover:text-blue-700 flex mb-4 justify-between items-center">
                        <span class="uppercase">Delete Order</span>
                        <x-icon-chevron-right />
                    </button>
                </div>
            </section>
        </div>
    </section>

</div>
