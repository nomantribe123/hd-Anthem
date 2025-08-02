export default () => ({
    view: localStorage.getItem('productViewMode') || 'grid',
    setGridView() {
        this.view = 'grid';
        localStorage.setItem('productViewMode', 'grid');
    },
    setListView() {
        this.view = 'list';
        localStorage.setItem('productViewMode', 'list');
    },
    isGridView() {
        return this.view === 'grid';
    },
    isListView() {
        return this.view === 'list';
    }
});