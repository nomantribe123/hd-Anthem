<?php

class Product_Quality_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'product_quality';
    }

    public function get_title() {
        return esc_html__('Product Quality', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-product-info';
    }

    public function get_categories() {
        return ['tribes'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ethical, Sustainable Workwear Solutions.',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Product Offering and Quality',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Our Ethical Statement',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        // Features Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__('Feature Icon', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'feature_title',
            [
                'label' => esc_html__('Feature Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Premium Materials',
            ]
        );

        $repeater->add_control(
            'feature_description',
            [
                'label' => esc_html__('Feature Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Crafted from top-tier fabrics for durability and long-lasting quality.',
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'feature_title' => 'Premium Materials',
                        'feature_description' => 'Crafted from top-tier fabrics for durability and long-lasting quality.',
                    ],
                    [
                        'feature_title' => 'Compliance & Safety',
                        'feature_description' => 'Products meet industry safety standards, ensuring protection and reliability.',
                    ],
                    [
                        'feature_title' => 'Comfort & Fit',
                        'feature_description' => 'Workwear that enhances team identity with a polished look and all-day comfort.',
                    ],
                    [
                        'feature_title' => 'Custom Branding',
                        'feature_description' => 'Personalised workwear with your logo and design for a professional look.',
                    ],
                ],
                'title_field' => '{{{ feature_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=" py-12 lg:py-30">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-12 xl:gap-20">
                    <div class="col-span-1">
                        <div class="mb-8 lg:mb-20">
                            <h4 class="text-sm sm:text-base mg:text-lg lg:text-xl font-bold font-din-next-stencil mb-4"><?php echo esc_html($settings['subtitle']); ?></h4>
                            <h3 class="text-3xl text-white font-black mb-6"><?php echo esc_html($settings['title']); ?></h3>
                            <p class="text-white"><?php echo esc_html($settings['description']); ?></p>
                        </div>
                        <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                           class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-white/12 backdrop-blur-2xl px-6 btn">
                            <span class="text-white"><?php echo esc_html($settings['button_text']); ?></span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                      fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col-span-1 lg:col-span-2">
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-x-6 lg:gap-y-20">
                            <?php foreach ($settings['features'] as $feature): ?>
                                <li class="flex items-center gap-4">
                                    <?php if ($feature['feature_icon']['url']): ?>
                                        <img src="<?php echo esc_url($feature['feature_icon']['url']); ?>" alt="<?php echo esc_attr($feature['feature_title']); ?>"
                                             class="w-17 h-17 object-contain object-center">
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="text-xl text-white font-black font-industry-text mb-2"><?php echo esc_html($feature['feature_title']); ?></h6>
                                        <p class="text-white"><?php echo esc_html($feature['feature_description']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 