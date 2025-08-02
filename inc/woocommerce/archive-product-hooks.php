<?php

/**
 * Add custom sorting options to WooCommerce
 */
add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');
function custom_woocommerce_get_catalog_ordering_args($args) {
    $orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

    switch ($orderby_value) {
        case 'alphabet_asc':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'alphabet_desc':
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
            break;
        case 'menu_order':
        default:
            $args['orderby'] = 'menu_order title';
            $args['order'] = 'ASC';
            break;
    }

    return $args;
}

// Remove default sorting options and add custom ones
add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby');
function custom_woocommerce_catalog_orderby($sortby) {
    return array(
        'menu_order'     => __('Sort By: Default', 'woocommerce'),
        'alphabet_asc'   => __('Sort By: A-Z', 'woocommerce'),
        'alphabet_desc'  => __('Sort By: Z-A', 'woocommerce'),
    );
}

// Set default sorting
add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');
function custom_default_catalog_orderby($default_orderby) {
    return 'menu_order';
}

// Set number of products per page
add_filter('loop_shop_per_page', 'custom_products_per_page', 20);
function custom_products_per_page($cols) {
    return 10;
}

/**
 * Add custom category page sections
 */
add_action('template_redirect', 'prortx_add_category_template_sections', 5);
function prortx_add_category_template_sections() {
    if (!is_product_category()) return;

    // Remove default WooCommerce breadcrumb
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    // Add custom hero section
    add_action('woocommerce_archive_description', 'prortx_category_hero_section', 5);

    // Add additional sections after product loop
    add_action('woocommerce_after_main_content', 'prortx_category_additional_sections', 15);
}

/**
 * Display category hero section using Elementor
 */
function prortx_category_hero_section() {
    if (!is_product_category()) return;

    $current_category = get_queried_object();
    if (!$current_category) return;

    $widget_data = [
        'category_name'        => $current_category->name,
        'category_description' => term_description($current_category->term_id, 'product_cat'),
        'category_image'       => get_term_meta($current_category->term_id, 'thumbnail_id', true)
    ];

    set_transient('current_category_data', $widget_data, HOUR_IN_SECONDS);

    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        if ($elementor->frontend) {
            $template_content = $elementor->frontend->get_builder_content(329, true);
            if ($template_content) {
                echo '<div class="category-hero-section">';
                echo $template_content;
                echo '</div>';
            }
        }
    }
}

/**
 * Display additional category sections (excluding CTA)
 */
function prortx_category_additional_sections() {
    if (!is_product_category()) return;

    $current_category = get_queried_object();

    $widget_data = [
        'category_name'        => $current_category->name,
        'related_categories'   => get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'exclude'    => [$current_category->term_id],
            'number'     => 3
        ])
    ];

    set_transient('category_additional_data', $widget_data, HOUR_IN_SECONDS);

    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        if ($elementor->frontend) {
            // Custom text/image widget
            prortx_render_category_text_image_widget($current_category);

            // Custom content template
            $template_content = $elementor->frontend->get_builder_content(333, true);
            if ($template_content) {
                echo '<div class="custom-category-section">';
                echo $template_content;
                echo '</div>';
            }

            prortx_render_faq_section($current_category);
        }
    }
}

/**
 * Populate category text/image widget with dynamic content
 */
function prortx_render_category_text_image_widget($current_category) {
    if (!$current_category || !function_exists('get_field')) return;

    $custom_content = [];
    $custom_image = null;

    $fields = get_field('content', 'product_cat_' . $current_category->term_id);
    if (!empty($fields) && is_array($fields)) {
        foreach ($fields as $row) {
            $custom_content[] = [
                'title'   => $row['heading'] ?? '',
                'content' => $row['content'] ?? '',
            ];
        }
    }

    $image_field = get_field('image', 'product_cat_' . $current_category->term_id);
    if (!empty($image_field['url'])) {
        $custom_image = [
            'url' => $image_field['url'],
            'id'  => $image_field['ID'],
            'alt' => $image_field['alt'] ?? '',
        ];
    }

    if (!empty($custom_content) || !empty($custom_image)) {
        add_filter('elementor/frontend/builder_content_data', function($data) use ($custom_content, $custom_image) {
            foreach ($data as &$section) {
                if (!empty($section['elements'])) {
                    foreach ($section['elements'] as &$widget) {
                        if ($widget['widgetType'] === 'category_text_image') {
                            if (!empty($custom_content)) {
                                $widget['settings']['content_items'] = $custom_content;
                            }
                            if (!empty($custom_image)) {
                                $widget['settings']['image'] = [
                                    'url' => $custom_image['url'],
                                    'id'  => $custom_image['id'],
                                ];
                                $widget['settings']['image_alt'] = $custom_image['alt'];
                            }
                        }
                    }
                }
            }
            return $data;
        }, 10, 1);

        $elementor = \Elementor\Plugin::$instance;
        $template_content = $elementor->frontend->get_builder_content(1140, true);
        if ($template_content) {
            echo '<div class="custom-category-text-section">';
            echo $template_content;
            echo '</div>';
        }

        remove_all_filters('elementor/frontend/builder_content_data');
    }
}

function prortx_render_faq_section($current_category) {
    if (!$current_category || !function_exists('get_field')) {
        return;
    }

    // Fetch ACF FAQ fields for the current category
    $faqs_title = get_field('faqs_title', 'product_cat_' . $current_category->term_id);
    $faqs_subtitle = get_field('faqs_subtitle', 'product_cat_' . $current_category->term_id);
    $faqs_text = get_field('faqs_text', 'product_cat_' . $current_category->term_id);
    $faqs_posts = get_field('faqs', 'product_cat_' . $current_category->term_id);

    // Only render if at least one FAQ field has data
    if (empty($faqs_title) && empty($faqs_subtitle) && empty($faqs_text) && empty($faqs_posts)) {
        return;
    }

    // Prepare FAQ items for the widget if there are FAQ posts
    $faq_items = [];
    if (!empty($faqs_posts) && is_array($faqs_posts)) {
        foreach ($faqs_posts as $faq_post) {
            $faq_items[] = [
                'question' => get_the_title($faq_post),
                'answer' => apply_filters('the_content', $faq_post->post_content),
            ];
        }
    }

    // Always set widget fields, even if empty, to prevent defaults
    add_filter('elementor/frontend/builder_content_data', function($data) use ($faqs_title, $faqs_subtitle, $faqs_text, $faq_items) {
        foreach ($data as &$section) {
            if (!empty($section['elements'])) {
                foreach ($section['elements'] as &$widget) {
                    if (
                        isset($widget['widgetType']) &&
                        $widget['widgetType'] === 'faq_section'
                    ) {
                        if (isset($widget['settings'])) {
                            $widget['settings']['title'] = $faqs_title ?? '';
                            $widget['settings']['subtitle'] = $faqs_subtitle ?? '';
                            $widget['settings']['description'] = $faqs_text ?? '';
                            $widget['settings']['faq_items'] = !empty($faq_items) ? $faq_items : [];
                        }
                    }
                }
            }
        }
        return $data;
    }, 10, 1);

    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        if ($elementor->frontend) {
            $faq_template_content = $elementor->frontend->get_builder_content(337, true);
            if ($faq_template_content) {
                echo '<div class="faq-section">';
                echo $faq_template_content;
                echo '</div>';
            }
        }
    }

    // Remove the filter after rendering to avoid affecting other templates
    remove_all_filters('elementor/frontend/builder_content_data');
}