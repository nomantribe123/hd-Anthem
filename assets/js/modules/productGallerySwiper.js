import Swiper from "swiper";
import { EffectFade, Navigation, Pagination, Thumbs } from "swiper/modules";
import Choices from "choices.js";

const initProductGallery = () => {
    const productGalleries = document.querySelectorAll('[data-swiper="product"]');

    productGalleries.forEach(gallery => {
        // Initialize thumbnail slider
        const thumbsSlider = gallery.querySelector('[data-swiper-product-thumbs]');
        const mainSlider = gallery.querySelector('[data-swiper-product-primary]');

        if (!thumbsSlider || !mainSlider) return;

        const thumbsSwiper = new Swiper(thumbsSlider, {
            modules: [Navigation],
            slidesPerView: 4,
            spaceBetween: 16,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
        });

        const mainSwiper = new Swiper(mainSlider, {
            modules: [EffectFade, Navigation, Pagination, Thumbs],
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            slidesPerView: 1,
            speed: 1000,
            allowTouchMove: false,
            navigation: {
                nextEl: gallery.querySelector('[data-swiper-navigation-next]'),
                prevEl: gallery.querySelector('[data-swiper-navigation-previous]'),
                disabledClass: 'opacity-50'
            },
            pagination: {
                el: gallery.querySelector('[data-swiper-pagination]'),
                clickable: true,
                bulletClass: 'swiper-pagination-bullet-class',
                bulletActiveClass: 'swiper-pagination-bullet-active-class'
            },
            thumbs: {
                swiper: thumbsSwiper
            }
        });
        
        // Store globally for access in other scripts
        window.productSwiper = mainSwiper;
    });

    document.querySelectorAll('.color-swatch [data-color-id]').forEach(colorSwatch => {
        colorSwatch.addEventListener('click', function(e) {
            e.stopImmediatePropagation();

            const galleries = document.querySelectorAll('[data-swiper="product"]');
            let gallery = null;
            let mainSliderEl = null;
            let targetSlide = null;
            let selectedColorId = e.target.getAttribute('data-color-id');

            for (const g of galleries) {
                if (g.offsetParent === null) continue; // skip hidden galleries
                const main = g.querySelector('[data-swiper-product-primary]');
                if (!main) continue;
                const slide = main.querySelector(`.swiper-slide[data-color-id="${selectedColorId}"]`);
                if (slide) {
                    gallery = g;
                    mainSliderEl = main;
                    targetSlide = slide;
                    break;
                }
            }

            if (!gallery || !mainSliderEl || !targetSlide) return;

            const swiperInstance = mainSliderEl.swiper;
            if (!swiperInstance) return;

            const targetIndex = parseInt(targetSlide.getAttribute('data-slide-index'), 10);
            swiperInstance.slideTo(targetIndex);

        });

    });

    document.querySelectorAll('[data-color-select]').forEach(colorSelector => {
        colorSelector.addEventListener('change', function(e) {
            const galleries = document.querySelectorAll('[data-swiper="product"]');
            let gallery = null;
            let mainSliderEl = null;
            let targetSlide = null;
            let selectedColorId = e.target.value;

            for (const g of galleries) {
                if (g.offsetParent === null) continue; // skip hidden galleries
                const main = g.querySelector('[data-swiper-product-primary]');
                if (!main) continue;
                const slide = main.querySelector(`.swiper-slide[data-color-id="${selectedColorId}"]`);
                if (slide) {
                    gallery = g;
                    mainSliderEl = main;
                    targetSlide = slide;
                    break;
                }
            }

            if (!gallery || !mainSliderEl || !targetSlide) return;

            const swiperInstance = mainSliderEl.swiper;
            if (!swiperInstance) return;

            const targetIndex = parseInt(targetSlide.getAttribute('data-slide-index'), 10);
            swiperInstance.slideTo(targetIndex);
        });
    });
};

// Initialize on document ready
document.addEventListener('DOMContentLoaded', initProductGallery);

// Initialize when Elementor frontend is initialized
if (window.elementorFrontend && window.elementorFrontend.hooks && typeof window.elementorFrontend.hooks.addAction === 'function') {
    window.elementorFrontend.hooks.addAction('frontend/element_ready/product_offerings.default', () => {
        initProductGallery();
    });
}

export default initProductGallery;