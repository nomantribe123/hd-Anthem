<?php

class FAQ_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'faq_section';
    }

    public function get_title() {
        return esc_html__('FAQ Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-help-o';
    }

    public function get_categories() {
        return ['tribes'];
    }

    protected function register_controls() {
        // Header Section
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Header', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Got A QUESTION?', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('FAQs', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('View All FAQs', 'tribes-prortx'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/faqs'),
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'show_external' => true,
            ]
        );

        $this->end_controls_section();

        // FAQ Items
        $this->start_controls_section(
            'section_faqs',
            [
                'label' => __('FAQ Items', 'tribes-prortx'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => __('Question', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('FAQ Question', 'tribes-prortx'),
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => __('Answer', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('FAQ Answer', 'tribes-prortx'),
            ]
        );

        $this->add_control(
            'faq_items',
            [
                'label' => __('FAQ Items', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => __('First FAQ Question', 'tribes-prortx'),
                        'answer' => __('First FAQ Answer', 'tribes-prortx'),
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Only render if at least one FAQ item or any header field is not empty
        $has_faqs = !empty($settings['faq_items']) && is_array($settings['faq_items']) && array_filter($settings['faq_items'], function($item) {
            return !empty($item['question']) || !empty($item['answer']);
        });
        $has_subtitle = !empty($settings['subtitle']);
        $has_title = !empty($settings['title']);
        $has_description = !empty($settings['description']);
        $has_header = $has_subtitle || $has_title || $has_description;

        if (!$has_faqs && !$has_header) {
            return;
        }
        ?>
        <section class="py-12 lg:py-30">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-20">
                    <?php if ($has_header): ?>
                        <div class="col-span-1 lg:col-span-2">
                            <div class="sticky top-25">
                                <div class="mb-8">
                                    <?php if ($has_subtitle): ?>
                                    <h4 class="text-2xl font-bold mb-4">
                                        <?php echo esc_html($settings['subtitle']); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <?php if ($has_title): ?>
                                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-6">
                                        <?php echo esc_html($settings['title']); ?>
                                    </h3>
                                    <?php endif; ?>
                                    <?php if ($has_description): ?>
                                    <p class="text-lg"><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php 
                                if (!empty($settings['button_link']['url'])) :
                                    $this->add_link_attributes('button_link', $settings['button_link']);
                                ?>
                                    <a <?php echo $this->get_render_attribute_string('button_link'); ?> 
                                    class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 backdrop-blur-2xl px-6 btn">
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
                        </div>
                    <?php endif; ?>
                    
                    <div class="col-span-1 <?php echo ($has_header) ? 'lg:col-span-3' : 'lg:col-span-full' ?>">
                        <?php if ($has_faqs): ?>
                        <ul class="space-y-4">
                            <?php foreach ($settings['faq_items'] as $item) : 
                                if (empty($item['question']) && empty($item['answer'])) continue;
                            ?>
                                <li x-data="accordion()" 
                                    x-bind:aria-expanded="open"
                                    class="faq-item border aria-expanded:bg-[#0000000A] duration-300"
                                    x-bind:class="{'open': open}">
                                    <button x-bind="onClick" class="border-gray-light w-full flex justify-between items-center gap-4 px-6 py-5">
                                        <?php if (!empty($item['question'])): ?>
                                        <span class="text-gray-light text-lg lg:text-xl duration-300"
                                              x-bind:class="{'text-black': open}">
                                            <?php echo esc_html($item['question']); ?>
                                        </span>
                                        <?php endif; ?>
                                        <svg class="w-6 h-6 duration-300"
                                             x-bind:class="{'rotate-180': open}"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z"
                                                  fill="currentColor" />
                                        </svg>
                                    </button>
                                    <?php if (!empty($item['answer'])): ?>
                                    <div x-bind="dialogue">
                                        <div class="px-6 pb-6">
                                            <?php echo wp_kses_post($item['answer']); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}