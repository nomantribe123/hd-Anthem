<?php 

// Register Product Features Taxonomy
function register_product_features_taxonomy() {
    $labels = array(
        'name'              => _x('Product Features', 'taxonomy general name', 'tribes-prortx'),
        'singular_name'     => _x('Product Feature', 'taxonomy singular name', 'tribes-prortx'),
        'search_items'      => __('Search Features', 'tribes-prortx'),
        'all_items'         => __('All Features', 'tribes-prortx'),
        'parent_item'       => __('Parent Feature', 'tribes-prortx'),
        'parent_item_colon' => __('Parent Feature:', 'tribes-prortx'),
        'edit_item'         => __('Edit Feature', 'tribes-prortx'),
        'update_item'       => __('Update Feature', 'tribes-prortx'),
        'add_new_item'      => __('Add New Feature', 'tribes-prortx'),
        'new_item_name'     => __('New Feature Name', 'tribes-prortx'),
        'menu_name'         => __('Features', 'tribes-prortx'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'           => $labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'product-feature'),
        'show_in_rest'     => true,
        'show_in_quick_edit' => false,
    );

    register_taxonomy('product_feature', array('product'), $args);
}
add_action('init', 'register_product_features_taxonomy');
