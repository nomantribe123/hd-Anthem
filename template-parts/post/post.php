<?php 
    global $post;
?>
<li class="h-full flex flex-col">
    <a href="<?php the_permalink(); ?>" class="w-full h-106 mb-8">
        <?php 
        if (has_post_thumbnail()) {
            the_post_thumbnail('large', array('class' => 'w-full h-full object-cover object-center'));
        } else {
            $default_image = get_field('default_blog_post_feature_image', 'option');
            if ($default_image) {
                echo '<img src="' . esc_url($default_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-36 h-full object-cover object-center">';
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
                <p class="font-bold font-din-next-stencil uppercase mb-2">
                    <?php echo implode(', ', wp_list_pluck($categories, 'name')); ?>
                </p>
            <?php endif; ?>

            <a href="<?php the_permalink(); ?>" class="text-2xl font-black uppercase hover:mb-1">
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