<?php

function register_event_post_type() {
    $labels = array(
        'name'                  => _x('Events', 'Post type general name', 'tribes-prortx'),
        'singular_name'         => _x('Event', 'Post type singular name', 'tribes-prortx'),
        'menu_name'             => _x('Events', 'Admin Menu text', 'tribes-prortx'),
        'name_admin_bar'        => _x('Event', 'Add New on Toolbar', 'tribes-prortx'),
        'add_new'              => __('Add New', 'tribes-prortx'),
        'add_new_item'         => __('Add New Event', 'tribes-prortx'),
        'new_item'             => __('New Event', 'tribes-prortx'),
        'edit_item'            => __('Edit Event', 'tribes-prortx'),
        'view_item'            => __('View Event', 'tribes-prortx'),
        'all_items'            => __('All Events', 'tribes-prortx'),
        'search_items'         => __('Search Events', 'tribes-prortx'),
        'not_found'            => __('No events found.', 'tribes-prortx'),
        'not_found_in_trash'   => __('No events found in Trash.', 'tribes-prortx'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug' => 'events',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-calendar-alt',
    );

    register_post_type('event', $args);

    // Register Event Category taxonomy
    $taxonomy_labels = array(
        'name'              => _x('Event Categories', 'taxonomy general name', 'tribes-prortx'),
        'singular_name'     => _x('Event Category', 'taxonomy singular name', 'tribes-prortx'),
        'search_items'      => __('Search Event Categories', 'tribes-prortx'),
        'all_items'         => __('All Event Categories', 'tribes-prortx'),
        'parent_item'       => __('Parent Event Category', 'tribes-prortx'),
        'parent_item_colon' => __('Parent Event Category:', 'tribes-prortx'),
        'edit_item'         => __('Edit Event Category', 'tribes-prortx'),
        'update_item'       => __('Update Event Category', 'tribes-prortx'),
        'add_new_item'      => __('Add New Event Category', 'tribes-prortx'),
        'new_item_name'     => __('New Event Category Name', 'tribes-prortx'),
        'menu_name'         => __('Event Categories', 'tribes-prortx'),
    );

    $taxonomy_args = array(
        'hierarchical'      => true,
        'labels'            => $taxonomy_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'event-category'),
    );

    register_taxonomy('event_category', array('event'), $taxonomy_args);
}
add_action('init', 'register_event_post_type');

// Add custom meta boxes for event details
function add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        __('Event Details', 'tribes-prortx'),
        'render_event_details_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

// Render meta box content
function render_event_details_meta_box($post) {
    // Add nonce for security
    wp_nonce_field('event_details_meta_box', 'event_details_meta_box_nonce');

    // Get existing values
    $event_date = get_post_meta($post->ID, 'event_date', true);
    $event_time = get_post_meta($post->ID, 'event_time', true);
    $event_location = get_post_meta($post->ID, 'event_location', true);
    $event_order = get_post_meta($post->ID, 'event_order', true);
    $event_link = get_post_meta($post->ID, 'event_link', true);
    ?>
    <p>
        <label for="event_date"><?php _e('Event Date:', 'tribes-prortx'); ?></label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" class="widefat">
    </p>
    <p>
        <label for="event_time"><?php _e('Event Time:', 'tribes-prortx'); ?></label><br>
        <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" class="widefat">
    </p>
    <p>
        <label for="event_location"><?php _e('Event Location:', 'tribes-prortx'); ?></label><br>
        <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>" class="widefat">
    </p>
    <p>
        <label for="event_link"><?php _e('Get in Touch Link:', 'tribes-prortx'); ?></label><br>
        <input type="text" id="event_link" name="event_link" value="<?php echo esc_attr($event_link); ?>" class="widefat" placeholder="e.g., https://, mailto:, tel:">
        <span class="description" style="color: #666; font-style: italic; margin-top: 5px; display: block;">
            <?php _e('Enter any type of link for the "Get in Touch" button - website URL (https://), email (mailto:), phone number (tel:), or any other valid link type.', 'tribes-prortx'); ?>
        </span>
    </p>
    <p>
        <label for="event_order"><?php _e('Event Order:', 'tribes-prortx'); ?></label><br>
        <input type="number" id="event_order" name="event_order" value="<?php echo esc_attr($event_order); ?>" class="widefat">
        <span class="description" style="color: #666; font-style: italic; margin-top: 5px; display: block;">
            <?php _e('Enter a number to control the order of events that share the same date. Lower numbers appear first. Events are primarily sorted by date, then by this order value.', 'tribes-prortx'); ?>
        </span>
    </p>
    <?php
}

// Save meta box data
function save_event_meta_box_data($post_id) {
    // Check if our nonce is set and verify it
    if (!isset($_POST['event_details_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['event_details_meta_box_nonce'], 'event_details_meta_box')) {
        return;
    }

    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the meta box data
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, 'event_date', sanitize_text_field($_POST['event_date']));
    }
    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, 'event_time', sanitize_text_field($_POST['event_time']));
    }
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, 'event_location', sanitize_text_field($_POST['event_location']));
    }
    if (isset($_POST['event_order'])) {
        update_post_meta($post_id, 'event_order', intval($_POST['event_order']));
    }
    if (isset($_POST['event_link'])) {
        update_post_meta($post_id, 'event_link', esc_url_raw($_POST['event_link']));
    }
}
add_action('save_post_event', 'save_event_meta_box_data'); 