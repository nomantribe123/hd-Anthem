<?php

class Legal_Table_Content_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'legal_table_content';
    }

    public function get_title() {
        return esc_html__('Legal Table of Contents', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-table-of-contents';
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
            'toc_title',
            [
                'label' => esc_html__('Table of Contents Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Table of contents',
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<h1>Heading 1</h1><p>Your content here...</p>',
                'description' => 'Add your content with proper headings (h1-h6). The table of contents will be automatically generated from these headings.',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=py-12 lg:py-30">
            <div class="container">
                <div x-data="tableOfContent" class="flex flex-col lg:flex-row justify-between gap-6">
                    <div class="lg:w-1/4">
                        <div class="sticky top-25">
                            <p class="text-2xl font-black mb-4"><?php echo esc_html($settings['toc_title']); ?></p>
                            <ul>
                                <template x-for="(item, index) in list" :key="index">
                                    <li>
                                        <a href=""
                                           class="w-full lg:text-xl lg:font-medium border border-transparent py-3 pr-4"
                                           x-bind:class="{'border-black!': item.el === activeElement}"
                                           x-bind:style="{ paddingLeft: `${item.level * 16}px` }"
                                           x-on:click.prevent="scrollTo(item.el)"
                                           x-text="item.text"></a>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                    <div x-ref="content" class="lg:w-3/5 prose">
                        <?php echo wp_kses_post($settings['content']); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 