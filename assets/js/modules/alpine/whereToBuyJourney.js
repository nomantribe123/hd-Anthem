import {bodyOverflowHidden, bodyOverflowVisible} from "../dom-utils.js";

export default () => ({
    open: false,
    steps: [],
    currentStep: 0,

    init() {
        Array.from(this.$el.querySelectorAll('[data-journey-step]'))
            .sort((a, b) => a.dataset.journeyStep - b.dataset.journeyStep)
            .map(item => {
                this.steps.push({
                    index: parseInt(item.dataset.journeyStep),
                    el: item,
                    selectedOption: null
                })
            });

        this.$watch('currentStep', (newValue, oldValue) => {
            if (newValue > 0)
                this.showJourneyModal();
            else
                this.hideJourneyModal();
        });
    },

    next(event) {
        for (let step of this.steps)
            if (step.index === parseInt(event.target.closest('[data-journey-step]').dataset.journeyStep))
                step.selectedOption = event.target.closest('[data-journey-step-option]').dataset.journeyStepOption;

        if (this.currentStep >= 0 && this.currentStep < this.steps.length - 1)
            this.currentStep++;
    },

    back() {
        if (this.currentStep > 0)
            this.currentStep--;
    },

    goto(step) {
        this.currentStep = step;
    },

    showJourneyModal() {
        bodyOverflowHidden();

        this.open = true;
    },

    hideJourneyModal() {
        bodyOverflowVisible();

        this.open = false;
    },

    journeyModal: {
        ['x-cloak']() {
        },
        ['x-show']() {
            return this.open;
        },
        ['x-transition']() {
        },
    },

    stepsTransition: {
        ['x-cloak']() {
        },
        ['x-transition:enter']() {
            return 'transition ease-out duration-1000'
        },
        ['x-transition:enter-start']() {
            return 'opacity-0'
        },
        ['x-transition:enter-end']() {
            return 'opacity-100'
        },
        ['x-transition:leave']() {
            return 'transition ease-in duration-0'
        },
        ['x-transition:leave-start']() {
            return 'opacity-100'
        },
        ['x-transition:leave-end']() {
            return 'opacity-0'
        },
    }
});