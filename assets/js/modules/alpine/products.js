import {bodyOverflowHidden, bodyOverflowVisible} from "../dom-utils.js";
import {nextTick} from "alpinejs/src/nextTick.js";

export default () => ({
    open: false,
    product: {},

    async showProductModal(event) {
        this.product = JSON.parse(event.target.closest('[data-product]').dataset.product);

        await nextTick();

        bodyOverflowHidden();

        this.open = true;
    },

    async hideProductModal() {
        bodyOverflowVisible();

        this.open = false;

        this.product = {};
    },

    // Watch for open becoming true and re-init Choices.js after options are rendered
    init() {
        this.$watch('open', async (isOpen) => {
            if (isOpen) {
                await nextTick();
                // For each select in the modal, re-init Choices.js via Alpine's select() component
                this.$root.querySelectorAll('select[x-data]').forEach(select => {
                    // Only proceed if select has options (other than the placeholder)
                    if (select.options.length > 1) {
                        // If already initialized, destroy safely
                        if (select.choiceInstance) {
                            try {
                                if (typeof select.choiceInstance.destroy === 'function') {
                                    select.choiceInstance.destroy();
                                }
                            } catch (e) {
                                // Ignore Choices.js destroy errors
                            }
                            select.choiceInstance = null;
                        }
                        // Call Alpine's select().init() if available
                        if (select._x_dataStack && select._x_dataStack.length) {
                            const selectComponent = select._x_dataStack.find(x => typeof x.init === 'function');
                            if (selectComponent && typeof selectComponent.init === 'function') {
                                selectComponent.init();
                            }
                        }
                    }
                });
            }
        });
    },

    productModal: {
        ['x-cloak']() {
        },
        ['x-show']() {
            return this.open;
        },
        ['x-transition']() {
        },
    },
});