<?php


class TextMedia extends \Elementor\Widget_Base
{

    protected $useLottie = true;

    public function get_name()
    {
        return 'find_developer';
    }

    public function get_title()
    {
        return 'TextMedia';
    }

    public function get_icon()
    {
        return 'eicon-columns';
    }

    public function get_categories()
    {
        return ['tribes'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        {
            $this->add_control(
                'position',
                [
                    'label' => esc_html__('Image Position', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left' => esc_html__('Left', 'textdomain'),
                        'right' => esc_html__('Right', 'textdomain'),
                    ],
                    'selectors' => [],
                ]
            );

            $this->add_control(
                'headline',
                [
                    'label' => esc_html__('Headline', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                ]
            );

            $this->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'rows' => 10,
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label' => esc_html__('Button Text', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'rows' => 10,
                ]
            );

            $this->add_control(
                'button_url',
                [
                    'label' => esc_html__('Button Url', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => ['url', 'is_external', 'nofollow'],
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'image',
                [
                    'label' => esc_html__('Image', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [],
                ]
            );
            $this->add_control(
                'html',
                [
                    'label' => esc_html__('Html', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => "",
                    'placeholder' => esc_html__('Type your description here', 'textdomain'),
                ]
            );
            $this->add_control(
                'image_width',
                [
                    'label' => esc_html__('Image Width', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'half',
                    'options' => [
                        'half' => esc_html__('Half', 'textdomain'),
                        'full' => esc_html__('Full', 'textdomain'),
                    ],
                    'selectors' => [],
                ]
            );
        }
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <section class="md:py-20 py-8" x-data="lottie" x-intersect.half.once="play()">
            <div class="container">
                <div class="relative grid grid-cols-12 items-center md:gap-x-16 gap-y-10 md:pb-0 pb-20 <?php if ($settings['position'] === "right"): ?> lg:order-last order-first <?php endif; ?>">
                    <div class="lg:col-span-6 col-span-full">
                        <h2 class="md:text-5xl text-3xl !leading-tight font-black font-big-shoulders md:mb-6 mb-5 <?php if ($settings['image_width'] == 'full'): ?> lg:!col-span-full<?php endif; ?>">
                            <?= $settings['headline'] ?>
                        </h2>
                        <?php if ($settings['image_width'] == "half"): ?>
                            <div class="description-text md:text-lg !leading-[160%] text-neutral-dark-gray text-opacity-70 md:mb-8">
                                <?= $settings['description'] ?>
                            </div>
                            <?php if ($settings['button_text']): ?>
                                <div class="md:static absolute bottom-0 w-full">
                                    <a href="<?= $settings['button_url']['url'] ?>"
                                       class="group btn-border-image md:w-auto w-full inline-flex items-center justify-center text-center !bg-teal-600 hover:!bg-teal-700 rounded-lg text-white font-semibold p-[2px]">
                                        <span class="block w-full rounded-lg bg-teal-600 group-hover:bg-teal-700 duration-300 py-2 px-5"> <?= $settings['button_text'] ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="lg:col-span-6 col-span-full <?php if ($settings['position'] === "right"): ?>lg:order-first order-last <?php endif; ?> <?php if ($settings['image_width'] == 'full'): ?> lg:!col-span-full <?php endif; ?>">

                        <?php if ($settings['lottie-src']) : ?>
                            <div class="lottie-container w-full h-auto"
                                 data-lottie-src="<?= $settings['lottie-src'] ?>"
                                 data-lottie-background="<?= $settings['lottie-color'] ?>"
                                 data-lottie-speed="<?= $settings['lottie-speed']['size'] ?>"
                                 data-lottie-loop-start="<?= $settings['lottie-seg-start'] ?>"
                                 data-lottie-loop-end="<?= $settings['lottie-seg-end'] ?>"
                                 data-lottie-direction="1"
                                 data-lottie-playMode="normal"
                            ></div>

                        <?php elseif ($settings['image']['url']): ?>
                            <img class="block max-w-full mx-auto" src="<?= $settings['image']['url'] ?>"
                                 alt="<?= $settings['image']['alt'] ?>">

                        <?php elseif ($settings['html']): ?>
                            <?= $settings['html'] ?>

                        <?php endif; ?>


                        <?php if ($settings['image_width'] == 'full' /*|| !$settings['image']['url']*/): ?>
                            <div class="col-span-full <?php if (!$settings['image']['url']): ?> lg:col-span-6<?php endif; ?>">
                                <div class="description-text md:text-lg !leading-[160%] text-neutral-dark-gray text-opacity-70 md:mb-8 w-full lg:w-1/2">
                                    <?= $settings['description'] ?>
                                </div>
                                <?php if ($settings['button_text']): ?>
                                    <div class="md:static absolute bottom-0 w-full">
                                        <a href="<?= $settings['button_url']['url'] ?>"
                                           class="group btn-border-image md:w-auto w-full inline-flex items-center justify-center text-center !bg-teal-600 hover:!bg-teal-700 rounded-lg text-white font-semibold p-[2px]">
                                            <span class="block w-full rounded-lg bg-teal-600 group-hover:bg-teal-700 duration-300 py-2 px-5"> <?= $settings['button_text'] ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
