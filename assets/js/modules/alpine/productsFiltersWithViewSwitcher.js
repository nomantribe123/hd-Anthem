import productsFilters from './productsFilters.js';
import viewSwitcher from './viewSwitcher.js';

export default (...args) => ({
    ...productsFilters(...args),
    ...viewSwitcher(...args)
});
