<?php

class Blog_Related {
    public static function render() {
        // Skip rendering if we're in Elementor editor
        if (isset($_GET['elementor-preview'])) {
            return;
        }
        
        // Skip if we're in any kind of Elementor editor mode
        if (\Elementor\Plugin::$instance->editor->is_edit_mode() || 
            \Elementor\Plugin::$instance->preview->is_preview_mode()) {
            return;
        }

        $args = [
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => [get_the_ID()]
        ];

        $posts = get_posts($args);
        ?>
        <section class=py-12 lg:py-30">
            <div class="container">
                <div class="mb-6 lg:mb-20">
                    <h4 class="text-2xl font-bold font-din-next-stencil mb-4">Workwear Insights & Tips</h4>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black">Expert Advice on Workwear Solutions</h3>
                </div>
                <ul class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 lg:gap-x-16 gap-y-6 lg:gap-y-12 mb-6 lg:mb-20">
                    <?php foreach ($posts as $post): 
                        setup_postdata($post);
                    ?>
                    <?php get_template_part('template-parts/post/blog'); ?>
                    <?php endforeach; 
                    wp_reset_postdata();
                    ?>
                </ul>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-[#3234481F] backdrop-blur-2xl px-6 btn">
                    <span class="text-black">View Blog Page</span>
                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </section>
        <?php
    }
} 