@props(['value' => 5])

<div class="flex items-center">
    @foreach ([1, 2, 3, 4, 5] as $item)
        <button type="button"
            class="size-5 inline-flex justify-center items-center text-2xl rounded-full disabled:opacity-50 disabled:pointer-events-none
          @if ($item <= $value) dark:text-yellow-500 text-yellow-400
          @else
text-gray-300 hover:text-yellow-400 dark:text-gray-600 dark:hover:text-yellow-500 @endif
          ">
            <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
            </svg>
        </button>
    @endforeach

</div>
