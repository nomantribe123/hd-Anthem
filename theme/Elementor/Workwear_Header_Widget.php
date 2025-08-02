<?php
class Workwear_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'workwear_header';
    }

    public function get_title() {
        return esc_html__('Workwear Header', 'tribes-prortx');
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
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Workwear',
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'search_placeholder',
            [
                'label' => esc_html__('Search Placeholder', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Search Our Workwear',
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_breadcrumbs() {
        $breadcrumbs = [];
        
        // Add home page
        $breadcrumbs[] = [
            'text' => 'Home',
            'url' => home_url('/')
        ];

        // If we're on a page
        if (is_page()) {
            $post = get_post();
            
            // If the page has a parent, add all ancestors
            if ($post->post_parent) {
                $ancestors = array_reverse(get_post_ancestors($post));
                foreach ($ancestors as $ancestor) {
                    $breadcrumbs[] = [
                        'text' => get_the_title($ancestor),
                        'url' => get_permalink($ancestor)
                    ];
                }
            }
            
            // Add current page
            $breadcrumbs[] = [
                'text' => get_the_title(),
                'url' => ''
            ];
        }
        
        return $breadcrumbs;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $breadcrumbs = $this->get_breadcrumbs();

        $this->add_render_attribute('wrapper', 'class', 'custom-workwear-header-wrapper');

        $current_category = get_queried_object();
        $product_categories = get_terms(['taxonomy'   => "product_cat"]);
        ?>
        <header class="pt-6 lg:py-20">
            <div class="container">
                <div class="mx-auto">
                    <div class="text-center mb-4 lg:mb-8">
                        <p class="mb-6">
                            <?php 
                            $last_index = count($breadcrumbs) - 1;
                            foreach ($breadcrumbs as $index => $crumb) {
                                if (!empty($crumb['url'])) {
                                    echo '<a href="' . esc_url($crumb['url']) . '" class="text-black hover:underline underline-offset-1 hover:brightness-80">' . esc_html($crumb['text']) . '</a>';
                                } else {
                                    echo '<span>' . esc_html($crumb['text']) . '</span>';
                                }
                                
                                if ($index < $last_index) {
                                    echo ' - ';
                                }
                            }
                            ?>
                        </p>
                        <h1 class="uppercase text-5xl md:text-6xl lg:text-7xl mb-6"><?php echo esc_html($settings['title']); ?></h1>
                        <div class="md:w-2/3 lg:w-3/5 text-lg mx-auto">
                            <?php echo wp_kses_post($settings['description']); ?>
                        </div>

                        <ul class="mini-categories-list flex gap-10 items-center justify-center my-12"> 
                            <li>
                                <a href="/our-line-up/" class="btn btn--grey rounded-xxl">
                                    View All
                                </a>
                            </li>
                            <?php foreach($product_categories as $product_category) {
                                if ($product_category->term_id === $current_category->term_id) continue;
                                get_template_part('template-parts/category/product', null, [
                                    'category' => $product_category
                                ]);
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <?php
    }
}
?>