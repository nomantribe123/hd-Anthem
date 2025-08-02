<?php
get_header();

// Set posts per page and get current page
$posts_per_page = 6;
$paged = (isset($_GET['pg'])) ? max(1, intval($_GET['pg'])) : 1;

// Get current category
$category = get_queried_object();


// Set up custom query
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'cat' => $category->term_id,
    'post_status' => 'publish'
);

// Create a new query
$blog_query = new WP_Query($args);

// Get all categories for navigation
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true
));

// Display the header template
if (class_exists('\Elementor\Plugin')) {
    $header_template_id = 496;
    echo \Elementor\Plugin::$instance->frontend->get_builder_content($header_template_id, true);
}
?>

<section class=py-12">
    <?php get_template_part('template-parts/archive/post/loop', 'start'); ?>

    <?php get_template_part('template-parts/archive/post/loop', null, [
        'query' => $blog_query,
    ]); ?>

    <?php /*if ($blog_query->have_posts()) : ?>
        <div class="container">
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12 md:gap-y-20">
                <?php 
                $post_counter = 0;
                $total_posts = $blog_query->post_count;
                
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    $post_counter++;
                    ?>
                    <li class="h-full flex flex-col">
                        <a href="<?php the_permalink(); ?>" class="w-full h-106 mb-8">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', array('class' => 'w-full h-full object-cover object-center'));
                            } else {
                                $default_image = get_field('default_blog_post_feature_image', 'option');
                                if ($default_image) {
                                    echo '<img src="' . esc_url($default_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-full h-full object-cover object-center">';
                                }
                            }
                            ?>
                        </a>
                        <div class="grow flex flex-col justify-between gap-6">
                            <div>
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) :
                                    ?>
                                    <p class="font-bold font-din-next-stencil mb-2">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </p>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>" class="text-2xl font-black hover:mb-1">
                                    <?php the_title(); ?>
                                </a>
                                <p class="line-clamp-1"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            </div>
                            <div>
                                <div class="flex items-center gap-4 mb-6">
                                    <?php
                                    $author_id = get_the_author_meta('ID');
                                    $avatar = get_avatar($author_id, 48, '', '', array('class' => 'w-12 h-12 object-cover object-center rounded-full'));
                                    if ($avatar) :
                                        echo $avatar;
                                    endif;
                                    ?>
                                    <div>
                                        <p class="text-xl font-black"><?php the_author(); ?></p>
                                        <p class="text-sm">
                                            <span><?php echo get_the_date('d M Y'); ?></span>
                                            <span>.</span>
                                            <span><?php echo esc_html(get_reading_time()); ?> min read</span>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="group w-fit flex items-center gap-2">
                                    <span class="text-lg font-black">Read more</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.70697 16.9496L15.414 11.2426L9.70697 5.53564L8.29297 6.94964L12.586 11.2426L8.29297 15.5356L9.70697 16.9496Z"
                                              fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>

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

            <div class="flex justify-center items-center mt-12">
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
            </div>
        </div>
    <?php endif; */ ?>
</section>

<?php get_footer(); ?> 