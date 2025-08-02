<?php

class WorkwearBuilder_section extends \Elementor\Widget_Base {

    public function get_name() {
        return 'workwear_builder_section';
    }

    public function get_title() {
        return 'Workwear Builder Section';
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['pro-rtx'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content Settings', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Build Your Custom Workwear.', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Try Our Workwear Builder', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'builder_button_text',
            [
                'label' => esc_html__('Builder Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Workwear Builder Page', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'builder_button_link',
            [
                'label' => esc_html__('Builder Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tribes-prortx'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'view_all_button_text',
            [
                'label' => esc_html__('View All Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Our Workwear', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'view_all_button_link',
            [
                'label' => esc_html__('View All Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tribes-prortx'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Add new section for product selection
        $this->start_controls_section(
            'products_section',
            [
                'label' => esc_html__('Product Selection', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'product_id',
            [
                'label' => esc_html__('Select Product', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_products_list(),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'selected_products',
            [
                'label' => esc_html__('Selected Products', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ product_id }}}',
            ]
        );

        $this->end_controls_section();
    }

    private function get_products_list() {
        $products = wc_get_products(['limit' => -1]);
        $product_list = [];
        
        foreach ($products as $product) {
            $product_list[$product->get_id()] = $product->get_name();
        }
        
        return $product_list;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $background_image = $settings['background_image']['url'];
        ?>
        <section class="lg:py-12"
                 style="background-image: linear-gradient(56.43deg, #31344A -10%, rgba(49, 52, 74, 0) 73.36%), url('<?php echo esc_url($background_image); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="lg:container">
                <div class="flex flex-col lg:flex-row justify-between lg:gap-8">
                    <div class="lg:bg-none!"
                         style="background-image: linear-gradient(56.43deg, #31344A -10%, rgba(49, 52, 74, 0) 73.36%), url('<?php echo esc_url($background_image); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <div class="h-full flex flex-col justify-end pt-75 lg:pt-12 pb-10 lg:pb-25 px-4 lg:px-0">
                            <h4 class="text-2xl font-bold font-din-next-stencil mb-4"><?php echo esc_html($settings['heading_subtitle']); ?></h4>
                            <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-black mb-6"><?php echo esc_html($settings['heading_title']); ?></h3>
                            <a href="<?php echo esc_url($settings['builder_button_link']['url']); ?>"
                               class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-white/12 backdrop-blur-2xl px-6 btn">
                                <span class="text-white"><?php echo esc_html($settings['builder_button_text']); ?></span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                     viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                          fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-110">
                        <div class="bg-white border-b-8  p-4 lg:p-6">
                            <?php
                            if (!empty($settings['selected_products'])) : ?>
                                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-x-6 gap-y-8 mb-6">
                                    <?php foreach ($settings['selected_products'] as $item) :
                                        $product = wc_get_product($item['product_id']);
                                        if (!$product) continue;
                                        
                                        $product_id = $product->get_id();
                                        $product_number = $product->get_sku();
                                        
                                        // Get available sizes from product attributes
                                        $available_sizes = '';
                                        $size_attribute = $product->get_attribute('pa_size');
                                        if (!empty($size_attribute)) {
                                            $available_sizes = $size_attribute;
                                        }
                                        
                                        // Get colors from product attributes
                                        $colors = array();
                                        $attributes = $product->get_attributes();
                                        foreach ($attributes as $attribute) {
                                            if (strpos(strtolower($attribute->get_name()), 'color') !== false || 
                                                strpos(strtolower($attribute->get_name()), 'colour') !== false) {
                                                if ($attribute->is_taxonomy()) {
                                                    $terms = $attribute->get_terms();
                                                    foreach ($terms as $term) {
                                                        $colors[] = $term->name;
                                                    }
                                                } else {
                                                    $option_string = $attribute->get_options();
                                                    if (is_array($option_string)) {
                                                        $colors = array_merge($colors, $option_string);
                                                    } else if (is_string($option_string)) {
                                                        $colors[] = $option_string;
                                                    }
                                                }
                                            }
                                        }
                                        
                                        // Check variations if it's a variable product
                                        if ($product->is_type('variable')) {
                                            $variations = $product->get_available_variations();
                                            foreach ($variations as $variation) {
                                                foreach ($variation['attributes'] as $key => $value) {
                                                    if (strpos(strtolower($key), 'color') !== false || 
                                                        strpos(strtolower($key), 'colour') !== false) {
                                                        $colors[] = $value;
                                                    }
                                                }
                                            }
                                        }
                                        
                                        // Remove duplicates
                                        $colors = array_unique($colors);
                                        ?>
                                        <li class="flex items-center gap-4">
                                            <?php echo $product->get_image('thumbnail'); ?>
                                            <div>
                                                <div class="mb-2">
                                                    <p class="text-xs mb-2">#<?php echo esc_html($product_number); ?></p>
                                                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="font-black uppercase hover:brightness-80"><?php echo esc_html($product->get_name()); ?></a>
                                                </div>
                                                <div>
                                                    <?php if (!empty($available_sizes)) : ?>
                                                        <p class="text-sm mb-2">Available Sizes: <?php echo esc_html($available_sizes); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (!empty($colors)) : ?>
                                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                                            <p class="text-sm">Colours:</p>
                                                            <ul class="flex items-center gap-1">
                                                                <?php 
                                                                $displayed_colors = array_slice($colors, 0, 5);
                                                                foreach ($displayed_colors as $color) : ?>
                                                                    <li class="w-3 h-3 border "
                                                                        style="background-color: <?php echo esc_attr($color); ?>;"></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <?php if (count($colors) > 5) : ?>
                                                                <div class="flex items-center gap-1 bg-[#2B2B2B] rounded-full px-2">
                                                                    <svg class="w-2.5 h-2.5 text-white" viewBox="0 0 11 11" fill="none"
                                                                         xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6.05 2.75H4.95V4.95H2.75V6.05H4.95V8.25H6.05V6.05H8.25V4.95H6.05V2.75Z"
                                                                              fill="currentColor"/>
                                                                        <path d="M5.5 0C2.4673 0 0 2.4673 0 5.5C0 8.5327 2.4673 11 5.5 11C8.5327 11 11 8.5327 11 5.5C11 2.4673 8.5327 0 5.5 0ZM5.5 9.9C3.07395 9.9 1.1 7.92605 1.1 5.5C1.1 3.07395 3.07395 1.1 5.5 1.1C7.92605 1.1 9.9 3.07395 9.9 5.5C9.9 7.92605 7.92605 9.9 5.5 9.9Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                    <p class="text-xs text-white"><?php echo count($colors) - 5; ?> More Colours</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="group w-fit flex items-center gap-2">
                                                        <span class="text-sm">View Product</span>
                                                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                             viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                  fill="currentColor"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($settings['view_all_button_link']['url']); ?>"
                               class="group w-fit h-11 flex justify-center items-center gap-3 bg-[#31344A17] backdrop-blur-2xl px-6 btn mx-auto">
                                <span class="text-black"><?php echo esc_html($settings['view_all_button_text']); ?></span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                     viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                          fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 