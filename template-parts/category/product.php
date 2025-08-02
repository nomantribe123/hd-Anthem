<?php 

$category = $args['category'] ?? null;

if (!$category || !is_a($category, 'WP_Term')) {
    return;
}

$image_url = wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true));

?>
<li>
    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="flex gap-3 items-center">
        <img class="w-17 rounded-lg" src="<?php echo $image_url ? esc_url($image_url) : ""; ?>" alt="" />
        <h4 class="text-lg">
            <?php echo $category->name; ?>
        </h4>
    </a>
</li>