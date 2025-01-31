@php
    $benefits = [
        [
            'title' => 'Instant Downloads',
            'icon' => '/icons/download.png',
        ],
        [
            'title' => 'Secure Checkout',
            'icon' => '/icons/secure.png',
        ],
        [
            'title' => '24/7 Support',
            'icon' => '/icons/support.png',
        ],
        [
            'title' => '100% Satisfaction Guarantee',
            'icon' => '/icons/guarantee.png',
        ],
        [
            'title' => 'Student-Friendly Prices',
            'icon' => '/icons/cheap.png',
        ],
    ];
@endphp

<section class="w-full py-10">
    <div class="container w-full max-w-7xl md:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach ($benefits as $item)
            <div class="bg-gray-200 dark:bg-gray-700 dark:text-white rounded p-4 py-6 text-center">
                <img src="{{ asset('/img' . $item['icon']) }}" alt="{{ $item['title'] }}"
                    class="h-14 w-auto mb-4 inline-block dark:invert" />
                <div>
                    <h4 class="font-bold">{{ $item['title'] }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</section>
