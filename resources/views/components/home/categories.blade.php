@php
    $defaultCategories = config('book-categories.tags');

    function converToUrlFriendly2($string)
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

<section class="w-full py-16 bg-white">
    <div class="container w-full grid md:grid-cols-4 gap-6">
        @foreach ($defaultCategories as $category)
            <a href="{{ '/tags' . '/' . converToUrlFriendly2($category) }}"
                class="w-full p-6 rounded bg-white border block hover:border-blue-700 hover:text-blue-600">
                <img src="/img/stack-of-books.png" alt="study resources" class="h-8 w-auto mb-4">
                <h2 class="font-bold text-sm">{{ $category }}</h2>
            </a>
        @endforeach
    </div>
</section>
