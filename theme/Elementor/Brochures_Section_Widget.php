<?php
class Brochures_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'brochures_section';
    }

    public function get_title() {
        return esc_html__('Brochures Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-document-file';
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
            'posts_per_page',
            [
                'label' => esc_html__('Number of Brochures', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 100,
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#31344A',
                'selectors' => [
                    '{{WRAPPER}} .brochures-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .brochures-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Query brochures
        $args = array(
            'post_type' => 'brochure',
            'posts_per_page' => $settings['posts_per_page'],
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'asc',
        );

        $brochures_query = new \WP_Query($args);

        if ($brochures_query->have_posts()) :
            ?>
            <section class=py-12 lg:py-20">
                <div class="container">
                    <ul class="space-y-12">
                        <?php
                        while ($brochures_query->have_posts()) : $brochures_query->the_post();
                            $post_id = get_the_ID();
                            $this->render_brochure_item($post_id);
                        endwhile;
                        ?>
                    </ul>
                </div>
            </section>
            <?php
            wp_reset_postdata();
        else :
            echo '<div class="container py-12 text-center">';
            echo esc_html__('No brochures found.', 'tribes-prortx');
            echo '</div>';
        endif;
    }

    protected function render_brochure_item($post_id) {
        // Check if ACF is available
        if (!function_exists('get_field')) {
            return;
        }

        // Get ACF fields using get_post_meta as fallback
        $brochure_logo = get_post_meta($post_id, 'brochure_logo', true);
        $follow_link = get_post_meta($post_id, 'follow_link', true);
        $download_brochure = get_post_meta($post_id, 'download_brochure', true);

        // If ACF is properly initialized, use get_field
        if (did_action('acf/init')) {
            $brochure_logo = get_field('brochure_logo', $post_id) ?: $brochure_logo;
            $follow_link = get_field('follow_link', $post_id) ?: $follow_link;
            $download_brochure = get_field('download_brochure', $post_id) ?: $download_brochure;
        }
        ?>
        <li class="grid grid-cols-1 lg:grid-cols-2 items-center gap-6 lg:gap-20 xl:gap-30">
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="brochure-thumbnail">
                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-130 object-cover object-center']); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <?php if (!empty($brochure_logo)) : 
                    $logo_url = is_array($brochure_logo) ? $brochure_logo['url'] : $brochure_logo;
                    $logo_alt = is_array($brochure_logo) && isset($brochure_logo['alt']) ? $brochure_logo['alt'] : get_the_title($post_id);
                    ?>
                    <div class="mb-4 lg:mb-12">
                        <img src="<?php echo esc_url($logo_url); ?>" 
                            alt="<?php echo esc_attr($logo_alt); ?>"
                            class="w-56 sm:w-64 h-14 object-contain object-center">
                    </div>
                <?php endif; ?>

                <p class="font-medium underline underline-offset-1 mb-4">Uploaded:
                    <?php echo get_the_time('d/m/Y'); ?></p>
                <h2 class="<?php echo (!empty($follow_link)) ? "text-3xl" : "text-2xl lg:text-3xl" ?> font-black mb-2"><?php the_title(); ?></h2>
                <div class="mb-4 line-clamp-2"><?php echo wp_strip_all_tags(get_the_excerpt()); ?></div>

                <?php if (!empty($follow_link)) : ?>
                    <a href="<?php echo esc_url($follow_link); ?>"
                    class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-[#0000000A] backdrop-blur-2xl px-6 btn mt-8 lg:mt-12">
                        <span class="text-black">Follow Link</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                            viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                fill="currentColor"/>
                        </svg>
                    </a>
                <?php endif; ?>

                <?php 
                if (!empty($download_brochure)) :
                    $download_url = is_array($download_brochure) ? $download_brochure['url'] : $download_brochure;
                    $download_link = add_query_arg('brochure_download', base64_encode($download_url), site_url('/'));
                    ?>
                    <a href="<?php echo esc_url($download_link); ?>"
                    class="group w-full lg:w-fit h-11 flex justify-between items-center gap-4 lg:gap-16 bg-white/7 px-4 border ">
                        <span>Download Brochure</span>
                        <svg class="w-6 h-6" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="-translate-y-1 group-hover:translate-y-0 duration-300"
                                d="M12 16L16 11H13V4H11V11H8L12 16Z"
                                fill="currentColor"/>
                            <path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z"
                                fill="currentColor"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </li>
        <?php
    }
} 