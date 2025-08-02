<?php
/**
 * Active Filters Template Part
 */
$active_filters = WC_Query::get_layered_nav_chosen_attributes();
if (!empty($active_filters)) :
    echo '<div class="active-filters mt-2 justify-between items-center mb-8 lg:mb-12">';
    echo '<div class="flex flex-wrap items-center gap-2">';
    echo '<p class="text-sm">Active Filters:</p>';
    foreach ($active_filters as $taxonomy => $data) {
        $terms = $data['terms'];
        $taxonomy_obj = get_taxonomy($taxonomy);
        if ($taxonomy_obj) {
            foreach ($terms as $term_slug) {
                $term = get_term_by('slug', $term_slug, $taxonomy);
                if ($term) {
                    $filter_link = remove_query_arg('filter_' . str_replace('pa_', '', $taxonomy));
                    echo '<span class="inline-flex items-center gap-2 bg-[#31344A0A] px-3 py-1 text-sm">';
                    echo esc_html($taxonomy_obj->labels->singular_name . ': ' . $term->name);
                    echo '<a href="' . esc_url($filter_link) . '" class="">Clear</a>';
                    echo '</span>';
                }
            }
        }
    }
    echo '</div>';
    echo '</div>';
endif;
?>
