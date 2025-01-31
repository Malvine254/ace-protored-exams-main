@php
    $topLinks = config('navigation-links.topLinks');
    $supportLinks = config('navigation-links.supportLinks');
    $legalLinks = config('navigation-links.legalLinks');
    $aboutLinks = config('navigation-links.aboutLinks');
@endphp

<footer class="bg-white dark:bg-gray-800 border-t dark:border-t-gray-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-2 gap-8 py-6 lg:py-12 md:grid-cols-4">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    Quick Links
                </h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    @foreach ($topLinks as $link)
                        <li class="mb-4">
                            <a href="{{ $link['link'] }}" class=" hover:underline">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    Help center
                </h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    @foreach ($supportLinks as $link)
                        <li class="mb-4">
                            <a href="{{ $link['link'] }}" class="hover:underline">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    Legal
                </h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    @foreach ($legalLinks as $link)
                        <li class="mb-4">
                            <a href="{{ $link['link'] }}" class="hover:underline">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    About Us
                </h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    @foreach ($aboutLinks as $link)
                        <li class="mb-4">
                            <a href="{{ $link['link'] }}" class="hover:underline">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section class=" py-6 bg-gray-100 dark:bg-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">
                © 2024 <a href="{{ config('app.url') }}">{{ config('app.name', 'Ace TestBank') }}</a>. All Rights
                Reserved.
            </span>

            <img src="/img/payment-methods.png" alt="payment methods" class="h-5 w-auto" />
        </div>
    </section>
</footer>
