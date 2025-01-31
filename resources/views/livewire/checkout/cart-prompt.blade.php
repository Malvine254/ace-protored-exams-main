<x-dialog-modal wire:model="showCheckoutPrompt" id="checkout-prompt">
    <x-slot name="title">Buy</x-slot>
    <x-slot name="content">
        <div class="p-8 dark:text-white text-center">
            <div class=" size-16 rounded-full bg-gray-200 dark:bg-white/10 inline-flex items-center justify-center mb-4">
                <x-icon-shopping-bag class="h-10 w-auto stroke-[0.5]" />
            </div>

            <h3 class="text-3xl font-bold mb-4">Added to shopping Bag</h3>
            <a href="{{ route('cart') }}" class="inline-block text-center px-6 py-3 rounded-md bg-primary text-white">
                Buy Now
            </a>

        </div>
    </x-slot>
    <x-slot name="footer"></x-slot>

</x-dialog-modal>
