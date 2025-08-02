<?php 
    // Get post author info
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author();
    $author_avatar = get_avatar_url($author_id, array('size' => 96));

    $post_date = get_the_date('d M Y');
    $reading_time = get_reading_time(get_the_content());

    $align = $args['align'] ?? 'justify-center items-center';
    $text_color = $args['text_color'] ?? 'text-white';
?>
<div class="<?php echo $align ?> flex gap-4">
    <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>"
            class="w-12 h-12 object-cover object-center rounded-full">
    <div>
        <p class="<?php echo $text_color ?> mb-1"><?php echo esc_html($author_name); ?></p>
        <p class="text-sm <?php echo $text_color ?>">
            <span><?php echo esc_html($post_date); ?></span>
            <span>.</span>
            <span><?php echo esc_html($reading_time); ?> min read</span>
        </p>
    </div>
</div>