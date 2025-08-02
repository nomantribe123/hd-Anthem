<?php

$products_query = $args['query'] ?? null;

if (!$products_query) {
    return;
}

$current_category = get_queried_object();

// Get all product categories
$product_categories = get_terms([
    'taxonomy' => 'product_cat',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'parent' => 0,
    'exclude' => get_option('default_product_cat') // Exclude Uncategorized category
]);

$number_of_products = wc_get_loop_prop('total') < wc_get_loop_prop('per_page', 10) ? wc_get_loop_prop('total') : wc_get_loop_prop('per_page', 10);
$total_products = wc_get_loop_prop('total');

?>

<!-- Category Filter Bar - Desktop -->
<?php get_template_part('template-parts/archive/filters-category', 'product', [
    'product_categories' => $product_categories,
    'current_category' => $current_category
]); ?>


<?php if ($products_query->have_posts()) :

    $image_type = get_image_type_var();
    ?>

    <!-- Product Count and Sorting -->
    <div class="grid grid-cols-3 mb-8 lg:mb-12">
        <div>
            <div class="image-type-switcher">
                <a href="<?php echo esc_url(add_query_arg('image_type', 'model')); ?>" class="<?php echo $image_type == 'model' ? 'active' : ''; ?>">
                    Model
                </a>
                <a href="<?php echo esc_url(add_query_arg('image_type', 'item')); ?>" class="<?php echo $image_type == 'item' ? 'active' : ''; ?>">
                    Item Image
                </a>
            </div>
        </div>
        <div class="hidden md:flex flex-row gap-4 justify-center">
            <?php get_template_part('template-parts/archive/display'); ?>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-end gap-y-4 gap-x-8">
            <div>
                <?php get_template_part('template-parts/archive/sort', 'product'); ?>
            </div>
            <div>
                <button id="filter-drawer-open"
                        type="button"
                        class="relative w-36 h-12 flex justify-center items-center gap-2 rounded-lg border border-black hover:brightness-80 transition-all"
                        @click="showProductsFiltersHamburger()">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 11H17V13H7V11ZM4 7H20V9H4V7ZM10 15H14V17H10V15Z" fill="currentColor"/>
                    </svg>
                    <span>Filters</span>
                </button>
            </div>
            <!-- Filter Drawer Overlay and Content -->
            <template x-if="showOverlay">
                <div id="filter-drawer-overlay" class="fixed inset-0 z-[9998] bg-[#31344A8C] backdrop-blur-md"
                     x-show="showOverlay"
                     x-transition.opacity
                     @click="hideProductsFiltersHamburger()"></div>
            </template>
            <div id="filter-drawer-content"
                 class="filter-drawer-content bg-white fixed top-0 right-0 w-dvw lg:w-240 h-dvh z-[9999] overflow-y-auto transform transition-transform duration-300 ease-in-out"
                 :class="showHamburger ? 'translate-x-0' : 'translate-x-full'"
                 x-show="showOverlay"
                 x-transition
                 @keydown.escape.window="hideProductsFiltersHamburger()">
                <?php get_template_part('template-parts/archive/filters', 'product'); ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php //get_template_part('template-parts/archive/filters, 'product-active'); ?>
