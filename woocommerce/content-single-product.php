<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Get the product slug from the URL
// $product_slug = get_query_var('product');
// if (empty($product_slug)) {
//     $product_slug = basename(get_permalink());
// }

$product_slug = $product->get_slug();
$product_id = $product->get_id();

// Get product by slug
// $product_id = wc_get_product_id_by_sku($product_slug);
// if (!$product_id) {
//     $product_obj = get_page_by_path($product_slug, OBJECT, 'product');
//     $product_id = $product_obj ? $product_obj->ID : 0;
// }

// Get the product using the found ID
// $product = wc_get_product($product_id);

// Ensure we have a valid product
if (!$product || !is_a($product, 'WC_Product')) {
    return;
}

/**
 * Hook: woocommerce_before_single_product.
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

// Get product data - don't overwrite the product_id we found earlier
$product_name = $product->get_name();
$product_sku = $product->get_sku();
$product_short_description = $product->get_short_description();
$product_description = $product->get_description();
$gallery_image_ids = $product->get_gallery_image_ids();
$featured_image_id = $product->get_image_id();
$featured_image_url = wp_get_attachment_image_url($featured_image_id, 'full');

// Get certifications and specifications from ACF if available
$certifications = get_post_meta($product_id, '_product_certifications', true);
$fabric_content = get_post_meta($product_id, '_product_fabric_content', true);
$fabric_weight = get_post_meta($product_id, '_product_fabric_weight', true);
$care_instructions = get_post_meta($product_id, '_product_care_instructions', true);

$size_guide_pdf = get_post_meta($product_id, '_size_guide_pdf', true);
$care_instructions_pdf = get_post_meta($product_id, '_care_instructions_pdf', true);

// Get additional specifications from product meta
$breathable = get_post_meta($product_id, '_product_breathable', true);
$material = get_post_meta($product_id, '_product_material', true);

$where_to_buy_link = get_field('where_to_buy_page', 'where_to_buy');

// Get product features from taxonomy
$key_features = wp_get_object_terms($product_id, 'product_feature', array('fields' => 'names'));

$norty_assets = get_post_meta($product_id, '_norty_assets', true);

$attributes = $product->get_attributes();
$colors = [];

foreach ($attributes as $attribute) {
    if ($attribute->get_name() === 'pa_color' || strpos(strtolower($attribute->get_name()), 'color') !== false || strpos(strtolower($attribute->get_name()), 'colour') !== false) {
        if ($attribute->is_taxonomy()) {
            $terms = $attribute->get_terms();
            foreach ($terms as $term) {
                $hex = get_term_meta($term->term_id, 'product_attribute_color', true);
                $colors[] = $term->name . "|" . $hex . "|" . $term->slug;
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

$colors = array_filter(array_unique($colors));

?>

<section class=py-6 lg:py-12">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <?php get_template_part('template-parts/single/gallery', 'product'); ?>

            <div class="product-aside">
                <div class="hidden lg:block mb-12">
                    <?php 
                    global $post, $product;
                    $temp_post = $post;
                    $temp_product = $product;
                    $post = get_post($product_id);
                    $product = wc_get_product($product_id);
                    
                    // Customize breadcrumb
                    add_filter('woocommerce_breadcrumb_defaults', function($defaults) {
                        $defaults['delimiter'] = ' - ';
                        $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">';
                        $defaults['wrap_after'] = '</nav>';
                        return $defaults;
                    });

                    // Add custom classes to last breadcrumb item
                    add_filter('woocommerce_breadcrumb_defaults', function($defaults) use ($product) {
                        $defaults['before'] = '';
                        $defaults['after'] = '';
                        return $defaults;
                    }, 20);

                    add_filter('woocommerce_get_breadcrumb', function($crumbs) {
                        if (!empty($crumbs)) {
                            $last_index = count($crumbs) - 1;
                            $crumbs[$last_index][0] = $crumbs[$last_index][0];
                            $crumbs[$last_index][1] = '';  // Remove link from last item
                        }
                        return $crumbs;
                    }, 20);

                    ob_start();
                    woocommerce_breadcrumb();
                    $breadcrumb = ob_get_clean();
                    
                    // Replace the last item with styled version
                    $product_name = $product->get_name();
                    $styled_name = '<span class="underline underline-offset-1 hover:brightness-80">' . $product_name . '</span>';
                    echo str_replace($product_name, $styled_name, $breadcrumb);
                    
                    // Restore the global post and product
                    $post = $temp_post;
                    $product = $temp_product;
                    ?>
                </div>
                <div class="mb-6 lg:mb-12">
                    <?php if ($product_sku) : ?>
                        <p class="mb-4">Product Code: <span class="font-semibold"><?php echo esc_html($product_sku); ?></span></p>
                    <?php endif; ?>
                    <h1 class="text-5xl font-black mb-4"><?php echo esc_html($product_name); ?></h1>
                </div>

                <div x-data="{ showMoreColors: false }" class="flex flex-wrap items-center gap-2">
                    <?php 
                    $displayed_colors = array_slice($colors, 0, 7);
                    foreach ($displayed_colors as $color) : 
                        echo get_color_swatch_html($color, "large");
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
                            $remaining_colors = array_slice($colors, 7);
                            foreach ($remaining_colors as $color) :
                                echo get_color_swatch_html($color, "large");
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

                <form id="product-attributes" class="product-attributes grid grid-cols-5 gap-6 mb-6 lg:mb-12">
                    <div class="col-span-5 xl:col-span-2">
                        <div class="h-full flex flex-col lg:flex-row items-stretch lg:items-start gap-6">
                            <?php 
                            // Get attributes using the correct product ID
                            $product_instance = wc_get_product($product_id);
                            $attributes = $product_instance->get_attributes();
                            $size_range = null;
                            
                            // Sort attributes to ensure consistent order
                            if (!empty($attributes)) {
                                foreach ($attributes as $attribute) :
                                    // Only show visible attributes
                                    if (!$attribute->get_visible()) {
                                        continue;
                                    }

                                    $attribute_name = $attribute->get_name();
                                    $attribute_label = wc_attribute_label($attribute_name);
                                    
                                    // Get terms if this is a taxonomy
                                    if ($attribute->is_taxonomy()) {
                                        $terms = wc_get_product_terms(
                                            $product_id,
                                            $attribute_name,
                                            array('fields' => 'all')
                                        );
                                    } else {
                                        // Convert custom attribute values to terms-like array
                                        $options = $attribute->get_options();
                                        $terms = array_map(function($option) {
                                            return (object) array(
                                                'name' => $option,
                                                'slug' => sanitize_title($option),
                                                'term_id' => 0
                                            );
                                        }, $options);
                                    }

                                    if (!empty($terms)) :
                                        $is_color_attribute = (
                                            strpos(strtolower($attribute_name), 'color') !== false || 
                                            strpos(strtolower($attribute_name), 'colour') !== false
                                        );

                                        // If is size attribute
                                        if (strpos(strtolower($attribute_name), 'size') !== false) {
                                            $first_size = $terms[0];
                                            $last_size = $terms[array_key_last($terms)];

                                            $first_size_val = $first_size->name;
                                            $last_size_val = $last_size->name;

                                            $size_range = $first_size_val . " - " . $last_size_val;
                                        }
                                        ?>
                                        <div class="grow <?php echo esc_attr('attr-' . $attribute_name); ?>">
                                            <label for="<?php echo esc_attr('product-' . $attribute_name); ?>">
                                                <?php echo esc_html(sprintf('Choose %s:', $attribute_label)); ?>
                                            </label>
                                            <select x-data="select()" 
                                                    x-init="init()"
                                                    name="<?php echo esc_attr('product-' . $attribute_name); ?>" 
                                                    id="<?php echo esc_attr('product-' . $attribute_name); ?>"
                                                    data-color-select 
                                                    <?php if ($is_color_attribute) echo 'data-style="color"'; ?>
                                                    <?php if ($is_color_attribute) echo ' data-color-slide-map=\'' . json_encode($color_to_slide_index) . '\''; ?>>
                                                <?php foreach ($terms as $term) : 
                                                    $color_code = '';
                                                    if ($is_color_attribute) {
                                                        if ($term->term_id) {
                                                            // For taxonomy-based attributes
                                                            $color_code = get_term_meta($term->term_id, 'product_attribute_color', true);
                                                        } else {
                                                            $color_value = $term->name;
                                                            if (strpos($color_value, '#') === 0) {
                                                                $color_code = $color_value;
                                                            } else {
                                                                $color_code = strtolower($color_value);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <option value="<?php echo esc_attr($term->slug); ?>"
                                                            <?php if ($color_code) echo 'data-custom-properties=\'{ "color": "' . esc_attr($color_code) . '" }\''; ?>
                                                            <?php if ($is_color_attribute && isset($color_to_slide_index[$term->slug])) echo ' data-slide-index="' . esc_attr($color_to_slide_index[$term->slug]) . '"'; ?>>
                                                        <?php echo esc_html($term->name); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                    <?php endif;
                                endforeach;
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-span-5 xl:col-span-3">
                        <div class="h-full flex flex-col justify-center">
                            <?php 
                            $pdf_url = get_post_meta($product_id, '_product_pdf_attachment', true);
                            if ($pdf_url) : ?>
                                <div class="">
                                    <a href="<?php echo esc_url($pdf_url); ?>"
                                       class="group w-full h-11 flex justify-between items-center bg-[#E1E2E3] border border-[#31344A33] px-4"
                                       target="_blank">
                                        <span>Download PDF Version</span>
                                        <svg class="w-6 h-6" viewBox="0 0 24 24"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="-translate-y-1 group-hover:translate-y-0 duration-300"
                                                  d="M12 16L16 11H13V4H11V11H8L12 16Z"
                                                  fill="currentColor"/>
                                            <path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z"
                                                  fill="currentColor"/>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>

                <?php 
                
                if ($where_to_buy_link) : ?>
                    <a href="<?php echo esc_url($where_to_buy_link); ?>"
                       class="where-to-buy btn justify-center dark bg-black text-white w-full h-[61px] mt-8">
                        <span>Where to Buy</span>
                        <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/right-arrow-alt.svg' ); ?>
                    </a>
                <?php endif; ?>

                <div class="mt-[27px] flex flex-col gap-y-5">
                    <?php if ($product_short_description) : ?>
                        <div>
                            <p class="font-bold text-lg mb-2">
                                Description
                            </p>
                            <div>
                                <?php echo wp_kses_post($product_short_description); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($fabric_weight || $size_range) : ?>
                        <div class="flex flex-wrap gap-6">
                            <div class="text-lg font-bold">Oversized Fit</div>

                            <?php if ($size_range) : ?>
                                <div class="text-lg font-bold">Sizes : <span class="font-normal"><?php echo $size_range; ?></span></div>
                            <?php endif; ?>

                            <?php if ($fabric_weight) : ?>
                                <div class="text-lg font-bold">Weight : <span class="font-normal"><?php echo esc_html($fabric_weight); ?></span></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($fabric_content) : ?>
                        <div>
                            <p class="font-bold mb-2">
                                Fabric
                            </p>
                            <div class="leading-[150%]">
                                <?php echo esc_html($fabric_content); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-wrap gap-10 fabric-icon-list">
                        <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-1.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-2.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-3.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-4.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-5.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                    </div>

                    <?php
                    $care_instructions = get_product_care_instructions($product_id);
                    if ($care_instructions['text'] || $care_instructions['icons']) : ?>
                        <div>
                            <p class="font-bold mb-2">
                                Care Instructions
                            </p>

                            <?php if ($care_instructions['text']) : ?>
                                <?php echo wp_kses_post($care_instructions['text']); ?>
                            <?php endif; ?>

                            <?php if ($care_instructions['icons']) : ?>
                                <ul class="mt-4 care-icons-list">
                                    <?php foreach ($care_instructions['icons'] as $icon) : ?>
                                        <?php 
                                        if (isset($icon['icon']) && is_array($icon['icon'])) {
                                            $icon_url = $icon['icon']['url'] ?? '';
                                            $icon_alt = $icon['icon']['alt'] ?? $icon['icon_name'] ?? '';
                                            if ($icon_url) {
                                                echo '<li>';
                                                echo '<img src="' . esc_url($icon_url) . '" 
                                                        alt="' . esc_attr($icon_alt) . '">';
                                                echo '</li>';
                                            }
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($size_guide_pdf || $care_instructions_pdf) : ?>
                        <div class="mb-6 lg:mb-8">
                            <?php if ($size_guide_pdf) : ?>
                                <a href="<?php echo esc_url($size_guide_pdf); ?>"
                                class="bg-gray-xlight border-gray-light border btn justify-center mb-4 rounded-full w-full"
                                target="_blank">
                                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/download.svg' ); ?>
                                    <span>
                                        Size Chart Download
                                    </span>
                                </a>
                            <?php endif;

                            if ($care_instructions_pdf) : ?>
                                <a href="<?php echo esc_url($care_instructions_pdf); ?>"
                                class="bg-gray-xlight border-gray-light border btn justify-center mb-4 rounded-full w-full"
                                target="_blank">
                                    <span>Care Instructions Download</span>
                                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/right-arrow-alt.svg' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif ?>
                </div>

                <?php if ($certifications || $breathable || $material) : ?>
                    <div class="mb-6 lg:mb-12">
                        <?php if ($certifications) : ?>
                            <p class="mb-8">Certifications: <?php echo wp_kses_post($certifications); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($breathable || $material) : ?>
                            <ul class="mb-8">
                                <?php if ($breathable) : ?>
                                    <li>Breathable: <?php echo esc_html(ucfirst($breathable)); ?></li>
                                <?php endif; ?>
                                <?php if ($material) : ?>
                                    <li>Material: <?php echo esc_html($material); ?></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!is_wp_error($key_features) && !empty($key_features)) : ?>
                            <div class="">
                                <p class="mb-4">Key Features:</p>
                                <ul class="grid gris-cols-1 lg:grid-cols-2 gap-6 lg:gap-x-12 items-start">
                                    <?php foreach ($key_features as $feature) : ?>
                                        <li class="flex flex-row items-start gap-2">
                                            <svg class="w-6 h-6 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z" fill="currentColor"/>
                                                <path d="M9.99902 13.587L7.70002 11.292L6.28802 12.708L10.001 16.413L16.707 9.70703L15.293 8.29303L9.99902 13.587Z" fill="currentColor"/>
                                            </svg>
                                            <span><?php echo esc_html($feature); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($norty_assets) : ?>
                    <div class="mb-6 lg:mb-8">
                        <p class="mb-4">Norty Assets:</p>
                         <a href="<?php echo esc_url($size_guide_pdf); ?>"
                            class="group w-full h-11 flex justify-between items-center bg-[#E1E2E3] border border-[#31344A33] px-4 mb-4"
                            target="_blank">
                            <span>Link to Norty Website Assets (for garment decorators)</span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>

<?php do_action('woocommerce_after_single_product'); ?>