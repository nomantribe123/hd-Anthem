<?php
/* Template Name: Where To Buy */
get_header();

the_content();

/*
if (have_posts()) : while (have_posts()) : the_post();
    
    // Output the content which includes Elementor sections
    // the_content();

    ?>

    <section class="bg-[#E9E9E9] py-12 lg:py-30 border-b-8 ">
        <div class="container">
            <!--
                WHERE TO BUY JOURNEY INFO (for Back-end Developer)

                1. Each step in the journey has multiple options for the user to choose from. These options are identified
                by the `data-journey-step-option` attribute in the HTML. This attribute is used to store the unique identifier
                for each option in the journey.

                2. When the user clicks on an option and proceeds to the next step (by clicking the "Continue" button), the
                selected option is saved. This is done by setting the `selectedOption` property in JavaScript, which corresponds
                to the `data-journey-step-option` attribute of the clicked option. This allows the app to track which option was
                selected in each step.

                3. At the last step (Contact Form), hidden input fields are dynamically generated for each selected option.
                Each generated input field will contain the value of the selected option. The `name` and `id` of these input fields
                will be formatted as `step-index-option`, where `index` refers to the step number (e.g., `step-2-option` for step 2).

                4. The relationship between the `data-journey-step-option` attribute, the `selectedOption` value, and the generated
                input field is as follows:
                    - The `data-journey-step-option` holds the unique identifier for each option.
                    - When an option is clicked, the value of `data-journey-step-option` is stored in the `selectedOption` property.
                    - At the last step, hidden input fields are created with the `name` and `id` formatted as `step-index-option`,
                    where `index` is the current step number and `option` is the value of the selected option.
                    - The values of these dynamically generated input fields are the actual selected options from each step.
                    For example, if the user selects the option `I need less than 20 items` at step 2, the value of the hidden input
                    generated for step 2 will be the same as the `data-journey-step-option` value for that option (e.g., `less-than-20`).
            -->
            <?php
            $where_to_buy_journey_title = get_field('section_title', 'where_to_buy');
            $where_to_buy_journey_sub_title = get_field('section_sub_title', 'where_to_buy');
            
            // Get trade customer data
            $trade_customer = get_field('trade_customer', 'where_to_buy');
            $non_trade_customer = get_field('non_trade_customer', 'where_to_buy');
            $journey_steps = get_field('journey_steps', 'where_to_buy');
            $journey_options = get_field('journey_options', 'where_to_buy');
            ?>
            <div x-data="whereToBuyJourney()" x-cloak>
                <div class="mb-12">
                    <h3 class="text-2xl font-bold font-din-next-stencil mb-4"><?php echo $where_to_buy_journey_title; ?></h3>
                    <h2 class="text-6xl font-black"><?php echo $where_to_buy_journey_sub_title; ?></h3>
                </div>
                <div data-journey-step="0" class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <div data-journey-step-option="trade"
                             class="w-full h-full flex flex-col justify-between gap-4 lg:gap-16 bg-prortx-light-grey border-2 border-black p-6 lg:p-8">
                            <div class="grow">
                                <div class="mb-6">
                                    <h4 class="text-5xl font-black mb-4"><?php echo $trade_customer['title']; ?></h5>
                                    <p class="text-lg"><?php echo $trade_customer['description']; ?></p>
                                </div>
                                <?php if($trade_customer['features']): ?>
                                <ul class="flex flex-wrap items-center gap-4">
                                    <?php foreach($trade_customer['features'] as $feature): ?>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                                  fill="currentColor"/>
                                            <path d="M9.99902 13.587L7.70002 11.292L6.28802 12.708L10.001 16.413L16.707 9.70703L15.293 8.29303L9.99902 13.587Z"
                                                  fill="currentColor"/>
                                        </svg>
                                        <span class="text-lg"><?php echo $feature['text']; ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                            <div>
                                <button x-on:click="next($event)"
                                        class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                    <span class="text-black">Continue</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                         viewBox="0 0 24 24"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                              fill="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div data-journey-step-option="non-trade"
                             class="w-full h-full flex flex-col justify-between gap-4 lg:gap-16 bg-prortx-light-grey border-2 border-black p-6 lg:p-8">
                            <div class="grow">
                                <div class="mb-6">
                                    <h5 class="text-5xl font-black mb-4"><?php echo $non_trade_customer['title']; ?></h5>
                                    <p class="text-lg"><?php echo $non_trade_customer['description']; ?></p>
                                </div>
                                <?php if($non_trade_customer['features']): ?>
                                <ul class="flex flex-wrap items-center gap-4">
                                    <?php foreach($non_trade_customer['features'] as $feature): ?>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12C22 6.486 17.514 2 12 2ZM12 20C7.589 20 4 16.411 4 12C4 7.589 7.589 4 12 4C16.411 4 20 7.589 20 12C20 16.411 16.411 20 12 20Z"
                                                  fill="currentColor"/>
                                            <path d="M9.99902 13.587L7.70002 11.292L6.28802 12.708L10.001 16.413L16.707 9.70703L15.293 8.29303L9.99902 13.587Z"
                                                  fill="currentColor"/>
                                        </svg>
                                        <span class="text-lg"><?php echo $feature['text']; ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                            <div>
                                <button x-on:click="next($event)"
                                        class="group w-full lg:w-fit h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                    <span class="text-black">Continue</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                         viewBox="0 0 24 24"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                              fill="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-bind="journeyModal"
                     class="fixed inset-0 z-10 bg-[#fff] backdrop-blur-sm overflow-x-hidden overflow-y-auto">
                    <div class="w-full min-h-[calc(100%-4rem)] flex flex-col justify-center items-center mx-auto my-8">
                        <div class="container lg:px-12">
                            <div x-on:click.outside="goto(0)"
                                 class="w-full bg-prortx-light-grey border-b-12  p-4 lg:p-8">

                                <div class="flex justify-end">
                                    <button x-on:click="goto(0)" class="hover:brightness-80">
                                        <svg class="w-9 h-9" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.192 6.34424L11.949 10.5862L7.70697 6.34424L6.29297 7.75824L10.535 12.0002L6.29297 16.2422L7.70697 17.6562L11.949 13.4142L16.192 17.6562L17.606 16.2422L13.364 12.0002L17.606 7.75824L16.192 6.34424Z"
                                                  fill="currentColor"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mb-12">


                                    <div x-bind="stepsTransition" x-show="currentStep === 1" data-journey-step="1">
                                        <template x-if="steps.find(item => item.index === 0).selectedOption === 'trade'">
                                            <div>
                                                <div class="mb-12">
                                                    <div class="flex flex-wrap items-center gap-4 mb-4">
                                                        <span class=" text-lg text-black font-black rounded-full px-4 py-1">Step 1</span>
                                                        <span class="text-3xl font-black"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['title']); ?></span>
                                                    </div>
                                                    <div class="lg:w-1/2">
                                                        <p class="text-xl font-medium"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['description']); ?></p>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                                    <div>
                                                        <div data-journey-step-option="individual"
                                                             class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                            <div class="grow">
                                                                <div>
                                                                    <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                        <?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['individual']['title']); ?></h5>
                                                                    <p class="text-lg"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['individual']['description']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button x-on:click="next($event)"
                                                                        class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                                    <span class="text-black">Continue</span>
                                                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                         viewBox="0 0 24 24"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div data-journey-step-option="partner"
                                                             class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                            <div class="grow">
                                                                <div>
                                                                    <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                        <?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['partner']['title']); ?></h5>
                                                                    <p class="text-lg"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['trade_step1']['partner']['description']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button x-on:click="next($event)"
                                                                        class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                                    <span class="text-black">Continue</span>
                                                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                         viewBox="0 0 24 24"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="steps.find(item => item.index === 0).selectedOption === 'non-trade'">
                                            <div>
                                                <div class="mb-12">
                                                    <div class="flex flex-wrap items-center gap-4 mb-4">
                                                        <span class=" text-lg text-white font-black rounded-full px-4 py-1">Step 1</span>
                                                        <span class="text-3xl font-black"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['title']); ?></span>
                                                    </div>
                                                    <div class="lg:w-1/2">
                                                        <p class="text-xl font-medium"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['description']); ?></p>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                                    <div>
                                                        <div data-journey-step-option="individual"
                                                             class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                            <div class="grow">
                                                                <div>
                                                                    <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                        <?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['individual']['title']); ?></h5>
                                                                    <p class="text-lg"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['individual']['description']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button x-on:click="next($event)"
                                                                        class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                                    <span class="text-black">Continue</span>
                                                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                         viewBox="0 0 24 24"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div data-journey-step-option="partner"
                                                             class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                            <div class="grow">
                                                                <div>
                                                                    <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                        <?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['partner']['title']); ?></h5>
                                                                    <p class="text-lg"><?php echo esc_html(get_field('journey_steps_content', 'where_to_buy')['non_trade_step1']['partner']['description']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button x-on:click="next($event)"
                                                                        class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                                    <span class="text-black">Continue</span>
                                                                    <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                         viewBox="0 0 24 24"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                              fill="currentColor"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <div x-bind="stepsTransition" x-show="currentStep === 2" data-journey-step="2">
                                        <?php $step2_content = get_field('journey_steps_content', 'where_to_buy')['step2_content']; ?>
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                            <div>
                                                <div data-journey-step-option="less-than-20"
                                                     class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                    <div class="grow">
                                                        <div>
                                                            <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                <?php echo esc_html($step2_content['less_than_20']['title']); ?></h5>
                                                            <p class="text-lg"><?php echo esc_html($step2_content['less_than_20']['description']); ?></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button x-on:click="next($event)"
                                                                class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                            <span class="text-black">Continue</span>
                                                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                      fill="currentColor"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div data-journey-step-option="more-than-20"
                                                     class="w-full h-full flex flex-col justify-between gap-12 border border-black p-6 lg:p-8">
                                                    <div class="grow">
                                                        <div>
                                                            <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                                <?php echo esc_html($step2_content['more_than_20']['title']); ?></h5>
                                                            <p class="text-lg"><?php echo esc_html($step2_content['more_than_20']['description']); ?></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button x-on:click="next($event)"
                                                                class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                            <span class="text-black">Continue</span>
                                                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                      fill="currentColor"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-1 lg:col-span-2">
                                                <div data-journey-step-option="less-than-20"
                                                     class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12 border border-black p-6 lg:p-8">
                                                    <div>
                                                        <h5 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black mb-6">
                                                            <?php echo esc_html($step2_content['one_item']['title']); ?></h5>
                                                        <p class="text-lg"><?php echo esc_html($step2_content['one_item']['description']); ?></p>
                                                    </div>
                                                    <div>
                                                        <button x-on:click="next($event)"
                                                                class="group w-full h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                            <span class="text-black">Continue</span>
                                                            <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                                 viewBox="0 0 24 24"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                      fill="currentColor"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-bind="stepsTransition" x-show="currentStep === 3" data-journey-step="3">
                                        <?php 
                                        $step3_title = get_field('step3_title', 'where_to_buy') ?: 'Contact Form';
                                        $step3_description = get_field('step3_description', 'where_to_buy') ?: 'Please fill out the form below and we will get back to you as soon as possible.';
                                        ?>
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                                            <div>
                                                <div class="sticky top-4">
                                                    <div class="flex flex-wrap items-center gap-4 mb-4">
                                                        <span class=" text-lg text-white font-black rounded-full px-4 py-1">Step 3</span>
                                                        <span class="text-3xl font-black"><?php echo esc_html($step3_title); ?></span>
                                                    </div>
                                                    <div>
                                                        <p class="text-xl font-medium"><?php echo esc_html($step3_description); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <form>
                                                    <div class="hidden">
                                                        <template x-for="item in steps" x-bind:key="item.index">
                                                            <input type="text"
                                                                   x-bind:name="`step-${item.index}-option`"
                                                                   x-bind:id="`step-${item.index}-option`"
                                                                   x-bind:value="item.selectedOption">
                                                        </template>
                                                    </div>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                                                        <div class="sm:col-span-2">
                                                            <label for="career">What best describes you?*</label>
                                                            <select x-data="select()" name="career" id="career"
                                                                    required>
                                                                <option value="1">Printer/ Embroider</option>
                                                                <option value="2">This is a test!</option>
                                                                <option value="3">This is a test!</option>
                                                                <option value="4">This is a test!</option>
                                                                <option value="5">This is a test!</option>
                                                                <option value="6">This is a test!</option>
                                                                <option value="7">This is a test!</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="first_name">First Name*</label>
                                                            <input type="text" id="first_name" required>
                                                        </div>
                                                        <div>
                                                            <label for="second_name">Second Name*</label>
                                                            <input type="text" id="second_name" required>
                                                        </div>
                                                        <div>
                                                            <label for="email">E-Mail*</label>
                                                            <input type="email" id="email" required>
                                                        </div>
                                                        <div>
                                                            <label for="tel">Phone Number</label>
                                                            <input type="tel" id="tel">
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="hear">How did you hear about us?*</label>
                                                            <select x-data="select()" name="hear" id="hear" required>
                                                                <option value="1">Social Media</option>
                                                                <option value="2">This is a test!</option>
                                                                <option value="3">This is a test!</option>
                                                                <option value="4">This is a test!</option>
                                                                <option value="5">This is a test!</option>
                                                                <option value="6">This is a test!</option>
                                                                <option value="7">This is a test!</option>
                                                            </select>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="topic">Choose Topic*</label>
                                                            <select x-data="select()" name="topic" id="topic" required>
                                                                <option value="1">Topic</option>
                                                                <option value="2">This is a test!</option>
                                                                <option value="3">This is a test!</option>
                                                                <option value="4">This is a test!</option>
                                                                <option value="5">This is a test!</option>
                                                                <option value="6">This is a test!</option>
                                                                <option value="7">This is a test!</option>
                                                            </select>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="message">Your enquiry*</label>
                                                            <textarea name="message" id="message"
                                                                      placeholder="Type your message..."
                                                                      class="w-full h-45 py-3" required></textarea>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <div class="space-y-4">
                                                                <div class="flex items-center gap-2">
                                                                    <input type="checkbox" id="subscribe">
                                                                    <label for="subscribe" class="text-sm m-0">I want to
                                                                        join your mailing
                                                                        list</label>
                                                                </div>
                                                                <div class="flex items-center gap-2">
                                                                    <input type="checkbox" id="terms" required>
                                                                    <label for="terms" class="text-sm m-0">I accept the
                                                                        <a href="#"
                                                                           class="underline underline-offset-1">Terms</a></label>
                                                                </div>
                                                                <div class="flex items-center gap-2">
                                                                    <input type="checkbox" id="copy">
                                                                    <label for="copy" class="text-sm m-0">Would you like
                                                                        to receive a copy of our newsletter?</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                            class="group w-fit h-11 flex justify-center items-center gap-3 bg-[#00000014] backdrop-blur-2xl px-6 btn">
                                                        <span class="text-black">Submit Contact Form</span>
                                                        <svg class="w-6 h-6 group-hover:translate-x-1 duration-300"
                                                             viewBox="0 0 24 24"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.293 17.293L12.707 18.707L19.414 12L12.707 5.29297L11.293 6.70697L15.586 11H6V13H15.586L11.293 17.293Z"
                                                                  fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <ul class="flex items-center gap-8">
                                        <template x-for="item in (steps.length - 1)">
                                            <li class="grow h-1.5 duration-300"
                                                x-bind:class="[item === currentStep ? '' : '/50']"></li>
                                        </template>
                                    </ul>
                                </div>
                                <button x-on:click="back()" class="group flex items-center gap-3">
                                    <svg class="w-6 h-6 group-hover:-translate-x-1 duration-300"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.999 1.99304C6.48602 1.99404 2.00002 6.48004 1.99902 11.994C1.99902 17.508 6.48502 21.994 12 21.994C17.514 21.993 22 17.507 22 11.994C22 6.48004 17.514 1.99404 11.999 1.99304ZM12 19.994C7.58802 19.994 3.99902 16.405 3.99902 11.994C4.00002 7.58304 7.58902 3.99404 11.999 3.99304C16.411 3.99404 20 7.58304 20 11.994C20 16.404 16.411 19.993 12 19.994Z"
                                              fill="currentColor"/>
                                        <path d="M12.012 7.98901L8.00702 11.994L12.012 15.998V12.994H16.006V10.994H12.012V7.98901Z"
                                              fill="currentColor"/>
                                    </svg>
                                    <span>Back</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; endif; */

get_footer(); ?>