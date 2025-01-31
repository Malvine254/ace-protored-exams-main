<section class="rounded-lg border bg-white dark:text-white dark:bg-gray-800 dark:border-gray-700">
    <div class="p-4 border-b dark:border-gray-700">
        <h2 class="uppercase">Rating</h2>
    </div>
    <div class="p-4">
        <span class="block text-gray-600 dark:text-gray-400 mb-4 uppercase text-sm">
            Overal Ratings
        </span>
        <div class="flex gap-3 items-center mb-6">
            <h3 class="font-bold text-6xl">4.8</h3>
            <div>
                <x-widgets.rating value={4.8} />
                <span class="block mt-1">12 Reviews</span>
            </div>
        </div>
        <span class="block text-gray-600 dark:text-gray-400 mb-4 uppercase text-sm">
            Ratings Breakdown
        </span>

        <div class="flex gap-4 items-center mb-3 justify-between sm:justify-start">
            <div>
                <x-widgets.rating :value="5" />
            </div>
            <div class="flex-grow hidden sm:block">
                <x-widgets.progress :value="50" />
            </div>
            <div class="w-10">
                <span>6</span>
            </div>
        </div>
        <div class="flex gap-4 items-center mb-3 justify-between sm:justify-start">
            <div>
                <x-widgets.rating :value="4" />
            </div>
            <div class="flex-grow hidden sm:block">
                <x-widgets.progress :value="20" />
            </div>
            <div class="w-10">
                <span>2</span>
            </div>
        </div>
        <div class="flex gap-4 items-center mb-3 justify-between sm:justify-start">
            <div>
                <x-widgets.rating :value="3" />
            </div>
            <div class="flex-grow hidden sm:block">
                <x-widgets.progress :value="30" />
            </div>
            <div class="w-10">
                <span>4</span>
            </div>
        </div>
        <div class="flex gap-4 items-center mb-3 justify-between sm:justify-start">
            <div>
                <x-widgets.rating :value="2" />
            </div>
            <div class="flex-grow hidden sm:block">
                <x-widgets.progress :value="0" />
            </div>
            <div class="w-10">
                <span>0</span>
            </div>
        </div>
        <div class="flex gap-4 items-center mb-3 justify-between sm:justify-start">
            <div>
                <x-widgets.rating :value="1" />
            </div>
            <div class="flex-grow hidden sm:block">
                <x-widgets.progress :value="0" />
            </div>
            <div class="w-10">
                <span>0</span>
            </div>
        </div>

        <button class="bg-primary mt-6 px-6 py-3 rounded-full uppercase text-sm text-white">
            Write a Review
        </button>
    </div>
</section>
