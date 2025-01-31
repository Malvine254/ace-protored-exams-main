<x-widgets.hover-card>
    <x-slot name="anchor">
        <a href="{{ route('cart') }}" class="relative dark:text-white">
            <x-icon-shopping-bag class="size-7 stroke-[0.5]" />
            <span
                class="absolute -top-1 -right-2 bg-blue-500 text-white text-[12px] p-1 size-5 flex items-center justify-center rounded-full">
                {{ $cartTotal }}
            </span>
        </a>
        @livewire('checkout.cart-prompt')

        {{-- Floating button --}}
        @if ($cartTotal > 0)
            <a href="{{ route('cart') }}"
                class="fixed z-[100] bottom-8 right-8 size-16 rounded-full shadow-lg bg-primary flex items-center justify-center">
                <button class="relative text-white">
                    <x-icon-shopping-bag class="size-7 stroke-[0.5]" />
                    <span
                        class="absolute -top-1 -right-2 bg-red-500 text-white text-[12px] p-1 size-5 flex items-center justify-center rounded-full">
                        {{ $cartTotal }}
                    </span>
                </button>
            </a>
        @endif
    </x-slot>
    <div class="p-2 px-4 min-h-[200px] flex flex-col">
        <span class="uppercase text-xs block mb-4">{{ $cartTotal }} Cart Items</span>
        <div class="flex-grow">
            @if (count($cart) > 0)
                <ul>
                    @foreach ($cart as $item)
                        <li class="text-xs block py-2 border-t dark:border-t-gray-600">
                            <a href="{{ route('cart') }}">
                                {{ $item->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif


        </div>
        <a href="{{ route('cart') }}"
            class="w-full block border dark:border-gray-600 text-center hover:text-primary hover:border-primary rounded-md px-4 py-2 text-xs uppercase">
            Open Cart
        </a>
    </div>
</x-widgets.hover-card>
