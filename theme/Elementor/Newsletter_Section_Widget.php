<?php
class Newsletter_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'newsletter_section';
    }

    public function get_title() {
        return esc_html__('Newsletter Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-email-field';
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
            'title',
            [
                'label' => esc_html__('Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'JOIN OUR NEWSLETTER',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Subscribe',
            ]
        );

        $this->add_control(
            'privacy_text',
            [
                'label' => esc_html__('Privacy Text', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'By subscribing you agree to with our Privacy Policy',
            ]
        );

        $this->add_control(
            'privacy_link',
            [
                'label' => esc_html__('Privacy Policy Link', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tribes-prortx'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $margin_classes = (is_category()) ? 'my-12 lg:my-20' : ((is_singular('post') || is_home() || is_archive() || is_search()) ? '' : ' my-12 lg:my-20');
        ?>
        <div class=" py-16 lg:py-20 <?php echo esc_attr($margin_classes); ?>">
            <div class="container">
                <div class="flex flex-col lg:flex-row justify-between gap-6">
                    <div>
                        <p class="text-3xl sm:text-4xl lg:text-5xl font-bold font-din-next-stencil mb-2">
                            <?php echo esc_html($settings['title']); ?></p>
                        <p class="text-white"><?php echo esc_html($settings['description']); ?></p>
                    </div>
                    <div>
                        <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4 mb-5">
                            <div class="relative">
                                <input type="email" placeholder="Enter your email"
                                       class="h-11 text-white border-white focus:border-black pr-12">
                                <svg class="absolute top-1/2 right-4 -translate-y-1/2 w-6 h-6"
                                     viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 4H6C4.897 4 4 4.897 4 6V11H6V8L12.4 12.8C12.5732 12.9297 12.7837 12.9998 13 12.9998C13.2163 12.9998 13.4268 12.9297 13.6 12.8L20 8V17H12V19H20C21.103 19 22 18.103 22 17V6C22 4.897 21.103 4 20 4ZM13 10.75L6.666 6H19.334L13 10.75Z"
                                          fill="currentColor"/>
                                    <path d="M2 12H9V14H2V12ZM4 15H10V17H4V15ZM7 18H11V20H7V18Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <button class="h-11 flex justify-center items-center gap-2 bg-white text-black btn px-9 hover:brightness-80">
                                <?php echo esc_html($settings['button_text']); ?>
                            </button>
                        </div>
                        <p class="text-xs text-white">
                            <?php 
                            $privacy_link = $settings['privacy_link'];
                            $privacy_text = explode('Privacy Policy', $settings['privacy_text']);
                            echo esc_html($privacy_text[0]); 
                            ?>
                            <a href="<?php echo esc_url($privacy_link['url']); ?>"
                               class="underline underline-offset-1">
                                Privacy Policy
                            </a>
                            <?php echo esc_html($privacy_text[1] ?? ''); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} 