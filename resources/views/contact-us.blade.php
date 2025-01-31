<x-app-layout>
    <x-widgets.seo-tags :data="[
        'title' => 'Contact Us',
        'description' => 'Get in touch with us for any questions, feedback, or suggestions. We are here to help you.',
        'image' => asset('img/student-in-a-library.jpg'),
    ]" />
    <div class="container pt-4 md:px-6 lg:px-8 pb-4">
        <x-widgets.breadcrumbs title="Contact Us" :links="[]" />

        <div class="mt-6 overflow-hidden bg-white rounded-xl">
            <div class="px-6 py-12 sm:p-12 mx-auto max-w-5xl">
                <h3 class="text-3xl font-semibold text-center text-gray-900">Send us a message</h3>

                <form action="#" method="POST" class="mt-14">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">
                        <div>
                            <label for="" class="text-base font-medium text-gray-900"> Your name
                            </label>
                            <div class="mt-2.5 relative">
                                <input type="text" name="" id="" placeholder="Enter your full name"
                                    class="block w-full px-4 py-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600" />
                            </div>
                        </div>

                        <div>
                            <label for="" class="text-base font-medium text-gray-900"> Email address
                            </label>
                            <div class="mt-2.5 relative">
                                <input type="email" name="" id="" placeholder="Enter your full name"
                                    class="block w-full px-4 py-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="" class="text-base font-medium text-gray-900"> Message
                            </label>
                            <div class="mt-2.5 relative">
                                <textarea name="" id="" placeholder=""
                                    class="block w-full px-4 py-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md resize-y focus:outline-none focus:border-blue-600 caret-blue-600"
                                    rows="4"></textarea>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center w-full px-4 py-4 mt-2 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
