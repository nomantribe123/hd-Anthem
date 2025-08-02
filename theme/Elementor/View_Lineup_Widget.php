<?php

class View_Lineup_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'view_lineup';
    }

    public function get_title() {
        return 'View Our Line-Up';
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['prortx'];
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
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Our Line-Up',
                'placeholder' => esc_html__('Enter title', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
                'placeholder' => esc_html__('Enter description', 'tribes-prortx'),
                'rows' => 3,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Our Line-Up',
                'placeholder' => esc_html__('Enter button text', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/our-line-up'),
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'placeholder' => esc_html__('Enter URL', 'tribes-prortx'),
            ]
        );

        $this->end_controls_section();

        // Image Section
        $this->start_controls_section(
            'image_section',
            [
                'label' => esc_html__('Image', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => home_url('/wp-content/uploads/2025/07/view-lineup2-1.png'),
                ],
            ]
        );

        $this->add_control(
            'image_alt',
            [
                'label' => esc_html__('Image Alt Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Line-Up Models',
                'placeholder' => esc_html__('Enter alt text', 'tribes-prortx'),
            ]
        );

        $this->end_controls_section();

        // Template Section
        $this->start_controls_section(
            'template_section',
            [
                'label' => esc_html__('Template', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'use_template',
            [
                'label' => esc_html__('Use Elementor Template', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__('Yes', 'tribes-prortx'),
                'label_off' => esc_html__('No', 'tribes-prortx'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'template_id',
            [
                'label' => esc_html__('Select Template', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_elementor_templates(),
                'condition' => [
                    'use_template' => 'yes',
                ],
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
                'default' => '#f8f8f8',
                'selectors' => [
                    '{{WRAPPER}} .lineup-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .lineup-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6b7280',
                'selectors' => [
                    '{{WRAPPER}} .lineup-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // If template is enabled, use template ID
        if ($settings['use_template'] === 'yes' && !empty($settings['template_id'])) {
            $this->render_lineup_section(null, $settings['template_id']);
        } else {
            $this->render_lineup_section($settings);
        }
    }

    private function get_elementor_templates() {
        $templates = [];
        
        if (class_exists('\Elementor\Plugin')) {
            $posts = get_posts([
                'post_type' => 'elementor_library',
                'post_status' => 'publish',
                'numberposts' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            ]);
            
            foreach ($posts as $post) {
                $templates[$post->ID] = $post->post_title;
            }
        }
        
        return $templates;
    }

    /**
     * Check if a template contains only lineup-related widgets
     */
    private function is_lineup_only_template($elements) {
        if (empty($elements)) {
            return false;
        }

        $lineup_widget_types = [
            'view_lineup', // This widget
            'view-lineup', // Alternative naming
            'lineup-section', // Alternative naming
        ];

        foreach ($elements as $element) {
            if (isset($element['widgetType'])) {
                $widget_type = $element['widgetType'];
                if (!in_array($widget_type, $lineup_widget_types)) {
                    // Found a non-lineup widget, this is not a lineup-only template
                    return false;
                }
            } elseif (isset($element['elType']) && $element['elType'] === 'section') {
                // Check nested elements in sections
                if (isset($element['elements']) && !empty($element['elements'])) {
                    if (!$this->is_lineup_only_template($element['elements'])) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function render_lineup_section($settings = null, $template_id = null) {
        // If template ID is provided, try to render the Elementor template
        if ($template_id && class_exists('\Elementor\Plugin')) {
            // Check if the template exists and get its data
            $template_data = \Elementor\Plugin::$instance->documents->get($template_id);
            if ($template_data && $template_data->is_built_with_elementor()) {
                // Get the template's element data to check if it contains only lineup widgets
                $template_elements = $template_data->get_elements_data();
                $is_lineup_only_template = $this->is_lineup_only_template($template_elements);
                
                if ($is_lineup_only_template) {
                    $template_content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id);
                    if ($template_content) {
                        echo $template_content;
                        return;
                    }
                }
                // If not a lineup-only template, fall back to default widget rendering
            }
        }
        
        // If no settings provided, use default settings
        if ($settings === null) {
            $settings = [
                'title' => ' Test View Our Line-Up',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
                'button_text' => 'View Our Line-Up',
                'button_url' => [
                    'url' => home_url('/our-line-up'),
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'image' => [
                    'url' => home_url('/wp-content/uploads/2025/07/view-lineup2-1.png'),
                ],
                'image_alt' => 'Our Line-Up Models',
            ];
        }
        
        $image_url = $settings['image']['url'] ? $settings['image']['url'] : home_url('/wp-content/uploads/2025/07/view-lineup2-1.png');
        $image_alt = $settings['image_alt'] ? $settings['image_alt'] : 'Our Line-Up Models';
        $button_url = $settings['button_url']['url'] ? $settings['button_url']['url'] : home_url('/our-line-up');
        $button_target = $settings['button_url']['is_external'] ? '_blank' : '_self';
        $button_nofollow = $settings['button_url']['nofollow'] ? 'nofollow' : '';
        ?>

        <section class="bg-grey-custom py-10">
            <div class="container lineup-section">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                    <!-- Text Content -->
                    <div class="w-full lg:w-1/2">
                        <?php if ($settings['title']): ?>
                            <h2 class="text-3xl lg:text-4xl font-bold mb-4 lineup-title"><?php echo esc_html($settings['title']); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ($settings['description']): ?>
                            <p class="text-base lg:text-lg mb-6 text-gray-700 lineup-description">
                                <?php echo esc_html($settings['description']); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($settings['button_text']): ?>
                            <a href="<?php echo esc_url($button_url); ?>" 
                               target="<?php echo esc_attr($button_target); ?>" 
                               <?php echo $button_nofollow ? 'rel="' . esc_attr($button_nofollow) . '"' : ''; ?>
                               class="inline-flex items-center gap-2 px-6 py-3 border border-gray-800 rounded-lg bg-white hover:bg-gray-50 transition-colors duration-300 lineup-btn justify-center">
                                <span class="text-gray-800 font-medium"><?php echo esc_html($settings['button_text']); ?></span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Models Image -->
                    <div class="w-full lg:w-1/2">
                        <div class="relative">
                            <img src="<?php echo esc_url($image_url); ?>" 
                                 width="400" 
                                 height="400" 
                                 alt="<?php echo esc_attr($image_alt); ?>" 
                                 class="w-full h-auto rounded-lg object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 