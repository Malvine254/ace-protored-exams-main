<div>


    <section class="container md:px-6 lg:px-8 py-8">
        <div class="mb-4 flex gap-4 justify-between">
            <div class="flex gap-4">
                <x-input class="min-w-[350px]" placeholder="Search" wire:model.live="search_string" />
            </div>

            <a href="{{ route('admin.schools.edit', ['id' => 'new']) }}">
                <x-button>Add New School</x-button>
            </a>
        </div>
        <x-admin.schools-table :schools="$schools" />

        <div class="container md:px-6 lg:px-8 py-6">
            {{ $schools->links() }}
        </div>
    </section>
</div>
