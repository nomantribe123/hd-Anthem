<?php 

function register_brochures_post_type() {
    $labels = array(
        'name'                  => _x('Brochures', 'Post type general name', 'tribes-prortx'),
        'singular_name'         => _x('Brochure', 'Post type singular name', 'tribes-prortx'),
        'menu_name'            => _x('Brochures', 'Admin Menu text', 'tribes-prortx'),
        'name_admin_bar'       => _x('Brochure', 'Add New on Toolbar', 'tribes-prortx'),
        'add_new'              => __('Add New', 'tribes-prortx'),
        'add_new_item'         => __('Add New Brochure', 'tribes-prortx'),
        'new_item'             => __('New Brochure', 'tribes-prortx'),
        'edit_item'            => __('Edit Brochure', 'tribes-prortx'),
        'view_item'            => __('View Brochure', 'tribes-prortx'),
        'all_items'            => __('All Brochures', 'tribes-prortx'),
        'search_items'         => __('Search Brochures', 'tribes-prortx'),
        'not_found'            => __('No brochures found.', 'tribes-prortx'),
        'not_found_in_trash'   => __('No brochures found in Trash.', 'tribes-prortx'),
        'featured_image'       => __('Brochure Cover Image', 'tribes-prortx'),
        'set_featured_image'   => __('Set cover image', 'tribes-prortx'),
        'remove_featured_image'=> __('Remove cover image', 'tribes-prortx'),
        'use_featured_image'   => __('Use as cover image', 'tribes-prortx'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug' => 'brochures',
            'with_front' => false
        ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-media-document',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'        => true,
    );

    register_post_type('brochure', $args);
}
add_action('init', 'register_brochures_post_type');

// Initialize ACF and Elementor integration
function init_acf_brochure_elementor() {
    if (!function_exists('acf')) {
        return;
    }

    // Register Elementor widget
    if (did_action('elementor/loaded')) {
        require_once get_stylesheet_directory() . '/theme/Elementor/Brochures_Section_Widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register(new Brochures_Section_Widget());
    }

}
add_action('acf/init', 'init_acf_brochure_elementor');

// Handle brochure downloads
function handle_brochure_download() {
    if (!isset($_GET['brochure_download']) || empty($_GET['brochure_download'])) {
        return;
    }

    $file_url = base64_decode($_GET['brochure_download']);
    $file_path = str_replace(site_url('/'), ABSPATH, $file_url);
    
    if (!file_exists($file_path)) {
        return;
    }

    // Get file info
    $file_name = basename($file_path);
    $file_size = filesize($file_path);
    $file_type = mime_content_type($file_path);

    // Set headers
    header('Content-Type: ' . $file_type);
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    header('Content-Length: ' . $file_size);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    // Clear output buffer
    ob_clean();
    flush();

    // Read file
    readfile($file_path);
    exit;
}
add_action('init', 'handle_brochure_download');
