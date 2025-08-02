<?php
namespace PRO_RTX\Dynamic_Tags;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Category_Data extends Tag {
    public function get_name() {
        return 'category-data';
    }

    public function get_title() {
        return esc_html__('Category Data', 'tribes-prortx');
    }

    public function get_group() {
        return 'woocommerce';
    }

    public function get_categories() {
        return [
            Module::TEXT_CATEGORY,
            Module::URL_CATEGORY,
            Module::IMAGE_CATEGORY,
        ];
    }

    protected function register_controls() {
        $this->add_control(
            'data_type',
            [
                'label' => esc_html__('Data Type', 'tribes-prortx'),
                'type' => Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name' => esc_html__('Category Name', 'tribes-prortx'),
                    'description' => esc_html__('Category Description', 'tribes-prortx'),
                    'image' => esc_html__('Category Image', 'tribes-prortx'),
                    'url' => esc_html__('Category URL', 'tribes-prortx'),
                ],
            ]
        );
    }

    public function render() {
        // Try to get data from transient first
        $category_data = get_transient('current_category_data');
        
        // If no transient data, try to get from current category
        if (!$category_data && is_product_category()) {
            $current_category = get_queried_object();
            if ($current_category) {
                $category_data = [
                    'category_name' => $current_category->name,
                    'category_description' => term_description($current_category->term_id, 'product_cat'),
                    'category_image' => get_term_meta($current_category->term_id, 'thumbnail_id', true)
                ];
            }
        }

        if (!$category_data) {
            return;
        }

        $data_type = $this->get_settings('data_type');

        switch ($data_type) {
            case 'name':
                echo esc_html($category_data['category_name']);
                break;
            
            case 'description':
                echo wp_kses_post($category_data['category_description']);
                break;
            
            case 'image':
                if ($category_data['category_image']) {
                    echo wp_get_attachment_url($category_data['category_image']);
                }
                break;
            
            case 'url':
                if (is_product_category()) {
                    $current_category = get_queried_object();
                    if ($current_category) {
                        echo esc_url(get_term_link($current_category));
                    }
                }
                break;
        }
    }
} 