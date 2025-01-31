@props(['cover' => '', 'pages' => [], 'title' => '', 'price' => 0])

<section class="bg-black relative w-full">
    <button @click="$dispatch('direct-purchase')"
        class="absolute top-4 left-4 border rounded p-2 border-white text-white/80 uppercase text-sm">
        Buy $ {{ number_format($price, 2) }}
    </button>

    <div class="py-8 flex justify-center h-[410px]">
        <img src="{{ $cover }}" alt="{{ $title }}" class="h-400px w-auto">
    </div>

    <button class="absolute top-[45%] left-4 text-white md:z-20">
        <x-icon-chevron-left class="h-14 w-auto" />
    </button>
    <button class="absolute top-[45%] right-4 text-white md:z-20">
        <x-icon-chevron-right class="h-14 w-auto" />
    </button>
</section>
