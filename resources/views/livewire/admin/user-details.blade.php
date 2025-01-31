<div>
    {{-- <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">

            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">{{ $user->name }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ $user->email }}
            </p>
        </div>
    </section> --}}

    <section class="container md:px-6 lg:px-8 py-4">
        <x-widgets.breadcrumbs title="View User" :links="[['title' => 'Users', 'slug' => '/admin/users']]" />

        <div class="w-full grid md:grid-cols-[1fr_280px] mt-4 gap-6">
            <section class="w-full">
                <div class="bg-white rounded p-6">
                    <div>
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="h-28 w-28 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        @else
                            <span class="inline-flex rounded-full h-28 w-28 items-center justify-center">
                                <x-icon-user class="size-16 stroke-[0.5] dark:text-white" />
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">{{ $user->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        {{ $user->email }}
                    </p>
                </div>
                <div class="mt-6">
                    <h2 class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Orders</h2>
                    <x-widgets.empty title="O orders found" />
                </div>
            </section>
            <section class="w-full">
                <div class="rounded p-6 bg-white">
                    <span class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Actions</span>
                    <a href="mailto:info@rnstudentresources.com"
                        class="w-full hover:text-blue-700 flex mb-4 justify-between items-center">
                        <span class="uppercase">Send email</span>
                        <x-icon-chevron-right />
                    </a>

                    @if ($user->email !== config('constants.admin_email'))
                        <button class="w-full hover:text-blue-700 flex mb-4 justify-between items-center">
                            <span class="uppercase">Block</span>
                            <x-icon-chevron-right />
                        </button>
                        <button wire:click="deleteUser"
                            wire:confirm="Please confirm deleting user. This action is irreversible."
                            class="w-full hover:text-blue-700 flex mb-4 justify-between items-center">
                            <span class="uppercase">Delete Account</span>
                            <x-icon-chevron-right />
                        </button>
                    @endif
                </div>
            </section>
        </div>
    </section>

</div>
