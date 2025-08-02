<?php
/**
 * Template Name: Events
 */

get_header(); ?>

<?php the_content(); ?>

<?php 
// Events listing section starts here
$event_categories = get_terms([
    'taxonomy' => 'event_category',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
    'parent' => 0
]);

$current_category = isset($_GET['event_category']) ? sanitize_text_field($_GET['event_category']) : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'event',
    'posts_per_page' => 5,
    'paged' => $paged,
    'orderby' => array(
        'meta_value' => 'ASC',
        'event_order' => 'ASC'
    ),
    'meta_key' => 'event_date',
    'meta_query' => array(
        'event_order' => array(
            'key' => 'event_order',
            'type' => 'NUMERIC',
            'compare' => 'EXISTS'
        )
    )
);

if (!empty($current_category)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'event_category',
            'field' => 'slug',
            'terms' => $current_category
        )
    );
}

$events_query = new WP_Query($args);
$events = $events_query->posts;
?>

<div id="events-listing-wrapper">
    <section class=pb-30">
        <div class="container">
            <div class="xl:w-2/3 mx-auto">
                <!-- Category Filter Bar - Desktop -->
                <div class="hidden lg:flex flex-wrap justify-between gap-x-8 mb-12">
                    <div>
                        <a href="<?php echo esc_url(remove_query_arg(['event_category', 'page', 'paged'], get_pagenum_link(1))); ?>" 
                           class="border px-8 py-4 <?php echo empty($current_category) ? 'peer-checked:bg-[#31344A0A] border-black' : 'border-transparent'; ?>">
                            View All
                        </a>
                    </div>
                    <?php if (!empty($event_categories)) : ?>
                        <ul class="flex flex-wrap items-center">
                            <?php foreach ($event_categories as $category) : 
                                // Remove pagination parameters and add category
                                $category_url = remove_query_arg(['page', 'paged'], get_pagenum_link(1));
                                $category_url = add_query_arg('event_category', $category->slug, $category_url);
                            ?>
                                <li>
                                    <a href="<?php echo esc_url($category_url); ?>" 
                                       class="border px-8 py-4 <?php echo $current_category === $category->slug ? 'peer-checked:bg-[#31344A0A] border-black' : 'border-transparent'; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Mobile Filter -->
                <div x-data="{ open: false }" class="block lg:hidden pt-12 mb-8">
                    <div class="w-full mb-4">
                        <button @click="open = !open" 
                                class="w-full h-12 flex justify-between items-center gap-2 bg-[#31344A0A] border border-black px-4">
                            <span>Categories</span>
                            
                            <svg class="w-6 h-6 transform" 
                                 :class="{'rotate-180': open}"
                                 viewBox="0 0 24 24" 
                                 fill="none" 
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" 
                                      fill="currentColor"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition 
                             class="mt-2 border border-black">
                            <a href="<?php echo esc_url(remove_query_arg(['event_category', 'page', 'paged'], get_pagenum_link(1))); ?>" 
                               class="block px-4 py-3 <?php echo empty($current_category) ? 'bg-[#31344A0A]' : ''; ?>">
                                View All
                            </a>
                            <?php foreach ($event_categories as $category) : 
                                // Remove pagination parameters and add category for mobile
                                $category_url = remove_query_arg(['page', 'paged'], get_pagenum_link(1));
                                $category_url = add_query_arg('event_category', $category->slug, $category_url);
                            ?>
                                <a href="<?php echo esc_url($category_url); ?>" 
                                   class="block px-4 py-3 <?php echo $current_category === $category->slug ? 'bg-[#31344A0A]' : ''; ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($events)) : ?>
                    <ul class="space-y-8 mb-4 lg:mb-8">
                        <?php foreach ($events as $event) : 
                            setup_postdata($event);
                            $categories = wp_get_post_terms($event->ID, 'event_category', array('fields' => 'all'));
                            $category_names = wp_list_pluck($categories, 'name');
                            $event_date = get_post_meta($event->ID, 'event_date', true);
                            $event_time = get_post_meta($event->ID, 'event_time', true);
                            $event_location = get_post_meta($event->ID, 'event_location', true);
                            $event_link = get_post_meta($event->ID, 'event_link', true);
						    $button_text = get_field('button_text', $event->ID);
                            
                            // Get featured image or default from ACF
                            if (has_post_thumbnail($event->ID)) {
                                $event_image = get_the_post_thumbnail_url($event->ID, 'full');
                            } else {
                                $event_image = get_field('default_events_post_feature_image', 'option');
                            }
                        ?>
                            <li x-data="{ open: false }"
                                class="border  aria-expanded:bg-[#0000000A] aria-expanded:border-black not-aria-expanded:opacity-50 duration-300"
                                :class="{'bg-[#0000000A] border-black': open}"
                                :aria-expanded="open">
                                <button @click="open = !open"
                                        class="relative w-full flex flex-col lg:flex-row justify-between lg:items-center gap-4 text-left px-6 py-5"
                                        :aria-expanded="open">
                                    <div>
                                        <p class="font-bold font-din-next-stencil mb-2 uppercase">
                                            <?php echo esc_html(implode(', ', $category_names)); ?>
                                        </p>
                                        <p class="block lg:hidden text-2xl lg:text-xl font-black duration-300">
                                            <?php echo esc_html($event->post_title); ?>
                                        </p>
                                        <p x-cloak x-show="!open" x-transition
                                           class="hidden lg:block text-2xl lg:text-xl font-black duration-300">
                                            <?php echo esc_html($event->post_title); ?>
                                        </p>
                                    </div>
                                    <div x-cloak x-show="!open" x-transition
                                         class="flex flex-col lg:flex-row justify-between lg:items-center gap-x-12 gap-y-4">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 11H9V13H7V11ZM7 15H9V17H7V15ZM11 11H13V13H11V11ZM11 15H13V17H11V15ZM15 11H17V13H15V11ZM15 15H17V17H15V15Z"
                                                      fill="currentColor"/>
                                                <path d="M5 22H19C20.103 22 21 21.103 21 20V6C21 4.897 20.103 4 19 4H17V2H15V4H9V2H7V4H5C3.897 4 3 4.897 3 6V20C3 21.103 3.897 22 5 22ZM19 8L19.001 20H5V8H19Z"
                                                      fill="currentColor"/>
                                            </svg>
                                            <span class="text-nowrap"><?php echo esc_html($event_date); ?></span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                                      fill="currentColor"/>
                                                <path d="M13 7H11V12.414L14.293 15.707L15.707 14.293L13 11.586V7Z"
                                                      fill="currentColor"/>
                                            </svg>
                                            <span class="text-nowrap"><?php echo esc_html($event_time); ?></span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.0001 14C14.2061 14 16.0001 12.206 16.0001 10C16.0001 7.794 14.2061 6 12.0001 6C9.79406 6 8.00006 7.794 8.00006 10C8.00006 12.206 9.79406 14 12.0001 14ZM12.0001 8C13.1031 8 14.0001 8.897 14.0001 10C14.0001 11.103 13.1031 12 12.0001 12C10.8971 12 10.0001 11.103 10.0001 10C10.0001 8.897 10.8971 8 12.0001 8Z"
                                                      fill="currentColor"/>
                                                <path d="M11.4201 21.814C11.5893 21.9349 11.7921 21.9998 12.0001 21.9998C12.2081 21.9998 12.4108 21.9349 12.5801 21.814C12.8841 21.599 20.0291 16.44 20.0001 10C20.0001 5.589 16.4111 2 12.0001 2C7.58909 2 4.00009 5.589 4.00009 9.995C3.97109 16.44 11.1161 21.599 11.4201 21.814ZM12.0001 4C15.3091 4 18.0001 6.691 18.0001 10.005C18.0211 14.443 13.6121 18.428 12.0001 19.735C10.3891 18.427 5.97909 14.441 6.00009 10C6.00009 6.691 8.69109 4 12.0001 4Z"
                                                      fill="currentColor"/>
                                            </svg>
                                            <span><?php echo esc_html($event_location); ?></span>
                                        </div>
                                    </div>
                                    <svg class="absolute lg:static top-5 right-6 w-6 h-6 duration-300"
                                         :class="{'rotate-180': open}"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z"
                                              fill="currentColor"/>
                                    </svg>
                                </button>
                                <div x-show="open" 
                                     x-transition 
                                     class="px-6 pb-6">
                                    <div class="grid grid-cols-5 gap-6">
                                        <div class="col-span-5 lg:col-span-2">
                                            <?php if ($event_image) : ?>
                                                <img src="<?php echo esc_url($event_image); ?>" alt="<?php echo esc_attr($event->post_title); ?>"
                                                     class="w-full h-full object-cover object-center">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-span-5 lg:col-span-3">
                                            <div class="flex flex-col h-full justify-between">
                                                <div>
                                                    <h2 class="hidden lg:block text-4xl font-black mb-6"><?php echo esc_html($event->post_title); ?></h2>
                                                    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 mb-6 lg:mb-12">
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-6 h-6" viewBox="0 0 24 24"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7 11H9V13H7V11ZM7 15H9V17H7V15ZM11 11H13V13H11V11ZM11 15H13V17H11V15ZM15 11H17V13H15V11ZM15 15H17V17H15V15Z"
                                                                    fill="currentColor"/>
                                                                <path d="M5 22H19C20.103 22 21 21.103 21 20V6C21 4.897 20.103 4 19 4H17V2H15V4H9V2H7V4H5C3.897 4 3 4.897 3 6V20C3 21.103 3.897 22 5 22ZM19 8L19.001 20H5V8H19Z"
                                                                    fill="currentColor"/>
                                                            </svg>
                                                            <span class="text-nowrap"><?php echo esc_html($event_date); ?></span>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                                                    fill="currentColor"/>
                                                                <path d="M13 7H11V12.414L14.293 15.707L15.707 14.293L13 11.586V7Z"
                                                                    fill="currentColor"/>
                                                            </svg>
                                                            <span class="text-nowrap"><?php echo esc_html($event_time); ?></span>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.0001 14C14.2061 14 16.0001 12.206 16.0001 10C16.0001 7.794 14.2061 6 12.0001 6C9.79406 6 8.00006 7.794 8.00006 10C8.00006 12.206 9.79406 14 12.0001 14ZM12.0001 8C13.1031 8 14.0001 8.897 14.0001 10C14.0001 11.103 13.1031 12 12.0001 12C10.8971 12 10.0001 11.103 10.0001 10C10.0001 8.897 10.8971 8 12.0001 8Z"
                                                                    fill="currentColor"/>
                                                                <path d="M11.4201 21.814C11.5893 21.9349 11.7921 21.9998 12.0001 21.9998C12.2081 21.9998 12.4108 21.9349 12.5801 21.814C12.8841 21.599 20.0291 16.44 20.0001 10C20.0001 5.589 16.4111 2 12.0001 2C7.58909 2 4.00009 5.589 4.00009 9.995C3.97109 16.44 11.1161 21.599 11.4201 21.814ZM12.0001 4C15.3091 4 18.0001 6.691 18.0001 10.005C18.0211 14.443 13.6121 18.428 12.0001 19.735C10.3891 18.427 5.97909 14.441 6.00009 10C6.00009 6.691 8.69109 4 12.0001 4Z"
                                                                    fill="currentColor"/>
                                                            </svg>
                                                            <span><?php echo esc_html($event_location); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="space-y-6 lg:space-y-12 mb-6 lg:mb-12">
                                                        <?php echo get_the_content($event->post_content); ?>
                                                    </div>
                                                </div>
                                               <?php $button_text = get_field('button_text'); ?>

<div class="mt-auto">
    <a href="<?php echo !empty($event_link) ? esc_url($event_link) : '#'; ?>"
       class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-white backdrop-blur-2xl px-6 lg:px-12 btn">
        <span class="text-black">
            <?php 
                $btn_text = get_field('button_text', $event->ID);
                echo !empty($btn_text) ? esc_html($btn_text) : 'Get In Touch'; 
            ?>
        </span>
        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
            viewBox="0 0 24 24"
            fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                fill="currentColor"/>
        </svg>
    </a>
</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php 
                            endforeach; 
                            wp_reset_postdata(); // Reset post data after the loop
                        ?>
                    </ul>

                    <!-- Pagination -->
                    <?php if ($events_query->max_num_pages > 1) : 
                        $total_posts = $events_query->found_posts;
                        $start_showing = (($paged - 1) * 5) + 1;
                        $end_showing = min($paged * 5, $total_posts);

                        // Build the base URL with category parameter if present
                        $base_url = get_pagenum_link(1);
                        if (!empty($current_category)) {
                            $base_url = add_query_arg('event_category', $current_category, $base_url);
                        }
                        $base_url = rtrim($base_url, '/') . '/page/%#%/';
                    ?>
                        <div class="flex justify-center items-center">
                            <div>
                                <p class="mb-4">Showing <?php echo $start_showing; ?> - <?php echo $end_showing; ?> Results</p>
                                <ul class="flex items-center gap-4">
                                    <?php
                                    $total_pages = $events_query->max_num_pages;
                                    for ($i = 1; $i <= $total_pages; $i++) :
                                        $is_current = $paged === $i;
                                        $page_url = $i === 1 ? rtrim(remove_query_arg('page', $base_url), '/') : str_replace('%#%', $i, $base_url);
                                        if (!empty($current_category)) {
                                            $page_url = add_query_arg('event_category', $current_category, $page_url);
                                        }
                                    ?>
                                        <li class="group <?php echo $is_current ? 'active' : ''; ?>">
                                            <a href="<?php echo esc_url($page_url); ?>"
                                               class="min-w-10 h-10 flex justify-center items-center bg-[#31344A0D] border border-transparent rounded-full group-[.active]:bg-[#31344A1A] group-[.active]:border-black hover:bg-[#31344A1A]">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-center py-8">No events found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
?> 