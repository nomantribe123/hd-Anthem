<?php 

global $product;

$product_name = $product->get_name();

$featured_video_yt_id = get_field('featured_video_yt_id');
$featured_video_overlay = get_field('featured_video_overlay');

$variation_images_by_color = [];
if ($product->is_type('variable')) {
    $variation_ids = $product->get_children();
    
    foreach ($variation_ids as $variation_id) {
        $variation_obj = wc_get_product($variation_id);
        
        if (!$variation_obj) continue;
        $attributes = $variation_obj->get_attributes();

        foreach ($attributes as $attr_name => $attr_value) {
            if (strpos($attr_name, 'color') !== false || strpos($attr_name, 'colour') !== false) {
                $img_id = $variation_obj->get_image_id();
                if ($img_id) {
                    if (taxonomy_exists($attr_name)) {
                        $terms = get_terms([
                            'taxonomy' => $attr_name,
                            'hide_empty' => false,
                        ]);
                        
                        foreach ($terms as $term) {
                            if (
                                strtolower($term->slug) === strtolower($attr_value) ||
                                strtolower($term->name) === strtolower($attr_value)
                            ) {
                                $color_slug = $term->slug;
                                break;
                            }
                        }

                    } else {
                        $color_slug = sanitize_title($attr_value);
                    }

                    if (!empty($color_slug) && empty($variation_images_by_color[$color_slug])) {
                        $variation_images_by_color[$color_slug] = [
                            'id' => $img_id,
                            'url' => wp_get_attachment_image_url($img_id, 'full')
                        ];
                    }
                }
            }
        }
    }
}

?>
<div class="product-media">
    <?php if ($featured_video_yt_id) : ?>
        <div x-data="{ playing: false }" :class="playing ? 'show-video' : ''" class="yt-video">
            <div class="video-overlay" style="background-image: url('<?php echo esc_url($featured_video_overlay); ?>');">
                <button x-on:click="playing = true" class="video-play-button" data-for-video="<?php echo $featured_video_yt_id; ?>">
                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/play-button-icon.svg' ); ?>
                </button>

                <div class="video-background yt-video-embed" data-youtube-id="<?php echo $featured_video_yt_id; ?>" id="video-iframe-<?php echo $featured_video_yt_id; ?>"></div>
            </div>
        </div>
    <?php endif; ?>

    <div data-swiper="product">
        <div class="mb-4">
            <?php
            $attachment_ids = $product->get_gallery_image_ids();
            array_unshift($attachment_ids, $product->get_image_id());
            $main_slider_images = [];
            $used_image_urls = [];

            foreach ($attachment_ids as $attachment_id) {
                $img_url = wp_get_attachment_image_url($attachment_id, 'full');
                if ($img_url && !in_array($img_url, $used_image_urls, true)) {
                    $main_slider_images[] = [
                        'id' => $attachment_id,
                        'url' => $img_url,
                        'color_slug' => false
                    ];
                    $used_image_urls[] = $img_url;
                }
            }

            // Add variation images
            foreach ($variation_images_by_color as $color_slug => $data) {
                $image_url = $data['url'];
                $img_id = $data['id'];
                if ($image_url && !in_array($image_url, $used_image_urls, true)) {
                    $main_slider_images[] = [
                        'id' => $img_id,
                        'url' => $image_url,
                        'color_slug' => $color_slug
                    ];
                    $used_image_urls[] = $image_url;
                }
            }

            // Now, for each image, check if it's a variation image and set color_slug accordingly
            foreach ($main_slider_images as $idx => $img) {
                if ($img['color_slug'] === false) {
                    // Check if this image is a variation image
                    foreach ($variation_images_by_color as $color_slug => $data) {
                        if ($data['url'] === $img['url']) {
                            $main_slider_images[$idx]['color_slug'] = $color_slug;
                            break;
                        }
                    }
                }
            }

            $color_to_slide_index = [];
            $slide_index = 0;
            ?>
            <div data-swiper-product-primary class="swiper mb-4 aspect-[77/73] min-h-[500px] max-w-full">
                <div class="swiper-wrapper">
                    <?php foreach ($main_slider_images as $img): ?>
                        <div class="swiper-slide"
                            <?php if ($img['color_slug']) echo 'data-color-id="' . esc_attr($img['color_slug']) . '"'; ?>
                            data-slide-index="<?php echo esc_attr($slide_index); ?>">
                            <div x-data="magnifier()" class="relative w-full h-full">
                                <img src="<?php echo esc_url($img['url']); ?>"
                                    x-ref="magnifiable"
                                    alt="<?php echo esc_attr($product_name); ?>"
                                    class="w-full h-full object-cover object-center"/>
                                <div class="absolute top-5 right-5 flex flex-col gap-2">
                                    <button x-bind="zoomIn"
                                            x-transition
                                            class="w-10 h-10 flex justify-center items-center bg-white border border-neutral rounded-lg shadow-sm hover:brightness-80">
                                        <svg class="w-6 h-6"
                                            viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 6H9V9H6V11H9V14H11V11H14V9H11V6Z"
                                                fill="currentColor"/>
                                            <path d="M10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2ZM10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </button>
                                    <button x-bind="zoomOut"
                                            x-transition
                                            class="w-10 h-10 flex justify-center items-center bg-white border border-neutral rounded-lg shadow-sm hover:brightness-80">
                                        <svg class="w-6 h-6"
                                            viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 9H14V11H6V9Z"
                                                fill="currentColor"/>
                                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($img['color_slug']) {
                            $color_to_slide_index[$img['color_slug']] = $slide_index;
                        }
                        $slide_index++;
                    endforeach; ?>
                </div>
            </div>

            <div data-swiper-product-thumbs class="swiper" thumbsSlider="">
                <div class="swiper-wrapper">
                    <?php foreach ($main_slider_images as $img): 
                        $thumb_url = wp_get_attachment_image_url($img['id'], 'thumbnail');
                        if ($thumb_url): ?>
                            <div class="swiper-slide cursor-pointer">
                                <div class="w-full h-25 lg:h-34">
                                    <img src="<?php echo esc_url($thumb_url); ?>"
                                            alt="<?php echo esc_attr($product_name); ?>"
                                            class="w-full h-full! object-cover object-center"/>
                                </div>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        </div>

        <div class="flex justify-center items-center gap-12">
            <button data-swiper-navigation-previous
                    class="group disabled:cursor-not-allowed">
                <svg class="w-6 h-6 group-enabled:group-hover:-translate-x-1 duration-300"
                        viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.7069 17.293L8.41394 13H17.9999V11H8.41394L12.7069 6.70697L11.2929 5.29297L4.58594 12L11.2929 18.707L12.7069 17.293Z"
                            fill="currentColor"/>
                </svg>
            </button>
            <div data-swiper-pagination
                    class="w-fit! flex items-center gap-2"></div>
            <button data-swiper-navigation-next
                    class="group disabled:cursor-not-allowed">
                <svg class="w-6 h-6 group-enabled:group-hover:translate-x-1 duration-300"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                            fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
</div>