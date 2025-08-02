<?php 

$product_counter = $args['product_counter'] ?? 0;

$blog_args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'post__not_in' => ($product_counter === 10 && isset($first_blog_id)) ? array($first_blog_id) : array()
);
$blog_query = new WP_Query($blog_args);


if (!$blog_query->have_posts()) {
    return;
}

while ($blog_query->have_posts()) {

    $blog_query->the_post();

    if ($product_counter === 4) {
        $first_blog_id = get_the_ID();
    }
    
    // Get post category
    $categories = get_the_category();
    $category_name = !empty($categories) ? $categories[0]->name : 'Category';
    
    // Get featured image or fallback from ACF options
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$featured_image) {
        $featured_image = get_field('default_blog_post_feature_image', 'option');
    }
    if (!$featured_image) {
        $featured_image = '/assets/sample-2-DPbfDUTs.jpg';
    }
    ?>
    <li class="md:aspect-[17/8] h-full flex flex-row justify-center md:justify-start px-8 py-6 md:py-8.5"
        style="background-image: linear-gradient(270deg, rgba(49, 52, 74, 0) 27.12%, #31344A 92.31%), url('<?php echo esc_url($featured_image); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="md:w-1/2 lg:w-1/3">
            <div class="mb-6">
                <div class="text-center md:text-left mb-6">
                    <p class="text-xs lg:text-base text-prortx-orange font-bold font-din-next-stencil uppercase mb-2"><?php echo esc_html($category_name); ?></p>
                    <h4 class="text-2xl md:text-3xl font-black mb-2"><?php the_title(); ?></h4>
                    <p class="text-white line-clamp-2">
                        <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                    </p>
                </div>
                <?php get_template_part('template-parts/post/author', null, [
                    'align' => 'justify-center md:justify-start items-center',
                    'text_color' => 'text-white',
                ]); ?>
            </div>
            <a href="<?php the_permalink(); ?>"
                class="group w-fit h-11 flex justify-center md:justify-start items-center gap-3 bg-white/12 backdrop-blur-2xl px-6 btn mx-auto md:mx-0">
                <span class="text-white">View More</span>
                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                        viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                            fill="currentColor"/>
                </svg>
            </a>
        </div>
    </li>
<?php }
wp_reset_postdata();
