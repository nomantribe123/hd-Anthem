<?php

class Category_Text_Image_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'category_text_image';
    }

    public function get_title() {
        return esc_html__('Category Support Text & Image', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return ['tribes'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'tribes-prortx'),
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => __('Content', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'content_items',
            [
                'label' => __('Content Items', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Supporting Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'image_alt',
            [
                'label' => esc_html__('Image Alt Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => esc_html__('Image Position', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Right', 'tribes-prortx'),
                'label_off' => esc_html__('Left', 'tribes-prortx'),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $has_content = !empty($settings['content_items']);
        $has_image = !empty($settings['image']['url']);

        if (!$has_content && !$has_image) {
            return;
        }
        ?>
        <section class=py-12">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-2 items-stretch gap-8">
                    <?php if ($has_content) : ?>
                        <div class="col-span-1 self-center">
                            <div class="flex flex-col gap-y-8">
                                <?php foreach ($settings['content_items'] as $item) : ?>
                                    <div>
                                        <?php if (!empty($item['title'])) : ?>
                                            <h2 class="text-5xl font-bold mb-6"><?php echo esc_html($item['title']); ?></h2>
                                        <?php endif; ?>
                                        <?php if (!empty($item['content'])) : ?>
                                            <div><?php echo wp_kses_post($item['content']); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($has_image) : ?>
                        <div class="col-span-1 <?php echo $settings['image_position'] === 'yes' ? 'order-2' : 'order-1'; ?>">
                            <div class="aspect-[11/9] h-full">
                                <img src="<?php echo esc_url($settings['image']['url']); ?>"
                                     alt="<?php echo esc_attr($settings['image_alt']); ?>"
                                     class="object-cover w-full h-full!">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

