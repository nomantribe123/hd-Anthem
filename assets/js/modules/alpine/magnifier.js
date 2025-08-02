import Panzoom from "@panzoom/panzoom";

export default () => ({
    panzoom: null,
    scale: 1,

    init() {
        this.panzoom = Panzoom(this.$refs.magnifiable, {
            minScale: 1,
            maxScale: 5,
            duration: 300,
            contain: 'outside'
        });
    },

    zoomIn: {
        ['x-on:click']() {
            this.scale = this.panzoom.zoomIn().scale;

            if (this.scale === 1)
                this.panzoom.reset();
        },
    },

    zoomOut: {
        ['x-on:click']() {
            this.scale = this.panzoom.zoomOut().scale;

            if (this.scale === 1)
                this.panzoom.reset();
        },
        ['x-show']() {
            return this.scale > 1;
        },
    },

    destroy() {
        this.panzoom.destroy();
    }
});