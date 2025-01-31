<div>
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Dashboard" :links="[]" />
            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Shop overview
            </p>
        </div>
    </section>

    <section class="container md:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-4 gap-5">
            <a href="{{ route('admin.users') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Users</span>

                <h3 class="font-bold">{{ $users_count }}</h3>
            </a>
            <a href="{{ route('admin.products') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Products</span>

                <h3 class="font-bold">{{ $products_count }}</h3>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Orders</span>

                <h3 class="font-bold">{{ $orders_count }}</h3>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 bg-white block rounded-md">
                <span class="block uppercase mb-4">Paid Orders</span>

                <h3 class="font-bold">{{ $paid_orders_count }}</h3>
            </a>
        </div>
    </section>
</div>
