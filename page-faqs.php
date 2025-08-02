<?php
/* Template Name: FAQs */
get_header();

// Get all FAQ categories
$faq_categories = get_terms([
    'taxonomy' => 'faq_category',
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => true,
    'parent' => 0
]);

// Get current category if any
$current_category = isset($_GET['faq_category']) ? sanitize_text_field($_GET['faq_category']) : '';

// Get FAQs based on category
$args = array(
    'post_type' => 'faq',
    'posts_per_page' => -1,
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
);

if (!empty($current_category)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'faq_category',
            'field' => 'slug',
            'terms' => $current_category
        )
    );
}

$faqs = get_posts($args);

the_content();

if (have_posts()) : while (have_posts()) : the_post();
    
    // Output the content which includes Elementor sections
    // the_content();
    
    // Render the Lead Header widget
    if (class_exists('\\Elementor\\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        
        if ($elementor->frontend) {
            // Get the template content for Lead Header
            $header_template_content = $elementor->frontend->get_builder_content(463, true);
            
            if ($header_template_content) {
                echo '<div class="lead-header-section">';
                echo $header_template_content;
                echo '</div>';
            }
        }
    }
    ?>

    <section class="py-12 lg:py-30 faqs-section-main">
        <div class="container">
            <!-- Category Filter Bar - Desktop -->
            <div class="hidden lg:flex flex-wrap justify-between gap-x-8 mb-12">
                <div class="relative">
                    <form role="search" method="get" class="bg-white search-form" action="">
                        <input type="text" placeholder="Search"
                            value="<?php echo get_search_query(); ?>" 
                            name="s"
                            class="h-11 border-white focus:border-black pr-12">
                        <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                                    fill="currentColor"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="flex items-center">
                    <a href="<?php echo esc_url(remove_query_arg('faq_category')); ?>" class="btn rounded-full <?php echo $current_category ? 'border-transparent' : 'bg-white border-black'; ?>">
                        View all
                    </a>
                    <?php if (!empty($faq_categories)) : ?>
                        <ul class="flex flex-wrap items-center">
                            <?php foreach ($faq_categories as $category) : ?>
                                <li>
                                    <a href="<?php echo esc_url(add_query_arg('faq_category', $category->slug)); ?>" 
                                    class="btn rounded-full <?php echo $current_category === $category->slug ? 'bg-white border-black' : 'border-transparent'; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mobile Filter -->
            <div x-data="{ open: false }" class="block lg:hidden mb-12">
                <div class="w-full mb-4">
                    <div class="mb-5">
                        <button @click="open = !open" 
                                class="w-full h-12 flex justify-between items-center gap-2 border border-anthem-grey-3 px-4 rounded-sm">
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
                            <a href="<?php echo esc_url(remove_query_arg('faq_category')); ?>" 
                            class="block px-4 py-3 <?php echo empty($current_category) ? 'bg-[#31344A0A]' : ''; ?>">
                                View All
                            </a>
                            <?php foreach ($faq_categories as $category) : ?>
                                <a href="<?php echo esc_url(add_query_arg('faq_category', $category->slug)); ?>" 
                                class="block px-4 py-3 <?php echo $current_category === $category->slug ? 'bg-[#31344A0A]' : ''; ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="relative">
                        <form role="search" method="get" class="bg-white search-form" action="">
                            <input type="text" placeholder="Search"
                                value="<?php echo get_search_query(); ?>" 
                                name="s"
                                class="h-11 border-white focus:border-black pr-12">
                            <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                                        fill="currentColor"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="faqs-list-container">
            <?php if (!empty($faqs)) : ?>
                <ul class="space-y-8">
                    <?php foreach ($faqs as $faq) : 
                        $categories = wp_get_post_terms($faq->ID, 'faq_category', array('fields' => 'all'));
                        $category_names = wp_list_pluck($categories, 'name');
                    ?>
                        <li x-data="{ open: false }"
                            class="border border-anthem-grey-3 rounded-sm aria-expanded:bg-anthem-grey-5 not-aria-expanded:opacity-47 duration-300"
                            :class="{'bg-anthem-grey-5': open}"
                            :aria-expanded="open">
                            <button @click="open = !open"
                                    class="w-full flex justify-between items-center gap-4 text-left px-6 py-5"
                                    :aria-expanded="open">
                                <div>
                                    <p class="leading-[150%] mb-2 text-sm uppercase">
                                        <?php echo esc_html(implode(', ', $category_names)); ?>
                                    </p>
                                    <p class="text-lg leading-[150%] lg:text-xl duration-300">
                                        <?php echo esc_html($faq->post_title); ?>
                                    </p>
                                </div>
                                <svg class="w-6 h-6 duration-300"
                                        :class="{'rotate-180': open}"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z"
                                            fill="currentColor"/>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-6 pb-6">
                                <div class="lg:columns-2 lg:gap-4 leading-[150%]">
                                    <?php echo apply_filters('the_content', $faq->post_content); ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="text-center py-8">No FAQs found.</p>
            <?php endif; ?>
        </div>
    </section>

<?php endwhile; endif;

get_footer(); ?>