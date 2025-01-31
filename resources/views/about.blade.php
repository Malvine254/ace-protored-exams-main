<x-app-layout>
    <x-widgets.seo-tags :data="[
        'title' => 'About',
        'description' => '',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <div class="container pt-4 md:px-6 lg:px-8 pb-4">
        <x-widgets.breadcrumbs title="About" :links="[]" />
        <div class="h-8"></div>
        <h1 class="text-4xl font-bold">About Us</h1>
        <article class="py-6 prose prose-xl">
            Ace Proctored Exams is your trusted partner in nursing education. We provide curated study
            materials, past exam questions, and answers designed to help nursing students excel in their
            academic journey. With a focus on accessibility, accuracy, and convenience, we aim to
            simplify your study process and support your success in becoming a skilled and confident RN.
        </article>
    </div>
</x-app-layout>
