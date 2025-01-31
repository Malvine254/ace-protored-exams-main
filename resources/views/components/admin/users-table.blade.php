@props(['users' => []])

@php
    $headerItems = ['Time', 'ID', 'Name', 'Email', 'Actions'];
@endphp

<div class="overflow-x-auto relative min-h-[400px]">
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white dark:bg-gray-800 table-striped relative">
        <thead>
            <tr class="text-left">
                {{-- <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            <label
                                class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline">
                            </label>
                        </th> --}}
                @foreach ($headerItems as $heading)
                    <th
                        class="bg-gray-100 dark:bg-gray-700 dark:border-gray-900 dark:text-white/80 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-start last:text-end">
                        {{ $heading }}
                    </th>
                @endforeach

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    {{-- <td class="border-dashed border-t border-gray-200 px-3">
                                <label
                                    class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox"
                                        class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline">
                                </label>
                            </td> --}}
                    <x-widgets.table-column>{{ $user->created_at->format('d M Y : h:m') }}</x-widgets.table-column>
                    <x-widgets.table-column>{{ $user->id }}</x-widgets.table-column>
                    <x-widgets.table-column>{{ $user->name }}</x-widgets.table-column>

                    <x-widgets.table-column>{{ $user->email }}</x-widgets.table-column>
                    <x-widgets.table-column>
                        <a href="mailto:{{ $user->email }}" class="text-primary uppercase font-semibold">Send Email</a>
                    </x-widgets.table-column>


                </tr>
            @endforeach

        </tbody>
    </table>
</div>
