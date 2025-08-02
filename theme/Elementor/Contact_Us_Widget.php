<?php 

class Contact_Us_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'contact_us';
    }

    public function get_title() {
        return 'Contact Us';
    }

    public function get_icon() {
        return 'eicon-notes';
    }

    public function get_categories() {
        return ['prortx'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Content',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Contact Us',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Contact Us Page',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '/contact-us',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'tribes-prortx'),
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
        <section class=py-12">
            <div class="container xl:w-4/5  mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:items-center">
                    <div class="col-span-1">
                        <div class="mb-10">
                            <h3 class="text-5xl font-black mb-6"><?php echo esc_html($settings['title']); ?></h3>
                            <?php if ($settings['description']) : ?>
                                <p class="text-lg mb-4"><?php echo esc_html($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if ($settings['button_link']['url']) : ?>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>"
                            class="group w-fit h-11 flex justify-center items-center gap-3 bg-white px-10 btn">
                                <span class="text-black"><?php echo esc_html($settings['button_text']); ?></span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                        fill="currentColor"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-span-1">
                        <?php if ($settings['image']['url']) : ?>
                            <div class="w-full h-full">
                                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="w-full h-auto object-cover">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}