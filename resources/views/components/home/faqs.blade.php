@props(['questions' => []])

<section class="py-10 bg-bg dark:bg-gray-800 dark:text-white/80">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold leading-tight text-black dark:text-white sm:text-4xl lg:text-5xl">
                Frequently Asked Questions
            </h2>
            <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-600 dark:text-gray-400">
                Discover answers to top questions
            </p>
        </div>

        <div class="max-w-3xl mx-auto mt-8 space-y-4">
            @foreach ($questions as $item)
                <x-home.question-card question="{{ $item['q'] }}" answer="{{ $item['a'] }}" />
            @endforeach
        </div>

        <p class="text-center text-gray-600 textbase mt-9">
            Didn't find the answer you are looking for?
            <a href="/contact-us"
                class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 focus:text-blue-700 hover:underline">
                Contact our support
            </a>
        </p>
    </div>
</section>
