<?php 

function prortx_register_faq_post_type() {
    $labels = array(
        'name'                  => _x('FAQs', 'Post Type General Name', 'tribes-prortx'),
        'singular_name'         => _x('FAQ', 'Post Type Singular Name', 'tribes-prortx'),
        'menu_name'            => __('FAQs', 'tribes-prortx'),
        'all_items'            => __('All FAQs', 'tribes-prortx'),
        'add_new_item'         => __('Add New FAQ', 'tribes-prortx'),
        'edit_item'            => __('Edit FAQ', 'tribes-prortx'),
    );

    $args = array(
        'label'               => __('FAQ', 'tribes-prortx'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-format-chat',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );

    register_post_type('faq', $args);

    // Register FAQ Category Taxonomy
    $tax_labels = array(
        'name'              => _x('FAQ Categories', 'taxonomy general name', 'tribes-prortx'),
        'singular_name'     => _x('FAQ Category', 'taxonomy singular name', 'tribes-prortx'),
        'menu_name'         => __('Categories', 'tribes-prortx'),
    );

    $tax_args = array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'faq-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('faq_category', array('faq'), $tax_args);
}
add_action('init', 'prortx_register_faq_post_type');



// Initialize ACF and Elementor integration
function init_acf_faq_elementor() {
    if (!function_exists('acf')) {
        return;
    }

    // Register Elementor widget
    if (did_action('elementor/loaded')) {
        require_once get_stylesheet_directory() . '/theme/Elementor/FAQ_Accordion_Widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register(new FAQ_Accordion_Widget());
    }

}
add_action('acf/init', 'init_acf_faq_elementor');