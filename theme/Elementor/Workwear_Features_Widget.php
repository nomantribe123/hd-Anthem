<?php

class Workwear_Features_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'workwear_features';
    }

    public function get_title() {
        return esc_html__('Workwear Features', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-features';
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
                'default' => 'Workwear That Works as Hard as You Do',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Durable, custom-branded workwear for comfort and performance.',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Explore Pro RTX offers high-quality, custom workwear that combines durability, comfort, and style. Tailored to meet the needs of your business, our workwear ensures your team looks professional and feels comfortable, no matter the task.',
            ]
        );

        // Features Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Feature Icon', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Feature Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Quality & Durability',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Feature Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Expertly crafted workwear designed to withstand the demands of any industry while maintaining comfort and style.',
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
                        'title' => 'Quality & Durability',
                        'description' => 'Expertly crafted workwear designed to withstand the demands of any industry while maintaining comfort and style.',
                    ],
                    [
                        'title' => 'Customisation & Branding',
                        'description' => 'Personalised solutions that showcase your brand with high-quality embroidery and printing.',
                    ],
                    [
                        'title' => 'Professionalism & Comfort',
                        'description' => 'Workwear that enhances team identity, ensuring a polished look without compromising on comfort.',
                    ],
                ],
            ]
        );

        $this->add_control(
            'right_image',
            [
                'label' => esc_html__('Right Side Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=py-6 lg:py-12">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-12">
                    <div>
                        <div class="mb-8 lg:mb-12">
                            <p class="text-2xl font-bold font-din-next-stencil mb-4 uppercase"><?php echo esc_html($settings['subtitle']); ?></p>
                            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-6"><?php echo esc_html($settings['title']); ?></h2>
                            <p class="text-lg"><?php echo esc_html($settings['description']); ?></p>
                        </div>
                        <ul class="xl:w-2/3 space-y-12 mb-8 lg:mb-12">
                            <?php foreach ($settings['features'] as $feature): ?>
                                <li class="flex items-center gap-4">
                                    <img src="<?php echo esc_url($feature['icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']); ?>" class="w-17 h-17 object-contain object-center">
                                    <div>
                                        <h4 class="text-xl lg:text-2xl font-black normal-case mb-2"><?php echo esc_html($feature['title']); ?></h4>
                                        <p><?php echo esc_html($feature['description']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div>
                        <img src="<?php echo esc_url($settings['right_image']['url']); ?>" alt="Workwear Features" class="w-full h-156! lg:h-full! object-cover object-center">
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 