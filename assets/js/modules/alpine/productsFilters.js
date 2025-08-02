import {bodyOverflowHidden, bodyOverflowVisible} from "../dom-utils.js";

export default () => ({
    showOverlay: false,
    showHamburger: false,
    selectedCategory: 'all',

    init() {
        const params = new URLSearchParams(window.location.search);
        const categoryFromUrl = params.get('category');
        if (categoryFromUrl) {
            this.selectedCategory = decodeURIComponent(categoryFromUrl);
        }
    },

    async showProductsFiltersHamburger() {
        bodyOverflowHidden();
        this.showOverlay = true;

        await new Promise(resolve => setTimeout(resolve, 300));
        this.showHamburger = true;
    },

    async hideProductsFiltersHamburger() {
        this.showHamburger = false;

        await new Promise(resolve => setTimeout(resolve, 300));
        this.showOverlay = false;
        bodyOverflowVisible();
    },

    productsFiltersHamburgerOverlay: {
        ['x-show']() {
            return this.showOverlay;
        },
        ['x-transition']() {
        },
        ['x-cloak']() {
        },
    },

    productsFiltersHamburger: {
        ['x-show']() {
            return this.showHamburger;
        },
        ['x-transition:enter']() {
            return 'transition duration-300 transform translate-x-full';
        },
        ['x-transition:enter-start']() {
            return 'translate-x-full';
        },
        ['x-transition:enter-end']() {
            return 'translate-x-0';
        },
        ['x-transition:leave']() {
            return 'transition duration-300 transform';
        },
        ['x-transition:leave-start']() {
            return 'translate-x-0';
        },
        ['x-transition:leave-end']() {
            return 'translate-x-full';
        },
        ['x-on:click.outside']() {
            this.hideProductsFiltersHamburger();
        },
        ['x-cloak']() {
        },
    },
});
