@php
    $defaultCategories = config('book-categories.categories');
    $defaultTags = config('book-categories.tags');
@endphp

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
@endpush

<div>

    <section class="w-full bg-white dark:bg-gray-800 dark:border-t dark:border-t-gray-700 py-6">
        <div class="container md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="Edit Products" :links="[['title' => 'Products', 'slug' => '/admin/products']]" />
            <h1 class="text-2xl mt-8 font-bold dark:text-white capitalize mb-4">
                {{ $product->name ?? 'Add New Products' }}</h1>
            @if ($product)
                <div class="flex justify-between">
                    <div class="flex items-center gap-4">

                        <a download href="{{ $product->download_link ?? '#' }}"><x-button
                                class="py-3 px-6 text-center !bg-primary text-white">
                                {{ __('Download Book') }}
                            </x-button></a>
                        <a target="_blank" rel="noopener noreferrer"
                            href="{{ 'https://www.rnstudentresources.com/products/' . $form->slug . '-' . $product->id }}"><x-button
                                class="py-3 px-6 text-center !bg-primary/20 !text-primary">
                                {{ __('View Product') }}
                            </x-button></a>
                    </div>
                    <div>
                        <x-button wire:confirm="Please confirm deleting this product"
                            wire:click="delete">Delete</x-button>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <section class="container md:px-6 lg:px-8 py-8">
        <div class="rounded-md p-6 bg-white">
            <form x-data="{ showSlugEditor: false, showDiscountInput: false }" wire:submit="update" class="grid grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.live="form.name"
                        required />
                    <x-input-error for="name" class="mt-2" />

                    <button x-on:click="showSlugEditor = !showSlugEditor;" class="" type="button">
                        <p class="font-bold text-blue-700 mt-2 flex items-center">
                            @if ($product)
                                {{ 'www.rnstudentresources.com/products/' . $form->slug . '-' . $product->id }}
                            @else
                                {{ 'www.rnstudentresources.com/products/' . $form->slug }}
                            @endif
                            <x-icon-edit class="h-4 w-auto inline-block ml-4" />
                        </p>
                    </button>
                </div>
                <div x-show="showSlugEditor" class="sm:col-span-2 -mt-3 ">
                    <x-input id="slug" type="text" class="block w-full" wire:model.live="form.slug" />
                </div>
                <div class="w-full">
                    <x-label for="price" value="{{ __('Price') }}" />
                    <x-input id="price" type="number" step="any" class="mt-1 block w-full"
                        wire:model="form.price" required />
                    <div class="mt-2">
                        <button x-on:click="showDiscountInput = !showDiscountInput;" class="" type="button">
                            <p class="font-bold text-blue-700 flex items-center">
                                Discounted from <x-icon-edit class="h-4 w-auto inline-block ml-4" />
                            </p>
                        </button>
                        <div x-show="showDiscountInput">
                            <x-input id="discounted_from" type="number" step="any" class="mt-1 block w-full"
                                wire:model="form.discounted_from" placeholder="Original price, example $ 70" />
                        </div>
                    </div>
                    <x-input-error for="price" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-label for="type" value="{{ __('Resource Type') }}" />
                    <x-select id="type" class="mt-1 block w-full" wire:model="form.type" :options="['PDF', 'Exam Screenshots', 'Videos', 'Mixed Media']" />
                    <x-input-error for="type" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-label for="in_stock" value="{{ __('In Stock') }}" />
                    <x-input id="in_stock" type="checkbox" class="mt-1" wire:model="form.in_stock" />
                    <x-input-error for="in_stock" class="mt-2" />
                </div>
                <div class="w-full col-span-2">
                    <x-label for="download_link" value="{{ __('Download Link') }}" />
                    <x-input id="download_link" type="text" class="mt-1 block w-full" wire:model="form.download_link"
                        required />
                    <x-input-error for="download_link" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <h4 class="mb-4 font-bold">Categories</h4>
                    <div class="grid grid-cols-4">
                        @foreach ($defaultTags as $item)
                            <label
                                class="flex items-center gap-4 p-2.5 hover:bg-slate-100 rounded ring-1 ring-transparent has-[:checked]:ring-indigo-500 has-[:checked]:text-indigo-900 has-[:checked]:bg-indigo-50">

                                <input class="rounded form-checkbox" type="checkbox" name="tags"
                                    value="{{ strtolower($item) }}" wire:model="form.categories" />

                                <span>{{ $item }}</span>

                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="w-full col-span-2 mb-8">
                    <x-label for="description" value="{{ __('Description') }}" />

                    <div class="w-full h-[300px] mt-1" wire:ignore>
                        <div x-data x-ref="quillEditor" x-init="quill = new Quill($refs.quillEditor, {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{
                                        'header': [1, 2, false]
                                    }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    ['blockquote', 'link'],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    ['clean']
                                ]
                            }
                        });
                        quill.on('text-change', function() {
                            $dispatch('quill-input', quill.root.innerHTML);
                        });"
                            x-on:quill-input.debounce.500ms="$wire.set('form.description', $event.detail)">
                            {!! $form->description !!}
                        </div>
                    </div>


                    <x-input-error for="description" class="mt-2" />
                </div>

                <div class="w-full col-span-2">
                    <x-label for="images" value="{{ __('Images') }}" />
                    <x-admin.image-uploader images="form.images" />
                    <x-input-error for="images" class="mt-2" />
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
