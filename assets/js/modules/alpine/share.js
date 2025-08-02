export default () => ({
    url: encodeURIComponent(window.location.href),
    text: encodeURIComponent('Check out this blog post!'),

    systemShare() {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                text: this.text,
                url: this.url,
            }).catch((error) => console.log('Sharing failed', error));
        } else {
            alert('Web Share is not supported. Use one of the links below instead.');
        }
    },
    get linkedinUrl() {
        return `https://www.linkedin.com/shareArticle?url=${this.url}`;
    },
    get twitterUrl() {
        return `https://twitter.com/intent/tweet?url=${this.url}&text=${this.text}`;
    },
    get facebookUrl() {
        return `https://www.facebook.com/sharer/sharer.php?u=${this.url}`;
    }
});