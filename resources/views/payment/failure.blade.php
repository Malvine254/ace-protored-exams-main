<x-app-layout>
    <div class="container py-4 md:px-6 lg:px-8">
        <x-widgets.breadcrumbs title="Order Successfull" :links="[]" />
        <div class="w-full mt-4 p-8 rounded-md bg-white dark:bg-gray-800 dark:text-white">
            <div class="text-center">
                <x-icon-circle-alert class="size-16 inline-block mb-6 text-red-500" />
                <h1 class="text-2xl mb-4">{{ __('Order Payment Failed') }}</h1>
                <p class="mb-6">We encountored an error processing your order payment.</p>


                <a href="{{ route('cart') }}" class="inline-block text-lg px-6 py-3 text-white bg-primary rounded-full">
                    {{ __('Go to Cart') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
