<?php
get_header();

use Elementor\Plugin;

if ( Plugin::instance()->preview->is_preview_mode() ) {
    // Elementor live preview/editor mode
    the_content();
}

// Blog Header
Blog_Header::render();

// Blog Content
if (class_exists('\Elementor\Plugin') && !isset($_GET['elementor-preview']) && is_single()) {
    Blog_Content::render();
}

// // Newsletter Section
// if (class_exists('\Elementor\Plugin') && !isset($_GET['elementor-preview']) && is_single()) {
//     $newsletter_template_id = 479;
//     echo \Elementor\Plugin::$instance->frontend->get_builder_content($newsletter_template_id, true);
// }

// Author Information
Blog_Author::render();



// Related Posts
// Blog_Related::render();

get_footer();
?>