<x-app-layout>
    <x-widgets.seo-tags :data="[
        'title' => 'FAQs',
        'description' =>
            'Find answers to the most frequently asked questions about RN Study Resources. Learn more about our services, products, and policies.',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <div class="container pt-4 md:px-6 lg:px-8 pb-4">
        <x-widgets.breadcrumbs title="FAQs" :links="[]" />
        <div class="h-4"></div>
        <x-home.faqs :questions="config('faqs.faqs')" />
    </div>
</x-app-layout>
