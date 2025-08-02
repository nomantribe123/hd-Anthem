<?php
/* Template Name: Legal */
get_header();

the_content();

if (have_posts()) : while (have_posts()) : the_post();
    // Always call the_content() first
    
    // Then handle Elementor editor mode specific content
    if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        // Render the legal header widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'legal_page_header',
            'settings' => [
                'breadcrumb_home_text' => 'Homepage',
                'breadcrumb_link_text' => 'Page Link',
                'breadcrumb_link_url' => ['url' => '#'],
                'title' => get_the_title(),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ]
        ])->render();

        // Render the table of contents widget
        echo \Elementor\Plugin::$instance->elements_manager->create_element_instance([
            'elType' => 'widget',
            'widgetType' => 'legal_table_content',
            'settings' => [
                'toc_title' => 'Table of contents',
                'content' => apply_filters('the_content', get_the_content())
            ]
        ])->render();
    }
endwhile; endif;

get_footer();
?> 