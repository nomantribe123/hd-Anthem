<?php

class Related_Posts_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'related_posts';
    }

    public function get_title() {
        return esc_html__('Related Posts', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
                'default' => 'Workwear Insights & Tips',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Expert Advice on Workwear Solutions',
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Post Type', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => [
                    'post' => esc_html__('Posts', 'tribes-prortx'),
                    'page' => esc_html__('Pages', 'tribes-prortx'),
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Posts', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Blog Page',
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        $posts = get_posts($args);
        ?>
        <section class=py-12 lg:py-20">
            <div class="container">
                <div class="mb-6 flex justify-between">
                    <div>
                        <h3 class="text-3xl sm:text-4xl"><?php echo esc_html($settings['title']); ?></h3>
                        <p class="mb-4"><?php echo esc_html($settings['subtitle']); ?></p>
                    </div>
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 backdrop-blur-2xl px-6 btn">
                        <span class="text-black"><?php echo esc_html($settings['button_text']); ?></span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
                <ul class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 lg:gap-x-12 gap-y-12 mb-6 lg:mb-20">
                    <?php foreach ($posts as $_post): 
                        global $post;
                        $post = $_post;
                        setup_postdata($post);
                    ?>
                        <?php get_template_part('template-parts/post/post', 'related'); ?>
                    <?php endforeach; 
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </section>
        <?php
    }
}