@php
    $purchaseBenefits = [
        'Download immediately after payment',
        'Verified resource from the publisher.',
        'Matches the most recent version.',
    ];
@endphp

@props(['product' => []])

<div
    class="w-full border-2 bg-white border-secondary dark:bg-gray-800 dark:border-gray-700 dark:text-white rounded text-center p-6">
    <div>
        <h3 class="font-bold text-sm mb-2 uppercase">Buy</h3>
        <price class="text-2xl md:text-3xl font-bold inline-block mb-8">
            $ <del class="font-normal opacity-80">
                {{ isset($product->discounted_from) ? number_format($product->discounted_from, 2) : number_format($product->price + 5.01, 2) }}
            </del> {{ $product->price }}
        </price>
        @isset($product->sample_link)
            <a download href="{{ $product->sample_link ?? '#' }}"
                class="block w-full rounded-full p-3 mb-4 bg-primary text-white uppercase font-semibold">
                Download Free Sample
            </a>
        @endisset

        <hr class="my-6 w-full dark:border-gray-700">
        <button @click="$dispatch('add-to-cart')"
            class="block w-full rounded-full p-3 mb-4 bg-secondary text-white uppercase font-semibold">
            Add to Cart
        </button>
        <button @click="$dispatch('direct-purchase')"
            class="w-full rounded-full p-3 border hover:text-primary uppercase font-semibold">
            Buy Now
        </button>

        <hr class="my-6 w-full dark:border-gray-700" />

        <ul>
            @foreach ($purchaseBenefits as $item)
                <li class="flex gap-3 items-center mb-2">
                    <img src="{{ asset('img/icons/check.svg') }}" alt="check" class="h-4 w-auto shrink-0" />
                    <span class="text-start">{{ $item }}</span>
                </li>
            @endforeach

        </ul>
    </div>
</div>
