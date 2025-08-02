<?php

class WorkwearCategories extends \Elementor\Widget_Base {

    public function get_name() {
        return 'workwear_categories';
    }

    public function get_title() {
        return 'Workwear Categories';
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
                'label' => esc_html__('Content Settings', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View More', 'tribes-prortx'),
                'placeholder' => esc_html__('Enter button text', 'tribes-prortx'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $button_text = $settings['button_text'];
        
        $product_categories = get_terms([
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0
        ]);
        ?>
        <section class=py-6 lg:pt-12 lg:pb-20">
            <div class="container max-sm:px-0">
                <ul class="categories-list">
                    <?php foreach ($product_categories as $category) :
                        if ($category->name == 'Uncategorized') continue;
                        get_template_part('template-parts/category/post', null, [
                            'category' => $category,
                            'button_text' => $button_text
                        ]);
                    endforeach; ?>
                </ul>
            </div>
        </section>
        <?php
    }
} 