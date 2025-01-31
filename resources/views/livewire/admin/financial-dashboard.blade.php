<section class="container md:px-6 lg:px-8 py-4">
    <x-widgets.breadcrumbs title="Financial Dashboard" :links="[]" />

    <section class="py-4">
        <div class="grid grid-cols-4 gap-5">
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Orders</span>

                <h3 class="font-bold">{{ $orders_count }}</h3>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Paid Orders</span>

                <h3 class="font-bold">{{ $paid_orders_count }}</h3>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Total Revenue</span>

                <h3 class="font-bold">$ {{ $revenue }}</h3>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Available Balance</span>

                <h3 class="font-bold">$ {{ $pending_balance }}</h3>
            </a>
        </div>

        <div class="mt-6">
            <h2 class="text-gray-600 uppercase tracking-wider block mb-4 text-sm font-bold">Withdrawal history
            </h2>
            <div class="bg-white rounded mb-4 p-6">
                <h3 class="text-xl font-bold mb-1">Make a Withrawal</h3>
                <p class="mb-4 text-gray-600">Withdraw funds to your account</p>
                <x-button wire:click="$set('showWithdrawPrompt', true)">Start A Withdrawal</x-button>
            </div>
            @empty($withdrawal_logs)
                <x-widgets.empty title="O withdrawals" />
            @endempty
            @foreach ($withdrawal_logs as $item)
                <div class="mb-1">
                    <div class="p-4 bg-white rounded-t grid grid-cols-4 gap-4">
                        <div>
                            <span class="block mb-2 text-gray-600">Time</span>
                            <span>{{ $item->created_at }}</span>
                        </div>
                        <div>
                            <span class="block mb-2 text-gray-600">Amount</span>
                            <span>$ {{ $item->total_amount }}</span>
                        </div>
                        <div>
                            <span class="block mb-2 text-gray-600">Starting Balance</span>
                            <span>$ {{ $item->starting_balance }}</span>
                        </div>
                        <div>
                            <span class="block mb-2 text-gray-600">Ending Balance</span>
                            <span>$ {{ $item->ending_balance }}</span>
                        </div>

                    </div>
                    <div class="bg-blue-100 rounded-b px-4 py-2 w-full flex justify-between items-center">
                        <div class="p-2 flex items-center gap-2 text-sm text-gray-600">
                            @if ($item->cleared)
                                <div class="size-2 rounded-full bg-green-500"></div>
                                <span>Cleared</span>
                            @else
                                <div class="size-2 rounded-full bg-orange-500"></div>
                                <span>Not Cleared</span>
                            @endif

                        </div>
                        @if (!$item->cleared)
                            <x-button wire:click="handleCleared('{{ $item->id }}')"
                                class="bg-green-600/20 hover:bg-green-600/30 !text-green-600">Mark As
                                Cleared</x-button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <x-dialog-modal wire:model="showWithdrawPrompt" id="withdrawal-prompt">
            <x-slot name="title">Withdraw</x-slot>
            <x-slot name="content">
                <div class="p-8 ">
                    <form wire:submit.prevent="handleWithdraw">
                        <label for="amount">Withdrawal Amount:</label>
                        <x-input id="amount" type="number" class="mb-4 mt-1 block w-full" wire:model.live="amount"
                            required />

                        <x-button wire:loading.attr="disabled"
                            class="w-full justify-center !text-center py-3 disabled:bg-gray-200">Start
                            Withdrawal</x-button>
                    </form>

                </div>
            </x-slot>
            <x-slot name="footer"></x-slot>

        </x-dialog-modal>
    </section>
</section>
