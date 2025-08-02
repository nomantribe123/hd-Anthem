<?php
class Distributors_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'distributors_section';
    }

    public function get_title() {
        return esc_html__('Distributors Section', 'tribes-prortx');
    }

    public function get_icon() {
        return 'eicon-columns';
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
            'flag_image',
            [
                'label' => esc_html__('Country Flag', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Distributors',
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Find your nearest Pro RTX distributor',
            ]
        );

        // Repeater for distributors
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'distributor_name',
            [
                'label' => esc_html__('Distributor Name', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'distributor_website',
            [
                'label' => esc_html__('Website URL', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'tribes-prortx'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'distributors_list',
            [
                'label' => esc_html__('Distributors', 'tribes-prortx'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ distributor_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <section class=py-0 lg:py-0 pb-12">
            <div class="container">
                <ul class="space-y-8 lg:space-y-12">

                    <li x-data="accordion()" x-bind:aria-expanded="open" class="border border-[#7C7C7C] aria-expanded:bg-[#31344A0F] aria-expanded:border-black aria-expanded:shadow-sm duration-300 px-6 lg:px-8 py-8 lg:py-14">

                        <button x-bind="onClick" class="w-full flex flex-row justify-between lg:items-center text-left pb-6">

                            <div class="lg:w-[350px] flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-6">
                                <?php if (!empty($settings['flag_image']['url'])) : ?>
                                    <img src="<?php echo esc_url($settings['flag_image']['url']); ?>" 
                                         alt="<?php echo esc_html($settings['section_title']); ?> Flag" 
                                         class="w-8 h-8 object-cover object-center rounded-full">
                                <?php endif; ?>
                                <div>
                                    <h3 class="text-3xl font-black normal-case"><?php echo esc_html($settings['section_title']); ?></h3>
                                    <?php echo esc_html($settings['section_description']); ?>

                                </div>

                            </div>
                            <svg class="min-w-4 w-4 duration-300" x-bind:class="{'rotate-180': open}" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="6.29 8.29 11.41 7.12">
                                <path d="M16.293 8.29297L12 12.586L7.70697 8.29297L6.29297 9.70697L12 15.414L17.707 9.70697L16.293 8.29297Z" fill="currentColor"></path>
                            </svg>
                        </button>
                        <div x-bind="dialogue">
                            <div class="px-10">
                               
                                <div class="flex justify-end">
                                    <ul id="<?php echo $unique_id; ?>" class="lg:w-4/4 flex flex-wrap lg:justify-end items-center gap-8 lg:gap-x-16 lg:gap-y-12">
                                    <?php
                                    foreach ($settings['distributors_list'] as $distributor) {
                                        ?>
                                        <li data-name="<?php echo esc_attr($distributor['distributor_name']); ?>">

                                            <p class="mb-2"><?php echo esc_html($distributor['distributor_name']); ?></p>
                                            <?php if (!empty($distributor['distributor_website']['url'])) : ?>
                                                <a href="<?php echo esc_url($distributor['distributor_website']['url']); ?>" 
                                                class="flex items-center gap-1 bg-[#4C4C4C] text-white text-sm rounded-full pl-1 pr-2 py-1 hover:brightness-80"
                                                <?php echo $distributor['distributor_website']['is_external'] ? 'target="_blank"' : ''; ?>
                                                <?php echo $distributor['distributor_website']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM4 12C4 11.101 4.156 10.238 4.431 9.431L8 13V15L11 18V19.931C7.061 19.436 4 16.072 4 12ZM18.33 16.873C17.677 16.347 16.687 16 16 16V15C16 14.4696 15.7893 13.9609 15.4142 13.5858C15.0391 13.2107 14.5304 13 14 13H10V10C10.5304 10 11.0391 9.78929 11.4142 9.41421C11.7893 9.03914 12 8.53043 12 8V7H13C13.5304 7 14.0391 6.78929 14.4142 6.41421C14.7893 6.03914 15 5.53043 15 5V4.589C17.928 5.778 20 8.65 20 12C19.9998 13.7647 19.4123 15.4791 18.33 16.873Z" fill="currentColor"/>
                                                    </svg>
                                                    <?php echo esc_url($distributor['distributor_website']['url']); ?>
                                                </a>
                                            <?php endif; ?>

                                        </li>
                                        <?php
                                    }
                                    ?>                                        

                                    </ul>
                                </div>

                            </div>
                        </div>

                    </li>

                </ul>
            </div>
            <script>
                function sortDistributors(selectElement, listId) {
                    const list = document.getElementById(listId);
                    const items = Array.from(list.children);
                    
                    items.sort((a, b) => {
                        const nameA = a.getAttribute('data-name').toLowerCase();
                        const nameB = b.getAttribute('data-name').toLowerCase();
                        
                        if (selectElement.value === 'asc') {
                            return nameA.localeCompare(nameB);
                        } else {
                            return nameB.localeCompare(nameA);
                        }
                    });
                    
                    // Clear the list
                    while (list.firstChild) {
                        list.removeChild(list.firstChild);
                    }
                    
                    // Add sorted items back
                    items.forEach(item => list.appendChild(item));
                }

                // Sort by A-Z on page load
                document.addEventListener('DOMContentLoaded', function() {
                    const select = document.querySelector('select[name="sort-by"][onchange*="<?php echo $unique_id; ?>"]');
                    if (select) {
                        select.value = 'asc';
                        sortDistributors(select, '<?php echo $unique_id; ?>');
                    }
                });
            </script>
        </section>
        <?php
    }
} 