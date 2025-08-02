<?php
define('THEME_BASE_PATH', __DIR__);

// Load Composer autoloader if available
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Include Components
require_once __DIR__ . '/theme/Components/Blog_Header.php';
require_once __DIR__ . '/theme/Components/Blog_Content.php';
require_once __DIR__ . '/theme/Components/Blog_Author.php';
require_once __DIR__ . '/theme/Components/Blog_Related.php';

//Nav Walkers
require __DIR__ . '/theme/Menu/header-menu-walker.php';
require __DIR__ . '/theme/Menu/header-mobile-menu-walker.php';
require __DIR__ . '/theme/Menu/footer-menu-walker.php';


require_once __DIR__ . '/inc/post-types/post.php';
require_once __DIR__ . '/inc/post-types/event.php';
require_once __DIR__ . '/inc/post-types/brochure.php';
require_once __DIR__ . '/inc/post-types/faqs.php';
require_once __DIR__ . '/inc/post-types/product.php';

require 'inc/helpers.php';
require 'inc/acf.php';
require 'inc/ajax.php';

if (function_exists('WC')) {
    require 'inc/woocommerce.php';
}

add_filter('use_block_editor_for_post', '__return_false'); // Disable Block Editor on all Post Types

// Add scripts and CSS
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('industry-test', 'https://use.typekit.net/rmd8kju.css');

    wp_enqueue_style('anthem-main-styles', get_stylesheet_directory_uri() . '/dist/css/main.css', [], null);
    wp_enqueue_script('anthem-main-scripts', get_stylesheet_directory_uri() . '/dist/js/main.js', [], null);

    // YouTube Video Embedder
    wp_enqueue_script('anthem-yt-scripts', get_stylesheet_directory_uri() . '/assets/js/youtube-player.js', [], null, array(
        'in_footer' => true,
        'strategy'  => 'async',
    ));

    // Localize script to make functions globally available
    wp_localize_script('tribes-prortx-modal', 'prortxModal', array(
        'showModal' => 'showProductModal',
        'hideModal' => 'hideProductModal'
    ));

    // Add type="module" to the scripts
    add_filter('script_loader_tag', function ($tag, $handle, $src) {
        if (in_array($handle, ['tribes-prortx-modal', 'tribes-prortx-swiper', 'tribes-prortx-mainOLD', 'tribes-prortx-products-filter'])) {
            return '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }, 10, 3);
});

// Register menus
add_action('after_setup_theme', function () {
    // Add WooCommerce support
    add_theme_support('woocommerce');
    
    // Add WooCommerce gallery support
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    register_nav_menus(
        array(
            'header-navbar-menu' => 'Header Navbar Menu',
            'footer-column-1-menu' => 'Footer Column 1 Menu',
            'footer-column-2-menu' => 'Footer Column 2 Menu',
            'footer-bottom-menu' => 'Footer Bottom Menu'
        )
    );
});


function partial(string $partial): void
{
    $arguments = func_get_args();

    ob_start();
    extract($arguments[1] ?? []);

    include __DIR__ . "/partials/$partial.php";

    $content = ob_get_contents();
    ob_end_clean();

    echo $content;
}

function getAsset(string $path): string
{
    return sprintf('%s/dist/%s', get_stylesheet_directory_uri(), $path);
}

// Modify search query to include products
function modify_product_search_query($query) {
    // Only modify search queries on the frontend main query
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // Set post types to search
        $post_types = array('post', 'product');
        $query->set('post_type', $post_types);
    }
    return $query;
}

add_action('pre_get_posts', 'modify_product_search_query');

// Function to get unique products by search term
function get_unique_products_by_search($search_term) {
    global $wpdb;
    
    $like_term = '%' . $wpdb->esc_like($search_term) . '%';
    
    $query = $wpdb->prepare("
        SELECT DISTINCT p.ID 
        FROM {$wpdb->posts} p 
        WHERE p.post_type = 'product' 
        AND p.post_status = 'publish'
        AND (
            p.post_title LIKE %s 
            OR EXISTS (
                SELECT 1 FROM {$wpdb->postmeta} pm 
                WHERE pm.post_id = p.ID 
                AND pm.meta_key = '_sku' 
                AND pm.meta_value LIKE %s
            )
        )
    ", $like_term, $like_term, $like_term, $like_term);
    
    return $wpdb->get_col($query);
}

// Function to get unique posts by search term
function get_unique_posts_by_search($search_term) {
    global $wpdb;
    
    $like_term = '%' . $wpdb->esc_like($search_term) . '%';
    
    $query = $wpdb->prepare("
        SELECT DISTINCT p.ID 
        FROM {$wpdb->posts} p 
        WHERE p.post_type = 'post' 
        AND p.post_status = 'publish'
        AND (
            p.post_title LIKE %s 
            OR p.post_content LIKE %s
        )
    ", $like_term, $like_term);
    
    return $wpdb->get_col($query);
}

// Add Elementor support and initialize
function prortx_elementor_init() {
    // Add support for Elementor features
    add_theme_support('elementor');
    
    // Ensure Elementor is loaded
    if (did_action('elementor/loaded')) {
        // Register dynamic tags
        add_action('elementor/dynamic_tags/register', 'prortx_register_dynamic_tags');
        
        // Add custom widget categories if needed
        add_action('elementor/elements/categories_registered', function($elements_manager) {
            $elements_manager->add_category(
                'prortx-widgets',
                [
                    'title' => esc_html__('PRO RTX Widgets', 'tribes-prortx'),
                    'icon' => 'fa fa-plug',
                ]
            );
        });

        // Register custom widgets
        add_action('elementor/widgets/register', function($widgets_manager) {
            require_once get_stylesheet_directory() . '/theme/Elementor/CustomCategorySection.php';
            require_once get_stylesheet_directory() . '/theme/Elementor/Distributors_Section_Widget.php';
            // require_once get_stylesheet_directory() . '/theme/Elementor/Related_Posts_Widget.php';
            require_once get_stylesheet_directory() . '/theme/Elementor/Blog_Section_Widget.php';
            require_once get_stylesheet_directory() . '/theme/Elementor/View_Lineup_Widget.php';

            $widgets_manager->register(new CustomCategorySection());
            $widgets_manager->register(new Distributors_Section_Widget());
            $widgets_manager->register(new Blog_Section_Widget());
            $widgets_manager->register(new View_Lineup_Widget());
            // $widgets_manager->register(new Related_Posts_Widget());
        });
    }
}
add_action('after_setup_theme', 'prortx_elementor_init');

/**
 * Get the View Lineup template ID from options
 */
function get_view_lineup_template_id() {
    return get_option('view_lineup_template_id', '3871');
}

/**
 * Set the View Lineup template ID
 */
function set_view_lineup_template_id($template_id) {
    update_option('view_lineup_template_id', $template_id);
}

// Set the default View Lineup template ID
add_action('init', function() {
    // Only set if not already set
    if (!get_option('view_lineup_template_id')) {
        set_view_lineup_template_id('3667');
    }
});

/**
 * Add custom dynamic tags for Elementor
 */
function prortx_register_dynamic_tags($dynamic_tags_manager) {
    // Add WooCommerce dynamic tags group
    \Elementor\Plugin::$instance->dynamic_tags->register_group(
        'woocommerce',
        [
            'title' => esc_html__('WooCommerce', 'tribes-prortx')
        ]
    );

    // Register category data tag
    $file_path = get_stylesheet_directory() . '/elementor/dynamic-tags/category-data.php';
    
    if (file_exists($file_path)) {
        require_once $file_path;
        $dynamic_tags_manager->register(new \PRO_RTX\Dynamic_Tags\Category_Data());
    }
}

function enqueue_blog_scripts() {
    if (is_page_template('blogs.php') || is_archive() || is_category()) {
        wp_enqueue_script('tribes-blog', get_template_directory_uri() . '/assets/js/blog.js', array(), '1.0', true);
    }
}
// add_action('wp_enqueue_scripts', 'enqueue_blog_scripts');

function get_reading_time() {
    $content = get_post_field('post_content');
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming 200 words per minute reading speed
    return $reading_time;
}

/**
 * Get color swatch HTML for a given color value or taxonomy term
 * 
 * @param array $color assoc array of color name and hex
 * @return string The HTML for the color swatch
 */
function get_color_swatch_html($color, $size = 'small') {
    $color_parts = explode("|", $color);
    $label = $color_parts[0];
    $hex_color = isset($color_parts[1]) ? $color_parts[1] : $label; // fallback to name if no hex        
    $slug = isset($color_parts[2]) ? $color_parts[2] : $label;

    // For white color, add a light gray border for visibility
    $size_class = ($size === 'large') ? 'w-6 h-6' : 'w-3 h-3';

    // Generate the HTML with improved tooltip
    $html = sprintf(
        '<div class="color-swatch relative group/swatch">
            <div class="%s cursor-pointer rounded-full" style="background-color: %s" title="%s" data-color-id="%s"></div>
        </div>',
        $size_class,
        esc_attr($hex_color),
        esc_html($label),
        esc_attr($slug)
    );

    return $html;
}

function get_image_type_var() {
    $image_type = 'model';

    if (isset($_GET['image_type'])) {

        // Important to validate the value of $_GET['image_type'] and ensure only expected values are passed
        if ($_GET['image_type'] == 'model' || $_GET['image_type'] == 'item') {
            $image_type = $_GET['image_type'];
        }
    }

    return $image_type;
}

// Function to ensure distinct product results
function wc_product_query_distinct($distinct) {
    return "DISTINCT";
}

// Add WooCommerce product filters
function apply_product_filters($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        $tax_query = array();

        // Size filter
        if (!empty($_GET['filter_size'])) {
            $sizes = explode(',', wc_clean($_GET['filter_size']));
            if (!empty($sizes)) {
                $tax_query[] = array(
                    'taxonomy' => 'pa_size',
                    'field' => 'slug',
                    'terms' => $sizes,
                    'operator' => 'IN'
                );
            }
        }

        // Fabric filter
        if (!empty($_GET['filter_fabric'])) {
            $tax_query[] = array(
                'taxonomy' => 'pa_fabric',
                'field' => 'slug',
                'terms' => wc_clean($_GET['filter_fabric']),
                'operator' => 'IN'
            );
        }

        // Color filter
        if (!empty($_GET['filter_color'])) {
            $colors = explode(',', wc_clean($_GET['filter_color']));
            if (!empty($colors)) {
                $tax_query[] = array(
                    'taxonomy' => 'pa_color',
                    'field' => 'slug',
                    'terms' => $colors,
                    'operator' => 'IN'
                );
            }
        }

        // Apply tax query if we have filters
        if (!empty($tax_query)) {
            $tax_query['relation'] = 'AND';
            $query->set('tax_query', array_merge($query->get('tax_query'), array($tax_query)));
        }
    }
}
add_action('woocommerce_product_query', 'apply_product_filters');

// Initialize session early
function init_session() {
    if (!session_id() && !headers_sent()) {
        session_start();
    }
}
add_action('init', 'init_session', 1);

add_filter('elementor_pro/utils/acf/get_field_object', function($field, $field_name) {
    if (is_tax('product_cat') && is_archive()) {
        $term = get_queried_object();
        if ($term && isset($term->term_id)) {
            $taxonomy_id = 'product_cat_' . $term->term_id;
            $acf_field = get_field_object($field_name, $taxonomy_id);
            if ($acf_field) {
                return $acf_field;
            }
        }
    }
    return $field;
}, 10, 2);

/**
 * Disable Gravity Forms CSS
 */
add_filter('gform_disable_css', '__return_true');

define('CONTACT_FORM_ID', 1);
define('NEWSLETTER_FORM_ID', 2);

/**
 * Modify Gravity Forms submit button to match design
 *
 * @param string $button The original button HTML.
 * @param array $form The form object.
 * @return string Modified button HTML.
 */
function gravity_forms_submit_button( $button, $form ) {
    $fragment = WP_HTML_Processor::create_fragment( $button );
    $fragment->next_token();

    if ($form['id'] === NEWSLETTER_FORM_ID) {
        $fragment->add_class( 'h-11 flex justify-center items-center gap-2 bg-white text-black border-l-4 border-prortx-green px-9 hover:brightness-80' );
    } else {
        $fragment->add_class( 'group w-fit h-11 flex justify-center items-center gap-3 bg-[#31344A12] backdrop-blur-2xl px-6 border-l-4 border-prortx-green' );
    }


    $attributes = array( 'id', 'type', 'class', 'onclick' );
    $data_attributes = $fragment->get_attribute_names_with_prefix( 'data-' );
    if ( ! empty( $data_attributes ) ) {
        $attributes = array_merge( $attributes, $data_attributes );
    }

    $new_attributes = array();
    foreach ( $attributes as $attribute ) {
        $value = $fragment->get_attribute( $attribute );
        if ( ! empty( $value ) ) {
            $new_attributes[] = sprintf( '%s="%s"', $attribute, esc_attr( $value ) );
        }
    }
    
    return sprintf( 
        '<button %s><span class="text-black">%s</span>%s</button>', 
        implode( ' ', $new_attributes ), 
        esc_html( $fragment->get_attribute( 'value' ) ), 
        $form['id'] === NEWSLETTER_FORM_ID ? '' : '<svg class="w-6 h-6 text-prortx-green group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"></path></svg>' 
    );

}
add_filter( 'gform_submit_button', 'gravity_forms_submit_button', 10, 2 );

/**
 * Add data attributes to Gravity Forms dropdown fields for easier targeting
 */
function add_gravity_forms_dropdown_attributes($field_content, $field, $value, $lead_id, $form_id) {
    // Only target dropdown fields
    if ($field->type === 'select') {
        // Add data attributes for color fields (if the field label contains 'color' or 'colour')
        $field_label = strtolower($field->label);
        if (strpos($field_label, 'color') !== false || strpos($field_label, 'colour') !== false) {
            $field_content = str_replace('<select', '<select data-gf-field-type="color"', $field_content);
        }
        
        // Add general dropdown attribute
        $field_content = str_replace('<select', '<select data-gf-dropdown="true"', $field_content);
    }
    
    return $field_content;
}
add_filter('gform_field_content', 'add_gravity_forms_dropdown_attributes', 10, 5);

/**
 * Add SVG icons to specific Gravity Forms fields
 */
function add_svg_to_gravity_forms_fields($field_content, $field, $value, $lead_id, $form_id) {
    if ($form_id == NEWSLETTER_FORM_ID) {
        if ($field->type === 'email') {
            $email_svg = '<svg class="absolute top-1/2 right-4 -translate-y-1/2 w-6 h-6 text-prortx-green" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H6C4.897 4 4 4.897 4 6V11H6V8L12.4 12.8C12.5732 12.9297 12.7837 12.9998 13 12.9998C13.2163 12.9998 13.4268 12.9297 13.6 12.8L20 8V17H12V19H20C21.103 19 22 18.103 22 17V6C22 4.897 21.103 4 20 4ZM13 10.75L6.666 6H19.334L13 10.75Z" fill="currentColor"></path>
                <path d="M2 12H9V14H2V12ZM4 15H10V17H4V15ZM7 18H11V20H7V18Z" fill="currentColor"></path>
            </svg>';

            $field_content = str_replace(
                "<div class='ginput_container ginput_container_email'>",
                '<div class="ginput_container ginput_container_email relative grow">',
                $field_content
            );
            
            $field_content = str_replace(
                '/>',
                '/>' . $email_svg,
                $field_content
            );
        }
    }
    
    return $field_content;
}
add_filter('gform_field_content', 'add_svg_to_gravity_forms_fields', 10, 5);