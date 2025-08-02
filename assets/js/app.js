import Alpine from 'alpinejs';

// Modules
import {collapse} from "@alpinejs/collapse";
import pageStore from "./modules/alpine/pageStore.js";
import dropdown from "./modules/alpine/dropdown.js";
import accordion from "./modules/alpine/accordion.js";
import products from "./modules/alpine/products.js";
import magnifier from "./modules/alpine/magnifier.js";
import select from "./modules/alpine/select.js";
import productsFiltersWithViewSwitcher from "./modules/alpine/productsFiltersWithViewSwitcher.js";
import share from "./modules/alpine/share.js";
import tableOfContent from "./modules/alpine/tableOfContent.js";
import whereToBuyJourney from "./modules/alpine/whereToBuyJourney.js";
import uniformBuilder from "./modules/alpine/uniformBuilder.js";
import editableText from "./modules/alpine/editableText.js";

// Import Swiper and product gallery initializers
import initSwipers from "./modules/swiperInit.js";
import initProductGallery from "./modules/productGallerySwiper.js";

import '../css/main.css';

// Register Alpine plugins and modules
Alpine.plugin(collapse);

const initAlpine = () => {
    Alpine.store('page', pageStore);

    Alpine.data('dropdown', dropdown);
    Alpine.data('accordion', accordion);
    Alpine.data('magnifier', magnifier);
    Alpine.data('select', select);
    Alpine.data('share', share);
    Alpine.data('tableOfContent', tableOfContent);
    Alpine.data('whereToBuyJourney', whereToBuyJourney);
    Alpine.data('uniformBuilder', uniformBuilder);
    Alpine.data('editableText', editableText);
    Alpine.data('products', products);
    Alpine.data('productsFiltersWithViewSwitcher', productsFiltersWithViewSwitcher);

    Alpine.start();
};

document.addEventListener('DOMContentLoaded', () => {
    initAlpine();
    // Initialize Swiper and product gallery globally
    initSwipers();
    initProductGallery();
    // If you want to run productsFiltersWithViewSwitcher globally, uncomment:
    // productsFiltersWithViewSwitcher();
});

// Elementor frontend hook
if (window.elementorFrontend && window.elementorFrontend.hooks) {
    window.elementorFrontend.hooks.addAction('frontend/element_ready/product_offerings.default', () => {
        initAlpine();
        initSwipers();
        initProductGallery();
        // productsFiltersWithViewSwitcher();
    });
}

// ...add any other global event listeners from main.js here if needed...
