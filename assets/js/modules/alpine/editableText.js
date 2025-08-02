export default () => ({
    text: null,
    initialText: null,
    editing: false,
    isEmpty: false,
    changed: false,

    init() {
        this.text        = this.$el.dataset.text;
        this.initialText = this.$el.dataset.text;

        this.$watch('text', (value) => {
            this.isEmpty = !value.trim();

            this.changed = this.text !== this.initialText;
        });
    },

    startEditing() {
        this.editing = true;

        this.$nextTick(() => {
            this.$root.querySelector('input').focus();
        });
    },

    stopEditing() {
        this.editing = false;
    }
});
