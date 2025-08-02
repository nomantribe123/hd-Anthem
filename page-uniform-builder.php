<?php
/* Template Name: Uniform Builder */
get_header();

the_content();

if (have_posts()) : while (have_posts()) : the_post();

    ?>

    <section class=py-12 lg:py-30">
        <div class="container">
            <div x-data="uniformBuilder()">

                <ul class="space-y-12 mb-12">

                    <li>

                        <div class=" flex flex-col lg:flex-row justify-between lg:items-center gap-2 lg:gap-6 rounded-t-lg p-6 lg:px-12 lg:py-8">

                            <div>

                                <p class="text-lg mb-2">Workwear Builder #1</p>
                                <div x-data="editableText()"
                                     data-text="Product Selection Name Goes Here"
                                     class="flex items-center gap-6">

                                    <template x-if="editing">
                                        <input type="text"
                                               x-model="text"
                                               @keydown.enter="stopEditing"
                                               @blur="stopEditing"
                                               autofocus
                                               class="text-2xl lg:text-3xl text-white font-black">
                                    </template>
                                    <template x-if="!editing">
                                    <span x-text="text"
                                          class="text-2xl lg:text-3xl text-white font-black break-all"></span>
                                    </template>
                                    <div class="flex items-center gap-4">

                                        <button x-show="!editing" @click="startEditing" class="hover:brightness-80">
                                            <svg class="min-w-6 w-6 h-6" viewBox="0 0 24 24"
                                                 fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 17.013L11.413 16.998L21.045 7.45802C21.423 7.08003 21.631 6.57802 21.631 6.04402C21.631 5.51002 21.423 5.00802 21.045 4.63002L19.459 3.04402C18.703 2.28802 17.384 2.29202 16.634 3.04102L7 12.583V17.013ZM18.045 4.45802L19.634 6.04102L18.037 7.62302L16.451 6.03802L18.045 4.45802ZM9 13.417L15.03 7.44402L16.616 9.03002L10.587 15.001L9 15.006V13.417Z"
                                                      fill="currentColor"/>
                                                <path d="M5 21H19C20.103 21 21 20.103 21 19V10.332L19 12.332V19H8.158C8.132 19 8.105 19.01 8.079 19.01C8.046 19.01 8.013 19.001 7.979 19H5V5H11.847L13.847 3H5C3.897 3 3 3.897 3 5V19C3 20.103 3.897 21 5 21Z"
                                                      fill="currentColor"/>
                                            </svg>
                                        </button>
                                        <button x-show="changed && !isEmpty" class="hover:brightness-80">
                                            <svg class="min-w-6 w-6 h-6" viewBox="0 0 24 24"
                                                 fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 21H19C19.5304 21 20.0391 20.7893 20.4142 20.4142C20.7893 20.0392 21 19.5305 21 19V8.00002C21.0008 7.86841 20.9755 7.73795 20.9258 7.61611C20.876 7.49427 20.8027 7.38346 20.71 7.29002L16.71 3.29002C16.6166 3.19734 16.5057 3.12401 16.3839 3.07425C16.2621 3.02448 16.1316 2.99926 16 3.00002H5C4.46957 3.00002 3.96086 3.21073 3.58579 3.5858C3.21071 3.96088 3 4.46958 3 5.00002V19C3 19.5305 3.21071 20.0392 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21ZM15 19H9V14H15V19ZM13 7.00002H11V5.00002H13V7.00002ZM5 5.00002H7V9.00002H15V5.00002H15.59L19 8.41002V19H17V14C17 13.4696 16.7893 12.9609 16.4142 12.5858C16.0391 12.2107 15.5304 12 15 12H9C8.46957 12 7.96086 12.2107 7.58579 12.5858C7.21071 12.9609 7 13.4696 7 14V19H5V5.00002Z"
                                                      fill="currentColor"/>
                                            </svg>
                                        </button>

                                    </div>

                                </div>

                            </div>
                            <button class="delete-product-selection min-w-fit flex items-center gap-1 hover:brightness-80">
                                <span class="text-white underline underline-offset-1 font-normal">Delete Product Selection</span>
                                <svg class="w-6 h-6 text-error" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V8H21V6H17V4C17 3.46957 16.7893 2.96086 16.4142 2.58579C16.0391 2.21071 15.5304 2 15 2H9C8.46957 2 7.96086 2.21071 7.58579 2.58579C7.21071 2.96086 7 3.46957 7 4V6H3V8H5V20ZM9 4H15V6H9V4ZM17 8V20H7V8H17Z"
                                          fill="currentColor"/>
                                    <path d="M9 10H11V18H9V10ZM13 10H15V18H13V10Z" fill="currentColor"/>
                                </svg>
                            </button>

                        </div>
                        <div class="bg-white rounded-b-lg p-4 lg:px-12 lg:pb-12">
                            <?php 
                            $workwear_items = get_workwear_builder_items();
                            
                            if (!empty($workwear_items)) : ?>
                                <ul class="workwear-builder-items space-y-8 lg:space-y-0 mb-8">
                                    <?php foreach ($workwear_items as $product_id) :
                                        $product = wc_get_product($product_id);
                                        if (!$product) continue;
                                        
                                        $product_image = wp_get_attachment_image_url($product->get_image_id(), 'thumbnail');
                                        $product_name = $product->get_name();
                                        $product_sku = $product->get_sku();
                                    ?>
                                <li class="flex flex-col lg:flex-row justify-between lg:items-center gap-8 lg:border-b border-[#91919133] rounded-sm lg:shadow-none! p-6 lg:px-0 lg:py-8"
                                    style="box-shadow: 0 1px 39.8px 0 #0000002E;">
                                    <div class="lg:w-3/5 xl:w-1/2 flex flex-col lg:flex-row justify-between lg:items-center gap-8">
                                        <div class="flex items-center gap-6 lg:gap-8">
                                                    <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_name); ?>"
                                                 class="min-w-22 w-22 h-25 object-contain object-center">
                                            <div class="grow">
                                                <div class="w-full flex justify-between items-start">
                                                            <p class="text-xs mb-4">#<?php echo esc_html($product_sku); ?></p>
                                                            <button class="block lg:hidden hover:brightness-80 remove-from-builder" data-product-id="<?php echo esc_attr($product_id); ?>">
                                                        <svg class="w-6 h-6 text-error" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.172 16.2421L12 13.4141L14.828 16.2421L16.242 14.8281L13.414 12.0001L16.242 9.17206L14.828 7.75806L12 10.5861L9.172 7.75806L7.758 9.17206L10.586 12.0001L7.758 14.8281L9.172 16.2421Z"
                                                                  fill="currentColor"/>
                                                            <path d="M12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22ZM12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4Z"
                                                                  fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                        <p class="text-lg font-semibold lg:mb-4"><?php echo esc_html($product_name); ?></p>
                                                        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="group hidden lg:flex items-center gap-2 w-fit">
                                                    <span class="text-sm">View Product Page</span>
                                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                              fill="currentColor"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="min-w-fit flex gap-6">
                                                    <?php 
                                                    // Get product attributes
                                                    $attributes = $product->get_attributes();
                                                    
                                                    if (!empty($attributes)) {
                                                        foreach ($attributes as $attribute) {
                                                            if (!$attribute->get_visible()) {
                                                                continue;
                                                            }

                                                            $attribute_name = $attribute->get_name();
                                                            $attribute_label = wc_attribute_label($attribute_name);
                                                            
                                                            // Only show size and color attributes
                                                            if (strpos(strtolower($attribute_name), 'size') === false && 
                                                                strpos(strtolower($attribute_name), 'colour') === false && 
                                                                strpos(strtolower($attribute_name), 'color') === false) {
                                                                continue;
                                                            }
                                                            
                                                            // Get terms if this is a taxonomy
                                                            if ($attribute->is_taxonomy()) {
                                                                $terms = wc_get_product_terms(
                                                                    $product_id,
                                                                    $attribute_name,
                                                                    array('fields' => 'all')
                                                                );
                                                            } else {
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
                                                                ?>
                                            <div class="grow">
                                                                    <label for="<?php echo esc_attr('product-' . $product_id . '-' . $attribute_name); ?>">
                                                                        <?php echo esc_html(sprintf('Choose %s:', $is_color_attribute ? 'Colour' : 'Size')); ?>
                                                                    </label>
                                                                    <select x-data="select()" 
                                                                            name="<?php echo esc_attr('product-' . $product_id . '-' . $attribute_name); ?>" 
                                                                            id="<?php echo esc_attr('product-' . $product_id . '-' . $attribute_name); ?>"
                                                                            <?php if ($is_color_attribute) echo 'data-style="color"'; ?>>
                                                                        <?php foreach ($terms as $term) : 
                                                                            $color_code = '';
                                                                            if ($is_color_attribute) {
                                                                                if ($term->term_id) {
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
                                                                            
                                                                            // Get stored attribute value
                                                                            $selected = '';
                                                                            if (isset($_SESSION['workwear_builder_attributes'][$product_id][$attribute_name]) 
                                                                                && $_SESSION['workwear_builder_attributes'][$product_id][$attribute_name] === $term->slug) {
                                                                                $selected = 'selected';
                                                                            }
                                                                            
                                                                            $custom_properties = $color_code ? sprintf('data-custom-properties=\'{ "color": "%s" }\'', esc_attr($color_code)) : '';
                                                                            ?>
                                                                            <option value="<?php echo esc_attr($term->slug); ?>"
                                                                                    <?php echo $custom_properties; ?>
                                                                                    <?php echo $selected; ?>>
                                                                                <?php echo esc_html($term->name); ?>
                                                    </option>
                                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                                            <?php endif;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row items-center gap-8">
                                                <?php 
                                                $pdf_url = get_post_meta($product_id, '_product_pdf_attachment', true);
                                                if ($pdf_url) : ?>
                                                    <a href="<?php echo esc_url($pdf_url); ?>"
                                           class="group w-full lg:w-fit h-11 flex justify-center items-center gap-2 bg-white/7 px-4 border border-[#31344A33] lg:border-transparent">
                                            <span>Download Individual PDF</span>
                                            <svg class="w-6 h-6" viewBox="0 0 24 24"
                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="-translate-y-1 group-hover:translate-y-0 duration-300"
                                                      d="M12 16L16 11H13V4H11V11H8L12 16Z"
                                                      fill="currentColor"/>
                                                <path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z"
                                                      fill="currentColor"/>
                                            </svg>
                                        </a>
                                                <?php endif; ?>
                                                <button class="hidden lg:block hover:brightness-80 remove-from-builder" data-product-id="<?php echo esc_attr($product_id); ?>">
                                            <svg class="w-6 h-6 text-error" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.172 16.2421L12 13.4141L14.828 16.2421L16.242 14.8281L13.414 12.0001L16.242 9.17206L14.828 7.75806L12 10.5861L9.172 7.75806L7.758 9.17206L10.586 12.0001L7.758 14.8281L9.172 16.2421Z"
                                                      fill="currentColor"/>
                                                <path d="M12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22ZM12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4Z"
                                                      fill="currentColor"/>
                                            </svg>
                                        </button>
                                                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="group flex lg:hidden items-center gap-2 w-fit">
                                            <span class="text-sm">View Product Page</span>
                                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                              fill="currentColor"/>
                                                    </svg>
                                                </a>
                                            </div>
                                </li>
                                    <?php endforeach; ?>
                                </ul>

                            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4">
                                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('shop'))); ?>"
                                        class="group w-full lg:w-fit h-12 flex justify-center items-center gap-3 bg-white px-4 lg:px-20 btn hover:brightness-80"
                                        style="box-shadow: 38px 11px 60.4px 0 #00000014;">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 7H11V11H7V13H11V17H13V13H17V11H13V7Z" fill="currentColor"/>
                                        <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                              fill="currentColor"/>
                                    </svg>
                                    <span class="text-black">Add More Products</span>
                                    </a>

                                <a href="#"
                                   class="group w-full lg:w-fit h-12 flex justify-between lg:justify-center items-center gap-4 lg:gap-9 bg-[#31344A05] px-4 border border-[#31344A80]">
                                    <span>Download Product Selection PDF</span>
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
                            <?php else : ?>
                                <p class="text-center text-2xl lg:text-3xl font-black mb-8 mt-8">Product Selection is Empty</p>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('shop'))); ?>" 
                                    class="group w-full lg:w-fit h-12 flex justify-center items-center gap-3 bg-white px-4 lg:px-20 btn mx-auto hover:brightness-80"
                                    style="box-shadow: 38px 11px 60.4px 0 #00000014;">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7H11V11H7V13H11V17H13V13H17V11H13V7Z" fill="currentColor"/>
                                    <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                          fill="currentColor"/>
                                </svg>
                                <span class="text-black">Add Products</span>
                                </a>
                            <?php endif; ?>
                        </div>

                    </li>

                </ul>
                <button
                        class="group w-full lg:w-2/5 h-12 flex justify-center items-center gap-3 bg-white px-4 btn hover:brightness-80 mx-auto"
                        style="box-shadow: 0 11px 55px 0 #0000000D;">

                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 7H11V11H7V13H11V17H13V13H17V11H13V7Z" fill="currentColor"/>
                        <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                              fill="currentColor"/>
                    </svg>
                    <span class="text-black">Add Product Selection</span>

                </button>

            </div>
        </div>
    </section>

    <?php
    // Render PDF Viewer widget
    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        
        if ($elementor->frontend) {
            $pdf_view_template_content = $elementor->frontend->get_builder_content(967, true);
            
            if ($pdf_view_template_content) {
                echo '<div class="workwear-cta-section">';
                echo $pdf_view_template_content;
                echo '</div>';
            }
        }
    }

    // Render the CTA widget
    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        
        if ($elementor->frontend) {
            // Get the template content for Workwear CTA
            $cta_template_content = $elementor->frontend->get_builder_content(982, true);
            
            if ($cta_template_content) {
                echo '<div class="workwear-cta-section">';
                echo $cta_template_content;
                echo '</div>';
            }
        }
    }

endwhile; endif;

// Add notification container
?>

<?php get_footer(); ?>