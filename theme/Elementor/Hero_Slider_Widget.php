<?php

class Hero_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hero_slider';
    }

    public function get_title() {
        return esc_html__('Hero Slider', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-slider-full-screen';
    }

    public function get_categories() {
        return ['tribes'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Slides', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__('Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'video_id',
            [
                'label' => esc_html__('YouTube Video ID', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'hero_slides',
            [
                'label' => esc_html__('Hero Slides', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div data-swiper="fullscreen" class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($settings['hero_slides'] as $slide) : ?>
                    <div x-data="{ playing: false }" class="swiper-slide" data-video-id="<?php echo $slide['video_id']; ?>">
                        <div :class="playing ? 'show-video' : ''" class="slide-content-container w-full flex flex-col justify-end pb-16 lg:pb-25" style="background-image: url('<?php echo esc_url($slide['background_image']['url']); ?>');">
                            <div class="bg-gradient"></div>

                            <div class="container content">
                                <?php if (!empty($slide['subtitle'])) : ?>
                                    <h2 class="text-2xl font-bold font-din-next-stencil mb-4 lg:mb-6">
                                        <?php echo esc_html($slide['subtitle']); ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if (!empty($slide['title'])) : ?>
                                    <h4 class="title">
                                        <?php echo esc_html($slide['title']); ?>
                                    </h4>
                                <?php endif; ?>
                                <?php if (!empty($slide['description'])) : ?>
                                    <p class="description">
                                        <?php echo esc_html($slide['description']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($slide['button_text']) && !empty($slide['button_link']['url'])) : ?>
                                    <a href="<?php echo esc_url($slide['button_link']['url']); ?>"
                                    class="justify-center gap-3 bg-white/12 backdrop-blur-2xl btn">
                                        <span><?php echo esc_html($slide['button_text']); ?></span>
                                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                            viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($slide['video_id'])) : ?>
                                <button x-on:click="playing = true" class="video-play-button" data-for-video="<?php echo $slide['video_id']; ?>">
                                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/play-button-icon.svg' ); ?>
                                </button>

                                <div class="video-background yt-video-embed" data-youtube-id="<?php echo $slide['video_id']; ?>" id="video-iframe-<?php echo $slide['video_id']; ?>"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="absolute bottom-6 lg:bottom-16 left-0 z-1 w-full">
                <div class="container flex justify-center">
                    <div data-swiper-pagination class="w-fit! flex items-center gap-2"></div>
                </div>
            </div>
        </div>
        <?php
    }
} 