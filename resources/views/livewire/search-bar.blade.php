@php
    $defaultCategories = config('book-categories.tags');

    function converToUrlFriendly($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);

        $string = preg_replace_callback(
            '/([a-z])([A-Z])/',
            function ($matches) {
                return strtolower($matches[1]) . '-' . strtolower($matches[2]);
            },
            $string,
        );

        $string = str_replace(' ', '-', $string);

        $string = trim($string, '-');

        return $string;
    }
@endphp

<header x-data="{ openSearch: false }" class="bg-white dark:bg-gray-800 shadow relative">
    <form wire:submit="search" class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center">
        <x-button type='button' class="h-[40px] rounded-r-none focus:ring-0" @click="openSearch=true">
            <x-icon-filters class="size-5 sm:hidden" />
            <span class="hidden sm:flex gap-2 items-center">Categories
                <span class="transition-all" :class="{ 'rotate-180': openSearch }">
                    <x-icon-chevron-down class="size-4" /></span>
            </span>
        </x-button>
        <x-input placeholder="Search" wire:model="query" class="rounded-none flex-grow" />
        <x-button type="submit" class="h-[40px] rounded-l-none">Search</x-button>
    </form>
    <div x-show="openSearch" class="absolute z-30 top-[68px] w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div @click.away="openSearch=false" x-cloak class="w-full rounded grid  p-6 bg-white shadow-xl min-h-20">
            @foreach ($defaultCategories as $item)
                <a href="{{ '/tags' . '/' . converToUrlFriendly($item) }}"
                    class="block mb-2 text-sm hover:text-primary">
                    {{ $item }}
                </a>
            @endforeach
        </div>
    </div>
</header>
