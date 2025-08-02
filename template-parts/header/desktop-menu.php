<?php
$logo = get_field('header_logo', 'option');

// Fetch mega menu blog posts and button from menu location ACF
$menu_obj = wp_get_nav_menu_object(get_nav_menu_locations()['header-navbar-menu'] ?? 0);
$mega_menu_blog_posts = $menu_obj ? get_field('mega_menu_blog_posts', $menu_obj) : [];
$mega_menu_button = $menu_obj ? get_field('mega_menu_button', $menu_obj) : null;
$menu_items = $menu_obj ? wp_get_nav_menu_items($menu_obj->term_id) : [];
?>

<div class="hidden lg:flex justify-between items-center gap-4">
    <div class="flex items-center gap-2 lg:gap-4">
        <?php if ($logo) : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo  esc_url($logo['url']) ?>" alt="<?php echo esc_attr($logo['alt']) ?>" class="logo">
            </a>
        <?php endif ?>
    </div>

    <?php // Output the menu using a custom walker for mega menu support
    wp_nav_menu([
        'theme_location' => 'header-navbar-menu',
        'container'      => false,
        'menu_class'     => 'flex items-center',
        'walker'         => new Header_Mega_Menu_Walker([
            'mega_menu_blog_posts' => $mega_menu_blog_posts,
            'mega_menu_button'     => $mega_menu_button,
            'menu_items'           => $menu_items,
        ]),
    ]);
    ?>

    <div class="flex items-center gap-4">
        <?php if ($cta_url = get_field('header_cta_url', 'option')) : ?>
            <?php
                $cta_new_tab = get_field('header_cta_open_in_new_tab', 'option');
                $target = $cta_new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';
            ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--dark" <?php echo $target; ?>>
                <?php if ($cta_icon = get_field('header_cta_icon', 'option')): ?>
                    <img src="<?php echo esc_url($cta_icon); ?>" alt="" class="w-6 h-6 object-contain" />
                <?php endif; ?>
                <span class="text-nowrap"><?php echo esc_html(get_field('header_cta_text', 'option')); ?></span>
            </a>
        <?php endif ?>
        <div class="relative">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" class="w-31 h-11">
                <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                            fill="currentColor"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>