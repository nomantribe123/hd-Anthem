<?php
$logo = get_field('header_logo', 'option');

$cta_url = get_field('header_cta_url', 'option');
$cta_new_tab = get_field('header_cta_open_in_new_tab', 'option');
$cta_target = $cta_new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';
$cta_icon = get_field('header_cta_icon', 'option');
?>

<div class="flex lg:hidden h-full justify-between items-center gap-2">
    <div>
        <?php if ($logo) : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($logo['url']) ?>" alt="<?php echo esc_attr($logo['alt']) ?>" class="logo">
            </a>
        <?php endif ?>
    </div>
    <div class="flex items-center gap-2">

        <?php if ($cta_url) : ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--dark w-full justify-center" <?php echo $cta_target; ?>>
                <span><?php echo esc_html(get_field('header_cta_text', 'option')); ?></span>
            </a>
        <?php endif ?> 

        <div x-data="dropdown()">
            <button x-bind="onClick" class="w-11 h-11 flex justify-center items-center border border-white"
                    style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) -32.42%, rgba(255, 255, 255, 0.1) 100%);">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z"
                        fill="currentColor"/>
                </svg>
            </button>
            <div x-bind="dialogue" x-cloak
                class="fixed top-19 left-0 z-10 w-dvw  py-4">
                <div class="container">
                    <div class="relative">
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" placeholder="Search"
                                value="<?php echo get_search_query(); ?>" 
                                name="s"
                                class="h-11 text-white border-white focus:border-black pr-12">
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

        <div>
            <button x-on:click="$store.page.toggleHamburgerMenu()">
                <svg x-cloak x-show="!$store.page.showHamburgerMenu" class="w-6 h-6"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20V8H4V6ZM8 11H20V13H8V11ZM13 16H20V18H13V16Z" fill="currentColor"/>
                </svg>
                <svg x-cloak x-show="$store.page.showHamburgerMenu" class="w-6 h-6"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.192 6.34424L11.949 10.5862L7.70697 6.34424L6.29297 7.75824L10.535 12.0002L6.29297 16.2422L7.70697 17.6562L11.949 13.4142L16.192 17.6562L17.606 16.2422L13.364 12.0002L17.606 7.75824L16.192 6.34424Z"
                        fill="currentColor"/>
                </svg>
            </button>
            <?php 
                // Output mega menu blog posts and button if available
                $menu_obj = wp_get_nav_menu_object(get_nav_menu_locations()['header-navbar-menu'] ?? 0);
                $mega_menu_blog_posts = $menu_obj ? get_field('mega_menu_blog_posts', $menu_obj) : [];
                $mega_menu_button = $menu_obj ? get_field('mega_menu_button', $menu_obj) : null;
                $menu_items = $menu_obj ? wp_get_nav_menu_items($menu_obj->term_id) : [];
            ?>
            <div class="mobile-menu bg-white fixed right-0 z-10 translate-x-full w-dvw overflow-auto duration-300" x-bind:class="{'!translate-x-0': $store.page.showHamburgerMenu}">
                <div class="pb-6">
                    <div class="container">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'header-navbar-menu',
                            'container'      => false,
                            'menu_class'     => '',
                            'walker'         => new Header_Mobile_Menu_Walker([
                                'menu_items'           => $menu_items,    
                            ]),
                        ]);
                        ?>
                    </div>
                </div>
                <?php if (!empty($mega_menu_blog_posts)) : ?>
                    <div class="pb-6">
                        <div class="container">
                            <ul class="blogs-list grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6 mb-12 test-m3">
                                <?php foreach ($mega_menu_blog_posts as $post) :
                                    get_template_part('template-parts/post/post', 'nav', [
                                        'post' => $post,
                                    ]);
                                endforeach;
                                wp_reset_postdata(); ?>
                            </ul>
                            <?php if ($mega_menu_button && !empty($mega_menu_button['url'])) : ?>
                                <div>
                                    <a href="<?php echo esc_url($mega_menu_button['url']); ?>"
                                    class="btn w-full backdrop-blur-2xl justify-between"
                                    <?php if (!empty($mega_menu_button['target'])) echo 'target="' . esc_attr($mega_menu_button['target']) . '"'; ?>>
                                        <span><?php echo esc_html($mega_menu_button['title']); ?></span>
                                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                            viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($cta_url) : ?>
                    <div class="mb-6">
                        <div class="container">
                            <a href="<?php echo esc_url($cta_url); ?>" class="btn dark w-full justify-center" <?php echo $cta_target; ?>>
                                <?php if ($cta_icon): ?>
                                    <img src="<?php echo esc_url($cta_icon); ?>" alt="" class="w-6 h-6" />
                                <?php else: ?>
                                    <svg class="w-6 h-6" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8567 17.12C20.802 17.0745 16.8333 14.0708 15.744 14.2864C15.224 14.383 14.9267 14.7554 14.33 15.5009C14.234 15.6213 14.0033 15.9097 13.824 16.1148C13.4469 15.9857 13.0791 15.8285 12.7233 15.6444C10.887 14.7057 9.40333 13.1478 8.50933 11.2197C8.33391 10.8462 8.18419 10.46 8.06133 10.064C8.25733 9.875 8.532 9.6328 8.64933 9.5292C9.356 8.9062 9.71133 8.594 9.80333 8.0466C9.992 6.9126 7.13333 2.7168 7.10333 2.679C6.97363 2.48445 6.80437 2.3226 6.60778 2.20517C6.4112 2.08774 6.19221 2.01766 5.96667 2C4.808 2 1.5 6.5059 1.5 7.2647C1.5 7.3088 1.56067 11.7916 6.82533 17.4147C12.1753 22.9363 16.444 23 16.486 23C17.2093 23 21.5 19.5266 21.5 18.31C21.4834 18.074 21.417 17.8448 21.3058 17.639C21.1945 17.4333 21.0411 17.256 20.8567 17.12Z"
                                            fill="currentColor"/>
                                    </svg>
                                <?php endif; ?>
                                <span><?php echo esc_html(get_field('header_cta_text', 'option')); ?></span>
                            </a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>