<div>
    <x-widgets.seo-tags :data="[
        'title' => 'Ace Proctored Exams',
        'description' =>
            'Discover thousand exam materials, solutions manuals, test banks, and books for your courses. Elevate your learning experience',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    @can('is-admin')
        @livewire('admin.dashboard')
    @else
        <x-home.hero />
        <x-home.benefits />
        <section class="w-full py-8 bg-bg dark:bg-gray-800 dark:text-white">
            <div class="container md:px-6 lg:px-8 grid md:grid-cols-3 gap-4">
                <div class="md:col-span-3 flex items-center justify-between mb-4">
                    <h2 class="uppercase font-medium">Featured Books</h2>
                    <a href="/shop" class="flex gap-2 items-center uppercase hover:text-primary">
                        View All
                        <ChevronRight class="h-5 w-auto" />
                    </a>
                </div>
                @foreach ($products as $item)
                    <x-shop.product-card :product="$item" />
                @endforeach
            </div>
        </section>
        <x-home.how-it-works />
        <x-home.testimonials />
        <x-home.about />
        <x-home.request-cta />
        <x-home.group-cta />
    @endcan
</div>
