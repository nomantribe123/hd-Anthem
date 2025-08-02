<?php

class Blog_Author {
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
        
        $author_id = get_the_author_meta('ID');
        $author_avatar = get_avatar_url($author_id, ['size' => 96]);
        $reading_time = get_field('reading_time') ? get_field('reading_time') . ' min read' : '5 min read';
        ?>
        <section class="py-8 blog-author-section">
            <div class="container">
                <div class="flex flex-col items-center gap-6">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr(get_the_author()); ?>"
                             class="w-12 h-12 object-cover object-center rounded-full">
                        <div>
                            <p class="text-xl font-black"><?php echo get_the_author(); ?></p>
                            <!-- <p class="text-sm">
                                <span><?php //echo get_the_date('d M Y'); ?></span>
                                <span>.</span>
                                <span><?php //echo esc_html($reading_time); ?></span>
                            </p> -->
                        </div>
                    </div>
                    <!-- <ul x-data="share()" class="flex flex-wrap justify-center items-center gap-4">
                        <li>
                            <button x-on:click="systemShare()" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.22172 19.7777C4.68559 20.2423 5.23669 20.6106 5.84334 20.8615C6.44999 21.1123 7.10023 21.2409 7.75672 21.2397C8.41335 21.2409 9.06374 21.1123 9.67054 20.8614C10.2774 20.6105 10.8286 20.2422 11.2927 19.7777L14.1207 16.9487L12.7067 15.5347L9.87872 18.3637C9.31519 18.9247 8.55239 19.2397 7.75722 19.2397C6.96205 19.2397 6.19925 18.9247 5.63572 18.3637C5.07422 17.8004 4.75892 17.0375 4.75892 16.2422C4.75892 15.4469 5.07422 14.684 5.63572 14.1207L8.46472 11.2927L7.05072 9.87872L4.22172 12.7067C3.28552 13.6452 2.75977 14.9166 2.75977 16.2422C2.75977 17.5678 3.28552 18.8393 4.22172 19.7777ZM19.7777 11.2927C20.7134 10.354 21.2388 9.08264 21.2388 7.75722C21.2388 6.4318 20.7134 5.16043 19.7777 4.22172C18.8393 3.28552 17.5678 2.75977 16.2422 2.75977C14.9166 2.75977 13.6452 3.28552 12.7067 4.22172L9.87872 7.05072L11.2927 8.46472L14.1207 5.63572C14.6842 5.07471 15.447 4.75975 16.2422 4.75975C17.0374 4.75975 17.8002 5.07471 18.3637 5.63572C18.9252 6.19899 19.2405 6.96189 19.2405 7.75722C19.2405 8.55255 18.9252 9.31545 18.3637 9.87872L15.5347 12.7067L16.9487 14.1207L19.7777 11.2927Z" fill="currentColor"/>
                                    <path d="M8.46371 16.9498L7.04871 15.5358L15.5357 7.0498L16.9497 8.4648L8.46371 16.9498Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <a x-bind:href="linkedinUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 3.24268C3.67157 3.24268 3 3.91425 3 4.74268V19.7427C3 20.5711 3.67157 21.2427 4.5 21.2427H19.5C20.3284 21.2427 21 20.5711 21 19.7427V4.74268C21 3.91425 20.3284 3.24268 19.5 3.24268H4.5ZM8.52076 7.2454C8.52639 8.20165 7.81061 8.79087 6.96123 8.78665C6.16107 8.78243 5.46357 8.1454 5.46779 7.24681C5.47201 6.40165 6.13998 5.72243 7.00764 5.74212C7.88795 5.76181 8.52639 6.40728 8.52076 7.2454ZM12.2797 10.0044H9.75971H9.7583V18.5643H12.4217V18.3646C12.4217 17.9847 12.4214 17.6047 12.4211 17.2246C12.4203 16.2108 12.4194 15.1959 12.4246 14.1824C12.426 13.9363 12.4372 13.6804 12.5005 13.4455C12.7381 12.568 13.5271 12.0013 14.4074 12.1406C14.9727 12.2291 15.3467 12.5568 15.5042 13.0898C15.6013 13.423 15.6449 13.7816 15.6491 14.129C15.6605 15.1766 15.6589 16.2242 15.6573 17.2719C15.6567 17.6417 15.6561 18.0117 15.6561 18.3815V18.5629H18.328V18.3576C18.328 17.9056 18.3278 17.4537 18.3275 17.0018C18.327 15.8723 18.3264 14.7428 18.3294 13.6129C18.3308 13.1024 18.276 12.599 18.1508 12.1054C17.9638 11.3713 17.5771 10.7638 16.9485 10.3251C16.5027 10.0129 16.0133 9.81178 15.4663 9.78928C15.404 9.78669 15.3412 9.7833 15.2781 9.77989C14.9984 9.76477 14.7141 9.74941 14.4467 9.80334C13.6817 9.95662 13.0096 10.3068 12.5019 10.9241C12.4429 10.9949 12.3852 11.0668 12.2991 11.1741L12.2797 11.1984V10.0044ZM5.68164 18.5671H8.33242V10.01H5.68164V18.5671Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a x-bind:href="twitterUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1761 4.24268H19.9362L13.9061 11.0201L21 20.2427H15.4456L11.0951 14.6493L6.11723 20.2427H3.35544L9.80517 12.9935L3 4.24268H8.69545L12.6279 9.3553L17.1761 4.24268ZM16.2073 18.6181H17.7368L7.86441 5.78196H6.2232L16.2073 18.6181Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a x-bind:href="facebookUrl" target="_blank" class="hover:brightness-80">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 12.3038C22 6.74719 17.5229 2.24268 12 2.24268C6.47715 2.24268 2 6.74719 2 12.3038C2 17.3255 5.65684 21.4879 10.4375 22.2427V15.2121H7.89844V12.3038H10.4375V10.0872C10.4375 7.56564 11.9305 6.1728 14.2146 6.1728C15.3088 6.1728 16.4531 6.36931 16.4531 6.36931V8.84529H15.1922C13.95 8.84529 13.5625 9.6209 13.5625 10.4166V12.3038H16.3359L15.8926 15.2121H13.5625V22.2427C18.3432 21.4879 22 17.3257 22 12.3038Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    </ul> -->
                </div>
              
            </div>
        </section>

        <?php
        // Related Posts Section
        self::render_related_posts();
        
        // View Our Line-Up Section
        self::render_lineup_section();
    }

    private static function render_lineup_section() {
        // Check if Elementor is active and we're not in Elementor editor
        if (class_exists('\Elementor\Plugin') && !\Elementor\Plugin::$instance->editor->is_edit_mode() && !\Elementor\Plugin::$instance->preview->is_preview_mode()) {
            // Render the View Our Line-Up widget
            $widget = new View_Lineup_Widget();
            
            // Render the template directly using Elementor's frontend renderer
            $template_id = 3871; // Your saved template ID
            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
        } else {
            // Fallback to default content if Elementor is not available
            ?>
            <!-- <section class="bg-grey-custom py-10">
                <div class="container lineup-section">
                    <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                       
                        <div class="w-full lg:w-1/2">
                            <h2 class="text-3xl lg:text-4xl font-bold mb-4">View Our Line-Up</h2>
                            <p class="text-base lg:text-lg mb-6 text-gray-700">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.
                            </p>
                            <a href="<?php //echo esc_url(home_url('/our-line-up')); ?>" class="inline-flex items-center gap-2 px-6 py-3 border border-gray-800 rounded-lg bg-white hover:bg-gray-50 transition-colors duration-300 lineup-btn justify-center">
                                <span class="text-gray-800 font-medium">View Our Line-Up</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                        
                       
                        <div class="w-full lg:w-1/2">
                            <div class="relative">
                            <img src="<?php //echo esc_url(home_url('/wp-content/uploads/2025/07/view-lineup2-1.png'));?>" width="400" height="400" alt="Our Line-Up Models" class="w-full h-auto rounded-lg object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <?php
        }
    }

    private static function render_related_posts() {
        // Get current post categories
        $current_post_id = get_the_ID();
        $current_categories = get_the_category($current_post_id);
        $category_ids = array();
        
        if (!empty($current_categories)) {
            foreach ($current_categories as $category) {
                $category_ids[] = $category->term_id;
            }
        }

        // Query related posts
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'post__not_in' => array($current_post_id), // Exclude current post
            'orderby' => 'date',
            'order' => 'DESC',
        );

        // Add category filter if categories exist
        if (!empty($category_ids)) {
            $args['category__in'] = $category_ids;
        }

        $related_posts = get_posts($args);

        // If no related posts found by category, get recent posts
        if (empty($related_posts)) {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'post_status' => 'publish',
                'post__not_in' => array($current_post_id),
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $related_posts = get_posts($args);
        }
        ?>
        <section class="bg-grey-custom">
            <div class="container single-rel-posts">
                <div class="mb-6 flex justify-between releated-articles">
                    <div>
                        <h3 class="text-3xl sm:text-4xl">Related Articles</h3>
                        <p class="mb-4">More insights and tips from our experts</p>
                    </div>

                    

                    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 backdrop-blur-2xl px-6 btn">
                        <span class="text-black">View All the thread Page</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
                <ul class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 lg:gap-x-12 gap-y-12 mb-6 lg:mb-20">
                    <?php foreach ($related_posts as $_post): 
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