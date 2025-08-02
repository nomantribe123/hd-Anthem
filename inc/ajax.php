<?php 

// AJAX handler for adding items to workwear builder
add_action('wp_ajax_add_to_workwear_builder', 'handle_add_to_workwear_builder');
add_action('wp_ajax_nopriv_add_to_workwear_builder', 'handle_add_to_workwear_builder');

function handle_add_to_workwear_builder() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'workwear_builder_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'));
        wp_die();
    }

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    if ($product_id > 0) {
        if (!isset($_SESSION['workwear_builder'])) {
            $_SESSION['workwear_builder'] = array();
        }
        
        // Only add if not already in the builder
        if (!in_array($product_id, $_SESSION['workwear_builder'])) {
            $_SESSION['workwear_builder'][] = $product_id;
        }
        
        wp_send_json_success(array(
            'count' => count($_SESSION['workwear_builder']),
            'message' => 'Product added to Workwear Builder'
        ));
    } else {
        wp_send_json_error(array('message' => 'Invalid product ID'));
    }
    
    wp_die();
}

// AJAX handler for removing items from workwear builder
add_action('wp_ajax_remove_from_workwear_builder', 'handle_remove_from_workwear_builder');
add_action('wp_ajax_nopriv_remove_from_workwear_builder', 'handle_remove_from_workwear_builder');

function handle_remove_from_workwear_builder() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'workwear_builder_nonce')) {
        wp_send_json_error(array('message' => 'Invalid security token'));
        wp_die();
    }

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    if ($product_id > 0 && isset($_SESSION['workwear_builder'])) {
        // Find and remove the product ID from the array
        $key = array_search($product_id, $_SESSION['workwear_builder']);
        if ($key !== false) {
            unset($_SESSION['workwear_builder'][$key]);
            // Re-index the array
            $_SESSION['workwear_builder'] = array_values($_SESSION['workwear_builder']);
        }
        
        wp_send_json_success(array(
            'count' => count($_SESSION['workwear_builder']),
            'message' => 'Product removed from Workwear Builder'
        ));
    } else {
        wp_send_json_error(array('message' => 'Invalid product ID or empty builder'));
    }
    
    wp_die();
}

// Add necessary scripts
function enqueue_workwear_builder_scripts() {
    wp_enqueue_script(
        'workwear-builder', 
        get_stylesheet_directory_uri() . '/assets/js/workwear-builder.js', 
        array(), 
        '1.0.3', 
        true
    );
    
    wp_localize_script(
        'workwear-builder', 
        'workwearBuilder', 
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('workwear_builder_nonce')
        )
    );
}
// add_action('wp_enqueue_scripts', 'enqueue_workwear_builder_scripts');

// Handle updating workwear builder attributes
add_action('wp_ajax_update_workwear_builder_attribute', 'handle_update_workwear_builder_attribute');
add_action('wp_ajax_nopriv_update_workwear_builder_attribute', 'handle_update_workwear_builder_attribute');

function handle_update_workwear_builder_attribute() {
    check_ajax_referer('workwear_builder_nonce', 'nonce');
    
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $attribute_name = isset($_POST['attribute_name']) ? sanitize_text_field($_POST['attribute_name']) : '';
    $attribute_value = isset($_POST['attribute_value']) ? sanitize_text_field($_POST['attribute_value']) : '';
    
    if (!$product_id || !$attribute_name) {
        wp_send_json_error(array('message' => 'Invalid product ID or attribute name'));
        return;
    }
    
    // Get current workwear builder items from session
    if (!session_id()) {
        session_start();
    }
    
    if (!isset($_SESSION['workwear_builder_attributes'])) {
        $_SESSION['workwear_builder_attributes'] = array();
    }
    
    if (!isset($_SESSION['workwear_builder_attributes'][$product_id])) {
        $_SESSION['workwear_builder_attributes'][$product_id] = array();
    }
    
    // Update the attribute value
    $_SESSION['workwear_builder_attributes'][$product_id][$attribute_name] = $attribute_value;
    
    wp_send_json_success(array(
        'message' => 'Attribute updated successfully',
        'product_id' => $product_id,
        'attribute_name' => $attribute_name,
        'attribute_value' => $attribute_value
    ));
}

// Handle deleting entire workwear selection
add_action('wp_ajax_delete_workwear_selection', 'handle_delete_workwear_selection');
add_action('wp_ajax_nopriv_delete_workwear_selection', 'handle_delete_workwear_selection');

function handle_delete_workwear_selection() {
    check_ajax_referer('workwear_builder_nonce', 'nonce');
    
    // Start session if not already started
    if (!session_id()) {
        session_start();
    }
    
    // Clear the workwear items array
    $_SESSION['workwear_builder'] = array();
    
    // Clear any stored attributes
    $_SESSION['workwear_builder_attributes'] = array();
    
    wp_send_json_success(array(
        'message' => 'Product selection deleted successfully'
    ));
}