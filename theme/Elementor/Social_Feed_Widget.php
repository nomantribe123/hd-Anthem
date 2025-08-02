<?php

class Social_Feed_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'social_feed';
    }

    public function get_title() {
        return esc_html__('Social Feed', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    public function get_categories() {
        return ['tribes'];
    }

    protected function register_controls() {
        // Content Section - Header
        $this->start_controls_section(
            'header_section',
            [
                'label' => esc_html__('Header', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'FOLLOW PRORTX',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Social Feed',
            ]
        );

        $this->end_controls_section();

        // Content Section - Feed Type
        $this->start_controls_section(
            'feed_type_section',
            [
                'label' => esc_html__('Feed Type', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feed_type',
            [
                'label' => esc_html__('Feed Type', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom' => esc_html__('Custom Feed', 'tribes-prortx'),
                    'embedded' => esc_html__('Embedded Script', 'tribes-prortx'),
                ],
            ]
        );

        $this->add_control(
            'embedded_script',
            [
                'label' => esc_html__('Embedded Script', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'description' => esc_html__('Paste your social media embedded script here', 'tribes-prortx'),
                'condition' => [
                    'feed_type' => 'embedded',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Section - Custom Feed Images
        $this->start_controls_section(
            'feed_images_section',
            [
                'label' => esc_html__('Feed Images', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'feed_type' => 'custom',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'feed_images',
            [
                'label' => esc_html__('Feed Images', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'image' => [
                            'url' => '/assets/sample-16-DvvG7Whw.jpg',
                        ],
                        'link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'image' => [
                            'url' => '/assets/sample-10-BAyhNLW9.jpg',
                        ],
                        'link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'image' => [
                            'url' => '/assets/sample-17-DboYHKWK.jpg',
                        ],
                        'link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ image.url }}}',
            ]
        );

        $this->end_controls_section();

        // Content Section - Social Links
        $this->start_controls_section(
            'social_links_section',
            [
                'label' => esc_html__('Social Links', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $social_repeater = new \Elementor\Repeater();
        $social_repeater->add_control(
            'social_name',
            [
                'label' => esc_html__('Social Name', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'YouTube',
            ]
        );
        $social_repeater->add_control(
            'social_url',
            [
                'label' => esc_html__('Social URL', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        $social_repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Social Icon', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );
        $this->add_control(
            'social_links',
            [
                'label' => esc_html__('Social Links', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $social_repeater->get_controls(),
                'default' => [
                    [
                        'social_name' => 'YouTube',
                        'social_url' => [ 'url' => 'https://www.youtube.com/@anthemclothing' ],
                        'social_icon' => [ 'url' => '/wp-content/uploads/2025/07/socialmedia-youtube.svg' ],
                    ],
                    [
                        'social_name' => 'Instagram',
                        'social_url' => [ 'url' => 'https://www.instagram.com/anthemclothing_/#' ],
                        'social_icon' => [ 'url' => '/wp-content/uploads/2025/07/socialmedia-instagram.svg' ],
                    ],
                    [
                        'social_name' => 'Facebook',
                        'social_url' => [ 'url' => 'https://www.facebook.com/AnthemclothingAM#' ],
                        'social_icon' => [ 'url' => '/wp-content/uploads/2025/07/socialmedia-facebook.svg' ],
                    ],
                ],
                'title_field' => '{{{ social_name }}}',
            ]
        );
        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .social-feed-custom-style' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .social-feed-custom-style h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .social-feed-custom-style h4' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .social-feed-custom-style p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .social-feed-custom-style a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=py-12 lg:pt-12 lg:pb-30 social-feed-custom-style">
            <div class="container">
                <div class="flex flex-wrap justify-between items-start gap-4 mb-6 social-anthem-title">
                    <div>
                        <h4 class="text-2xl font-din-next-stencil mb-4"><?php echo esc_html($settings['subtitle']); ?></h4>
                        <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl mb-6"><?php echo esc_html($settings['title']); ?></h3>
                    </div>
                    <div class="flex flex-wrap items-center gap-4">
                        <?php if ( ! empty( $settings['social_links'] ) ) : ?>
                        <ul class="flex flex-wrap items-center gap-6 socialmediaicons-sec">
                            <?php foreach ( $settings['social_links'] as $item ) :
                                $url = isset($item['social_url']['url']) ? $item['social_url']['url'] : '';
                                $name = isset($item['social_name']) ? esc_html($item['social_name']) : '';
                                $icon = isset($item['social_icon']['url']) ? $item['social_icon']['url'] : '';
                                if ( $url && $icon ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" class="flex items-center gap-3">
                                        <img decoding="async" src="<?php echo esc_url( $icon ); ?>" alt="<?php echo $name; ?>" class="w-6 h-6">
                                        <span><?php echo $name; ?></span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($settings['feed_type'] === 'embedded' && !empty($settings['embedded_script'])): ?>
                    <div class="social-feed-embedded">
                        <?php echo $settings['embedded_script']; ?>
                    </div>
                <?php else: ?>
                    <ul class="grid grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-8">
                        <?php foreach ($settings['feed_images'] as $image): ?>
                        <li>
                            <a href="<?php echo esc_url($image['link']['url']); ?>" class="block">
                                <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr__('Social Feed Image', 'tribes-prortx'); ?>"
                                     class="w-full h-47 sm:h-77 lg:h-107 object-cover object-center">
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
} 