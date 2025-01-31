@props(['country' => '', 'province' => '', 'defaultCountry' => '', 'defaultProvince' => ''])

@php
    $defaultCategories = config('book-categories.categories');
    $schoolTypes = config('constants.school_type');

    $locale = app()->getLocale();
@endphp

@push('head')
    <!-- link for jquery style -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}

    <script src="{{ asset('gds/js/geodatasource-cr.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="assets/css/geodatasource-countryflag.css"> --}}

    <!-- link to nl language po file -->
    <link rel="gettext" type="application/x-po"
        href="{{ asset('languages/' . $locale . '/' . 'LC_MESSAGES/' . $locale . '.po') }}" />
    <script type="text/javascript" src="{{ asset('gds/js/Gettext.js') }}"></script>
@endpush

<div>

    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Edit Products" :links="[['title' => 'Schools', 'slug' => '/admin/schools']]" />
            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-2">
                {{ $school->name ?? 'Add New School' }}</h1>
            @if ($school)
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    {{ $school->description }}
                </p>
            @endif
        </div>
    </section>


    <section class="container md:px-6 lg:px-8 py-8">
        <div class="rounded-md p-6 bg-white">
            <form wire:submit="save" class="grid grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name" required />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div wire:ignore class="col-span-2 grid grid-cols-6 gap-6">
                    <!-- Country -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="country" value="{{ __('Country') }}" />
                        <select wire:model="form.country" id="countrySelection"
                            class="gds-cr w-full block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            country-data-region-id="gds-cr-one" data-language="{{ $locale }}"
                            country-data-default-value="{{ $form->country ?? 'United States of America' }}"></select>
                        <x-input-error for="form.country" class="mt-2" />
                    </div>

                    <!-- Province -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="gds-cr-one" value="{{ __('State/Province') }}" />
                        <select wire:model="form.state_province"
                            class="form-control w-full block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            id="gds-cr-one" region-data-default-value="{{ $form->state_province }}"></select>
                        <x-input-error for="form.province" class="mt-2" />
                    </div>
                </div>

                <!-- Type -->
                <div class="w-full">
                    <x-label for="school-type" value="{{ __('School Level') }}" />
                    <select wire:model="form.type"
                        class="form-control w-full block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        id="school-type">
                        @foreach ($schoolTypes as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="school-type" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <h4 class="mb-4 font-bold">Courses</h4>
                    <div class="w-full grid grid-cols-2 gap-4">
                        @foreach ($defaultCategories as $category)
                            <div class="w-full p-4 border">
                                <h4 class="font-bold mb-4">{{ $category['title'] }}</h4>

                                <div class="grid grid-cols-2">
                                    @foreach ($category['categories'] as $item)
                                        <label
                                            class="flex items-center gap-4 p-2.5 hover:bg-slate-100 rounded ring-1 ring-transparent has-[:checked]:ring-indigo-500 has-[:checked]:text-indigo-900 has-[:checked]:bg-indigo-50">

                                            <input class="rounded form-checkbox" type="checkbox" name="tags"
                                                value="{{ $item }}" wire:model="form.courses" />

                                            <span>{{ $item }}</span>

                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error for="categories" class="mt-2" />
                </div>
                <div class="w-full col-span-2">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" type="text" class="mt-1 block w-full min-h-[200px]" wire:model="form.description"></textarea>
                    <x-input-error for="description" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <x-button type="submit" wire:loading.attr="disabled"
                        class="py-4 px-8 text-center !bg-primary text-white">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </div>
    </section>
</div>
