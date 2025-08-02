<?php
/**
 * The Template for displaying products in a product category.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 */
do_action('woocommerce_before_main_content');

// Get current category
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

// Set products per page
$products_per_page = 10;

// Get current page number
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Use shared product query logic
get_template_part('template-parts/query/query', 'product');
$products_query = prortx_get_products_query([
    'current_category' => $current_category,
    'products_per_page' => $products_per_page,
    'paged' => $paged
]);

// Update pagination info
wc_set_loop_prop('total', $products_query->found_posts);
wc_set_loop_prop('total_pages', $products_query->max_num_pages);
wc_set_loop_prop('current_page', $paged);
wc_set_loop_prop('per_page', $products_per_page);

global $wp_query;
$wp_query = $products_query;

$number_of_products = $products_query->found_posts < $products_per_page ? $products_query->found_posts : $products_per_page;
?>

<main>
    <?php prortx_category_hero_section(); ?>

    <section class="cat-loop-section">
        <div class="container">
            <div x-data="productsFiltersWithViewSwitcher()" x-cloak>
                <?php get_template_part('template-parts/archive/product/loop-start', null, [
                    'query' => $products_query,
                    'per_page' => $products_per_page,
                ]); ?>
                <?php get_template_part('template-parts/archive/product/loop', null, [
                    'query' => $products_query,
                ]); ?>                
            </div>
        </div>
    </section>

    <?php //prortx_add_category_template_sections(); ?>
</main>

<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action('woocommerce_after_main_content');

// Reset WooCommerce loop
wc_reset_loop();

// Reset postdata
wp_reset_postdata();

get_footer('shop');
?>