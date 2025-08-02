<?php

$products_query = $args['query'] ?? null;

if (!$products_query) {
    return;
}
?>

<!-- Product Grid -->
<div id="cat-wc-grid-outer">
    <template x-if="isGridView()">
        <div>
            <?php if ($products_query->have_posts()) : ?>
                <div>
                    <?php do_action('woocommerce_before_shop_loop'); ?>
                    <ul class="clear grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-8 gap-y-8 lg:gap-y-12 pb-8 lg:pb-12 cat-wc-loopin">
                        <?php
                        $product_counter = 0;
                        $first_blog_id = null;

                        while ($products_query->have_posts()) :
                            $products_query->the_post();

                            global $product;
                            get_template_part('template-parts/product/post', null, array('product_counter' => $product_counter));


                            if ($product_counter === 4 || $product_counter === 9) {
                                get_template_part('template-parts/post/post', 'grid', array('product_counter' => $product_counter));
                            }
                            $product_counter++;
                        endwhile;
                        wp_reset_postdata(); ?>
                    </ul>
                </div>
                <?php get_template_part('template-parts/archive/pagination', null, ['query' => $products_query]);
                do_action('woocommerce_after_shop_loop');
            else :
                do_action('woocommerce_no_products_found');
            endif ?>
        </div>
    </template>
    <template x-if="isListView()">
        <?php if ($products_query->have_posts()) : ?>
            <div>
                <ul class="flex flex-col gap-y-8 md:gap-y-12 pb-8 lg:pb-12 cat-wc-loopin mx-auto">
                    <?php
                        $products_query->rewind_posts();
                        while ($products_query->have_posts()) : 
                            $products_query->the_post();
                            get_template_part('template-parts/product/post', 'list');

                            if ($product_counter === 4 || $product_counter === 10) {
                                get_template_part('template-parts/post/post', 'list', array('product_counter' => $product_counter));
                            }
                            $product_counter++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                </ul>
                <?php get_template_part('template-parts/archive/pagination', null, ['query' => $products_query]); ?>
                <?php do_action('woocommerce_after_shop_loop'); ?>
            </div>
        <?php else :
            do_action('woocommerce_no_products_found');
        endif ?>
    </template>
</div>