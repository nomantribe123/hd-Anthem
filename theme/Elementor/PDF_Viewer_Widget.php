<?php
class PDF_Viewer_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'pdf_viewer';
    }

    public function get_title() {
        return esc_html__('PDF Viewer', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-document-file';
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
            'pdf_file',
            [
                'label' => esc_html__('PDF File', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'application/pdf',
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'aspect_ratio',
            [
                'label' => esc_html__('Aspect Ratio', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '16:9' => esc_html__('16:9', 'tribes-prortx'),
                    '2:1' => esc_html__('2:1', 'tribes-prortx'),
                ],
                'default' => '16:9',
            ]
        );

        $this->add_control(
            'viewer_height',
            [
                'label' => esc_html__('Viewer Height', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pdf-viewer iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'tribes-prortx'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .pdf-viewer iframe',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pdf-viewer iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .pdf-viewer iframe',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (empty($settings['pdf_file']['url'])) {
            echo '<div class="pdf-viewer-error">' . esc_html__('Please select a PDF file.', 'tribes-prortx') . '</div>';
            return;
        }

        $pdf_url = $settings['pdf_file']['url'];
        $aspect_ratio = $settings['aspect_ratio'];

        $aspect_class = '';
        switch ($aspect_ratio) {
            case '16:9':
                $aspect_class = 'aspect-video';
                break;
            case '2:1':
                $aspect_class = 'aspect-[2/1]';
                break;
        }
        ?>
        <div class="pdf-viewer <?php echo esc_attr($aspect_class); ?>">
            <iframe src="<?php echo esc_url($pdf_url); ?>#toolbar=0"
                class="w-full"
                frameborder="0"
                scrolling="no"
                allowfullscreen>
            </iframe>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var aspectClass = '';
        switch ( settings.aspect_ratio ) {
            case '16:9':
                aspectClass = 'aspect-video';
                break;
            case '2:1':
                aspectClass = 'aspect-[2/1]';
                break;
        }
        #>
        <# if ( settings.pdf_file.url ) { #>
            <div class="pdf-viewer {{ aspectClass }}">
                <iframe src="{{ settings.pdf_file.url }}#toolbar=0"
                    class="w-full"
                    frameborder="0"
                    scrolling="no"
                    allowfullscreen>
                </iframe>
            </div>
        <# } else { #>
            <div class="pdf-viewer-error"><?php echo esc_html__('Please select a PDF file.', 'tribes-prortx'); ?></div>
        <# } #>
        <?php
    }
}