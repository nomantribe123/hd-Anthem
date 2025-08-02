<?php

class History_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'history_section';
    }

    public function get_title() {
        return esc_html__('History Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-history';
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
                'default' => 'SUBHEADER',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our History',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue.',
                'rows' => 10,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 xl:gap-20">
            <div>
                <div class="sticky top-25">
                    <h4 class="text-2xl font-bold font-din-next-stencil mb-4"><?php echo esc_html($settings['subtitle']); ?></h4>
                    <h3 class="text-6xl font-black"><?php echo esc_html($settings['title']); ?></h3>
                </div>
            </div>
            <div>
                <p class="text-lg"><?php echo esc_html($settings['description']); ?></p>
            </div>
        </div>
        <?php
    }
} 