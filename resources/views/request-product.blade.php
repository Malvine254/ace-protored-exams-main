<x-app-layout>
    <x-widgets.seo-tags :data="[
        'title' => 'Request a Book or Exam Resource',
        'description' => 'Looking for specific study materials to help you prepare for your next exam or deepen your understanding of
                                                                                            a topic? Weve got you covered! Simply let us know the exam, book, or subject resource you need, and we ll
                                                                                            provide tailored materials to support your learning journey.',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <div class="container pt-4 md:px-6 lg:px-8 pb-16">
        <x-widgets.breadcrumbs title="Request a Book" :links="[]" />
        <div class="h-8"></div>
        <div class="w-full grid gap-10 md:grid-cols-2">
            <div class="rounded bg-white p-10 text-center border-t-4 border-t-secondary">
                <h1 class="text-3xl font-bold">Request a Book or Exam Resource</h1>
                <article class="py-6 text-base">
                    Looking for specific study materials to help you prepare for your next exam or deepen your
                    understanding of
                    a topic? We've got you covered! Simply let us know the exam, book, or subject resource you need, and
                    we’ll
                    provide tailored materials to support your learning journey. Whether it's detailed notes, practice
                    exams, or
                    a hard-to-find book, we’re here to ensure you have everything you need to succeed.
                </article>
                <a href="mailto:{{ config('constants.admin_notifications_email') }}"><button
                        class="mb-8 p-4 rounded bg-primary text-white uppercase tracking-wider">
                        Send an Email
                    </button></a>
            </div>
            <div class="rounded bg-white p-10 text-center border-t-4 border-t-secondary">
                <h1 class="text-3xl font-bold">Let Us Handle Your Proctored Exam</h1>
                <article class="py-6 text-base">
                    If you still do not feel confident in handling your own proctored exam, email
                    {{ config('constants.admin_notifications_email') }} or WhatsApp
                    {{ config('constants.whatsapp_number') }}. We handle all types of proctored exams
                    including Guardian browser, Proctor U, all lock down browser exams, Proctorio, Honour Lock and all
                    other proctored certification exams.
                </article>
                <div class="flex justify-center gap-4 mt-4">
                    <a href="http://wa.me/18328618439" target="_blank" rel="noopener noreferrer">
                        <button
                            class="p-4 bg-primary hover:bg-blue-700 rounded text-white uppercase tracking-wider flex items-center gap-2">
                            <x-icon-whatsapp class="h-5 w-auto fill-white" />
                            WhatsApp</button>
                    </a>
                    <a href="mailto:{{ config('constants.admin_notifications_email') }}">
                        <button
                            class="p-4 bg-primary hover:bg-blue-700 rounded text-white uppercase tracking-wider flex items-center gap-2">
                            <x-icon-mail class="h-5 w-auto text-white" />
                            Email
                            Us</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-widgets.whatsapp-btn />
</x-app-layout>
