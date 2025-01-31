<section class="bg-secondary 2xl:py-24 2xl:bg-secondary">
    <div class="px-4 mx-auto overflow-hidden bg-secondary max-w-7xl sm:px-6 lg:px-8">
        <div class="py-10 sm:py-16 lg:py-24 2xl:pl-24">
            <div class="grid items-center grid-cols-1 gap-y-12 lg:grid-cols-2 lg:gap-x-8 2xl:gap-x-20">
                <div>
                    <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">Be
                        the first one to discover new resources</h2>
                    <p class="mt-4 text-base text-gray-50">Get access to exclusive study tips, shared resources, and
                        real-time support as you prepare for your exams.</p>


                </div>

                <div class="relative px-12">
                    <svg class="absolute inset-x-0 bottom-0 left-1/2 -translate-x-1/2 -mb-48 lg:-mb-72 text-cyan-300 w-[460px] h-[460px] sm:w-[600px] sm:h-[600px]"
                        fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                    <div class="relative mx-auto max-w-[480px]">
                        <x-home.fb-group />
                        <a href="{{ config('constants.facebook_link') }}" target="_blank" rel="noopener noreferrer"
                            class="mt-2 block text-center w-full p-3 rounded bg-white hover:bg-blue-800 hover:text-white text-blue-600 font-bold uppercase tracking-wider text-sm">Join
                            Group</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
