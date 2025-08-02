<?php 

$show_search = (is_category() || $args['show_search']) ?? false;
$search_placeholder = $args['search_placeholder'] ?? 'Search';
$show_filters =  (is_category() || $args['show_filter']) ?? false;

$current_category = is_category() ? get_queried_object() : null;

// Get all categories
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true
));

?>

<div class="container">
    <div class="flex flex-wrap justify-between items-center gap-10 mb-12">
        <?php if ($show_search) : ?>
            <div class="relative w-full sm:w-72">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" name="s" placeholder="<?php echo $search_placeholder ?>" id="blog-search" value="<?php echo get_search_query(); ?>" class="h-11 w-full border border-[#9B9B9B] focus:border-black pl-4 pr-4 text-black"
                        style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) -32.42%, rgba(49, 52, 74, 0.1406) 100%);">
                        <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2" >
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                                    fill="currentColor"/>
                        </svg>
                    </button>
                </form>
            </div>
        <?php endif; ?>

        <?php if ($show_filters) : ?>
            <?php get_template_part('template-parts/archive/filters-category', 'blog', [
                'categories' => $categories,
                'current_category' => $current_category,
            ]); ?>
        <?php endif; ?>
    </div>
</div>