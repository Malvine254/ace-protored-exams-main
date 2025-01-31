@php
    $defaultCategories = config('book-categories.categories');
@endphp

<div>
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Universities" :links="[]" />
            <div class="w-full text-center py-10">
                <h1 class="text-3xl mb-4 font-bold dark:text-white capitalize">
                    {{ $university->name }}
                </h1>
                @if ($university->description)
                    {{ $university->description }}
                @else
                    <p class="max-w-3xl mx-auto text-center text-gray-600 mb-6">
                        Attention, {{ $university->name }} students! RN Study Resources is your ultimate destination for
                        test banks, solution manuals, and premium study materials designed to take your exam prep to the
                        next level. Whether you're tackling tough courses or gearing up for finals, we've got you
                        covered with authentic, up-to-date resources that make studying smarter, not harder. Ace your
                        exams with ease—start exploring now and see why we're the go-to choice for students who refuse
                        to settle for less.
                    </p>
                @endif


                <label for="uni-search" class="relative">
                    <input type="text" id="uni-search" wire:model.live="search_string" placeholder="Search testbanks"
                        class="h-16 rounded max-w-xl w-full border">
                    <x-icon-search class="absolute -top-1.5 right-4 h-8 w-auto" />
                </label>
            </div>
        </div>
    </section>
    <section class="w-full container py-6 md:px-6 lg:px-8 md:grid md:grid-cols-[280px_1fr] gap-8">
        <div>
            <h4 class="uppercase text-xs text-gray-600 font-semibold mb-5">
                Courses
            </h4>

            <div class="bg-white dark:bg-gray-800 dark:text-white rounded py-4">
                @foreach ($defaultCategories as $category)
                    <div class="px-4 py-0" x-data="{ show: false }">
                        <button x-on:click="show = !show" class="flex w-full items-center justify-between text-primary">
                            <h2 class="font-semibold text-base">{{ $category['title'] }}</h2>
                            <span class=" transition-all" :class="{ 'rotate-90': show }">
                                <x-icon-chevron-right class="h-4 w-auto" /></span>

                        </button>

                        <ul x-cloak class="overflow-hidden py-2" :class="{ 'h-auto': show, 'h-0': !show }">
                            @foreach ($category['categories'] as $item)
                                <a href="{{ '/tags' . '/' . kebabCase($item) }}"
                                    class="block py-1 hover:text-primary text-sm">
                                    {{ $item }}
                                </a>
                            @endforeach

                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="uppercase text-xs text-gray-600 font-semibold mb-5">
                {{ $university->name }} Notes, Test banks and Solution Manuals
            </h4>

            <div>
                @foreach ($books as $product)
                    <div class="p-4 rounded border bg-white flex gap-4 items-center mb-4">
                        <a href={{ '/products' . '/' . kebabCase($product->name) . '-' . $product->id }}
                            class="shrink-0">
                            <img src="{{ $product->cover }}"alt="{{ $product->name }}" class="h-[150px] mx-auto" />
                        </a>
                        <a href={{ '/products' . '/' . kebabCase($product->name) . '-' . $product->id }}>
                            <h2 class="font-bold text-lg mb-2 text-blue-600">{{ $product->name }}</h2>
                            <div class="flex gap-4 mb-2">
                                <span class="text-sm text-black font-bold">${{ $product->price }}</span>
                                @if ($product->categories)
                                    <span class="text-sm text-black capitalize">{{ $product->categories[0] }}</span>
                                @endif
                                @foreach ($product->tags as $tag)
                                    <span class="text-gray-600 text-sm">{{ $tag }}</span>
                                @endforeach
                                <span class="text-gray-600 text-sm">{{ $product->created_at->year ?? '2024' }}</span>
                            </div>
                            @if ($product->description)
                                <p class="text-gray-600 truncate">{{ truncateString($product->description, 80) }}</p>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
