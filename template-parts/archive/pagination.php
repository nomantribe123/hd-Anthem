<?php 

$query = $args['query'] ?? null;

$per_page = $query->get('posts_per_page') ?: get_option('posts_per_page');

if (!$query || !$query->have_posts()) {
    return; // No products to display
}

// Add pagination if needed
$total_pages = $query->max_num_pages;
if ($total_pages > 1) :
    $current_page = get_query_var('paged');
    if (!$current_page) {
        $current_page = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
        if ($current_page < 1 && isset($_GET['page'])) {
            $current_page = intval($_GET['page']);
        }
        if ($current_page < 1) {
            $current_page = 1;
        }
    }
    $total_products = $query->found_posts;
    $per_page = $per_page;
    $showing_start = (($current_page - 1) * $per_page) + 1;
    $showing_end = min($current_page * $per_page, $total_products);
    ?>

    <div class="flex flex-col items-center gap-4 mt-8">
        <?php printf('<p class="text-center mb-4">Showing %d - %d of %d Results</p>', $showing_start, $showing_end, $total_products); ?>
        
        <ul class="flex items-center gap-4">
            <?php     
                for ($i = 1; $i <= $total_pages; $i++) {
                    $is_current = $current_page == $i;
                    printf(
                        '<li class="group%s"><a href="%s" class="min-w-10 h-10 flex justify-center items-center bg-[#31344A0D] border border-transparent rounded-full group-[.active]:bg-[#31344A1A] group-[.active]:border-black hover:bg-[#31344A1A]">%d</a></li>',
                        $is_current ? ' active' : '',
                        get_pagenum_link($i),
                        $i
                    );
                }
            ?>
        </ul>
    </div>
<?php endif ?>