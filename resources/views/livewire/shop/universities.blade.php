<div>
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Universities" :links="[]" />
            <div class="w-full text-center py-10">
                <h1 class="text-3xl mb-4 font-bold dark:text-white capitalize">
                    @if ($state)
                        Universities in {{ $state }}
                    @elseif($country)
                        Universities in {{ $country }}
                    @else
                        Universities
                    @endif
                </h1>
                @if (!$country)
                    <p class="max-w-3xl mx-auto text-center text-gray-600 mb-6">
                        Find Exam materials, test banks, solution manuals, and study materials specifically for your
                        university right
                        here
                        on {{ config('app.name') }}! Whether you're looking for resources for your current courses or
                        preparing
                        for
                        exams, our curated selection makes it easy to access the materials you need to succeed. Explore
                        now
                        and discover the perfect study tools tailored to your institution!
                    </p>
                @endif

                <label for="uni-search" class="relative">
                    <input type="text" id="uni-search" wire:model.live="search_string"
                        placeholder="Search Universities" class="h-16 rounded max-w-xl w-full border">
                    <x-icon-search class="absolute -top-1.5 right-4 h-8 w-auto" />
                </label>
            </div>
        </div>
    </section>
    <section class="w-full container py-6 md:px-6 lg:px-8 md:grid md:grid-cols-[280px_1fr] gap-8">
        <div>
            <h4 class="uppercase text-xs text-gray-600 font-semibold mb-5">
                @if ($country)
                    States
                @else
                    Countries
                @endif
            </h4>
            @if ($country)
                <div>
                    @foreach ($states as $item)
                        <a href="/school?country={{ $country }}&state={{ $item }}"
                            class="justify-between w-full text-primary flex items-center hover:underline mb-3">
                            {{ $item }}
                            <x-icon-chevron-right class="h-4 w-auto" />
                        </a>
                    @endforeach
                </div>
            @else
                @foreach ($countries as $item)
                    <a href="/school?country={{ $item }}"
                        class="justify-between w-full text-primary flex items-center hover:underline mb-3">
                        {{ $item }}
                        <x-icon-chevron-right class="h-4 w-auto" />
                    </a>
                @endforeach
            @endif
        </div>

        <div>
            <h4 class="uppercase text-xs text-gray-600 font-semibold mb-5">
                @if ($country)
                    Universities in {{ $country }}
                @else
                    Universities
                @endif
            </h4>

            <div>
                @foreach ($schools as $item)
                    <a href="/school/{{ kebabCase($item->country) }}/{{ kebabCase($item->state_province) }}/{{ kebabCase($item->name) }}-{{ $item->id }}"
                        class="p-4 rounded border bg-white flex gap-4 items-center mb-4">
                        <div class="size-16 bg-slate-400 text-white flex items-center justify-center">
                            <x-icon-academic-cap />
                        </div>
                        <div>
                            <h2 class="font-bold text-xl mb-1 text-blue-600">{{ $item->name }}</h2>
                            <p class="text-gray-600 text-xs">{{ $item->type }} . {{ $item->country }} .
                                {{ $item->state_province }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>
