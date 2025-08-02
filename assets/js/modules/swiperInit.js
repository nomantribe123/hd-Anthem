import Swiper from "swiper";
import {Autoplay, EffectFade, Navigation, Pagination, Thumbs} from "swiper/modules";

const initSwipers = () => {
    const swipers = document.querySelectorAll('[data-swiper]');
    let productSwiperInstances = [];

    for (const swiper of swipers) {
        switch (swiper.dataset.swiper) {
            case 'fullscreen':
                new Swiper(swiper, {
                    modules: [Pagination, EffectFade, Autoplay],
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    centeredSlides: true,
                    loop: true,
                    speed: 500,
                    autoplay: {
                        delay: 5000,
                        pauseOnMouseEnter: true,
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: false
                    },
                    pagination: {
                        el: swiper.querySelector('[data-swiper-pagination]'),
                        clickable: true,
                        clickableClass: 'cursor-pointer',
                        bulletClass: 'swiper-pagination-bullet-class',
                        bulletActiveClass: 'swiper-pagination-bullet-active-class'
                    },
                });
                break;
            case 'products':
                const isElementorEditor = window.elementorFrontend && window.elementorFrontend.isEditMode();
                
                if (isElementorEditor) {
                    // Destroy existing instance if it exists
                    const existingInstance = productSwiperInstances.find(instance => instance.el === swiper);
                    if (existingInstance) {
                        existingInstance.destroy(true, true);
                        productSwiperInstances = productSwiperInstances.filter(instance => instance !== existingInstance);
                    }

                    // Wait for Elementor to finish rendering
                    setTimeout(() => {
                        const swiperInstance = new Swiper(swiper, {
                            modules: [Pagination, Autoplay],
                            simulateTouch: true,
                            slidesPerView: "auto",
                            spaceBetween: 32,
                            centeredSlides: false,
                            loop: false,
                            speed: 500,
                            observer: true,
                            observeParents: true,
                            resizeObserver: true,
                            watchOverflow: true,
                            updateOnWindowResize: true,
                            pagination: {
                                el: swiper.querySelector('[data-swiper-pagination]'),
                                clickable: true,
                                clickableClass: 'cursor-pointer',
                                bulletClass: 'swiper-pagination-bullet-class',
                                bulletActiveClass: 'swiper-pagination-bullet-active-class'
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 1.75
                                },
                                768: {
                                    slidesPerView: 2
                                },
                                1024: {
                                    slidesPerView: 3
                                },
                                1280: {
                                    slidesPerView: 4
                                },
                            },
                            on: {
                                resize: function() {
                                    // Force update after resize
                                    this.update();
                                }
                            }
                        });

                        // Store the instance for later cleanup
                        productSwiperInstances.push(swiperInstance);

                        // Force update after initialization
                        swiperInstance.update();
                    }, 300);
                } else {
                    new Swiper(swiper, {
                        modules: [Pagination, Autoplay],
                        simulateTouch: true,
                        slidesPerView: 1.3,
                        spaceBetween: 32,
                        centeredSlides: false,
                        loop: false,
                        speed: 500,
                        autoplay: {
                            delay: 5000,
                            pauseOnMouseEnter: true,
                        },
                        pagination: {
                            el: swiper.querySelector('[data-swiper-pagination]'),
                            clickable: true,
                            clickableClass: 'cursor-pointer',
                            bulletClass: 'swiper-pagination-bullet-class',
                            bulletActiveClass: 'swiper-pagination-bullet-active-class'
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1.75
                            },
                            768: {
                                slidesPerView: 2
                            },
                            1024: {
                                slidesPerView: 3
                            },
                            1280: {
                                slidesPerView: 4
                            },
                        }
                    });
                }
                break;
            case 'product':
                // Product gallery Swiper initialization has been removed from this file.
                // Now handled exclusively by productGallerySwiper.js for better separation and to avoid double initialization.
                // If you need to restore the old approach, refer to previous commits for the original implementation.
                break;
            case 'testimonials':
                new Swiper(swiper, {
                    modules: [Pagination, Autoplay],
                    simulateTouch: true,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    centeredSlides: false,
                    loop: true,
                    speed: 500,
                    autoplay: {
                        delay: 5000,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: swiper.querySelector('[data-swiper-pagination]'),
                        clickable: true,
                        clickableClass: 'cursor-pointer',
                        bulletClass: 'testimonials-swiper-pagination-bullet-class',
                        bulletActiveClass: 'testimonials-swiper-pagination-bullet-active-class'
                    },
                });
                break;
            default:

                break;
        }
    }
};

// Initialize on document ready
document.addEventListener('DOMContentLoaded', () => {
    initSwipers();
});

// Initialize when Elementor frontend is initialized
if (window.elementorFrontend && window.elementorFrontend.hooks && typeof window.elementorFrontend.hooks.addAction === 'function') {
    window.elementorFrontend.hooks.addAction('frontend/element_ready/product_offerings.default', ($element) => {
        initSwipers();
    });
}

// Handle Elementor editor changes and resize
if (window.elementorFrontend && window.elementorFrontend.isEditMode && window.elementorFrontend.hooks && typeof window.elementorFrontend.hooks.addAction === 'function') {
    // Handle editor changes
    window.elementor.channels.editor.on('change', initSwipers);
    
    // Handle resize with debounce
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(initSwipers, 250);
    });
}

export default initSwipers;