@props(['products' => []])

<section class="w-full py-10">
    <div class="container w-full max-w-7xl md:px-6 lg:px-8">
        <h2 class="uppercase mb-5">Related Products</h2>
    </div>
    <div class="container w-full max-w-7xl md:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-shop.product-card :product="$product" />
        @endforeach
    </div>
</section>
