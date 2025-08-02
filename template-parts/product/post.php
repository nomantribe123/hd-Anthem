<?php 
global $product;

$tag = $args['tag'] ?? 'li';
$product_counter = $args['product_counter'] ?? 0;

// Ensure we have a valid product
if (!is_a($product, 'WC_Product')) {
    $product = wc_get_product(get_the_ID());
}

if (!$product) {
    return;
}

// Get product data
$product_id = $product->get_id();
$product_name = $product->get_name();
$product_sku = $product->get_sku();
$product_image_id = $product->get_image_id();
$product_image_url = wp_get_attachment_image_url($product_image_id, 'full');
$product_permalink = get_permalink($product_id);

$product_counter++;

// Initialize arrays for sizes and colors
$sizes = [];
$colors = [];

// First check regular product attributes
$attributes = $product->get_attributes();
foreach ($attributes as $attribute) {
    if (strpos(strtolower($attribute->get_name()), 'size') !== false) {
        if ($attribute->is_taxonomy()) {
            $terms = $attribute->get_terms();
            foreach ($terms as $term) {
                $sizes[] = $term->name;
            }
        } else {
            $option_string = $attribute->get_options();
            if (is_array($option_string)) {
                $sizes = array_merge($sizes, $option_string);
            } else if (is_string($option_string)) {
                $sizes[] = $option_string;
            }
        }
    }
    if (strpos(strtolower($attribute->get_name()), 'color') !== false || strpos(strtolower($attribute->get_name()), 'colour') !== false) {
        if ($attribute->is_taxonomy()) {
            $terms = $attribute->get_terms();
            foreach ($terms as $term) {
                $hex = get_term_meta($term->term_id, 'product_attribute_color', true);
                $colors[] = $term->name . "|" . $hex;
            }
        } else {
            $options = $attribute->get_options();
            if (is_array($options)) {
                foreach ($options as $option) {
                    $colors[] = $option;
                }
            } else if (is_string($option_string)) {
                $colors[] = $option_string;
            }
        }
    }
}

// Then check variations if it's a variable product
$available_variations = $product->is_type('variable') ? $product->get_available_variations() : [];
if ($product->is_type('variable')) {
    foreach ($available_variations as $variation) {
        foreach ($variation['attributes'] as $key => $value) {
            if (strpos(strtolower($key), 'size') !== false) {
                $sizes[] = $value;
            }
            if (strpos(strtolower($key), 'color') !== false || 
            strpos(strtolower($key), 'colour') !== false) {
                $colors[] = $value;
            }
        }
    }
}

// Remove duplicates
$sizes = array_unique($sizes);
$colors = array_unique($colors);

// Get product features
$features = get_post_meta($product->get_id(), '_product_features', true);
$features = is_array($features) ? $features : array();

// Get category names and slugs
$categories = wp_get_post_terms($product->get_id(), 'product_cat', array('fields' => 'names'));
$category_terms = wp_get_post_terms($product->get_id(), 'product_cat', array('fields' => 'all'));
$category_slugs = array_map(function($term) { return $term->slug; }, $category_terms);

// Prepare product data for JSON
$product_json = array(
    'id' => $product->get_id(),
    'name' => $product->get_name(),
    'number' => $product->get_sku(),
    'description' => $product->get_short_description(),
    'the_content' => $product->get_description(),
    'images' => array(),
    'sizes' => $sizes,
    'colours' => array_map(function($color) use ($product) {
        $color_parts = explode("|", $color);
        $name = $color_parts[0];
        $slug = sanitize_title($name);
        $hex = isset($color_parts[1]) ? $color_parts[1] : $name; // fallback to name if no hex

        return array(
            'id' => $slug,
            'label' => $name,
            'value' => $hex
        );
    }, $colors),
    'features' => $features,
    'link' => get_permalink($product->get_id()),
    'where_to_buy' => get_field('where_to_buy', $product->get_id()),
    'pdf_attachment' => get_post_meta($product->get_id(), '_product_pdf_attachment', true),
    'fabric_content' => $product->get_meta('_product_fabric_content', true),
    'fabric_weight' => $product->get_meta('_product_fabric_weight', true),
);

// Add featured image
if ($product_image_url) {
    $product_json['images'][] = [
        'url' => $product_image_url,
        'color_slug' => null
    ];
}

// Add gallery images
$gallery_image_ids = $product->get_gallery_image_ids();
foreach ($gallery_image_ids as $gallery_image_id) {
    $gallery_image_url = wp_get_attachment_image_url($gallery_image_id, 'full');
    if ($gallery_image_url) {
        $product_json['images'][] = [
            'url' => $gallery_image_url,
            'color_slug' => null
        ];
    }
}

// Add variation images by color (if variable product)
if ($product->is_type('variable')) {
    $variation_ids = $product->get_children();
    $used_urls = array_column($product_json['images'], 'url');
    foreach ($variation_ids as $variation_id) {
        $variation_obj = wc_get_product($variation_id);
        if (!$variation_obj) continue;
        $attributes = $variation_obj->get_attributes();
        foreach ($attributes as $attr_name => $attr_value) {
            if (strpos($attr_name, 'color') !== false || strpos($attr_name, 'colour') !== false) {
                $img_id = $variation_obj->get_image_id();
                if ($img_id) {
                    // Get color slug
                    if (taxonomy_exists($attr_name)) {
                        $terms = get_terms([
                            'taxonomy' => $attr_name,
                            'hide_empty' => false,
                        ]);
                        foreach ($terms as $term) {
                            if (
                                strtolower($term->slug) === strtolower($attr_value) ||
                                strtolower($term->name) === strtolower($attr_value)
                            ) {
                                $color_slug = $term->slug;
                                break;
                            }
                        }
                    } else {
                        $color_slug = sanitize_title($attr_value);
                    }
                    $variation_url = wp_get_attachment_image_url($img_id, 'full');
                    if ($variation_url && !in_array($variation_url, $used_urls, true)) {
                        $product_json['images'][] = [
                            'url' => $variation_url,
                            'color_slug' => $color_slug
                        ];
                        $used_urls[] = $variation_url;
                    }
                }
            }
        }
    }
}

$image_type = get_image_type_var();
$image_to_display = $product_image_url;

if ($image_type == 'item') {
    $product_item_image = get_field('product_item_image');



    if ($product_item_image) {
        $image_to_display = $product_item_image;
    } else {
        // Fallback to the first gallery of the product if no product_item_image is set
        if ($gallery_image_ids) {
            $first_gallery_image = $gallery_image_ids[0];
            $image_to_display = wp_get_attachment_image_url($first_gallery_image, 'full');
        }
    }
}
?>

<<?php echo $tag ?> class="product-card h-full flex flex-col justify-end" data-product='<?php echo esc_attr(json_encode($product_json)); ?>'>
    <div class="relative w-full flex flex-col justify-end items-start mb-4 rounded-xxl overflow-hidden">
        <?php if ($product_image_url) : ?>
            <a href="<?php echo esc_url($product_permalink); ?>" class="w-full" title="<?php echo esc_attr($product_name); ?>">
                <img src="<?php echo esc_url($image_to_display); ?>" alt="<?php echo esc_attr($product_name); ?>" class="prod-img">
            </a>
        <?php endif; ?>
        <div class="quick-view">
            <button @click="showProductModal($event)"
                    class="backdrop-blur-2xl rounded-full w-full h-8 flex justify-center items-center gap-3 border px-4 hover:brightness-80 z-10">
                <span class="text-sm">Quick View</span>
                <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/magnifying-glass.svg' ); ?>
            </button>
        </div>
    </div>
    <div class="grow flex flex-col justify-between">
        <div class="mb-2">
            <p class="text-xl">
                <a href="<?php echo esc_url($product_permalink); ?>" title="<?php echo esc_attr($product_name); ?>">
                    <?php echo esc_html($product_name); ?>
                </a>
            </p>
            <?php if ($product_sku) : ?>
                <p class="mb-2 text-sm">#<?php echo esc_html($product_sku); ?> (Item Number)</p>
            <?php endif; ?>
        </div>
        <div>
        <?php if (!empty($sizes)) : ?>
            <p class="mb-2 text-sm">Sizes: <?php echo esc_html(implode(' - ', $sizes)); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($colors)) : ?>
                <div class="color-options flex flex-wrap items-center gap-2 mb-8">
                    <p class="label">Colours:</p>
                    <div x-data="{ showMoreColors: false }" class="flex flex-wrap items-center gap-2">
                    <?php 
                    $displayed_colors = array_slice($colors, 0, 5);
                    foreach ($displayed_colors as $color) : 
                        echo get_color_swatch_html($color);
                    endforeach; 
                
                    if (count($colors) > 5) : ?>
                        <!-- Additional colors that show/hide on click -->
                        <div x-show="showMoreColors"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="flex flex-wrap items-center gap-2">
                            <?php 
                            $remaining_colors = array_slice($colors, 5);
                            foreach ($remaining_colors as $color) :
                                echo get_color_swatch_html($color);
                            endforeach;
                            ?>
                        </div>
                        
                        <!-- More colors toggle button -->
                        <button @click="showMoreColors = !showMoreColors" class="bg-anthem-grey-1 flex items-center gap-1 rounded-full px-2 h-6.5 cursor-pointer">
                            <svg x-show="!showMoreColors" class="w-2.5 h-2.5" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.05 2.75H4.95V4.95H2.75V6.05H4.95V8.25H6.05V6.05H8.25V4.95H6.05V2.75Z" fill="currentColor"/>
                                <path d="M5.5 0C2.4673 0 0 2.4673 0 5.5C0 8.5327 2.4673 11 5.5 11C8.5327 11 11 8.5327 11 5.5C11 2.4673 8.5327 0 5.5 0ZM5.5 9.9C3.07395 9.9 1.1 7.92605 1.1 5.5C1.1 3.07395 3.07395 1.1 5.5 1.1C7.92605 1.1 9.9 3.07395 9.9 5.5C9.9 7.92605 7.92605 9.9 5.5 9.9Z" fill="currentColor"/>
                            </svg>
                            <svg x-show="showMoreColors" class="w-2.5 h-2.5" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.75 4.95H8.25V6.05H2.75V4.95Z" fill="currentColor"/>
                                <path d="M5.5 0C2.4673 0 0 2.4673 0 5.5C0 8.5327 2.4673 11 5.5 11C8.5327 11 11 8.5327 11 5.5C11 2.4673 8.5327 0 5.5 0ZM5.5 9.9C3.07395 9.9 1.1 7.92605 1.1 5.5C1.1 3.07395 3.07395 1.1 5.5 1.1C7.92605 1.1 9.9 3.07395 9.9 5.5C9.9 7.92605 7.92605 9.9 5.5 9.9Z" fill="currentColor"/>
                            </svg>
                            <span x-text="showMoreColors ? 'Show Less' : '<?php echo count($colors) - 5; ?> Colours'" class="text-sm"></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</<?php echo $tag ?>>
