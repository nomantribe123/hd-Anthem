import {bodyOverflowHidden, bodyOverflowVisible} from "../dom-utils.js";

export default {
    mobileMode: false,
    showHamburgerMenu: false,
    pageScrolled: false,

    init() {
        this.mobileMode = window.innerWidth < 1024;
    },
    resized() {
        this.mobileMode = window.innerWidth < 1024;

        if (!this.mobileMode && this.showHamburgerMenu)
            this.toggleHamburgerMenu();
    },
    scrolled() {
        this.pageScrolled = window.scrollY >= 50;
    },
    toggleHamburgerMenu() {
        this.showHamburgerMenu = !this.showHamburgerMenu;

        if (this.showHamburgerMenu)
            bodyOverflowHidden();
        else
            bodyOverflowVisible();
    }
};