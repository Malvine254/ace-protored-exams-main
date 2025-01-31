<section class="w-full bg-white py-16">
    <div class="container">
        <div class="border-l-4 border-l-red-500 pl-8">
            <h2 class="text-3xl font-bold mb-4">Let Us Handle Your Proctored Exam</h2>
            <p class="text-lg text-gray-600 max-w-6xl">
                If you still do not feel confident in
                handling your own proctored exam, email <a
                    href="mailto:{{ config('constants.admin_notifications_email') }}">{{ config('constants.admin_notifications_email') }}</a>.
                We
                handle all types of proctored exams including Guardian browser, Proctor U, all lock down browser exams,
                Proctorio, Honour Lock and all other proctored certification exams.
            </p>
            <div class="flex gap-4 mt-4">
                <a href="http://wa.me/18328618439" target="_blank" rel="noopener noreferrer">
                    <button
                        class="p-4 bg-primary hover:bg-secondary rounded text-white uppercase tracking-wider flex items-center gap-2">
                        <x-icon-whatsapp class="h-5 w-auto fill-white" />
                        WhatsApp</button>
                </a>
                <a href="mailto:{{ config('constants.admin_notifications_email') }}">
                    <button
                        class="p-4 bg-primary hover:bg-secondary rounded text-white uppercase tracking-wider flex items-center gap-2">
                        <x-icon-mail class="h-5 w-auto text-white" />
                        Email
                        Us</button>
                </a>
            </div>
        </div>
    </div>
</section>
