@php
    $how_to_steps = [
        [
            'title' => 'Search',
            'copy' =>
                'Effortlessly browse through our extensive collection of college textbooks, test banks, and solution manuals by entering relevant keywords, titles, authors, or subjects into the search bar.',
        ],
        [
            'title' => 'Preview',
            'copy' =>
                'Explore sample chapters, table of contents, and sample questions to gauge the suitability of the resource for your academic needs before you make a purchase.',
        ],
        [
            'title' => 'Buy & Download',
            'copy' =>
                'Upon selecting the necessary resources, proceed to purchase and download with confidence. Our secure checkout process prioritizes the confidentiality of your personal information.',
        ],
    ];
@endphp

<section class="py-10 bg-white dark:bg-gray-900 dark:text-white">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold leading-tight text-black dark:text-white sm:text-4xl lg:text-5xl">
                How does it work?
            </h2>
            <p class="max-w-lg mx-auto mt-4 text-base leading-relaxed text-gray-600 dark:text-white/80">
                Experience the convenience of digital learning materials without
                delay, and elevate your academic performance with Ace Testbanks
                today.
            </p>
        </div>

        <div class="relative mt-12 lg:mt-20">
            <div class="absolute inset-x-0 hidden xl:px-44 top-2 md:block md:px-20 lg:px-28">
                <img class="w-full" src="/img/curved-dotted-line.svg" alt="" />
            </div>

            <div class="relative grid grid-cols-1 text-center gap-y-12 md:grid-cols-3 gap-x-12">
                @foreach ($how_to_steps as $item)
                    <div>
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto bg-white border-2 border-gray-200 dark:bg-gray-700 rounded-full shadow">
                            <span class="text-xl font-semibold text-gray-700 dark:text-white">
                                {{ $loop->index + 1 }}
                            </span>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold leading-tight text-black dark:text-white md:mt-10">
                            {{ $item['title'] }}
                        </h3>
                        <p class="mt-4 text-base text-gray-600 dark:text-white/80">{{ $item['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
