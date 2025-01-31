<div>
    <x-widgets.product-seo :data="[
        'name' => $product->name,
        'description' => Str::limit($product->description, 155),
        'image' => $product->images[0],
        'offers' => [
            'type' => 'Offer',
            'price' => $product->price,
            'priceCurrency' => 'USD',
            'availability' => 'https://schema.org/InStock',
            'url' => url()->current(),
        ],
    ]" />
    <section class="bg-bg dark:bg-gray-700 py-3">
        <div class="container max-w-7xl md:px-6 lg:px-8">
            <x-widgets.breadcrumbs title="{{ $product->name }}" :links="[['title' => 'Products', 'slug' => '/shop']]" />
        </div>
    </section>

    <section class="container max-w-7xl md:px-6 lg:px-8 w-full pt-10 pb-6 grid md:grid-cols-[1fr_360px] gap-8">
        <div>
            <section class="block">
                <div class="w-full relative scroll-smooth">
                    <div
                        class="w-16 h-16 rounded-full absolute z-50 top-4 left-4 bg-red-600 text-white flex items-center justify-center">
                        <span class="uppercase text-sm font-bold">Sale</span>
                    </div>
                    <x-shop.product-images :images="$product->images" />
                </div>

                <div class="mb-8 dark:text-white">
                    <h1 class="font-bold text-2xl md:text-3xl md:leading-tight mb-8 max-w-4xl">
                        {{ $product->name }}
                    </h1>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div>
                            <h3 class="uppercase text-gray-600 dark:text-white/80 text-sm mb-2">
                                Resource Type
                            </h3>
                            <span class="text-sm">{{ $product->type ?? 'Exam' }}</span>
                        </div>
                        <div>
                            <h3 class="uppercase text-gray-600 dark:text-white/80 text-sm mb-2">
                                Categories
                            </h3>

                            <div class="flex items-center gap-2">
                                @foreach ($product->categories as $item)
                                    <a class="block p-1 rounded dark:bg-white/20 bg-primary/20 text-xs uppercase"
                                        href="{{ '/tags' . '/' . $item }}">
                                        {{ $item }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h3 class="uppercase text-gray-600 dark:text-white/80 text-sm mb-2">
                                Tags
                            </h3>

                            <div class="flex items-center gap-2">
                                @foreach ($product->tags as $item)
                                    <a class="block p-1 rounded dark:bg-white/20 bg-primary/20 text-xs uppercase"
                                        href="{{ '/tags' . '/' . $item }}">
                                        {{ $item }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="rounded-lg border bg-white dark:text-white dark:border-gray-700 dark:bg-gray-800 mb-8">
                <div class="p-4 border-b dark:border-gray-700">
                    <h2 class="uppercase">Description</h2>
                </div>
                <article class="prose max-w-none dark:text-white/80 p-4">
                    <p>{!! $product->description !!}</p>
                </article>
            </section>

            <x-shop.product-rating />
        </div>

        <div>
            <x-shop.buy-cta :product="$product" />
            <x-widgets.social-share :title="$product->name" :description="$description" :slug="url()->current()" :img="$product->images[0]" />
            <x-home.fb-group />
        </div>
    </section>
    <x-shop.related-products :products="$related_products" />
    <x-home.benefits />
    <x-home.faqs :questions="config('faqs.downloadPageFaqs')" />
    <x-widgets.whatsapp-btn />


</div>
