<?php

class FAQ_Accordion_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'faq-accordion';
    }

    public function get_title()
    {
        return 'FAQ Accordion';
    }

    public function get_icon()
    {
        return 'eicon-post-content';
    }

    public function get_categories()
    {
        return ['tribes'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => esc_html__('#9B2F84', 'textdomain'),
            ]
        );


        $this->add_control(
            'accordions',
            [
                'label' => esc_html__('Accordions', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'question',
                        'label' => esc_html__('Question', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => esc_html__('', 'textdomain')
                    ],
                    [
                        'name' => 'answer',
                        'label' => esc_html__('Answer', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'rows' => 10
                    ],
                    [
                        'name' => 'isOpen',
                        'label' => esc_html__('Is Open?', 'plugin-name'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'default' => 'false',
                        'label_on' => esc_html__('Yes', 'textdomain'),
                        'label_off' => esc_html__('No', 'textdomain'),
                        'return_value' => 'yes',
                    ]
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__('Show Category Filter', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'faq_category',
            [
                'label' => esc_html__('FAQ Category Slug (optional)', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Show only FAQs from this category (leave blank for all)', 'textdomain'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_filter = $settings['show_filter'] === 'yes';
        $selected_category = !empty($settings['faq_category']) ? sanitize_text_field($settings['faq_category']) : (isset($_GET['faq_category']) ? sanitize_text_field($_GET['faq_category']) : '');

        // Get all FAQ categories
        $faq_categories = get_terms([
            'taxonomy' => 'faq_category',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
            'parent' => 0
        ]);

        // Get FAQs based on category
        $args = array(
            'post_type' => 'faq',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'faq_order',
            'order' => 'ASC'
        );
        if (!empty($selected_category)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'faq_category',
                    'field' => 'slug',
                    'terms' => $selected_category
                )
            );
        }
        $faqs = get_posts($args);
        ?>

        <section class=py-12 lg:py-30 faqs-section-main">
            <div class="container">
                <div class="xl:w-2/3 mx-auto">
                    <?php if ($show_filter): ?>
                    <!-- Category Filter Bar - Desktop -->
                    <div class="hidden lg:flex flex-wrap justify-between gap-x-8 mb-12">
                        <div>
                            <a href="<?php echo esc_url(remove_query_arg('faq_category')); ?>" 
                               class="border px-8 py-4 <?php echo empty($selected_category) ? 'peer-checked:bg-[#31344A0A] border-black' : 'border-transparent'; ?>">
                                View All
                            </a>
                        </div>
                        <?php if (!empty($faq_categories)) : ?>
                            <ul class="flex flex-wrap items-center">
                                <?php foreach ($faq_categories as $category) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(add_query_arg('faq_category', $category->slug)); ?>" 
                                           class="border px-8 py-4 <?php echo $selected_category === $category->slug ? 'peer-checked:bg-[#31344A0A] border-black' : 'border-transparent'; ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Mobile Filter -->
                    <div x-data="{ open: false }" class="block lg:hidden mb-12">
                        <div class="w-full mb-4">
                            <button @click="open = !open" 
                                    class="w-full h-12 flex justify-between items-center gap-2 bg-[#31344A0A] border border-black px-4">
                                <span>Categories</span>
                                <svg class="w-6 h-6 transform" 
                                     :class="{'rotate-180': open}"
                                     viewBox="0 0 24 24" 
                                     fill="none" 
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" 
                                          fill="currentColor"/>
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-transition 
                                 class="mt-2 border border-black">
                                <a href="<?php echo esc_url(remove_query_arg('faq_category')); ?>" 
                                   class="block px-4 py-3 <?php echo empty($selected_category) ? 'bg-[#31344A0A]' : ''; ?>">
                                    View All
                                </a>
                                <?php foreach ($faq_categories as $category) : ?>
                                    <a href="<?php echo esc_url(add_query_arg('faq_category', $category->slug)); ?>" 
                                       class="block px-4 py-3 <?php echo $selected_category === $category->slug ? 'bg-[#31344A0A]' : ''; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($faqs)) : ?>
                        <ul class="space-y-8">
                            <?php foreach ($faqs as $faq) : 
                                $categories = wp_get_post_terms($faq->ID, 'faq_category', array('fields' => 'all'));
                                $category_names = wp_list_pluck($categories, 'name');
                            ?>
                                <li x-data="{ open: false }"
                                    class="border  aria-expanded:bg-[#0000000A] aria-expanded:border-black not-aria-expanded:opacity-50 duration-300"
                                    :class="{'bg-[#0000000A] border-black': open}"
                                    :aria-expanded="open">
                                    <button @click="open = !open"
                                            class="w-full flex justify-between items-center gap-4 text-left px-6 py-5"
                                            :aria-expanded="open">
                                        <div>
                                            <p class="text-xs font-billet mb-4">
                                                <?php echo esc_html(implode(', ', $category_names)); ?>
                                            </p>
                                            <p class="text-lg lg:text-xl font-medium duration-300">
                                                <?php echo esc_html($faq->post_title); ?>
                                            </p>
                                        </div>
                                        <svg class="w-6 h-6 duration-300"
                                             :class="{'rotate-180': open}"
                                             viewBox="0 0 24 24"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z"
                                                  fill="currentColor"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" 
                                         x-transition 
                                         class="px-6 pb-6">
                                        <div class="lg:columns-2 lg:gap-4">
                                            <div class="px-6 pb-6">
                                                <?php echo apply_filters('the_content', $faq->post_content); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-center py-8">No FAQs found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
