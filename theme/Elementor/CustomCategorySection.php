<?php

class CustomCategorySection extends \Elementor\Widget_Base {
    public function get_name() {
        return 'custom_category_section';
    }

    public function get_title() {
        return esc_html__('Custom Category Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['pro-rtx'];
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
                'default' => '',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 3,
                'default' => '',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View All Categories', 'tribes-prortx'),
                'label_block' => true,
            ]
        );

        // Create a repeater for category items
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category',
            [
                'label' => esc_html__('Select Category', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#31344A',
            ]
        );

        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'custom_description',
            [
                'label' => esc_html__('Custom Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => '',
            ]
        );

        $this->add_control(
            'category_items',
            [
                'label' => esc_html__('Category Items', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ category }}}',
            ]
        );

        $this->end_controls_section();
    }

    private function get_product_categories() {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ]);

        $options = [];
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section>
            <div class="container">
                <?php if (!empty($settings['title']) || !empty($settings['subtitle']) || !empty($settings['button_link']['url'])) : ?>
                    <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-start gap-8 mb-6 lg:mb-8 pt-6 lg:pt-0">
                        <div class="">
                            <?php if ($settings['title']) : ?>
                                <h3 class="text-3xl font-bold">
                                    <?php echo esc_html__($settings['title'], 'tribes-prortx'); ?>
                                </h3>
                            <?php endif ?>
                            <?php if ($settings['subtitle']) : ?>
                                <p>
                                    <?php echo esc_html($settings['subtitle']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['button_link']) && $settings['button_text']): ?>
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" 
                                class="group w-full sm:w-fit h-11 flex justify-center items-center gap-3 bg-[#3234481F] backdrop-blur-2xl px-6 btn">
                                <span class="text-black"><?php echo esc_html($settings['button_text']); ?></span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" 
                                        viewBox="0 0 24 24" 
                                        fill="none" 
                                        xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" 
                                            fill="currentColor"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <ul class="grid grid-cols-1 lg:grid-cols-3">
                    <?php foreach ($settings['category_items'] as $item) :                    
                        $category = get_term($item['category'], 'product_cat');

                        get_template_part('template-parts/category/post', null, [
                            'category' => $category,
                            'custom_description' => $item['custom_description'] ?? '',
                            'background_image' => $item['background_image'] ?? [],
                            'button_text' => $settings['button_text']
                        ]);
                    endforeach; 
                    ?>
                </ul>
            </div>
        </section>
        <?php
    }
}