export default () => ({
    viewMode: 'grid',

    init() {
        this.$watch('$store.page.mobileMode', value => {
            if (value)
                this.viewMode = 'grid';
        })
    }
});