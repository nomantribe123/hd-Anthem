import Choices from "choices.js";

export default () => ({
    init() {
        switch (this.$el.dataset.style) {
            case 'color':
                this.$el.choiceInstance = new Choices(this.$el, {
                    searchEnabled: false,
                    itemSelectText: '',
                    shouldSort: false,
                    classNames: {
                        containerOuter: ['choices'],
                        containerInner: ['choices__inner', 'min-h-12!', 'bg-transparent!', 'border-black!', 'pr-8!', 'pl-3!',  'leading-[0]!'],
                        input: ['choices__input', 'bg-transparent!'],
                        inputCloned: ['choices__input--cloned', 'bg-transparent!'],
                        list: ['choices__list', 'p-0!'],
                        listItems: ['choices__list--multiple', '*:!', '*:border-black!'],
                        item: ['choices__item', 'flex', 'items-center', 'flex-row'],
                    },
                    callbackOnCreateTemplates: function (template, escapeForTemplate, getClassNames) {
                        return {
                            containerInner: (classNames) => {
                                return template(`
                                    <div class="choices__inner relative ${getClassNames(classNames.containerInner).join(' ')}">
                                        <!-- Dropdown Arrow -->
                                        <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                            <svg class="w-3.25 h-auto duration-300" x-bind:class="{'rotate-180': open}" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="6.29 8.29 11.41 7.12"><path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" fill="currentColor"></path></svg>
                                        </div>
                                    </div>
                                `);
                            },
                            item: ({classNames}, data) => {
                                return template(`
                                    <div class="${getClassNames(classNames.item).join(' ')} ${
                                            getClassNames(data.highlighted ? classNames.highlightedState : classNames.itemSelectable).join(' ')
                                        } ${
                                            data.placeholder ? classNames.placeholder : ''
                                        }" data-item data-id="${data.id}" data-value="${data.value}" ${
                                            data.active ? 'aria-selected="true"' : ''
                                        } ${data.disabled ? 'aria-disabled="true"' : ''}>
                                        <div class="w-7.5 h-7.5 border  shrink-0" style="background-color: ${data.customProperties?.color};"></div>
                                    </div>
                                `);
                            },
                            choice: ({classNames}, data) => {
                                // console.log('Choice item data:', data);
                                return template(`
                                     <div class="${getClassNames(classNames.item).join(' ')} ${getClassNames(classNames.itemChoice).join(' ')} ${
                                            getClassNames(data.disabled ? classNames.itemDisabled : classNames.itemSelectable).join(' ')
                                        }" data-select-text="${this.config.itemSelectText}" data-choice ${
                                            data.disabled ? 'data-choice-disabled aria-disabled="true"' : 'data-choice-selectable'
                                        } data-id="${data.id}" data-value="${data.value}" ${
                                            data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                                        }>
                                        <div class="w-7.5 h-7.5 border  shrink-0" style="background-color: ${data.customProperties?.color};"></div>
                                        <span class="choices__item__label ml-2 text-nowrap">${(data.label)}</span>
                                    </div>
                                `);
                            },
                        };
                    },
                });
                break;
            default:
                this.$el.choiceInstance = new Choices(this.$el, {
                    searchEnabled: false,
                    itemSelectText: null,
                    shouldSort: false,
                    classNames: {
                        containerOuter: ['choices'],
                        containerInner: ['choices__inner', 'min-h-12!', 'bg-transparent!', 'border-black!', 'pr-8!', 'pl-3!', 'py-3!'],
                        input: ['choices__input', 'bg-transparent!'],
                        inputCloned: ['choices__input--cloned', 'bg-transparent!'],
                        list: ['choices__list', 'p-0!'],
                        listItems: ['choices__list--multiple', '*:!', '*:border-black!'],
                    },
                    callbackOnCreateTemplates: function (template, escapeForTemplate, getClassNames) {
                        return {
                            containerInner: (classNames) => {
                                return template(`
                                    <div class="choices__inner ${getClassNames(classNames.containerInner).join(' ')} relative">
                                        <div data-element="input" class="${getClassNames(classNames.input).join(' ')}" contenteditable="true" role="combobox" aria-autocomplete="list"></div>

                                        <div class="absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                            <svg class="w-3.25 h-auto duration-300" x-bind:class="{'rotate-180': open}" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="6.29 8.29 11.41 7.12"><path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" fill="currentColor"></path></svg>
                                        </div>
                                    </div>
                                `);
                            },
                        }
                    }
                });
                break;
        }
    }
});
