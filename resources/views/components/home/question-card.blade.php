@props(['question' => '', 'answer' => ''])

<div x-data="{
    active: false
}"
    class="transition-all duration-200 bg-white dark:bg-gray-800 dark:border-gray-700 border border-gray-200 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/80"
    :class="{ 'shadow-lg': active }">
    <button type="button" class="flex items-center justify-between w-full px-4 py-5 sm:p-6" @click="active = !active;">
        <span class="flex text-lg text-start font-semibold text-black dark:text-white/80">
            {{ $question }}
        </span>

        <svg class="w-6 h-6 text-gray-400" :class="{ 'rotate-180': active }" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div class="px-4 pb-5 sm:px-6 sm:pb-6" :class="{ 'hidden': !active }">
        <p>{!! $answer !!}</p>
    </div>
</div>
