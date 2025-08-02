<?php

class Legal_Page_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'legal_page_header';
    }

    public function get_title() {
        return esc_html__('Legal Page Header', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-header';
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
            'breadcrumb_home_text',
            [
                'label' => esc_html__('Breadcrumb Home Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Homepage',
            ]
        );

        $this->add_control(
            'breadcrumb_home_url',
            [
                'label' => esc_html__('Breadcrumb Home URL', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/'),
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_text',
            [
                'label' => esc_html__('Breadcrumb Link Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Page Link',
            ]
        );

        $this->add_control(
            'breadcrumb_link_url',
            [
                'label' => esc_html__('Breadcrumb Link URL', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Privacy Policy',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $home_text = $settings['breadcrumb_home_text'];
        $home_url = !empty($settings['breadcrumb_home_url']['url']) ? $settings['breadcrumb_home_url']['url'] : '';
        $link_text = $settings['breadcrumb_link_text'];
        $link_url = !empty($settings['breadcrumb_link_url']['url']) ? $settings['breadcrumb_link_url']['url'] : '#';
        ?>
        <header class="pt-6 lg:py-12">
            <div class="container">
                <div class="mx-auto">
                    <div class="text-center mb-4 lg:mb-8">
                        <p class="mb-6">
                            <?php if ($home_url): ?>
                                <a href="<?php echo esc_url($home_url); ?>" class="text-black hover:underline underline-offset-1 hover:brightness-80">
                                    <?php echo esc_html($home_text); ?>
                                </a>
                            <?php else: ?>
                                <span><?php echo esc_html($home_text); ?></span>
                            <?php endif; ?>
                             - 
                            <a href="<?php echo esc_url($link_url); ?>" class="underline underline-offset-1 hover:brightness-80">
                                <?php echo esc_html($link_text); ?>
                            </a>
                        </p>
                        <h1 class="uppercase text-5xl md:text-6xl lg:text-7xl mb-6"><?php echo esc_html($settings['title']); ?></h1>
                        <div class="md:w-2/3 lg:w-3/5 text-lg mx-auto">
                            <?php echo wp_kses_post($settings['description']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php
    }
}