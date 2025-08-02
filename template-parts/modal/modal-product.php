<?php
/**
 * Template part for displaying the product quick view modal
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<!-- Product Modal -->
<div id="productModal" x-show="open" x-cloak class="product-modal fixed inset-0 z-10 bg-black-44 backdrop-blur-sm overflow-x-hidden overflow-y-auto">
    <div class="w-full min-h-[calc(100%-4rem)] flex flex-col justify-center items-center mx-auto my-8">
        <div class="container lg:px-12">
            <div class="rounded-xxl w-full bg-white p-4 lg:p-8" style="box-shadow: 0 4px 50px 0 #000000D1;">

                <div class="lg:hidden flex justify-end mb-4 lg:mb-0">
                    <button @click="hideProductModal()" class="hover:brightness-80">
                        <svg class="w-10 h-10" viewBox="0 0 38 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M25.6373 10.838L18.9192 17.5545L12.2027 10.838L9.96387 13.0769L16.6804 19.7934L9.96387 26.5099L12.2027 28.7487L18.9192 22.0322L25.6373 28.7487L27.8761 26.5099L21.1596 19.7934L27.8761 13.0769L25.6373 10.838Z"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div data-swiper="product"
                         x-effect="
                            if (open && product.images && product.images.length) {
                                $nextTick(() => {
                                    if (window.initProductGallery) window.initProductGallery();
                                });
                            }
                         ">
                        <div class="mb-4">
                            <div data-swiper-product-primary class="swiper mb-4">
                                <div class="swiper-wrapper">
                                    <!-- Render slides with data-color-id and data-slide-index -->
                                    <template x-for="(image, idx) in product.images" :key="idx">
                                        <div class="swiper-slide"
                                             :data-color-id="image.color_slug ? image.color_slug : null"
                                             :data-slide-index="idx">
                                            <div x-data="magnifier()" class="relative w-full border border-gray-300">
                                                <img :src="image.url ? image.url : image"
                                                     x-ref="magnifiable"
                                                     alt=""
                                                     class="h-130 mx-auto" />
                                                <div class="absolute top-5 right-5 flex flex-col gap-2">
                                                    <button x-bind="zoomIn"
                                                            x-transition
                                                            class="w-10 h-10 flex justify-center items-center bg-white border border-neutral rounded-lg shadow-sm hover:brightness-80">
                                                        <svg class="w-6 h-6"
                                                             viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11 6H9V9H6V11H9V14H11V11H14V9H11V6Z"
                                                                  fill="currentColor"/>
                                                            <path d="M10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2ZM10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16Z"
                                                                  fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                    <button x-bind="zoomOut"
                                                            x-transition
                                                            class="w-10 h-10 flex justify-center items-center bg-white border border-neutral rounded-lg shadow-sm hover:brightness-80">
                                                        <svg class="w-6 h-6"
                                                             viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 9H14V11H6V9Z"
                                                                  fill="currentColor"/>
                                                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                                                                  fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <div class="product-swiper-pagination flex justify-center items-center gap-12">
                                    <button data-swiper-navigation-previous class="group disabled:cursor-not-allowed">
                                        <svg class="w-6 h-6 group-enabled:group-hover:-translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.7069 17.293L8.41394 13H17.9999V11H8.41394L12.7069 6.70697L11.2929 5.29297L4.58594 12L11.2929 18.707L12.7069 17.293Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                    <div data-swiper-pagination class="w-fit! flex items-center gap-2"></div>
                                    <button data-swiper-navigation-next class="group disabled:cursor-not-allowed">
                                        <svg class="w-6 h-6 group-enabled:group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div data-swiper-product-thumbs class="swiper" thumbsSlider="">
                                <div class="swiper-wrapper">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="hidden lg:flex justify-end mb-4 lg:mb-0">
                            <button @click="hideProductModal()" class="hover:brightness-80">
                                <svg class="w-10 h-10" viewBox="0 0 38 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M25.6373 10.838L18.9192 17.5545L12.2027 10.838L9.96387 13.0769L16.6804 19.7934L9.96387 26.5099L12.2027 28.7487L18.9192 22.0322L25.6373 28.7487L27.8761 26.5099L21.1596 19.7934L27.8761 13.0769L25.6373 10.838Z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="lg:pt-12">
                            <template x-if="product.number">
                                <p class="mb-2">Product Code: <span x-text="product.number"></span></p>
                            </template>
                            <template x-if="product.name">
                                <p class="text-3xl mb-4" x-text="product.name"></p>
                            </template>
                            <div class="mb-6" x-show="product.description">
                                <p class="text-xl font-black uppercase mb-5">Description</p>
                                <p x-html="product.description"></p>
                            </div>
                            <form id="product-attributes" class="grid grid-cols-4 gap-6 mb-6">
                                <div class="col-span-4 xl:col-span-1">
                                    <div class="h-full flex flex-col justify-center">
                                        <div class="mb-6" x-show="product.sizes && product.sizes.length">
                                            <label for="modalProductSize" class="block mb-2 text-sm font-medium">Choose Size:</label>
                                            <select
                                                x-data="select()"
                                                name="size"
                                                id="modalProductSize"
                                                class="w-full h-11 border border-black px-4 focus:outline-none focus:ring-2 focus:border-transparent"
                                            >
                                                <template x-for="(size, index) in product.sizes" :key="index">
                                                    <option :value="size" x-text="size"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div x-show="product.colours && product.colours.length">
                                            <label for="modalProductColor" class="block mb-2 text-sm font-medium">Choose Colour:</label>
                                            <select
                                                x-data="select()"
                                                name="colour"
                                                id="modalProductColor"
                                                class="w-full h-11 border border-black px-4 focus:outline-none focus:ring-2 focus:border-transparent"
                                                data-color-select
                                                data-style="color"
                                            >
                                                <template x-for="(colour, index) in product.colours" :key="index">
                                                    <option
                                                        :value="colour.id"
                                                        x-text="colour.label"
                                                        :data-custom-properties="JSON.stringify({color: colour.value})"
                                                    ></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-4 xl:col-span-3">
                                    <div class="h-full flex flex-col justify-center">
                                        <div class="">
                                            <a id="modalProductPdfLink" href="#" target="_blank" class="group w-full h-11 flex justify-between items-center bg-[#E1E2E3] border border-[#31344A33] px-4">
                                                <span>Download PDF Version</span>
                                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path class="-translate-y-1 group-hover:translate-y-0 duration-300" d="M12 16L16 11H13V4H11V11H8L12 16Z" fill="currentColor"/>
                                                    <path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z" fill="currentColor"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="space-y-6 mb-6">
                                <a x-show="product.link" :href="product.link" class="btn w-full group h-11 flex justify-center items-center gap-3 border border-[#9B9B9B] px-4" style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) -32.42%, rgba(255, 255, 255, 0.1) 100%);">
                                    <span>View Product</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <a x-show="product.where_to_buy" :href="product.where_to_buy" class="btn group h-14 flex justify-center items-center gap-3 bg-[#31344A1F] backdrop-blur-2xl px-6 btn">
                                    <span>Where to Buy</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                            <div x-show="product.fabric_content || product.fabric_weight">
                                <p x-show="product.fabric_content">Fabric: <span x-text="product.fabric_content"></span></p>
                                <p x-show="product.fabric_weight">Weight (Fabric): <span x-text="product.fabric_weight"></span></p>
                            </div>
                            <ul>
                                <template x-for="(feature, index) in product.features" :key="index">
                                    <li>
                                        <span x-text="Object.keys(feature)[0]"></span>:
                                        <span x-text="feature[Object.keys(feature)[0]]"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>