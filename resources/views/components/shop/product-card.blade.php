@props(['product' => []])

<article class="rounded w-full bg-white">

    <!-- Carousel -->
    <div class="h-48 md:h-64 overflow-hidden">
        <div x-data="{
            slides: {{ json_encode($product->images) }},
            currentSlideIndex: 1,
            previous() {
                if (this.currentSlideIndex > 1) {
                    this.currentSlideIndex = this.currentSlideIndex - 1
                } else {
                    // If it's the first slide, go to the last slide           
                    this.currentSlideIndex = this.slides.length
                }
            },
            next() {
                if (this.currentSlideIndex < this.slides.length) {
                    this.currentSlideIndex = this.currentSlideIndex + 1
                } else {
                    // If it's the last slide, go to the first slide    
                    this.currentSlideIndex = 1
                }
            },
        }" class="relative w-full overflow-hidden">

            <!-- previous button -->
            <button type="button"
                class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white"
                aria-label="previous slide" x-on:click="previous()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <!-- next button -->
            <button type="button"
                class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white"
                aria-label="next slide" x-on:click="next()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <!-- slides -->
            <a href={{ '/products' . '/' . $product->slug . '-' . $product->id }}>
                <div class="relative h-48 md:h-64 w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                            x-transition.opacity.duration.300ms>
                            <img class="absolute w-full h-full inset-0 object-cover rounded-t text-neutral-600 dark:text-neutral-300"
                                x-bind:src="slide" x-bind:alt="{{ $product->name }}" />
                        </div>
                    </template>
                </div>
            </a>

        </div>
    </div>
    <div class="p-3 text-center">
        <div class="flex items-center justify-center gap-2 mb-2">

            @foreach ($product->tags as $item)
                <a class="block p-1 rounded bg-primary/20 dark:bg-white/20 dark:text-white/80 text-xs uppercase"
                    href="{{ '/tags' . '/' . $item }}">
                    {{ $item }}
                </a>
            @endforeach
        </div>
        <a class="hover:text-primary dark:text-white"
            href={{ '/products' . '/' . $product->slug . '-' . $product->id }}>
            <h3 class=" mb-2 text-base">
                {{ $product->name }}
            </h3>
        </a>

        <price class="text-primary font-bold text-lg">$ <del class="font-normal opacity-80">
                {{ isset($product->discounted_from) ? number_format($product->discounted_from, 2) : number_format($product->price + 5.01, 2) }}
            </del> {{ $product->price }}</price>
    </div>
</article>
