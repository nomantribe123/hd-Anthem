<?php
/**
 * Template part for product filters drawer
 */


$parent_id = is_product_category() ? get_queried_object_id() : 0;

// Get all product attributes
$attribute_taxonomies = wc_get_attribute_taxonomies();

$categories = get_terms([
    'taxonomy' => 'product_cat',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'parent' => $parent_id,
]);

// Define your colour groups by term slug (or name)
$color_groups = [
    'Red Shades' => ['red', 'burgundy', 'crimson'],
    'Green Shades' => ['green', 'lime', 'olive'],
    'Blue Shades' => ['blue', 'navy', 'sky-blue'],
    // Add more groups as needed
];

$current_category = get_queried_object();
$product_categories = get_terms(['taxonomy'   => "product_cat"]);

?>

<div 
    x-data="{
        accordions: [],
        groupAccordions: [],
        openAll() {
            this.accordions.forEach(acc => acc.open = true);
            this.groupAccordions.forEach(acc => acc.open = true);
        }
    }"
    x-on:register-accordion.window="accordions.push($event.detail)"
    x-on:register-group-accordion.window="groupAccordions.push($event.detail)"
>
    <div class="flex flex-wrap justify-between items-center gap-2 mb-12">
        <p class="text-2xl font-bold">Filters</p>
        <a href="<?php echo esc_url(remove_query_arg(array_keys($_GET))); ?>">Clear all</a>
    </div>

    <div class="lg:flex lg:gap-x-12 mb-8">
        <div class="mb-6">
            <button type="button" class="btn bg-gray-mid rounded-full" @click="openAll()">
                View All
            </button>
        </div>
        <ul class="mini-categories-list flex-wrap flex gap-x-4 gap-y-10"> 
            <?php foreach($product_categories as $product_category) {
                if ($product_category->term_id === $current_category->term_id) continue;
                get_template_part('template-parts/category/product', null, [
                    'category' => $product_category
                ]);
            } ?>
        </ul>
    </div>

    <div>
        <?php $total_products = wc_get_loop_prop('total');
        printf('<p class="mb-10">Showing %d Products</p>', $total_products);
        ?>
    </div>

    <form id="product-filters-form" method="get" action="">
        <?php
        // Preserve category parameter if on category page
        if (is_product_category()) {
            $current_cat = get_queried_object();
            echo '<input type="hidden" name="product_cat" value="' . esc_attr($current_cat->slug) . '">';
        }

        // Preserve search parameter if exists
        if (isset($_GET['s'])) {
            echo '<input type="hidden" name="s" value="' . esc_attr($_GET['s']) . '">';
        }

        // Preserve orderby parameter if exists
        if (isset($_GET['orderby'])) {
            echo '<input type="hidden" name="orderby" value="' . esc_attr($_GET['orderby']) . '">';
        }

        
        if ($categories) :
            // Get checked categories from query string
            $checked_categories = [];
            if (isset($_GET['category'])) {
                // Support both single and multiple values
                if (is_array($_GET['category'])) {
                    $checked_categories = array_map('wc_clean', $_GET['category']);
                } else {
                    $checked_categories = array_map('wc_clean', explode(',', $_GET['category']));
                }
            }
        ?>
            <div class="mb-8">
                <ul class="grid grid-cols-2 lg:grid-cols-4">
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <label class="inline-flex items-center gap-2 cursor-pointer hover:relative">
                                <input type="checkbox"
                                       class="peer hidden h-5 w-5"
                                       name="category[]"
                                       value="<?php echo esc_attr($category->slug); ?>"
                                       <?php checked(in_array($category->slug, $checked_categories)); ?>>
                                <span class="text-sm whitespace-nowrap transition-colors">
                                    <?php echo esc_html($category->name); ?>
                                </span>
                                <svg class="w-4 h-4 hidden peer-checked:inline"
                                     fill="none" viewBox="0 0 16 16">
                                    <path d="M4 8l3 3 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php foreach ($attribute_taxonomies as $tax) :
            $taxonomy = wc_attribute_taxonomy_name($tax->attribute_name);
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
            ]);

            if (!empty($terms) && !is_wp_error($terms)) :
                $filter_name = 'filter_' . $tax->attribute_name;
                $current_filter = isset($_GET[$filter_name]) ? explode(',', wc_clean($_GET[$filter_name])) : array();
                ?>
                <div 
                    class="filter-section border-t border-black"
                    x-data="accordion()"
                    x-init="$dispatch('register-accordion', $data)"
                >
                    <button type="button" class="accordion-trigger w-full flex justify-between items-center gap-4 py-5" @click="open = !open">
                        <span class="text-lg font-black"><?php echo esc_html($tax->attribute_label); ?></span>
                        <span :class="{'rotate-180': open}">
                            <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/chevron-down-in-circle.svg' ); ?>
                        </span>
                    </button>
                    
                    <div class="filter-content overflow-hidden transition-all duration-300 mb-4 lg:mb-12" x-show="open" x-collapse>
                        <div class="">
                            <?php if ($tax->attribute_name === 'colour'): ?>
                                <div class="flex flex-wrap gap-6">
                                    <?php
                                    // Group terms by the built-in group field from the Variation Swatches plugin
                                    $groups = [];
                                    foreach ($terms as $term) {
                                        $group_slug = get_term_meta($term->term_id, 'group_name', true);
                                        if (!$group_slug) $group_slug = 'other-colours';
                                        $groups[$group_slug][] = $term;
                                    }
                                    foreach ($groups as $group_slug => $group_terms) {
                                        // Get the group term object from the group taxonomy (adjust 'group_name' if needed)
                                        $group_term = get_term_by('slug', $group_slug, 'group_name');
                                        $group_label = $group_term && !is_wp_error($group_term) ? $group_term->name : ucwords(str_replace('-', ' ', $group_slug));
                                        ?>
                                        <div class="rounded-xxl max-w-full h-11 flex py-2 px-3 gap-4 items-center border border-[#CACACA] color-group-accordion"
                                             x-data="{ open: false }"
                                             x-init="$dispatch('register-group-accordion', $data)">
                                            <!-- Group Dropdown Trigger -->
                                            <button type="button"
                                                class="flex flex-1 items-center w-full justify-between"
                                                @click.stop="open = !open">
                                                <span class="flex items-center gap-2">
                                                    <span class="text-xl flex items-center gap-1">
                                                        <?php
                                                        $color = $group_terms[0]->name;
                                                        $hex = get_term_meta($group_terms[0]->term_id, 'product_attribute_color', true);
                                                        echo get_color_swatch_html($color . "|" . $hex . "|" . $group_terms[0]->slug, 'large'); 
                                                        
                                                        ?>
                                                    </span>
                                                    <span class="font-semibold whitespace-nowrap"><?php echo esc_html($group_label); ?></span>
                                                </span>
                                            </button>
                                            <!-- Group Dropdown Content -->
                                            <div x-show="open" x-collapse class="overflow-auto">
                                                <div class="flex items-center">
                                                    <?php foreach ($group_terms as $term): ?>
                                                        <label class="whitespace-nowrap flex items-center justify-between gap-2 px-3 py-2 cursor-pointer mb-0!">
                                                            <span class="relative self-center">
                                                                <input type="checkbox"
                                                                    class="custom-radio"
                                                                    name="<?php echo esc_attr($filter_name); ?>"
                                                                    value="<?php echo esc_attr($term->slug); ?>"
                                                                    <?php checked(in_array($term->slug, $current_filter)); ?>>
                                                            </span>
                                                            <span class="flex items-center gap-2">
                                                                <?php
                                                                $color = $term->name;
                                                                $hex = get_term_meta($term->term_id, 'product_attribute_color', true);
                                                                echo get_color_swatch_html($color . "|" . $hex . "|" . $term->slug); ?>
                                                                <span class="text-sm"><?php echo esc_html($term->name); ?></span>
                                                            </span>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <svg @click.stop="open = !open" class="w-6 h-6 transition-transform duration-300" :class="{'rotate-180': open}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.70697 16.9496L15.414 11.2426L9.70697 5.53564L8.29297 6.94964L12.586 11.2426L8.29297 15.5356L9.70697 16.9496Z" fill="currentColor"/>
                                            </svg>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php elseif ($tax->attribute_name === 'size'): ?>
                                <div class="flex flex-wrap gap-4 lg:gap-x-5 lg:max-w-1/2">
                                    <?php foreach ($terms as $term) : ?>
                                        <label class="inline-flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" class="h-5 w-5" name="<?php echo esc_attr($filter_name); ?>[]" value="<?php echo esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $current_filter)); ?>>
                                            <span class="text-sm whitespace-nowrap"><?php echo esc_html($term->name); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div class="flex flex-wrap gap-4 lg:gap-x-5 lg:max-w-1/2">
                                    <?php foreach ($terms as $term) : ?>
                                        <label class="inline-flex items-center gap-2 cursor-pointer">
                                            <input type="radio" class="custom-radio h-5 w-5" name="<?php echo esc_attr($filter_name); ?>" value="<?php echo esc_attr($term->slug); ?>" <?php checked(in_array($term->slug, $current_filter)); ?>>
                                            <span class="text-sm whitespace-nowrap"><?php echo esc_html($term->name); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif;
        endforeach; ?>
        <div class="flex gap-4 mt-8">
            <button type="submit" id="apply-filters-btn" class="btn btn--dark justify-center w-full">
                <span class="filter-btn-text">Apply Filters</span>
                <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/right-arrow-alt.svg' ); ?>
            </button>
        </div>
    </form>
</div>

<style>
/* .filter-section {
    border-top: 1px solid #31344A;
} */

.filter-content {
    transition: height 0.3s ease-in-out;
}

/* Custom checkbox styles */
.custom-checkbox:checked + div {
    border-color: #31344A;
}

.custom-checkbox:checked + div svg {
    display: block;
}

.custom-checkbox:focus + div {
    outline: 2px solid #31344A;
    outline-offset: 2px;
}

/* Custom radio styles */
.custom-radio:checked + div {
    border-color: #31344A;
    opacity: 0;
}

.custom-radio:checked + div div {
    display: block;
}

.custom-radio:focus + div {
    outline: 2px solid #31344A;
    outline-offset: 2px;
}
</style>

<?php
/**
 * Helper function to get accurate term counts for attribute terms
 */
function get_term_count_for_attribute($term_id, $taxonomy) {
    global $wpdb;
    
    $sql = $wpdb->prepare(
        "SELECT COUNT(DISTINCT p.ID) FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        WHERE tt.taxonomy = %s
        AND tt.term_id = %d
        AND p.post_type = 'product'
        AND p.post_status = 'publish'",
        $taxonomy,
        $term_id
    );
    
    return $wpdb->get_var($sql);
}
?>