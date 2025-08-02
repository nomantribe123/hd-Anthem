<?php 
    global $post;
    $author_id = get_the_author_meta('ID');
    $author_avatar = get_avatar_url($author_id, ['size' => 96]);
    $reading_time = get_field('reading_time', $post->ID) ? get_field('reading_time', $post->ID) . ' min read' : '5 min read';
    $categories = get_the_category($post->ID);
    $category_name = !empty($categories) ? $categories[0]->name : 'Category';
?>
<li>
    <a href="<?php echo get_permalink($post->ID); ?>" class="mb-5">
        <?php 
        if (has_post_thumbnail($post->ID)) {
            echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'rounded-xxl w-full h-full! object-cover object-center']);
        } else {
            $default_image = get_field('default_blog_post_feature_image', 'option');
            if ($default_image) {
                echo '<img src="' . esc_url($default_image) . '" alt="' . esc_attr(get_the_title($post->ID)) . '" class="rounded-xxl w-full h-full! object-cover object-center">';
            }
        }
        ?>
    </a>
    <div class="lg:flex">
        <div class="col-span-3 lg:col-span-2">
            <p class="text-xs lg:text-sm mb-2"><?php echo esc_html($category_name); ?></p>
            <a href="<?php echo get_permalink($post->ID); ?>" class="text-2xl mb-2 hover:brightness-80"><?php echo get_the_title($post->ID); ?></a>
            <p class="line-clamp-2 text-xs lg:text-sm mb-4"><?php echo get_the_excerpt($post->ID); ?></p>
        </div>
        <div class="flex gap-2 items-start">
            <span class="tag text-xs lg:text-sm"><?php echo get_the_date('d M Y', $post->ID); ?></span>
            <span class="tag text-xs lg:text-sm"><?php echo esc_html($reading_time); ?></span>
        </div>
    </div>    
</li>