@php
    $otherLinks = config('navigation-links.otherLinks');
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src='/logo.png' class=" block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @can('is-admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        {{-- <x-nav-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                            {{ __('All Users') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.orders') }}" :active="request()->routeIs('admin.orders')">
                            {{ __('All Orders') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.products') }}" :active="request()->routeIs('admin.products')">
                            {{ __('Products') }}
                        </x-nav-link> --}}
                    </div>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('shop') }}" :active="request()->routeIs('shop')">
                            {{ __('Shop') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('shop.popular') }}" :active="request()->routeIs('shop.popular')">
                            {{ __('Popular') }}
                        </x-nav-link>
                        {{-- <x-nav-link href="{{ route('request-product') }}" :active="request()->routeIs('request-product')">
                            {{ __('Exam Help') }}
                        </x-nav-link> --}}
                        <x-nav-link href="{{ route('shop.categories') }}" :active="request()->routeIs('shop.categories')">
                            {{ __('Categories') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('universities') }}" :active="request()->routeIs('universities')">
                            {{ __('Universities') }}
                        </x-nav-link>

                        <div class="h-full group flex items-center">
                            <x-nav-link href="{{ route('blog') }}" :active="request()->routeIs('shop.blog')">
                                <span class="flex gap-2 items-center">
                                    {{ __('More') }}
                                    <x-icon-chevron-down class="size-4" />
                                </span>
                            </x-nav-link>

                            <div
                                class="hidden min-w-[280px] max-h-[450px] group-hover:block top-16 p-5 bg-white text-black rounded shadow-[-10px_-10px_30px_4px_rgba(0,0,0,0.1),_10px_10px_30px_4px_rgba(45,78,255,0.15)] overflow-y-auto absolute z-50">
                                @foreach ($otherLinks as $link)
                                    <a href="{{ $link['link'] }}" class="block mb-2 hover:text-primary">
                                        {{ $link['title'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @auth
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('My Orders') }}
                            </x-nav-link>
                        @endauth
                    </div>
                @endcan
            </div>

            <div class="flex items-center ms-6">
                @cannot('is-admin')
                    @livewire('shop.cart-button')
                @endcannot

                <div class="w-5"></div>
                <!-- Settings Dropdown -->
                @auth
                    <div class="ms-3 relative hidden sm:block">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">

                                            <x-icon-user class="size-8 stroke-[0.5] dark:text-white" />
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('dashboard') }}">
                                    {{ __('My Orders') }}
                                </x-dropdown-link>

                                {{-- @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif --}}

                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}">
                        <x-icon-user class="size-8 stroke-[0.5] dark:text-white" /> </a>
                @endauth

                <!-- CTA -->
                @cannot('is-admin')
                    <a class="hidden ml-4 md:block" href="{{ route('request-product') }}">
                        <x-button class="bg-blue-700 py-3">Book Your Exam</x-button>
                    </a>
                @endcannot

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden ml-4">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>


        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @can('is-admin')
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('shop') }}" :active="request()->routeIs('shop')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>

            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('shop') }}" :active="request()->routeIs('shop')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('shop.popular') }}" :active="request()->routeIs('shop.popular')">
                    {{ __('Popular') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('request-product') }}" :active="request()->routeIs('request-product')">
                    {{ __('Exam Help') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('shop.categories') }}" :active="request()->routeIs('shop.categories')">
                    {{ __('Categories') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                    {{ __('About Us') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('contact-us') }}" :active="request()->routeIs('contact-us')">
                    {{ __('Contact Us') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('faqs') }}" :active="request()->routeIs('faqs')">
                    {{ __('FAQs') }}
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('My Orders') }}
                    </x-responsive-nav-link>
                @endauth
            </div>
        @endcan

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    {{-- @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif --}}

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
