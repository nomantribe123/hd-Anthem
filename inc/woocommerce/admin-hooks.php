<?php 

// Add Product Settings & Where to Buy sub page to ACF Options
add_action('acf/init', function() {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'page_title'  => 'Products',
            'menu_title'  => 'Products',
            'menu_slug'   => 'acf-products-settings',
            'parent_slug' => 'acf-options',
            'post_id'     => 'products',
            'capability'  => 'manage_options'
        ));

         acf_add_options_sub_page(array(
            'page_title'  => 'Where to Buy',
            'menu_title'  => 'Where to Buy',
            'menu_slug'   => 'acf-where-to-buy-settings',
            'parent_slug' => 'acf-options',
            'post_id'     => 'where_to_buy',
            'capability'  => 'manage_options'
        ));
    }
});

// Add PDF Upload field to WooCommerce products
function add_product_pdf_upload_field() {
    woocommerce_wp_text_input(
        array(
            'id'          => '_product_pdf_attachment',
            'label'       => 'PDF Attachment',
            'desc_tip'    => true,
            'description' => 'Upload a PDF file for this product.',
            'type'        => 'text',
            'custom_attributes' => array(
                'readonly' => 'readonly'
            )
        )
    );
    echo '<button type="button" class="button-secondary" id="upload_pdf_button">Upload PDF</button>';
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('#upload_pdf_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: 'Upload PDF',
                button: {
                    text: 'Select PDF'
                },
                multiple: false,
                library: {
                    type: 'application/pdf'
                }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_product_pdf_attachment').val(attachment.url);
            });

            mediaUploader.open();
        });
    });
    </script>
    <?php
}
add_action('woocommerce_product_options_general_product_data', 'add_product_pdf_upload_field');

/*
// Add Product Features fields to WooCommerce
function add_product_features_fields() {
    global $woocommerce, $post;
    
    echo '<div class="options_group">';
    
    // Features Section Title
    echo '<h4 style="margin-left: 10px;">Product Features</h4>';
    
    // Get existing features
    $features = get_post_meta($post->ID, '_product_features', true);
    if (!is_array($features)) {
        $features = array();
    }
    
    // Features Container
    echo '<div id="product_features_container" style="margin: 10px;">';
    
    // Existing Features
    if (!empty($features)) {
        foreach ($features as $index => $feature) {
            echo '<div class="feature-row" style="margin-bottom: 10px;">';
            echo '<input type="text" name="product_features[]" value="' . esc_attr($feature) . '" style="width: 80%;" placeholder="Enter feature" />';
            echo '<button type="button" class="remove-feature button" style="margin-left: 10px;">Remove</button>';
            echo '</div>';
        }
    }
    
    echo '</div>';
    
    // Add Feature Button
    echo '<p style="margin: 10px;"><button type="button" id="add_feature" class="btn">Add Feature</button></p>';
    
    // JavaScript for dynamic feature management
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Add new feature
            $('#add_feature').on('click', function() {
                var row = '<div class="feature-row" style="margin-bottom: 10px;">' +
                         '<input type="text" name="product_features[]" value="" style="width: 80%;" placeholder="Enter feature" />' +
                         '<button type="button" class="remove-feature button" style="margin-left: 10px;">Remove</button>' +
                         '</div>';
                $('#product_features_container').append(row);
            });
            
            // Remove feature
            $(document).on('click', '.remove-feature', function() {
                $(this).parent('.feature-row').remove();
            });
        });
    </script>
    <?php
    
    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'add_product_features_fields');

// Save Product Features
function save_product_features_fields($post_id) {
    $features = isset($_POST['product_features']) ? array_filter($_POST['product_features']) : array();
    update_post_meta($post_id, '_product_features', $features);
}
add_action('woocommerce_process_product_meta', 'save_product_features_fields'); */

// Add Product Specifications fields to WooCommerce
function add_product_specification_fields() {
    global $woocommerce, $post;
    
    echo '<div class="options_group">';

    // Certifications field
    woocommerce_wp_textarea_input(
        array(
            'id'          => '_product_certifications',
            'label'       => 'Certifications',
            'desc_tip'    => true,
            'description' => 'Enter product certifications.',
            'placeholder' => 'e.g., EN ISO 20471:2013+A1:2016',
            'value'       => get_post_meta($post->ID, '_product_certifications', true)
        )
    );

    // Fabric Content field
    woocommerce_wp_text_input(
        array(
            'id'          => '_product_fabric_content',
            'label'       => 'Fabric Content',
            'desc_tip'    => true,
            'description' => 'Enter fabric content details.',
            'placeholder' => 'e.g., 100% Recycled Polyester',
            'value'       => get_post_meta($post->ID, '_product_fabric_content', true)
        )
    );

    // Fabric Weight field
    woocommerce_wp_text_input(
        array(
            'id'          => '_product_fabric_weight',
            'label'       => 'Weight (Fabric)',
            'desc_tip'    => true,
            'description' => 'Enter fabric weight.',
            'placeholder' => 'e.g., 190gsm',
            'value'       => get_post_meta($post->ID, '_product_fabric_weight', true)
        )
    );

    // Breathable field
    woocommerce_wp_select(
        array(
            'id'          => '_product_breathable',
            'label'       => 'Breathable',
            'desc_tip'    => true,
            'description' => 'Is the product breathable?',
            'options'     => array(
                ''    => 'Select...',
                'yes' => 'Yes',
                'no'  => 'No'
            ),
            'value'       => get_post_meta($post->ID, '_product_breathable', true)
        )
    );

    // Material field
    woocommerce_wp_text_input(
        array(
            'id'          => '_product_material',
            'label'       => 'Material',
            'desc_tip'    => true,
            'description' => 'Enter material details.',
            'placeholder' => 'e.g., Mesh & Rubber',
            'value'       => get_post_meta($post->ID, '_product_material', true)
        )
    );

    // Size Guide PDF Upload
    woocommerce_wp_text_input(
        array(
            'id'          => '_size_guide_pdf',
            'label'       => 'Size Guide PDF',
            'desc_tip'    => true,
            'description' => 'Upload a Size Guide PDF file for this product.',
            'type'        => 'text',
            'custom_attributes' => array(
                'readonly' => 'readonly'
            )
        )
    );
    echo '<button type="button" class="button-secondary" id="upload_size_guide_button">Upload Size Guide PDF</button>';

    // Care Instructions PDF Upload
    woocommerce_wp_text_input(
        array(
            'id'          => '_care_instructions_pdf',
            'label'       => 'Care Instructions PDF',
            'desc_tip'    => true,
            'description' => 'Upload a Care Instructions PDF file for this product.',
            'type'        => 'text',
            'custom_attributes' => array(
                'readonly' => 'readonly'
            )
        )
    );
    echo '<button type="button" class="button-secondary" id="upload_care_instructions_button">Upload Care Instructions PDF</button>';

    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'add_product_specification_fields');

// Save Product Specifications
function save_product_specification_fields($post_id) {

    // Save PDF Attachment
    $pdf_attachment = isset($_POST['_product_pdf_attachment']) ? $_POST['_product_pdf_attachment'] : '';
    update_post_meta($post_id, '_product_pdf_attachment', sanitize_text_field($pdf_attachment));

    // Save Certifications
    $certifications = isset($_POST['_product_certifications']) ? sanitize_textarea_field($_POST['_product_certifications']) : '';
    update_post_meta($post_id, '_product_certifications', $certifications);

    // Save Fabric Content
    $fabric_content = isset($_POST['_product_fabric_content']) ? sanitize_text_field($_POST['_product_fabric_content']) : '';
    update_post_meta($post_id, '_product_fabric_content', $fabric_content);

    // Save Fabric Weight
    $fabric_weight = isset($_POST['_product_fabric_weight']) ? sanitize_text_field($_POST['_product_fabric_weight']) : '';
    update_post_meta($post_id, '_product_fabric_weight', $fabric_weight);

    // Save Breathable
    $breathable = isset($_POST['_product_breathable']) ? sanitize_text_field($_POST['_product_breathable']) : '';
    update_post_meta($post_id, '_product_breathable', $breathable);

    // Save Material
    $material = isset($_POST['_product_material']) ? sanitize_text_field($_POST['_product_material']) : '';
    update_post_meta($post_id, '_product_material', $material);

    // Save Size Guide PDF
    $size_guide_pdf = isset($_POST['_size_guide_pdf']) ? $_POST['_size_guide_pdf'] : '';
    update_post_meta($post_id, '_size_guide_pdf', sanitize_text_field($size_guide_pdf));

    // Save Care Instructions PDF
    $care_instructions_pdf = isset($_POST['_care_instructions_pdf']) ? $_POST['_care_instructions_pdf'] : '';
    update_post_meta($post_id, '_care_instructions_pdf', sanitize_text_field($care_instructions_pdf));

    // Save Care Instructions
    $care_instructions = isset($_POST['_product_care_instructions']) ? sanitize_textarea_field($_POST['_product_care_instructions']) : '';
    update_post_meta($post_id, '_product_care_instructions', $care_instructions);

    // Save selected care instruction icons (indexes)
    $selected = isset($_POST['product_care_instructions_selected']) ? array_map('intval', (array)$_POST['product_care_instructions_selected']) : array();
    update_post_meta($post_id, '_product_care_instructions_selected', $selected);

    // Save Norty Assets
    $assets = isset($_POST['_norty_assets']) ? sanitize_text_field($_POST['_norty_assets']) : '';
    update_post_meta($post_id, '_norty_assets', $assets);
}
add_action('woocommerce_process_product_meta', 'save_product_specification_fields');

// Add Features column to products admin table
function add_product_features_admin_column($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $column) {
        $new_columns[$key] = $column;
        // Add Features column after Tags column
        if ($key === 'product_tag') {
            $new_columns['taxonomy-product_feature'] = __('Product Features', 'tribes-prortx');
        }
    }
    
    return $new_columns;
}
add_filter('manage_edit-product_columns', 'add_product_features_admin_column', 20);

// Populate Features column content
function populate_product_features_admin_column($column, $post_id) {
    if ($column === 'taxonomy-product_feature') {
        $terms = wp_get_object_terms($post_id, 'product_feature');
        if (!empty($terms) && !is_wp_error($terms)) {
            $feature_links = array();
            foreach ($terms as $term) {
                $feature_links[] = sprintf(
                    '<a href="%s">%s</a>',
                    esc_url(add_query_arg('product_feature', $term->slug, admin_url('edit.php?post_type=product'))),
                    esc_html($term->name)
                );
            }
            echo join(', ', $feature_links);
        } else {
            echo '<span class="na">—</span>';
        }
    }
}
add_action('manage_product_posts_custom_column', 'populate_product_features_admin_column', 10, 2);

// Make Features column sortable
function make_product_features_column_sortable($columns) {
    $columns['taxonomy-product_feature'] = 'product_feature';
    return $columns;
}
add_filter('manage_edit-product_sortable_columns', 'make_product_features_column_sortable');

// Handle Features column sorting
function handle_product_features_column_sorting($query) {
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');
    
    if ('product_features' === $orderby) {
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'product_feature',
                'field'    => 'term_id',
            ),
        ));
        $query->set('orderby', 'name');
    }
}
add_action('pre_get_posts', 'handle_product_features_column_sorting');

// Add Features filter dropdown to products admin
function add_product_features_admin_filter() {
    global $typenow;
    
    if ($typenow === 'product') {
        $selected = isset($_GET['product_feature']) ? $_GET['product_feature'] : '';
        
        wp_dropdown_categories(array(
            'show_option_all' => __('Filter by Product Feature', 'tribes-prortx'),
            'taxonomy'        => 'product_feature',
            'name'           => 'product_feature',
            'orderby'        => 'name',
            'selected'       => $selected,
            'hierarchical'   => true,
            'show_count'     => true,
            'hide_empty'     => true,
        ));
    }
}
add_action('restrict_manage_posts', 'add_product_features_admin_filter');

// Handle Features filter
function handle_product_features_admin_filter($query) {
    global $pagenow;
    
    if (is_admin() && 
        $pagenow === 'edit.php' && 
        isset($_GET['post_type']) && 
        $_GET['post_type'] === 'product' && 
        isset($_GET['product_feature']) && 
        $_GET['product_feature'] > 0) {
        
        $query->query_vars['tax_query'] = array(
            array(
                'taxonomy' => 'product_feature',
                'field'    => 'id',
                'terms'    => array($_GET['product_feature']),
            ),
        );
    }
}
add_action('parse_query', 'handle_product_features_admin_filter');

// Add JavaScript for PDF uploads
add_action('admin_footer', function() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Size Guide PDF Upload
        $('#upload_size_guide_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: 'Upload Size Guide PDF',
                button: {
                    text: 'Select PDF'
                },
                multiple: false,
                library: {
                    type: 'application/pdf'
                }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_size_guide_pdf').val(attachment.url);
            });

            mediaUploader.open();
        });

        // Care Instructions PDF Upload
        $('#upload_care_instructions_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: 'Upload Care Instructions PDF',
                button: {
                    text: 'Select PDF'
                },
                multiple: false,
                library: {
                    type: 'application/pdf'
                }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_care_instructions_pdf').val(attachment.url);
            });

            mediaUploader.open();
        });
    });
    </script>
    <?php
});

// Save PDF fields
// add_action('woocommerce_process_product_meta', function($post_id) {
//     // Save Size Guide PDF
//     $size_guide_pdf = isset($_POST['_size_guide_pdf']) ? $_POST['_size_guide_pdf'] : '';
//     update_post_meta($post_id, '_size_guide_pdf', sanitize_text_field($size_guide_pdf));

//     // Save Care Instructions PDF
//     $care_instructions_pdf = isset($_POST['_care_instructions_pdf']) ? $_POST['_care_instructions_pdf'] : '';
//     update_post_meta($post_id, '_care_instructions_pdf', sanitize_text_field($care_instructions_pdf));
// });

// Remove Show Care Instructions checkbox
// Add Product Care Instructions fields to WooCommerce
function add_product_care_instructions_fields() {
    global $post;

    echo '<div class="options_group">';
    // Custom care instructions text field
    woocommerce_wp_textarea_input(
        array(
            'id'          => '_product_care_instructions',
            'label'       => 'Care Instructions',
            'desc_tip'    => true,
            'description' => 'Enter custom care instructions for this product (optional).',
            'placeholder' => 'e.g., Wash at 30°C, do not bleach, etc.',
            'value'       => get_post_meta($post->ID, '_product_care_instructions', true)
        )
    );

    // Get global care instructions from ACF options
    $global_care_instructions = get_field('care_instruction_icons', 'products');
    if ($global_care_instructions) {
        $selected = get_post_meta($post->ID, '_product_care_instructions_selected', true);
        if (!is_array($selected)) $selected = array();

        echo '<p><strong>Select Care Instruction Icons for this product:</strong></p>';
        echo '<ul style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom:10px; padding: 5px 9px;">';
        foreach ($global_care_instructions as $index => $row) {
            $icon = $row['icon'];
            $icon_url = is_array($icon) && isset($icon['url']) ? $icon['url'] : '';
            $icon_title = is_array($icon) && isset($icon['title']) ? $icon['title'] : '';
            $icon_label = !empty($row['label']) ? $row['label'] : '';
            $checked = in_array($index, $selected) ? 'checked' : '';
            echo '<li style="display: flex; align-items: center; min-width: 180px;">';
                echo '<label style="margin: 0; display: flex; align-items: center;">';
                    if ($icon_url) {
                        echo '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($icon_title) . '" style="width:32px;height:32px;vertical-align:middle;margin-right:8px;border:1px solid #ddd;background:#fff;border-radius:4px;">';
                    }
                    echo '<input type="checkbox" name="product_care_instructions_selected[]" value="' . esc_attr($index) . '" ' . $checked . ' style="margin-right:6px;"> ';
                    echo '<span>' . esc_html($icon_label) . '</span>';
                echo '</label>';
            echo '</li>';
        }
        echo '</ul>';
    }

    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'add_product_care_instructions_fields');


function add_norty_assets_link() {
    global $post;

    woocommerce_wp_text_input(
        array(
            'id'          => '_norty_assets',
            'label'       => 'Norty Assets Link',
            'desc_tip'    => true,
            'description' => 'Enter URL for Norty Assets',
            'placeholder' => '',
            'value'       => get_post_meta($post->ID, '_norty_assets', true)
        )
    );
}
add_action('woocommerce_product_options_general_product_data', 'add_norty_assets_link');


/**
 * Add Custom Related Products field to Product Options
 *
 * @return void
 */
function add_custom_related_products_field() {
    global $post;

    woocommerce_wp_text_input(
        array(
            'id'          => '_custom_related_products_title',
            'label'       => 'Related Products Title',
            'desc_tip'    => true,
            'description' => 'Title displayed above related products slider.',
            'placeholder' => 'View our product offerings',
            'value'       => get_post_meta($post->ID, '_custom_related_products_title', true)
        )
    );

       // Certifications field
    woocommerce_wp_textarea_input(
        array(
            'id'          => '_custom_related_products_text',
            'label'       => 'Related Products Text',
            'desc_tip'    => true,
            'description' => 'Enter text displayed under the related products title.',
            // 'placeholder' => 'e.g., ',
            'value'       => get_post_meta($post->ID, '_custom_related_products_text', true)
        )
    );


    $custom_related_products = get_post_meta($post->ID, '_custom_related_products', true);
    if (!is_array($custom_related_products)) {
        $custom_related_products = array();
    }

?>
    <p class="form-field">
        <label for="custom_related_products"><?php _e('Custom Related Products', 'woocommerce'); ?></label>
        <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="_custom_related_products" name="_custom_related_products[]" data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'woocommerce'); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo esc_attr(json_encode(array($post->ID))); ?>">
            <?php
            foreach ($custom_related_products as $product_id) {
                $product = wc_get_product($product_id);
                if (is_object($product)) {
                    echo '<option value="' . esc_attr($product_id) . '"' . selected(true, true, false) . '>' . wp_kses_post($product->get_formatted_name()) . '</option>';
                }
            }
            ?>
        </select>
        <?php echo wc_help_tip(__('If this is left empty it will default to show products in the same category.', 'woocommerce')); ?>
    </p>
<?php
}
add_action('woocommerce_product_options_related', 'add_custom_related_products_field');

/**
 * Save Custom Related Products field data
 *
 * @param int $post_id
 * @return void
 */
function save_custom_related_products_fields($post_id) {
    $custom_related_products_title = isset($_POST['_custom_related_products_title']) ? $_POST['_custom_related_products_title'] : '';
    update_post_meta($post_id, '_custom_related_products_title', sanitize_text_field($custom_related_products_title));

    $custom_related_products_text = isset($_POST['_custom_related_products_text']) ? $_POST['_custom_related_products_text'] : '';
    update_post_meta($post_id, '_custom_related_products_text', sanitize_text_field($custom_related_products_text));

    $custom_related_products = isset($_POST['_custom_related_products']) ? array_map('intval', $_POST['_custom_related_products']) : array();
    update_post_meta($post_id, '_custom_related_products', $custom_related_products);
}
add_action('woocommerce_process_product_meta', 'save_custom_related_products_fields');
