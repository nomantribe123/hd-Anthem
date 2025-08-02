<?php 

// Initialize ACF and Elementor integration
function init_acf_post_elementor() {
    if (!function_exists('acf')) {
        return;
    }

    // Register Elementor widget
    if (did_action('elementor/loaded')) {
        require_once get_stylesheet_directory() . '/theme/Elementor/Blog_Section_Widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register(new Blog_Section_Widget());
    }

}
// add_action('acf/init', 'init_acf_post_elementor');