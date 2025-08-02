<?php

class Blog_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'blog_section';
    }

    public function get_title() {
        return 'Blog Section';
    }

    public function get_icon() {
        return 'eicon-archive-posts';
    }

    public function get_categories() {
        return ['prortx'];
    }

    // private function get_current_category() {
    //     $current_category = get_query_var('category');
    //     if (empty($current_category)) {
    //         $current_category = 'all';
    //     }

    //     return $current_category;
    // }

    // private function get_post_categories() {
    //     $categories = get_categories(array(
    //         'orderby' => 'name',
    //         'order' => 'ASC',
    //         'hide_empty' => true
    //     ));

    //     return $categories;
    // }

    // private function get_posts() {
    //     $current_category = $this->get_current_category();

    //     $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    //     $args = array(
    //         'post_type' => 'post',
    //         'posts_per_page' => 6,
    //         'paged' => $paged
    //     );

    //     // Add category filter if set and not 'all'
    //     if (!empty($current_category) && $current_category !== 'all') {
    //         $args['category_name'] = $current_category;
    //     }

    //     return new WP_Query($args);
    // }

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
            'posts_per_page',
            [
                'label' => esc_html__('Number of posts', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
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
            'show_search',
            [
                'label' => esc_html__('Show Search', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'search_placeholder',
            [
                'label' => esc_html__('Search Placeholder', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Search',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get current category if set
        $current_category = is_category() ? get_queried_object() : null;

        $paged = get_query_var('paged');
        if (!$paged) {
            $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
            if ($paged < 1 && isset($_GET['page'])) {
                $paged = intval($_GET['page']);
            }
            if ($paged < 1) {
                $paged = 1;
            }
        }

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'paged' => $paged
        );

        // Add category filter if set
        if (!empty($current_category)) {
            $args['cat'] = $current_category->term_id;
        }

        $blog_query = new WP_Query($args);

        // Get all categories
        $categories = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true
        ));
        // $categories = $this->get_post_categories();
        // $blog_query = $this->get_posts();
        
        ?>

        <section class=py-12 lg:pt-18 lg:pb-30">
            <?php get_template_part('template-parts/archive/post/loop', 'start', [
                'show_search' => $settings['show_search'],
                'search_placeholder' => $settings['search_placeholder'],
                'show_filter' => $settings['show_filter'],
            ]); ?>

            <?php get_template_part('template-parts/archive/post/loop', null, [
                'query' => $blog_query,
            ]); ?>
        </section>
    <?php }
}