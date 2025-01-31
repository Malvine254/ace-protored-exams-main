@props(['images' => [], 'maxFiles' => 20])

<div x-cloak x-data="imageUploader" class="w-full grid gap-4 mt-2 mb-4">
    <template x-if="loading">
        <div
            class="fixed top-0 left-0 right-0 bottom-0 z-[100] flex items-center justify-center bg-black bg-opacity-50 text-white">
            {{ __('Uploading Images') }} ...
        </div>
    </template>

    <div x-show="error" class="bg-red-200 text-red-500 p-4 rounded text-sm">
        <span>Image upload failed</span>
    </div>

    <div :class="images.length > 0 && 'border-orange-500 dark:border-pink-500'"
        class="flex justify-center items-center border-2 border-gray-300 dark:border-dark-line border-dashed rounded-md h-48 overflow-y-hidden">

        <div class="space-y-1 text-center px-6 pt-5 pb-6 w-full">
            <x-icon-image-add class="mx-auto h-12 w-12 text-gray-400" />
            <div class="text-sm text-gray-600 dark:text-gray-400">
                <label
                    class="relative cursor-pointer bg-transparent rounded-md font-medium text-orange-500 dark:text-pink-500"
                    for="post_image">
                    <p class="text-gray-500 dark:text-white space-y-1 text-center">
                        <span
                            class="text-orange-500 dark:text-primary text-center block">{{ __('Upload Images') }}</span>
                        <span
                            class="block text-xs text-gray-500">{{ __('PNG, JPG, JPEG; Max :maxFiles Images', ['maxFiles' => $maxFiles]) }}</span>
                    </p>
                    {{-- File input moved outside of template so to not be overwritten by the x-if --}}
                </label>
            </div>
        </div>




        <input class="sr-only" id="post_image" name="post_image" type="file" multiple accept="image/*"
            x-on:change="selectFile">
    </div>
    <div class="block" id="sh-images">
        <template x-if="images.length > 0">

            <template x-for="(image,index) in images" :key="image">
                <div :data-id="image"
                    class="image-item group relative h-[160px] inline-block w-[48%] md:w-[30%] p-1 object-cover rounded">
                    <div class=" absolute top-3 right-3 text-white tracking-wider ">
                        <button type="button" x-on:click="images = images.filter((i) => i !== image)"
                            class="h-8 w-8 rounded-full bg-white border flex items-center justify-center">
                            <x-icon-trash class="h-4 w-auto text-red-600" />
                        </button>
                    </div>
                    <img :src="image || ''" alt="" class="w-full h-full object-cover rounded">
                </div>
            </template>
        </template>
    </div>

    {{-- Pending Images Modal --}}
    <div x-show="pendingImages.length > 0" class="fixed inset-0 bg-white z-50 flex flex-col" id="pendingImgModal"
        aria-hidden="true" x-cloak>
        <div class="px-4 h-[80px] border-b flex justify-between items-center w-full max-w-7xl mx-auto">
            <h3 class="hidden md:block text-lg">{{ __('Upload Images') }}</h3>

            <div class="flex items-center gap-4">
                <x-button type="button" class="bg-primary hover:bg-black" @click="uploadAllImages">
                    {{ __('Upload All') }}
                </x-button>
                <x-button type="button" class="bg-red-500 hover:bg-red-600" @click="pendingImages = []">
                    {{ __('Cancel') }}
                </x-button>
            </div>
        </div>
        <div class="h-[calc(100vh-80px)] overflow-y-auto w-full bg-gray-200">
            <div class="p-6 grid md:grid-cols-4 gap-4 w-full max-w-6xl mx-auto">

                <template x-for="(image,index) in pendingImages" :key="image">
                    <div :data-id="image" class="group relative h-[240px] block p-1 object-cover rounded">
                        <div class=" absolute top-3 right-3 text-white tracking-wider ">
                            <button type="button" x-on:click="openCropperByIndex(index)"
                                class="h-8 w-8 rounded-full bg-white border flex mb-2 items-center justify-center">
                                <x-icon-edit class="h-4 w-auto text-blue-600" />
                            </button>
                            <button type="button" x-on:click="pendingImages = pendingImages.filter((i) => i !== image)"
                                class="h-8 w-8 rounded-full bg-white border flex items-center justify-center">
                                <x-icon-trash class="h-4 w-auto text-red-600" />
                            </button>
                        </div>
                        <img :src="image" alt="" class="w-full h-full object-cover rounded">
                    </div>
                </template>

            </div>

        </div>

        {{-- Cropping Modal --}}
        <div x-show="Boolean(croppingImage)" class="fixed inset-0 bg-black/20 z-[100] flex items-center justify-center"
            id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
            <div class="w-full md:w-3/4 h-[450px] bg-white rounded-md" role="document">
                <div class="w-full">
                    <div class="p-4 flex w-full justify-between items-center">
                        <h5 class="modal-title" id="cropperModalLabel">{{ __('Crop Image') }}</h5>
                        <button type="button" @click="closeCropper" class="text-xl" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-[300px] cropper-bg">
                        <img id="croppingImage" :src="croppingImage"
                            style="max-width: 100%; height: 100%; width: auto; margin: 0 auto;">
                    </div>
                    <div class="p-4 flex gap-4">
                        <x-button type="button" class="bg-primary hover:bg-black"
                            @click="cropImage">{{ __('Crop Image') }}</x-button>
                        <x-button type="button" class="bg-red-500 hover:bg-red-600" data-dismiss="modal"
                            @click="closeCropper">{{ __('Cancel') }}</x-button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageUploader', () => ({
                images: @entangle($images),
                pendingImages: [],
                loading: false,
                maxUploads: {{ $maxFiles ?? 20 }},
                sortable: null,
                cropper: null,
                croppingImage: null,
                croppingImageIndex: null,
                cloudName: 'geoffokumustudio',
                uploadPreset: 'evgr6nbq',
                error: null,
                $watch: {
                    images: function() {
                        this.initSort();
                    }
                },

                selectFile(event) {
                    if (event.target.files.length < 1) {
                        return;
                    }

                    // Check if the total number of images plus the new ones exceeds the limit
                    if (this.images.length + event.target.files.length > this.maxUploads) {
                        alert(`You can only upload up to ${this.maxUploads} images.`);
                        return;
                    }

                    for (var i = 0; i < event.target.files.length; i++) {
                        let file = event.target.files[i];

                        // Check if the file is an image
                        if (!file.type.match('image.*')) {
                            alert('Only image files are allowed');
                            continue;
                        }

                        //resize image
                        this.loading = true;
                        var maxSize = 1000;
                        this.resizeImage(file, maxSize).then((resizedImage) => {
                            if (this.pendingImages.includes(resizedImage)) {
                                this.loading = false;
                                return;
                            }

                            this.pendingImages = [...this.pendingImages, resizedImage];

                            this.loading = false;
                        });
                    }
                },

                resizeImage(file, maxSize) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();

                        reader.onload = function(event) {
                            const img = new Image();

                            img.onload = function() {
                                let width = img.width;
                                let height = img.height;

                                // Calculate the scaling factor to maintain the aspect ratio
                                if (width > height) {
                                    if (width > maxSize) {
                                        height = Math.round((height *= maxSize /
                                            width));
                                        width = maxSize;
                                    }
                                } else {
                                    if (height > maxSize) {
                                        width = Math.round((width *= maxSize / height));
                                        height = maxSize;
                                    }
                                }

                                const canvas = document.createElement("canvas");
                                canvas.width = width;
                                canvas.height = height;

                                const ctx = canvas.getContext("2d");
                                ctx.drawImage(img, 0, 0, width, height);

                                resolve(canvas.toDataURL("image/jpeg"));
                            };

                            img.onerror = function(error) {
                                reject(error);
                            };

                            img.src = event.target.result;
                        };

                        reader.onerror = function(error) {
                            reject(error);
                        };

                        reader.readAsDataURL(file);
                    });
                },

                dataURLToBlob(dataURL) {
                    var BASE64_MARKER = ';base64,';
                    if (dataURL.indexOf(BASE64_MARKER) == -1) {
                        var parts = dataURL.split(',');
                        var contentType = parts[0].split(':')[1];
                        var raw = parts[1];

                        return new Blob([raw], {
                            type: contentType
                        });
                    }

                    var parts = dataURL.split(BASE64_MARKER);
                    var contentType = parts[0].split(':')[1];
                    var raw = window.atob(parts[1]);
                    var rawLength = raw.length;

                    var uInt8Array = new Uint8Array(rawLength);

                    for (var i = 0; i < rawLength; ++i) {
                        uInt8Array[i] = raw.charCodeAt(i);
                    }

                    return new Blob([uInt8Array], {
                        type: contentType
                    });
                },

                openCropperByIndex(index) {
                    this.openCropper(this.pendingImages[index], index);
                },

                async uploadAllImages() {
                    this.loading = true;

                    // let imagesToUpload = this.images.filter(function(el) {
                    //     return !el.includes('http');
                    // });

                    for (let i = 0; i < this.pendingImages.length; i++) {
                        // remove from queue
                        // this.images = this.images.filter(function(el) {
                        //     return el !== imagesToUpload[i];
                        // });

                        // upload
                        const uploadRes = await this.uploadToServer(this.pendingImages[i]);
                        if (uploadRes.url) {
                            this.images = [...this.images, uploadRes.url];
                        } else {
                            this.error = true;
                        }
                    }

                    this.loading = false;
                    this.pendingImages = [];
                    this.initSort();
                },

                closeCropper() {
                    if (this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }
                    this.croppingImage = null;
                    this.croppingImageIndex = null;

                },

                async openCropper(imageSrc, index) {
                    this.croppingImage = imageSrc;
                    this.croppingImageIndex = index;
                    //Hacky: wait 1s for dom change
                    await new Promise(r => setTimeout(r, 1000));
                    // Initialize cropper
                    this.$nextTick(() => {
                        const imageElement = document.getElementById('croppingImage');
                        this.cropper = new Cropper(imageElement, {
                            aspectRatio: 7 / 6,
                            viewMode: 1
                        });
                    });
                },

                $nextTick(callback) {
                    requestAnimationFrame(() => {
                        requestAnimationFrame(callback);
                    });
                },

                async cropImage() {
                    this.loading = true;

                    const canvas = this.cropper.getCroppedCanvas();
                    const croppedImage = canvas.toDataURL('image/jpeg');

                    this.pendingImages.splice(this.croppingImageIndex, 1, croppedImage);

                    this.loading = false;
                    this.closeCropper();
                },

                async uploadToServer(base64Image) {
                    const formData = new FormData();
                    formData.append('file', base64Image);

                    const response = await fetch(`/upload-image`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file: base64Image
                        })
                    });
                    // const formData = new FormData();
                    // formData.append('file', base64Image);
                    // formData.append('upload_preset', this.uploadPreset);

                    // const response = await fetch(
                    //     `https://api.cloudinary.com/v1_1/${this.cloudName}/image/upload`, {
                    //         method: 'POST',
                    //         body: formData
                    //     });

                    const jsonResponse = await response.json();

                    return jsonResponse;
                },

                init() {
                    if (!this.images) {
                        this.images = []
                    }

                    this.initSort();
                },

                initSort() {
                    if (this.images.length > 0) {
                        this.sortable = Sortable.create(document.getElementById('sh-images'), {
                            onEnd: (event) => {
                                let temp_arr = this.sortable.toArray();

                                //only add image by checking if string is url
                                this.images = temp_arr.filter(function(el) {
                                    return el.includes('http');
                                });
                            },
                        });
                    }
                },

                filterValidImages() {
                    return this.images.filter(function(el) {
                        return el && el.includes('http');
                    });
                }
            }))
        })
    </script>
@endpush
