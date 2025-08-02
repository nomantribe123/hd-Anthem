export default () => ({
    list: [],
    observer: null,
    activeElement: null,

    init() {
        this.list = Array.from(this.$refs.content.querySelectorAll('h1, h2, h3, h4, h5, h6')).map(el => ({
            el,
            text: el.textContent,
            level: parseInt(el.tagName.replace('H', ''))
        }));

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.activeElement = entry.target
                }
            })
        }, {
            root: null,
            rootMargin: '0px 0px -70% 0px',
            threshold: 0
        });

        this.list.forEach(item => this.observer.observe(item.el));
    },

    scrollTo(el) {
        window.scrollTo({top: el.getBoundingClientRect().top + window.scrollY - 100, behavior: 'smooth'});

        this.activeElement = el;
    }
});
