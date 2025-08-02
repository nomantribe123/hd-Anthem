<?php

class Workwear_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'workwear_cta';
    }

    public function get_title() {
        return esc_html__('Workwear CTA', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return ['tribes'];
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

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Image', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'video_id',
            [
                'label' => esc_html__('YouTube Video ID', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'View Our Workwear',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Where to Buy',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section data-video-id="<?php echo $settings['video_id']; ?>" x-data="{ playing: false }" :class="playing ? 'show-video' : ''" class="section-workwear-cta" style="background-image: url('<?php echo esc_url($settings['background_image']['url']); ?>');">
            <div class="bg-gradient"></div>

            <div class="content">
                <h3 class="title">
                    <?php echo esc_html($settings['title']); ?>
                </h3>

                <?php if (!empty($settings['description'])) : ?>
                    <p class="description">
                        <?php echo esc_html($settings['description']); ?>
                    </p>
                <?php endif; ?>

                <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="justify-center backdrop-blur-2xl bg-white/12 btn">
                    <span><?php echo esc_html($settings['button_text']); ?></span>
                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/right-arrow-alt.svg' ); ?>
                </a>
            </div>

            <?php if (!empty($settings['video_id'])) : ?>
                <button x-on:click="playing = true" class="video-play-button" data-for-video="<?php echo $settings['video_id']; ?>">
                    <?php echo file_get_contents( get_stylesheet_directory_uri() . '/assets/img/svg/play-button-icon.svg' ); ?>
                </button>

                <div class="video-background yt-video-embed" data-youtube-id="<?php echo $settings['video_id']; ?>" id="video-iframe-workwear-cta"></div>
            <?php endif; ?>
        </section>
        <?php
    }
} 