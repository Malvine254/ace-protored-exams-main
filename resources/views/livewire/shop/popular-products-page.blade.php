<div>
    <x-widgets.seo-tags :data="[
        'title' => 'Popular Products - Ace TestBank',
        'description' => 'Find the most popular products on Ace TestBank',
        'image' => count($products) != 0 ? asset($products[0]->cover) : asset('img/student-in-a-library.jpg'),
    ]" />
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container max-w-7xl md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Popular Products" :links="[]" />
            <h1 class="text-2xl mt-6 font-bold dark:text-white capitalize mb-4">Popular Exams and Study Resources
                Products
            </h1>

        </div>
    </section>

    <x-shop.products-list :products="$products" />

    <div class="container max-w-7xl md:px-6 lg:px-8">
        {{ $products->links() }}
    </div>

    <x-home.benefits />
    <x-home.request-cta />
    <x-home.group-cta />
</div>
