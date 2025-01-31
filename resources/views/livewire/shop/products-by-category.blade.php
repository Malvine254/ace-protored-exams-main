@php
    $id = \Route::current()->parameter('id');
    $title = str_replace('-', ' ', $id);
    $description = 'Find the most popular ' . $title . ' products on Ace TestBank';
@endphp

<div>
    <x-widgets.seo-tags :data="[
        'title' => $title,
        'description' => $description,
        'image' => count($products) != 0 ? asset($products[0]->cover) : asset('img/student-in-a-library.jpg'),
    ]" />
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="{{ $title }}" :links="[['title' => 'Products', 'slug' => '/shop']]" />
            <h1 class="text-2xl mt-6 font-bold dark:text-white capitalize">{{ $title }}</h1>
        </div>
    </section>

    <x-shop.products-list :products="$products" />
    <div class="container md:px-6 lg:px-8 py-6">
        {{ $products->links() }}
    </div>
    <x-home.benefits />
    <x-home.request-cta />
</div>
