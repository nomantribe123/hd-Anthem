<?php 

$category = $args['category'] ?? null;

if (!$category || !is_a($category, 'WP_Term')) {
    return;
}

$button_text = $args['button_text'] ?? 'View More';

$catTitle = $category->name;
$catDescription = !empty($args['custom_description']) ? $args['custom_description'] : $category->description;

$image_url = !empty($args['background_image']['url']) ? $args['background_image']['url'] : wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true));

?>
<li class="rounded-xxl">
    <img src="<?php echo $image_url ? esc_url($image_url) : ""; ?>" alt="" />
    <div class="white-overlay"></div>
    <div class="content w-full h-full flex flex-col justify-end py-4 px-16 lg:py-20 sm:px-8 md:px-12">
        <h2 class="text-5xl font-black mb-2"><?php echo $catTitle; ?></h2>
        <p class="mb-8"><?php echo $catDescription; ?></p>
        <a href="<?php echo esc_url(get_term_link($category)); ?>"
            class="group w-fit h-11 flex justify-center items-center gap-3 bg-white/12 backdrop-blur-2xl px-6 btn">
            <span><?php echo esc_html($button_text); ?></span>
            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                        fill="currentColor"/>
            </svg>
        </a>
    </div>
</li>