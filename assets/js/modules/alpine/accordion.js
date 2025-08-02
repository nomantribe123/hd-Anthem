export default () => ({
    open: false,

    onClick: {
        ['x-on:click']() {
            this.open = !this.open;
        },
    },

    onHover: {
        ['x-onmouseenter']() {
            this.open = true;
        },
        ['x-onmouseleave']() {
            this.open = false;
        },
    },

    dialogue: {
        ['x-cloak']() {
        },
        ['x-show']() {
            return this.open;
        },
        ['x-collapse']() {
        },
    },
});