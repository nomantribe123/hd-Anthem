<?php

class Norty_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'norty_section';
    }

    public function get_title() {
        return esc_html__('Norty Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-image-box';
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
                'default' => 'Norty Section',
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label' => esc_html__('Logo Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Follow Link',
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

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
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
                    <h3 class="text-6xl font-black mb-6 lg:mb-12"><?php echo esc_html($settings['title']); ?></h3>
                    
                    <?php if ($settings['logo_image']['url']): ?>
                    <div class="mb-6 lg:mb-12">
                        <img src="<?php echo esc_url($settings['logo_image']['url']); ?>" alt="Logo" class="w-90 h-23 object-contain object-center">
                    </div>
                    <?php endif; ?>

                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                       class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-[#0000000A] backdrop-blur-2xl px-6 btn">
                        <span class="text-black"><?php echo esc_html($settings['button_text']); ?></span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24"
                             fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                  fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div>
                <p class="text-lg"><?php echo esc_html($settings['description']); ?></p>
            </div>
        </div>
        <?php
    }
} 