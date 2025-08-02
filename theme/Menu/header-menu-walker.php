<?php

if ( ! class_exists( 'Walker_Nav_Menu' ) ) {
    return;
}

class Header_Mega_Menu_Walker extends \Walker_Nav_Menu {
    protected $menu_items = [];
    protected $mega_menu_blog_posts = [];
    protected $mega_menu_button = null;
    protected $skip_children = false;

    public function __construct($args = []) {
        if (!empty($args['menu_items'])) {
            $this->menu_items = $args['menu_items'];
        }

        if (!empty($args['mega_menu_blog_posts'])) {
            $posts = $args['mega_menu_blog_posts'];
            if (!empty($posts) && is_array($posts)) {
                if (is_object(reset($posts))) {
                    $this->mega_menu_blog_posts = $posts;
                } else {
                    $this->mega_menu_blog_posts = get_posts([
                        'post__in' => $posts,
                        'post_type' => 'post',
                        'orderby' => 'post__in',
                        'numberposts' => count($posts),
                    ]);
                }
            }
        }

        if (!empty($args['mega_menu_button'])) {
            $this->mega_menu_button = $args['mega_menu_button'];
        }
    }

    // Ensure $args->has_children is set for each element
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '') {
        if (!$element) return;

        $id_field = $this->db_fields['id'];
        // Set has_children property
        $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        $show_mega_menu = get_field('dropdown_mega_menu', $element);

        if ($show_mega_menu && $depth === 0) {
            $this->skip_children = true;
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
            $this->skip_children = false;
        } elseif ($this->skip_children && $depth > 0) {
            // Completely skip children of mega menu parents
            return;
        } else {
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // Prevent empty <ul> if there are no children
        if (isset($args->has_children) && !$args->has_children) {
            return;
        }

        $parent = !empty($args->walker->has_mega_menu_parent) ? $args->walker->has_mega_menu_parent : false;
        if ($parent) {
            // Do not output <ul> for mega menu dropdowns
            return;
        } else {
            $submenu_class = $depth === 0 ? 'sub-menu absolute top-full bg-white shadow-lg z-20 min-w-xs top-full p-8 ' : 'sub-menu';
            $output .= '<ul x-cloak x-show="open" @click.outside="open = false" x-transition class="' . $submenu_class . '">';
        }

        // Prevent empty <ul> if there are no children
        // if (isset($args->has_children) && !$args->has_children) {
        //     return;
        // }
        // $submenu_class = $depth === 0 ? 'sub-menu absolute top-full bg-white shadow-lg z-20 min-w-xs top-full p-8 ' : 'sub-menu';
        // $output .= '<ul x-bind="dialogue" x-cloak class="' . $submenu_class . '">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $parent = !empty($args->walker->has_mega_menu_parent) ? $args->walker->has_mega_menu_parent : false;
        if ($parent) {
            // Do not output </ul> for mega menu dropdowns
            return;
        }
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Skip child items of mega menu parents
        if ($this->skip_children && $depth > 0) {
            return;
        }

        $show_mega_menu = get_field('dropdown_mega_menu', $item);
        $has_children = !empty($args->has_children);

        if ($show_mega_menu && $depth === 0) {
            $args->walker->has_mega_menu_parent = true;

            $sub_items = [];
            foreach ($this->menu_items as $sub_item) {
                if ((int)$sub_item->menu_item_parent === (int)$item->ID) {
                    $sub_items[] = $sub_item;
                }
            }

            $category_items = [];
            $other_items = [];
            foreach ($sub_items as $sub_item) {
                if ($sub_item->object === 'product_cat') {
                    $category_items[] = $sub_item;
                } else {
                    $other_items[] = $sub_item;
                }
            }

            // Mega menu item
            $output .= '<li x-data="dropdown()">';
                $output .= '<button x-bind="onClick" class="rounded-full flex items-center gap-2 px-3 py-3 border-b-2 border-transparent hover:bg-white/12 group-[.active]:bg-white/12 group-[.active]:border-black">';
                    $output .= '<span class="text-nowrap">' . esc_html($item->title) . '</span>';
                    $output .= '<svg class="w-3.25 h-auto duration-300" x-bind:class="{\'rotate-180\': open}" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="6.29 8.29 11.41 7.12"><path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" fill="currentColor"></path></svg>';
                $output .= '</button>';
                $output .= '<div x-cloak x-show="open" @click.outside="open = false" x-transition class="mega-menu rounded-b-lg bg-white absolute top-full left-0 z-10 w-dvw max-h-[calc(100dvh-5.25rem)] overflow-auto">';
                    $output .= '<div class="container pt-12">';
                        $output .= '<div class="grid grid-cols-5">';
                            // Product categories grid
                            $output .= '<div class="col-span-3 py-8">';
                                $output .= '<h3 class="text-2xl mb-2">'. esc_html($item->title) .'</h3>';
                                $output .= '<ul class="w-full grid grid-cols-2 gap-x-5 gap-y-3 mb-8">';
                                    foreach ($category_items as $cat_item) {
                                        $term = get_term($cat_item->object_id, 'product_cat');
                                        if (!$term || is_wp_error($term)) continue;
                                        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                                        if (!$thumbnail_id) {
                                            $thumbnail_id = get_field('category_image', $term);
                                        }
                                        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                                        $output .= '<li class="mega-menu-item rounded-lg">';
                                            $output .= '<a href="' . esc_url(get_term_link($term)) . '" class="group flex items-center gap-2">';
                                                if ($thumbnail_url) {
                                                    $output .= '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($cat_item->title) . '" class="rounded-lg min-w-17 w-17 h-17 object-cover object-center">';
                                                }
                                                $output .= '<span class="text-black">' . esc_html($cat_item->title) . '</span>';
                                            $output .= '</a>';
                                        $output .= '</li>';
                                    }
                                $output .= '</ul>';

                                // "Other" sub items (not product categories)
                                if (!empty($other_items)) {
                                    $output .= '<div class="flex flex-row gap-4">';
                                        foreach ($other_items as $other_item) {
                                            $output .= '<a href="' . esc_url($other_item->url) . '" class="btn">';
                                                $output .= '<span>' . esc_html($other_item->title) . '</span>';
                                                $output .= '<svg class="arrow group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/></svg>';
                                            $output .= '</a>';
                                        }
                                    $output .= '</div>';
                                }
                            $output .= '</div>';

                            // Blog posts column
                            $output .= '<div class="col-span-2 p-8 flex flex-col">';
                                $output .= '<div class="space-y-13 mb-13">';
                                    if (!empty($this->mega_menu_blog_posts)) {
                                        $output .= '<ul class="blogs-list grid grid-cols-1 gap-6">';
                                            foreach ($this->mega_menu_blog_posts as $post) {
                                                ob_start();
                                                get_template_part('template-parts/post/post', 'nav', [
                                                    'post' => $post
                                                ]);
                                                $output .= ob_get_clean();
                                            }
                                            wp_reset_postdata();
                                        $output .= '</ul>';
                                    }
                                $output .= '</div>';
                
                                if (!empty($this->mega_menu_button) && !empty($this->mega_menu_button['url'])) {
                                    $output .= '<a href="' . esc_url($this->mega_menu_button['url']) . '" class="btn"';
                                    if (!empty($this->mega_menu_button['target'])) {
                                        $output .= ' target="' . esc_attr($this->mega_menu_button['target']) . '"';
                                    }
                                    $output .= '>';
                                        $output .= '<span class="text-black">' . esc_html($this->mega_menu_button['title']) . '</span>';
                                        $output .= '<svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/></svg>';
                                    $output .= '</a>';
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';

            $args->walker->has_mega_menu_parent = false;
        } else {
            // Normal menu item (with or without children)
            $classes = ['group'];
            if ($has_children && $depth === 0) {
                $classes[] = 'menu-item-has-children';
            }
            $output .= '<li x-data="dropdown()" class="' . implode(' ', $classes) . '">';
                $link_classes = '';

                if ($depth === 0) {
                    $link_classes = 'rounded-full text-nowrap px-3 py-3 border-b-2 border-transparent hover:bg-white/12 group-[.active]:bg-white/12 group-[.active]:border-black flex items-center gap-2';

                    // if (!$has_children) {
                    //     $link_classes .= 'flex flex-row gap-2';
                    // }
                } else {
                    $link_classes = 'block px-4 py-2 text-black';

                    if (!$has_children) {
                        $link_classes .= ' ';
                    }
                }

                //$output .= '<span class="flex flex-row gap-2">';
                    if ($has_children && $depth === 0) {
                        // Replace <a> with <button> for dropdowns
                        $output .= '<button type="button" @click="open = !open" class="' . $link_classes . '">';
                            $output .= '<span class="text-nowrap">' . esc_html($item->title) . '</span>';
                            // Dropdown indicator
                            $output .= '<svg class="w-3.25 h-auto duration-300" x-bind:class="{\'rotate-180\': open}" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="6.29 8.29 11.41 7.12"><path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" fill="currentColor"></path></svg>';
                        $output .= '</button>';
                    } else {
                        // Keep <a> for non-dropdowns
                        $output .= '<a href="' . esc_url($item->url) . '" class="' . $link_classes . '">';
                            $output .= '<span class="text-nowrap">' . esc_html($item->title) . '</span>';
                        $output .= '</a>';
                    }
                //$output .= '</span>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $show_mega_menu = get_field('dropdown_mega_menu', $item);
        if (!$show_mega_menu || $depth > 0) {
            $output .= '</li>';
        }
    }
}
