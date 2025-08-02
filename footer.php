<?php
?>
    <?php get_template_part('template-parts/modal/modal', 'product'); ?>
</main>
<!-- /.End Main tag -->

<?php
    $NewsL_title = get_field('footer_newsletter_title', 'option');
    $NewsL_text = get_field('footer_newsletter_text', 'option');
    $NewsL_privacy_text = get_field('footer_newsletter_privacy_text', 'option');
    $NewsL_link_text = get_field('footer_newsletter_privacy_link_text', 'option');
    $NewsLprivacy_link = get_field('footer_newsletter_privacy_link', 'option');
    $footer_address = get_field('footer_address', 'option');
    $footer_company_number = get_field('footer_company_number', 'option');
    $footer_info_text = get_field('footer_info_text', 'option');
    $footer_info_link = get_field('footer_info_link', 'option');
    $footer_nav_1_link = get_field('footer_nav_column_1_button', 'option');
    $footer_copyright_text = get_field('footer_copyright_text', 'option');
?>

<footer>
    <div class="container">
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-5 lg:gap-20 py-12 pt-6 lg:pt-16 pb-6 lg:pb-12">

            <div class="col-span-2 mb-10">
                <div class="flex items-center gap-4 mb-6">
                    <a href="<?php echo esc_url(home_url('/')); ?> ">
                        <?php $logo = get_field('footer_logo', 'option');
                            if ($logo) {
                                echo '<img width="156" src="' . esc_url($logo['url']) . '" alt="' . esc_attr($logo['alt']) . '" class="footer-logo">';
                            }
                        ?>
                    </a>
                </div>

                <?php if ($NewsL_title): ?>
                    <p class="text-2xl mb-6"><?php echo esc_html($NewsL_title); ?></p>
                <?php endif; ?>

                <?php if ($NewsL_text): ?>
                    <p class="mt-2 text-xs text-white mb-6"><?php echo esc_html($NewsL_text); ?></p>
                <?php endif; ?>

                <div class="flex rounded-lg newsletter-signup mb-4">
                    <input type="email" placeholder="Enter your email">
                    <button type="button" class="px-4 text-black bg-white">
                        Subscribe
                    </button>
                </div>

                <?php if ($NewsL_privacy_text): ?>
                    <p class="text-xs text-white mb-11"><?php echo $NewsL_privacy_text; ?> <a href="<?php echo esc_url($NewsLprivacy_link); ?>" class="underline underline-offset-1"><?php echo esc_html($NewsL_link_text); ?></a></p>
                <?php endif; ?>
                
                <?php if ($footer_address): ?>
                    <p class="text-xs lg:text-sm text-white mb-10"><?php echo $footer_address; ?></p>
                <?php endif; ?>

                <?php if ($footer_company_number): ?>
                    <p class="text-xs lg:text-base text-white mb-4">Company number: <?php echo $footer_company_number; ?></p>
                <?php endif; ?>

                <div class="flex flex-wrap items-center justify-between mt-12">
                    <?php if ($footer_info_text): ?>
                        <p class="text-white mb-4"><?php echo $footer_info_text; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($footer_info_link)): ?>
                        <a href="<?php echo $footer_info_link['url']; ?>" class="btn text-black bg-white" target="<?php echo $footer_info_link['target'] ?>">
                            <span><?php echo $footer_info_link['title']; ?></span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                        fill="currentColor"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-span-1 column-1-menu">
                <?php
                    $menu_location = 'footer-column-1-menu';
                    $locations = get_nav_menu_locations();

                    if (isset($locations[$menu_location])) {
                        $menu_obj = wp_get_nav_menu_object($locations[$menu_location]);
                        
                        echo '<p class="font-bold mb-4 text-sm">' . esc_html($menu_obj->name) . '</p>';
                
                        wp_nav_menu(array(
                            'theme_location' => $menu_location,
                            'container' => 'nav',
                            'menu_class' => 'mb-4 text-sm',
                            'fallback_cb' => false,
                            'walker' => new Custom_Nav_Walker()

                        )); ?>

                        <?php if (!empty($footer_nav_1_link)): ?>
                            <a href="<?php echo $footer_nav_1_link['url']; ?>" class="group w-fit h-11 flex justify-center items-center gap-3 bg-white/12 backdrop-blur-2xl px-6 btn" target="<?php echo $footer_nav_1_link['target'] ?>">
                                <span class="text-white"><?php echo $footer_nav_1_link['title']; ?></span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.70697 16.9496L15.414 11.2426L9.70697 5.53564L8.29297 6.94964L12.586 11.2426L8.29297 15.5356L9.70697 16.9496Z"
                                            fill="currentColor"/>
                                </svg>
                            </a>
                        <?php endif;
                    }
                ?>
            </div>
            <div class="col-span-1 column-2-menu">
                <?php
                $menu_location_2 = 'footer-column-2-menu';
                $locations = get_nav_menu_locations();
                
                if (isset($locations[$menu_location_2])) {
                    $menu_obj = wp_get_nav_menu_object($locations[$menu_location_2]);
                
                    echo '<p class="font-bold mb-4 text-sm">' . esc_html($menu_obj->name) . '</p>';
                
                    wp_nav_menu(array(
                        'theme_location' => $menu_location_2,
                        'container' => 'nav',
                        'menu_class' => 'text-sm',
                        'fallback_cb' => false,
                        'walker' => new Custom_Nav_Walker()

                    ));
                }
                ?>

            </div>

            <div class="col-span-2 lg:col-span-1">
                <?php echo '<p class="font-bold mb-4 text-sm">Follow Us</p>'; ?>

                <?php if (have_rows('social_icons', 'option')): ?>
                    <ul class="flex flex-wrap flex-col gap-3">
                        <?php while (have_rows('social_icons', 'option')): the_row(); 
                            $icon = get_sub_field('icon');
                            $link = get_sub_field('social_link');
                            $name = get_sub_field('name_of_social_icon');
                        ?>
                            <li>
                                <?php if ($link): ?><a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener" class="hover:brightness-80"><?php endif; ?>
                                    <span class="flex gap-3">
                                        <?php if ($icon): ?>
                                            <img src="<?php echo esc_url($icon); ?>" alt="social icon" class="w-6 h-6" />
                                        <?php endif; ?>
                                        <?php if ($name): ?>
                                            <span class="text-sm"><?php echo $name; ?></span>
                                        <?php endif; ?>
                                    </span>
                                <?php if ($link): ?></a><?php endif; ?>
                            </li>
                        <?php endwhile; ?>

                    </ul>
                <?php endif; ?>
            </div>

        </div>
        <hr class="border-white/50">
        <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-2 pt-8 pb-12 lg:pb-20">
            <?php if ($footer_copyright_text): ?>
                <p class="text-sm text-white"><?php echo $footer_copyright_text; ?></p>
            <?php endif; ?>
            
            <?php $menu_location_bottom = 'footer-bottom-menu';
            $locations = get_nav_menu_locations();
            
            if (isset($locations[$menu_location_bottom])) {
                $menu_obj = wp_get_nav_menu_object($locations[$menu_location_bottom]);
                            
                wp_nav_menu(array(
                    'theme_location' => $menu_location_bottom,
                    'container' => 'nav',
                    'menu_class' => 'flex flex-wrap items-center gap-x-6 gap-y-4',
                    'fallback_cb' => false,
                    'walker' => new Custom_Nav_Walker_bottom()

                ));
            } ?>
        </div>
    </div>
</footer>

<!-- Add notification container -->
<div id="notification-container" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 transition-all duration-300 opacity-0">
    <div class=" text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3">
        <svg class="notification-icon w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="success-icon hidden" d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20ZM16.293 9.293L11 14.586L8.707 12.293L7.293 13.707L11 17.414L17.707 10.707L16.293 9.293Z" fill="currentColor"/>
            <path class="error-icon hidden" d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20ZM12 13.414L14.293 15.707L15.707 14.293L13.414 12L15.707 9.707L14.293 8.293L12 10.586L9.707 8.293L8.293 9.707L10.586 12L8.293 14.293L9.707 15.707L12 13.414Z" fill="currentColor"/>
        </svg>
        <span id="notification-message"></span>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>