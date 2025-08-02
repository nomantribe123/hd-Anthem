<?php

if ( ! class_exists( 'Walker_Nav_Menu' ) ) {
    return;
}

class Header_Mobile_Menu_Walker extends Walker_Nav_Menu {
    protected $menu_items = [];
    protected $skip_children = false;


    public function __construct($args = []) {
        if (!empty($args['menu_items'])) {
            $this->menu_items = $args['menu_items'];
        }
    }

    // Ensure $args->has_children is set for each element
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '') {
        if (!$element) return;

        $id_field = $this->db_fields['id'];
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
            $submenu_class = $depth === 0 ? 'sub-menu p-8 hidden' : 'sub-menu';
            // Only add Alpine directives if parent <li> has x-data (i.e., for mega menu parents)
            if ($depth === 0 && isset($args->has_children) && $args->has_children) {
                // This is a normal dropdown, not a mega menu
                $output .= '<ul class="' . $submenu_class . '">';
            } else {
                $output .= '<ul class="' . $submenu_class . '">';
            }
        }
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

            // Mega menu accordion
            $output .= '<li x-data="accordion()" x-bind:aria-expanded="open" class="duration-300">';
                $output .= '<button x-bind="onClick" class="w-full h-15 flex justify-between items-center gap-2">';
                    $output .= '<span class="text-black">' . esc_html($item->title) . '</span>';
                    $output .= '<svg class="w-6 h-6 duration-300" x-bind:class="{\'-rotate-90\': open}"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/></svg>';
                $output .= '</button>';
                $output .= '<div x-cloak x-show="open" @click.outside="open = false" x-transition><div>';
                    // Product categories grid
                    if (!empty($category_items)) {
                        $output .= '<ul class="grid md:grid-cols-3 gap-x-4 gap-y-5 mb-6">';
                        foreach ($category_items as $cat_item) {
                            $term = get_term($cat_item->object_id, 'product_cat');
                            if (!is_object($term) || is_wp_error($term)) continue;
                            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                            if (!$thumbnail_id) {
                                $thumbnail_id = get_field('category_image', $term);
                            }
                            $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                            $output .= '<li>';
                                $output .= '<a href="' . esc_url(get_term_link($term)) . '" class="group flex items-center gap-2">';
                                    if ($thumbnail_url) {
                                        $output .= '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($cat_item->title) . '" class="rounded-lg min-w-22 w-22 h-22 object-cover object-center">';
                                    }
                                    $output .= '<span class="text-black">' . esc_html($cat_item->title) . '</span>';
                                $output .= '</a>';
                            $output .= '</li>';
                        }
                        $output .= '</ul>';
                    }
            
                    // Other sub items (not product categories)
                    if (!empty($other_items)) {
                        $output .= '<div class="flex flex-col items-center gap-2">';
                        foreach ($other_items as $other_item) {
                            $output .= '<a href="' . esc_url($other_item->url) . '" class="w-full btn backdrop-blur-2xl justify-between">';
                                $output .= '<span class="text-black">' . esc_html($other_item->title) . '</span>';
                                $output .= '<svg class="w-6 h-6 group-hover:translate-x-1 duration-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/></svg>';
                            $output .= '</a>';
                        }
                        $output .= '</div>';
                    }
                $output .= '</div>';
            $output .= '</div>';

            $args->walker->has_mega_menu_parent = false;

        } else {
            // Normal menu item (with or without children)
            $classes = ['group'];
            if ($has_children && $depth === 0) {
                $classes[] = 'menu-item-has-children';
            }
            $output .= '<li class="' . implode(' ', $classes) . '">';
                $link_classes = '';
                if ($depth === 0) {
                    $link_classes = 'w-full h-15 flex justify-between items-center gap-2 flex flex-row gap-2';
                } else {
                    $link_classes = 'block px-4 py-2 text-black hover:/10';
                    if (!$has_children) {
                        $link_classes .= ' ';
                    }
                }
                $output .= '<span class="flex flex-row gap-2">';
                    // Keep <a> for non-dropdowns
                    $output .= '<a href="' . esc_url($item->url) . '" class="' . $link_classes . '">';
                        $output .= '<span class="text-black">' . esc_html($item->title) . '</span>';
                        $output .= '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z" fill="currentColor"/></svg>';
                    $output .= '</a>';
                $output .= '</span>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $show_mega_menu = get_field('dropdown_mega_menu', $item);
        if (!$show_mega_menu || $depth > 0) {
            $output .= '</li>';
        }
    }
}