<div>
    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="All Users" :links="[]" />
            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">All Users</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Check the status of recent orders, manage returns, and discover similar products.
            </p>
        </div>
    </section>

    <section class="container md:px-6 lg:px-8 py-8">
        <livewire:tables.users-table />
    </section>
</div>
