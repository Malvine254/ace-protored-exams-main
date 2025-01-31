<x-app-layout>

    <div class="container py-4 md:px-6 lg:px-8">
        <x-widgets.seo-tags :data="[
            'title' => 'Order Successfull',
            'description' => 'Thank you for your order.',
            'image' => asset('img/student-in-a-library.jpg'),
        ]" />
        <x-widgets.breadcrumbs title="Order Successfull" :links="[]" />
        <div class="w-full mt-4 p-8 rounded-md bg-white dark:bg-gray-800 dark:text-white">
            <div class="text-center">
                <x-icon-check class="h-16 inline-block mb-6 text-green-500" />
                <h1 class="text-2xl mb-4">{{ __('Order Payment Successfull') }}</h1>
                <p class="mb-2">Thank you for your order</p>
                <p class="mb-4 max-w-2xl mx-auto">Download your resource with the link bellow or check your email for a
                    download link to your purchased resource.
                    If you have not yet received a direct download link, please be assured that the document
                    will be emailed to you within the next 4 hours. For urgent assistance, feel free to reach out via
                    WhatsApp at +1(564) 544-6478 or reply directly to this email.</p>

                @isset($order)
                    <div class="w-full max-w-4xl border rounded mb-4">
                        <div class="p-4 border-b">
                            <h3 class="uppercase text-lg">Downloads</h3>
                        </div>
                        <div class="p-4">
                            <ul class="block text-start">
                                @foreach ($order->products as $product)
                                    <li class="block mb-2 text-start">
                                        <a class="text-primary"
                                            href="{{ URL::route('download.link', ['orderId' => $order->id, 'productId' => $product['product_id']]) }}">
                                            {{ $product['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endisset

                <a href="{{ route('register') }}"
                    class="inline-block text-lg px-6 py-3 text-white bg-primary rounded-full">
                    {{ __('Create an Account') }}
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
