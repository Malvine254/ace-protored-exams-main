@php
    $defaultCategories = config('book-categories.categories');
@endphp

<section class="py-0">
    <x-widgets.seo-tags :data="[
        'title' => 'Categories',
        'description' =>
            'Test banks and books categories. Discover thousand solutions manuals, test banks, and books for your courses.',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <x-home.categories />
</section>
