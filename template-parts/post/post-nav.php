<?php 
    $post = $args['post'];

    $post = get_post($post);
    if ($post) {
        setup_postdata($post);
    } else {
        return;
    }
?>
<li class="grid grid-cols-1 lg:grid-cols-5 gap-4">
    <a href="<?php the_permalink(); ?>" class="lg:col-span-2">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('full', ['class' => 'aspect-video lg:aspect-[11/9] w-full rounded-lg object-cover object-center']); ?>
        <?php else: ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/sample-2.jpg" alt="Placeholder"
                class="w-full h-full object-cover object-center">
        <?php endif; ?>
    </a>
    <div class="lg:col-span-3 flex flex-col justify-center">
        <a href="<?php the_permalink(); ?>" class="mb-2 hover:brightness-80">
            <?php the_title(); ?>
        </a>
        <p class="line-clamp-2 text-sm mb-4"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
        <div>
            <span class="tag text-xs lg:text-sm"><?php echo get_the_date('j M Y'); ?></span>
        </div>
    </div>
</li>