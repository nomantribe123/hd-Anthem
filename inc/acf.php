<?php 

// Add Product Settings & Where to Buy sub page to ACF Options
add_action('acf/init', function() {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'page_title'  => 'Products',
            'menu_title'  => 'Products',
            'menu_slug'   => 'acf-products-settings',
            'parent_slug' => 'acf-options',
            'post_id'     => 'products',
            'capability'  => 'manage_options'
        ));

         acf_add_options_sub_page(array(
            'page_title'  => 'Where to Buy',
            'menu_title'  => 'Where to Buy',
            'menu_slug'   => 'acf-where-to-buy-settings',
            'parent_slug' => 'acf-options',
            'post_id'     => 'where_to_buy',
            'capability'  => 'manage_options'
        ));
    }
});

?>