<div class="w-full flex gap-4 px-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('home')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('home') }}">
        <x-icon-home class="h-5 w-auto" />
        {{ __('Dashboard') }}
    </a>
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('admin.users')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('admin.users') }}">
        <x-icon-user class="h-5 w-auto" />
        {{ __('All Users') }}
    </a>
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('admin.orders')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('admin.orders') }}">
        <x-icon-shopping-bag class="h-5 w-auto" /> {{ __('All Orders') }}
    </a>
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('admin.products')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('admin.products') }}">
        <x-icon-box class="h-5 w-auto" /> {{ __('Products') }}
    </a>
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('admin.schools')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('admin.schools') }}">
        <x-icon-academic-cap class="h-5 w-auto" /> {{ __('Schools') }}
    </a>
    <a class="flex p-3 gap-2 items-center uppercase text-sm
                    @if (request()->routeIs('admin.financials')) text-primary border-b border-b-primary @else text-gray-800 dark:text-white @endif
                    "
        href="{{ route('admin.financials') }}">
        <x-icon-dollar-sign class="h-5 w-auto" /> {{ __('Financial Dashboard') }}
    </a>
    {{-- <a class="flex p-3 gap-2 items-center uppercase text-sm text-gray-800 dark:text-white"
        href="https://analytics.google.com/analytics/web/#/p471523371/reports/intelligenthome" target="_blank"
        rel="noopener noreferrer">
        <x-icon-bar-chart class="h-5 w-auto" /> {{ __('Analytics') }}
    </a> --}}
</div>
