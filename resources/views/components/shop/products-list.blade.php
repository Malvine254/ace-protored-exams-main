@props(['products' => []])

<section class="w-full container py-6 md:px-6 lg:px-8">
    @if (count($products) == 0)
        <x-widgets.empty />
    @else
        <div class="grid md:grid-cols-3 gap-5">
            @foreach ($products as $product)
                <x-shop.product-card :product="$product" />
            @endforeach
        </div>
    @endif


</section>
