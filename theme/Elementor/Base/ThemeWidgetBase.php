<?php

namespace Theme\Elementor\Base;
use Elementor\Controls_Manager;


abstract class ThemeWidgetBase extends \Elementor\Widget_Base
{
    protected $useLottie = false;

    protected function _register_controls()
    {
        parent::_register_controls();
        $this->_controls();

        if ($this->useLottie) {
            $this->start_controls_section(
                'ds-lottie',
                [
                    'label' => __('Lottie Animation', 'elementor'),
                    'tab'   => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control('lottie-src',
                [
                    'type'        => Controls_Manager::TEXT,
                    'label'       => 'Src',
                    'default'     => '',
                    'description' => ''
                ]);

            $this->add_control('lottie-stop-frame',
                [
                    'type'        => Controls_Manager::NUMBER,
                    'label'       => 'Stop Frame',
                    'default'     => '1',
                    'min'         => '1',
                    'description' => ''
                ]);

            $this->add_control('lottie-color',
                [
                    'type'      => Controls_Manager::COLOR,
                    'label'     => __('Background Color', 'elementor-pro'),
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container::before' => 'display: block; background-color: {{value}};'
                    ],
                ]
            );

            $this->add_control('lottie-speed',
                [
                    'type' => Controls_Manager::SLIDER,
                    'label' => __('Speed', 'elementor-pro'),
                    'size_units' => ['speed'],
                    'range' => [
                        "speed" => [
                            'min' => 1,
                            'max' => 20,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'size' => 1,
                        'unit' => 'speed'
                    ],
                ]
            );

            $this->add_control('lottie-seg-start',
                [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __('Loop Segment Start', 'elementor-pro'),
                    'step' => 1,
                    'min' => 1,
                    'max' => 100000,
                    'default' => 0,
                ]
            );

            $this->add_control('lottie-seg-end',
                [
                    'type' => Controls_Manager::NUMBER,
                    'label' => __('Loop Segment End', 'elementor-pro'),
                    'step' => 1,
                    'min' => 1,
                    'max' => 10000,
                    'default' => 0,
                ]
            );

            $this->end_controls_section();
        }

    }


    protected function _render()
    {
    }

    protected function _controls()
    {
    }

    protected function render()
    {
        print_r("--------------" );
        print_r($this->useLottie );
        if ($this->useLottie && $this->get_settings('lottie-src')) {
            wp_enqueue_script("lottie", "https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/lottie-player.js", [], '1.0.0');
        }
        $this->_render();
    }
}

