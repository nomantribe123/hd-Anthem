<?php 


// Helper function to get care instructions from global ACF fields and per-product selection
function get_product_care_instructions($product_id) {
    // Get custom care instructions text
    $custom_text = get_post_meta($product_id, '_product_care_instructions', true);

    // Get selected care instruction icon indexes
    $selected_indexes = get_post_meta($product_id, '_product_care_instructions_selected', true);
    if (!is_array($selected_indexes)) $selected_indexes = array();

    // Get global care instructions from ACF options
    $global_care_instructions = get_field('care_instruction_icons', 'products');
    $icons = array();

    if ($global_care_instructions && is_array($selected_indexes) && count($selected_indexes)) {
        foreach ($selected_indexes as $index) {
            if (isset($global_care_instructions[$index])) {
                $row = $global_care_instructions[$index];
                $icon = $row['icon'];
                $icon_name = is_array($icon) && isset($icon['title']) ? $icon['title'] : '';
                $icons[] = array(
                    'icon' => $icon,
                    'icon_name' => $icon_name
                );
            }
        }
    }

    return array(
        'text' => $custom_text,
        'icons' => $icons
    );
}

function get_product_bottom_blocks() {
    // Render Elementor sections after the main product content
    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
        
        // Check if we're not in edit mode
        if (!$elementor->editor->is_edit_mode()) {

            // Where to buy video​ Section - Replace with your template ID
            echo $elementor->frontend->get_builder_content_for_display(982);

            // Sustainability Commitment​ Section - Replace with your template ID
            echo $elementor->frontend->get_builder_content_for_display(3208);

            get_related_products_block();
        }
    }
}
add_action('woocommerce_after_single_product', 'get_product_bottom_blocks', 10);


function get_related_products_block() {
    global $product;
    $product_id = $product ? $product->get_id() : get_the_ID();

    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
    
        // Product Offerings Section
        $offerings_template_id = 826; // Replace with your template ID
        if ($offerings_template_id && $product_id) {

            // Dynamic values saved against specific product
            $custom_related_products = get_post_meta($product_id, '_custom_related_products', true);
            if (!is_array($custom_related_products)) $custom_related_products = array();
            $custom_related_products_title = get_post_meta($product_id, '_custom_related_products_title', true);
            $custom_related_products_text = get_post_meta($product_id, '_custom_related_products_text', true);

            // Only filter if we have custom data to override with
            $has_custom_data = !empty($custom_related_products) || !empty($custom_related_products_title) || !empty($custom_related_products_text);
            
            if ($has_custom_data) {
                // Use Elementor filter to override widget settings (similar to FAQ section)
                add_filter('elementor/frontend/builder_content_data', function($data) use ($custom_related_products, $custom_related_products_title, $custom_related_products_text) {
                    foreach ($data as &$section) {
                        if (!empty($section['elements'])) {
                            foreach ($section['elements'] as &$widget) {
                                if (
                                    isset($widget['widgetType']) &&
                                    $widget['widgetType'] === 'product_offerings'
                                ) {
                                    if (isset($widget['settings'])) {
                                        // Override with custom data if available
                                        if (!empty($custom_related_products_title)) {
                                            $widget['settings']['title'] = $custom_related_products_title;
                                        }
                                        if (!empty($custom_related_products_text)) {
                                            $widget['settings']['subtitle'] = $custom_related_products_text;
                                        }
                                        if (!empty($custom_related_products)) {
                                            // Ensure we have the right format - convert to strings as Elementor might expect
                                            $widget['settings']['selected_products'] = array_map('strval', $custom_related_products);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    return $data;
                }, 10, 1);
            }

            echo '<div class="product-offerings-section">';
            echo $elementor->frontend->get_builder_content_for_display($offerings_template_id);
            echo '</div>';

            // Clean up filter to avoid affecting other templates
            if ($has_custom_data) {
                remove_all_filters('elementor/frontend/builder_content_data');
            }
        }
    }
}