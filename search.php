<?php
get_header();
?>

<div class=py-12">
    <div class="container">
        <div class="lg:w-2/3 xl:w-3/5 mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'tribes-prortx'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </div>

            <!-- Search Form -->
            <div class="relative w-full sm:w-68 mx-auto mt-4 lg:mt-8 mb-12">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
                    <input type="search" name="s" value="<?php echo get_search_query(); ?>"
                           class="h-11 w-full border-[#9B9B9B] focus:border-black pr-12"
                           style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) -32.42%, rgba(49, 52, 74, 0.1406) 100%);">
                    <input type="hidden" name="post_type" value="any">
                    <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z" fill="currentColor"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Results Section -->
            <div class="space-y-12">
                <?php
                $search_query = get_search_query();
                
                // Get matching product categories
                $product_cats = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'name__like' => $search_query,
                    'hide_empty' => true
                ));

                // Show product categories if any match
                if (!empty($product_cats)) : ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-6">Matching Product Categories</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php foreach ($product_cats as $cat) : 
                                $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                                $image = $thumbnail_id ? wp_get_attachment_image_src($thumbnail_id, 'medium') : null;
                            ?>
                                <a href="<?php echo get_term_link($cat); ?>" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow block">
                                    <?php if ($image) : ?>
                                        <div class="aspect-video mb-4 overflow-hidden rounded-md">
                                            <img src="<?php echo esc_url($image[0]); ?>" 
                                                 alt="<?php echo esc_attr($cat->name); ?>" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="text-xl font-semibold"><?php echo $cat->name; ?></h3>
                                    <?php if ($cat->description) : ?>
                                        <p class="text-gray-600 mt-2"><?php echo wp_trim_words($cat->description, 15); ?></p>
                                    <?php endif; ?>
                                    <div class="text-sm text-gray-500 mt-2">
                                        <?php 
                                        $count = $cat->count;
                                        echo sprintf(_n('%s product', '%s products', $count, 'tribes-prortx'), number_format_i18n($count)); 
                                        ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Get unique product IDs
                $product_ids = get_unique_products_by_search($search_query);

                // Show products section if there are results
                if (!empty($product_ids)) : ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-6">Matching Products</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($product_ids as $product_id) :
                                $product = wc_get_product($product_id);
                                if (!$product) continue;
                            ?>
                                <article class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                    <div class="mb-4 aspect-square overflow-hidden rounded-md">
                                        <?php echo $product->get_image('medium', ['class' => 'w-full h-full object-cover']); ?>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold mb-2">
                                        <a href="<?php echo get_permalink($product_id); ?>" class="hover:brightness-90 transition-all">
                                            <?php echo $product->get_name(); ?>
                                        </a>
                                    </h3>

                                    <div class="text-lg font-bold mb-2"><?php echo $product->get_price_html(); ?></div>
                                    <div class="text-gray-600 mb-4"><?php echo wp_trim_words($product->get_short_description(), 15); ?></div>

                                    <a href="<?php echo get_permalink($product_id); ?>" class="inline-block  text-white px-4 py-2 rounded hover:brightness-90 transition-all">
                                        View Product
                                    </a>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Get unique post IDs
                $post_ids = get_unique_posts_by_search($search_query);

                // Show posts section if there are results
                if (!empty($post_ids)) : ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-6">Matching Posts</h2>
                        <div class="space-y-6">
                            <?php foreach ($post_ids as $post_id) :
                                $post = get_post($post_id);
                                setup_postdata($post);
                            ?>
                                <article class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                    <h3 class="text-2xl font-bold mb-3">
                                        <a href="<?php echo get_permalink($post_id); ?>" class="hover:brightness-90 transition-all">
                                            <?php echo get_the_title($post_id); ?>
                                        </a>
                                    </h3>
                                    
                                    <?php if (has_post_thumbnail($post_id)) : ?>
                                        <div class="mb-4">
                                            <?php echo get_the_post_thumbnail($post_id, 'medium', ['class' => 'rounded-md w-full h-auto']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="text-gray-600 mb-4">
                                        <?php echo get_the_excerpt($post_id); ?>
                                    </div>

                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span><?php echo get_the_date('', $post_id); ?></span>
                                        <a href="<?php echo get_permalink($post_id); ?>" class="hover:brightness-90 transition-all font-medium">
                                            Read More →
                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (empty($product_ids) && empty($post_ids) && empty($product_cats)) : ?>
                    <div class="text-center py-12">
                        <h2 class="text-2xl font-bold mb-4">No Results Found</h2>
                        <p class="text-gray-600">Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(); ?> 