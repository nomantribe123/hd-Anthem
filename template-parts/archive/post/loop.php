<?php 
    $blog_query = $args['query'] ?? null;

    if (!$blog_query) {
        return;
    }

?>
<?php if ($blog_query->have_posts()) : ?>
    <div class="container">
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12 md:gap-y-20">
            <?php 
            $post_counter = 0;
            $total_posts = $blog_query->post_count;
            
            while ($blog_query->have_posts()) : $blog_query->the_post();
                $post_counter++; ?>
                <?php get_template_part('template-parts/post/post'); ?>                
                <?php
                // Show newsletter only once after first two posts
                    if ($post_counter === 2) : ?>
        </ul>
    </div>
    <?php
        // Display the newsletter template
        if (class_exists('\Elementor\Plugin')) {
            $newsletter_template_id = 479;
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($newsletter_template_id, true);
        }
    ?>
    <div class="container">
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12 md:gap-y-20 mb-8 lg:mb-12">
                    <?php endif; ?>
                
            <?php endwhile; ?>
        </ul>

        <?php get_template_part('template-parts/archive/pagination', null, [
            'query' => $blog_query,
        ]); ?>

        <?php /*<div class="flex justify-center items-center mt-12">
            <div>
                <?php
                $total_posts = $blog_query->found_posts;
                $posts_per_page = 6;
                $current_page = max(1, get_query_var('paged'));
                $start_post = (($current_page - 1) * $posts_per_page) + 1;
                $end_post = min($current_page * $posts_per_page, $total_posts);
                ?>
                <p class="mb-4">Showing <?php echo $start_post; ?> - <?php echo $end_post; ?> Results</p>
                
                <ul class="flex items-center gap-4">
                    <?php
                    $total_pages = ceil($total_posts / $posts_per_page);
                    
                    // Previous page
                    if ($current_page > 1) : ?>
                        <!-- <li class="group">
                            <a href="<?php echo get_pagenum_link($current_page - 1); ?>" 
                            class="min-w-10 h-10 flex justify-center items-center bg-[#31344A0D] border border-transparent rounded-full hover:bg-[#31344A1A]">
                                Previous
                            </a>
                        </li> -->
                    <?php endif; ?>

                    <?php
                    // Page numbers
                    for ($i = 1; $i <= $total_pages; $i++) :
                        $is_current = $current_page === $i;
                    ?>
                        <li class="group <?php echo $is_current ? 'active' : ''; ?>">
                            <a href="<?php echo get_pagenum_link($i); ?>"
                            class="min-w-10 h-10 flex justify-center items-center bg-[#31344A0D] border border-transparent rounded-full group-[.active]:bg-[#31344A1A] group-[.active]:border-black hover:bg-[#31344A1A]">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php
                    // Next page
                    if ($current_page < $total_pages) : ?>
                        <!-- <li class="group">
                            <a href="<?php echo get_pagenum_link($current_page + 1); ?>"
                            class="min-w-10 h-10 flex justify-center items-center bg-[#31344A0D] border border-transparent rounded-full hover:bg-[#31344A1A]">
                                Next
                            </a>
                        </li> -->
                    <?php endif; ?>
                </ul>
            </div>
        </div> */ ?>
    </div>
<?php endif; ?>