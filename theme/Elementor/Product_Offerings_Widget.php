<?php

class Product_Offerings_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'product_offerings';
    }

    public function get_title() {
        return esc_html__('Product Offerings', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return ['tribes'];
    }

    public function get_script_depends() {
        return ['swiper', 'tribes-prortx-products'];
    }

    public function get_style_depends() {
        return ['swiper'];
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        // wp_register_script(
        //     'tribes-prortx-products',
        //     get_stylesheet_directory_uri() . '/assets/js/modules/swiperInit.js',
        //     ['elementor-frontend', 'swiper'],
        //     '1.0.0',
        //     true
        // );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Our Product Offerings', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Our Workwear', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'selected_products',
            [
                'label' => esc_html__('Select Products', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_products_for_select2(),
                'multiple' => true,
                'label_block' => true,
                'description' => esc_html__('Search and select products to display. Leave empty to show 20 random products.', 'tribes-prortx'),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Helper to get products for select2 control
     */
    private function get_products_for_select2() {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 100,
            'post_status' => 'publish',
            'fields' => 'ids',
        );
        $products = get_posts($args);
        $options = array();
        foreach ($products as $product_id) {
            $product = wc_get_product($product_id);
            if ($product) {
                $options[$product_id] = $product->get_name() . ' (#' . $product->get_sku() . ')';
            }
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <style>
            .elementor-editor-active [data-swiper="products"] .swiper-slide {
                width: calc((100% - 96px) / 4) !important;
                margin-right: 32px !important;
            }
            @media (max-width: 1279px) {
                .elementor-editor-active [data-swiper="products"] .swiper-slide {
                    width: calc((100% - 64px) / 3) !important;
                }
            }
            @media (max-width: 1023px) {
                .elementor-editor-active [data-swiper="products"] .swiper-slide {
                    width: calc((100% - 32px) / 2) !important;
                }
            }
            @media (max-width: 767px) {
                .elementor-editor-active [data-swiper="products"] .swiper-slide {
                    width: calc((100% - 32px) / 1.75) !important;
                }
            }
            @media (max-width: 639px) {
                .elementor-editor-active [data-swiper="products"] .swiper-slide {
                    width: calc((100% - 32px) / 1.3) !important;
                }
            }
        </style>
        <section class="prod-offerings-widget">
            <div class="container lg:px-12">
                <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-start gap-8 mb-8">
                    <div>
                        <h3 class="text-3xl font-black mb-2"><?php echo esc_html($settings['title']); ?></h3>
                        <p><?php echo esc_html($settings['subtitle']); ?></p>
                    </div>
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                       class="group w-full sm:w-fit h-11 flex justify-center items-center gap-3 backdrop-blur-2xl px-6 btn">
                        <span class="text-black"><?php echo esc_html($settings['button_text']); ?></span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24"
                             fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>
                </div>

                <div>
                    <div data-swiper="products" class="swiper">
                        <div class="swiper-wrapper mb-8">

                            <!--
                            NOTE FOR BACKEND DEVELOPER:

                            To make the product modal work properly,please inject the product data into the `data-product` attribute as a JSON string.
                            Make sure to encode it safely for HTML by using this PHP snippet:
                            <?php //echo htmlspecialchars(json_encode($product_data), ENT_QUOTES, 'UTF-8') ?>

                            The expected structure of the product data is:
                            {
                                name: string,
                                number: string,
                                description: string,
                                pdf_link: string,
                                images: string[],             // array of image URLs
                                sizes: string[],              // array of available sizes
                                colours: [{"id": 1, "label": "Red", "value": "#ff0000"}, {"id": 2, "label": "Green", "value": "#00ff00"}, {"id": 3, "label": "Blue", "value": "#0000ff"}],            // array of HEX color values
                                link: string,                 // URL to product detail page
                                where_to_buy: string,         // URL to purchase info page
                                features: [                   // array of feature objects
                                    { FeatureName: Value },
                                    ...
                                ]
                            }

                            ⚠️ If your field names are different from the structure above,
                            please also update the corresponding bindings in the modal template.
                            For example, if the field is called `title` instead of `name`,
                            you should replace `x-text="product.name"` with `x-text="product.title"`.
                            -->
                            <?php
                                // Product selection logic
                                $selected_products = !empty($settings['selected_products']) ? array_filter((array)$settings['selected_products']) : [];
                                if (!empty($selected_products)) {
                                    $args = array(
                                        'post_type' => 'product',
                                        'post__in' => $selected_products,
                                        'orderby' => 'post__in',
                                        'posts_per_page' => count($selected_products)
                                    );
                                } else {
                                    $args = array(
                                        'post_type' => 'product',
                                        'posts_per_page' => 20,
                                        'orderby' => 'rand'
                                    );
                                }
                                $loop = new WP_Query($args);

                                if ($loop->have_posts()) :
                                    while ($loop->have_posts()) : $loop->the_post();

                                        global $product;

                                        // Get product data
                                        $product_id = $product->get_id();
                                        $name = $product->get_name();
                                        $number = $product->get_sku() ?: $product_id;
                                        $description = wp_strip_all_tags($product->get_short_description());
                                        $image_url = wp_get_attachment_image_url($product->get_image_id(), 'large');
                                        $product_link = get_permalink($product_id);
                                        $gallery_image_ids = $product->get_gallery_image_ids();
                                        $images = [$image_url];
                                        foreach ($gallery_image_ids as $img_id) {
                                            $images[] = wp_get_attachment_image_url($img_id, 'large');
                                        }

                                        // Get product attributes for sizes and colors
                                        $attributes = $product->get_attributes();
                                        $sizes = array();
                                        $colors = array();

                                        foreach ($attributes as $attribute) {
                                            $attribute_name = $attribute->get_name();
                                            
                                            // Handle size attributes
                                            if ($attribute_name === 'pa_size' || strpos(strtolower($attribute_name), 'size') !== false) {
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
                                            
                                            // Handle color attributes
                                            if ($attribute_name === 'pa_color' || strpos(strtolower($attribute_name), 'color') !== false || 
                                                strpos(strtolower($attribute_name), 'colour') !== false) {
                                                if ($attribute->is_taxonomy()) {
                                                    $terms = $attribute->get_terms();
                                                    foreach ($terms as $term) {
                                                        $color_code = get_term_meta($term->term_id, 'product_attribute_color', true);
                                                        $colors[] = array(
                                                            'id' => $term->term_id,
                                                            'label' => $term->name,
                                                            'value' => $color_code ?: $term->name
                                                        );
                                                    }
                                                } else {
                                                    $option_string = $attribute->get_options();
                                                    if (is_array($option_string)) {
                                                        foreach ($option_string as $color) {
                                                            $colors[] = array(
                                                                'id' => sanitize_title($color),
                                                                'label' => $color,
                                                                'value' => strpos($color, '#') === 0 ? $color : $color
                                                            );
                                                        }
                                                    } else if (is_string($option_string)) {
                                                        $colors[] = array(
                                                            'id' => sanitize_title($option_string),
                                                            'label' => $option_string,
                                                            'value' => strpos($option_string, '#') === 0 ? $option_string : $option_string
                                                        );
                                                    }
                                                }
                                            }
                                        }

                                        // Check variations if it's a variable product
                                        if ($product->is_type('variable')) {
                                            $variations = $product->get_available_variations();
                                            foreach ($variations as $variation) {
                                                foreach ($variation['attributes'] as $key => $value) {
                                                    if (strpos(strtolower($key), 'size') !== false) {
                                                        $sizes[] = $value;
                                                    }
                                                    if (strpos(strtolower($key), 'color') !== false || 
                                                        strpos(strtolower($key), 'colour') !== false) {
                                                        $colors[] = array(
                                                            'id' => sanitize_title($value),
                                                            'label' => $value,
                                                            'value' => strpos($value, '#') === 0 ? $value : $value
                                                        );
                                                    }
                                                }
                                            }
                                        }

                                        // Remove duplicates
                                        $sizes = array_unique($sizes);
                                        $colors = array_unique(array_map('serialize', $colors));
                                        $colors = array_map('unserialize', $colors);

                                        // Product data JSON for modal
                                        $product_data = [
                                            'name' => $name,
                                            'number' => $number,
                                            'description' => $description,
                                            'images' => $images,
                                            'sizes' => array_values($sizes),
                                            'colours' => array_values($colors),
                                            'link' => $product_link,
                                            'where_to_buy' => get_field('where_to_buy', $product_id),
                                            'features' => get_post_meta($product_id, '_product_features', true) ?: [],
                                            'pdf_link' => get_post_meta($product_id, '_product_pdf_attachment', true)
                                        ];
                                        ?>

                                        <div class="swiper-slide h-auto!">
                                            <?php get_template_part('template-parts/product/post', null, [
                                                'product_data' => $product_data,
                                                'tag' => 'div',
                                            ]); ?>                                            
                                        </div>

                                    <?php endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                        </div>
                        <div data-swiper-pagination class="test-me w-fit! flex items-center gap-2"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}