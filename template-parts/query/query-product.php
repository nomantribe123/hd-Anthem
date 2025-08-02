<?php
/**
 * Returns a WP_Query for products, handling filters and category.
 * Args:
 *   - current_category (object|null)
 *   - products_per_page (int|null)
 *   - paged (int|null)
 */
if (!function_exists('prortx_get_products_query')) {
    function prortx_get_products_query($args = []) {
        $current_category = isset($args['current_category']) ? $args['current_category'] : null;
        $products_per_page = isset($args['products_per_page']) ? $args['products_per_page'] : get_option('posts_per_page');
        $paged = isset($args['paged']) ? $args['paged'] : (get_query_var('paged') ? get_query_var('paged') : 1);

        $query_args = [
            'post_type' => 'product',
            'posts_per_page' => $products_per_page,
            'paged' => $paged,
            'orderby' => get_option('woocommerce_default_catalog_orderby', 'menu_order'),
            'order' => 'ASC',
            'post_status' => 'publish'
        ];

        // Apply WooCommerce sorting if set
        if (isset($_GET['orderby'])) {
            $ordering = WC()->query->get_catalog_ordering_args();
            $query_args['orderby'] = $ordering['orderby'];
            $query_args['order'] = $ordering['order'];
            if (isset($ordering['meta_key'])) {
                $query_args['meta_key'] = $ordering['meta_key'];
            }
        }

        // Build tax_query
        $tax_query = [];

        // Handle attribute filters
        foreach ($_GET as $key => $value) {
            if (strpos($key, 'filter_') === 0) {
                $attribute = str_replace('filter_', '', $key);
                $taxonomy = 'pa_' . $attribute;

                if (!empty($value)) {
                    $terms = explode(',', wc_clean($value));
                    $tax_query[] = [
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $terms,
                        'operator' => 'IN',
                    ];
                }
            }
        }

        // Add category filter if set
        if ($current_category && isset($current_category->term_id)) {
            $tax_query[] = [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $current_category->term_id,
                'operator' => 'IN',
                'include_children' => true
            ];
        }

        // Only add relation if there are multiple tax queries
        if (count($tax_query) > 1) {
            $tax_query = array_merge([ 'relation' => 'AND' ], $tax_query);
        }

        if (!empty($tax_query)) {
            $query_args['tax_query'] = $tax_query;
        }

        return new WP_Query($query_args);
    }
}
?>
