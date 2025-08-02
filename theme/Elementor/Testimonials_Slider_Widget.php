<?php

class Testimonials_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'testimonials_slider';
    }

    public function get_title() {
        return esc_html__('Testimonials Slider', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['tribes'];
    }

    public function get_script_depends() {
        return ['swiper'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Testimonials Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Testimonial Content', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rows' => 6,
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => esc_html__('Author Name', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'John Brown',
            ]
        );

        $repeater->add_control(
            'author_title',
            [
                'label' => esc_html__('Author Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Job Title, Company Name',
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'author_name' => 'John Brown',
                        'author_title' => 'Job Title, Company Name',
                    ],
                ],
                'title_field' => '{{{ author_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=py-12 lg:py-30">
            <div class="container">
                <div class="lg:w-4/5 mx-auto">
                    <div data-swiper="testimonials" class="swiper">
                        <div class="swiper-wrapper mb-8">
                            <?php foreach ($settings['testimonials'] as $testimonial): ?>
                                <div class="swiper-slide h-auto!">
                                    <div class="h-full flex flex-col justify-between items-center text-center">
                                        <div>
                                            <div class="w-fit mb-4 mx-auto">
                                                <svg class="w-8 h-6" viewBox="0 0 28 23" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.3929 21.6307V12.9938V10.8872C15.3929 9.76367 15.4643 8.7806 15.6071 7.93797C15.75 7.09534 16 6.32293 16.3571 5.62074C16.7857 4.91854 17.3214 4.21635 17.9643 3.51415C18.6786 2.74174 19.5714 1.82889 20.6428 0.775606C21.2143 0.143632 21.6071 -0.102136 21.8214 0.0383005C22.1071 0.178737 22.4643 0.424506 22.8928 0.775606C23.4643 1.19692 23.7143 1.54802 23.6428 1.82889C23.6428 2.03955 23.2857 2.49597 22.5714 3.19817C21.4999 4.25146 20.75 5.30475 20.3214 6.35803C19.8928 7.3411 19.7142 8.21884 19.7857 8.99125C19.9285 9.69345 20.25 10.2903 20.75 10.7818C21.3215 11.2032 22.0357 11.4138 22.8928 11.4138C24.5357 11.4138 25.7143 11.5543 26.4285 11.8351C27.1428 12.0458 27.5 12.432 27.5 12.9938V21.4201C27.5 22.052 26.9643 22.4734 25.8928 22.684C24.8214 22.8947 23.4642 23 21.8214 23C20.1785 23 18.6785 22.8947 17.3214 22.684C16.0357 22.4031 15.3929 22.052 15.3929 21.6307ZM0.5 21.6307V12.9938V10.8872C0.5 9.76367 0.571413 8.7806 0.71427 7.93797C0.857128 7.09534 1.10712 6.32293 1.46427 5.62074C1.89284 4.91854 2.42859 4.21635 3.07145 3.51415C3.78573 2.74174 4.67855 1.82889 5.74998 0.775606C6.32141 0.143632 6.71423 -0.102136 6.92852 0.0383005C7.21423 0.178737 7.5714 0.424506 7.99997 0.775606C8.5714 1.19692 8.8214 1.54802 8.74997 1.82889C8.74997 2.03955 8.3928 2.49597 7.67852 3.19817C6.60709 4.25146 5.8571 5.30475 5.42852 6.35803C4.99995 7.3411 4.82137 8.21884 4.8928 8.99125C5.03565 9.69345 5.35717 10.2903 5.85717 10.7818C6.4286 11.2032 7.14283 11.4138 7.99997 11.4138C9.64283 11.4138 10.8214 11.5543 11.5357 11.8351C12.25 12.0458 12.6071 12.432 12.6071 12.9938V21.4201C12.6071 22.052 12.0714 22.4734 11 22.684C9.92853 22.8947 8.57138 23 6.92852 23C5.28566 23 3.78568 22.8947 2.42853 22.684C1.14282 22.4031 0.5 22.052 0.5 21.6307Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </div>
                                            <p class="text-2xl lg:text-3xl font-medium mb-12"><?php echo esc_html($testimonial['testimonial_content']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-3xl font-black mb-2 lg:mb-4"><?php echo esc_html($testimonial['author_name']); ?></p>
                                            <p class="text-2xl font-bold font-din-next-stencil"><?php echo esc_html($testimonial['author_title']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div data-swiper-pagination class="w-fit! flex items-center gap-2 mx-auto"></div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('[data-swiper="testimonials"]', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    pagination: {
                        el: '[data-swiper-pagination]',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 5000,
                    },
                });
            });
        </script>
        <?php
    }
} 