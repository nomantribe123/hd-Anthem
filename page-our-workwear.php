<?php
/* Template Name: Our Workwear */
get_header();

$product_categories = get_terms([
    'taxonomy' => 'product_cat',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'parent' => 0
]);

the_content();

if (have_posts()) : while (have_posts()) : the_post();
    // Always call the_content() first
    // the_content();
    
    // Then handle Elementor editor mode specific content
    if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        // Render the header widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'workwear_header',
            'settings' => []
        ])->render();

        // Render the product categories widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'workwear_categories',
            'settings' => []
        ])->render();
    }
?>

<?php endwhile; endif;

get_footer();
?>
