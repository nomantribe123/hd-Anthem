<?php
/* Template Name: Contact Us */
get_header();

the_content();

if (have_posts()) : while (have_posts()) : the_post();
    // Always call the_content() first
    
    // Then handle Elementor editor mode specific content
    if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        // Render the contact header widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'contact_header',
            'settings' => []
        ])->render();

        // Render the contact info widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'contact_info',
            'settings' => []
        ])->render();

        // Render the CTA widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'workwear_cta',
            'settings' => []
        ])->render();
    }
endwhile; endif;

get_footer();
?> 