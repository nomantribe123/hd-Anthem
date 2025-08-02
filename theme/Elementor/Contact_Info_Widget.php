<?php

class Contact_Info_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'contact_info';
    }

    public function get_title() {
        return 'Contact Info';
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return ['prortx'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Content',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Email Column
        $this->add_control(
            'email_title',
            [
                'label' => 'Email Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email',
            ]
        );

        $this->add_control(
            'email_description',
            [
                'label' => 'Email Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.',
            ]
        );

        $this->add_control(
            'email_link',
            [
                'label' => 'Email Address',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'anthem@email.com',
            ]
        );

        // Phone Column
        $this->add_control(
            'phone_title',
            [
                'label' => 'Phone Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Phone',
            ]
        );

        $this->add_control(
            'phone_description',
            [
                'label' => 'Phone Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.',
            ]
        );

        $this->add_control(
            'phone_link',
            [
                'label' => 'Phone Number',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '01234 56789',
            ]
        );

        // Office Column
        $this->add_control(
            'office_title',
            [
                'label' => 'Office Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Office',
            ]
        );

        $this->add_control(
            'office_description',
            [
                'label' => 'Office Description',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.',
            ]
        );

        $this->add_control(
            'office_link',
            [
                'label' => 'Office Address',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Office Address',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class=" py-12 lg:py-30">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8">
                    <div>
                        <div class="mb-5 lg:mb-6">
                            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 4H4C2.897 4 2 4.897 2 6V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V6C22 4.897 21.103 4 20 4ZM20 6V6.511L12 12.734L4 6.512V6H20ZM4 18V9.044L11.386 14.789C11.5611 14.9265 11.7773 15.0013 12 15.0013C12.2227 15.0013 12.4389 14.9265 12.614 14.789L20 9.044L20.002 18H4Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <p class="text-2xl lg:text-3xl text-white font-black mb-3 lg:mb-4"><?php echo esc_html($settings['email_title']); ?></p>
                        <p class="text-white mb-5 lg:mb-6"><?php echo esc_html($settings['email_description']); ?></p>
                        <a href="mailto:<?php echo esc_attr($settings['email_link']); ?>" class="underline underline-offset-1 hover:brightness-80">
                            <?php echo esc_html($settings['email_link']); ?>
                        </a>
                    </div>
                    <div>
                        <div class="mb-5 lg:mb-6">
                            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.7073 12.293C17.6145 12.2 17.5043 12.1263 17.383 12.076C17.2617 12.0257 17.1317 11.9998 17.0003 11.9998C16.869 11.9998 16.739 12.0257 16.6176 12.076C16.4963 12.1263 16.3861 12.2 16.2933 12.293L14.6993 13.887C13.9603 13.667 12.5813 13.167 11.7073 12.293C10.8333 11.419 10.3333 10.04 10.1133 9.30096L11.7073 7.70696C11.8003 7.61417 11.874 7.50397 11.9243 7.38265C11.9746 7.26134 12.0005 7.13129 12.0005 6.99996C12.0005 6.86862 11.9746 6.73858 11.9243 6.61726C11.874 6.49595 11.8003 6.38575 11.7073 6.29296L7.70733 2.29296C7.61455 2.20001 7.50434 2.12627 7.38303 2.07596C7.26171 2.02565 7.13167 1.99976 7.00033 1.99976C6.869 1.99976 6.73896 2.02565 6.61764 2.07596C6.49633 2.12627 6.38612 2.20001 6.29333 2.29296L3.58133 5.00496C3.20133 5.38496 2.98733 5.90696 2.99533 6.43996C3.01833 7.86396 3.39533 12.81 7.29333 16.708C11.1913 20.606 16.1373 20.982 17.5623 21.006H17.5903C18.1183 21.006 18.6173 20.798 18.9953 20.42L21.7073 17.708C21.8003 17.6152 21.874 17.505 21.9243 17.3837C21.9746 17.2623 22.0005 17.1323 22.0005 17.001C22.0005 16.8696 21.9746 16.7396 21.9243 16.6183C21.874 16.4969 21.8003 16.3867 21.7073 16.294L17.7073 12.293ZM17.5803 19.005C16.3323 18.984 12.0623 18.649 8.70733 15.293C5.34133 11.927 5.01533 7.64196 4.99533 6.41896L7.00033 4.41396L9.58633 6.99996L8.29333 8.29296C8.1758 8.41041 8.08938 8.55529 8.04189 8.71453C7.9944 8.87376 7.98733 9.04231 8.02133 9.20496C8.04533 9.31996 8.63233 12.047 10.2923 13.707C11.9523 15.367 14.6793 15.954 14.7943 15.978C14.9569 16.0129 15.1256 16.0064 15.285 15.9591C15.4444 15.9117 15.5893 15.825 15.7063 15.707L17.0003 14.414L19.5863 17L17.5803 19.005Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <p class="text-2xl lg:text-3xl text-white font-black mb-3 lg:mb-4"><?php echo esc_html($settings['phone_title']); ?></p>
                        <p class="text-white mb-5 lg:mb-6"><?php echo esc_html($settings['phone_description']); ?></p>
                        <a href="tel:<?php echo esc_attr($settings['phone_link']); ?>" class="underline underline-offset-1 hover:brightness-80">
                            <?php echo esc_html($settings['phone_link']); ?>
                        </a>
                    </div>
                    <div>
                        <div class="mb-5 lg:mb-6">
                            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0001 14C14.2061 14 16.0001 12.206 16.0001 10C16.0001 7.794 14.2061 6 12.0001 6C9.79406 6 8.00006 7.794 8.00006 10C8.00006 12.206 9.79406 14 12.0001 14ZM12.0001 8C13.1031 8 14.0001 8.897 14.0001 10C14.0001 11.103 13.1031 12 12.0001 12C10.8971 12 10.0001 11.103 10.0001 10C10.0001 8.897 10.8971 8 12.0001 8Z" fill="currentColor"/>
                                <path d="M11.4201 21.814C11.5893 21.9349 11.7921 21.9998 12.0001 21.9998C12.2081 21.9998 12.4108 21.9349 12.5801 21.814C12.8841 21.599 20.0291 16.44 20.0001 10C20.0001 5.589 16.4111 2 12.0001 2C7.58909 2 4.00009 5.589 4.00009 9.995C3.97109 16.44 11.1161 21.599 11.4201 21.814ZM12.0001 4C15.3091 4 18.0001 6.691 18.0001 10.005C18.0211 14.443 13.6121 18.428 12.0001 19.735C10.3891 18.427 5.97909 14.441 6.00009 10C6.00009 6.691 8.69109 4 12.0001 4Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <p class="text-2xl lg:text-3xl text-white font-black mb-3 lg:mb-4"><?php echo esc_html($settings['office_title']); ?></p>
                        <p class="text-white mb-5 lg:mb-6"><?php echo esc_html($settings['office_description']); ?></p>
                        <a href="#" class="underline underline-offset-1 hover:brightness-80">
                            <?php echo esc_html($settings['office_link']); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
} 