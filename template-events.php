<?php
/**
 * Template Name: Events
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main" class="page-gradient">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'EVENTS PAGE', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

    <section class="mt-[46px]">
        <div class="container py-2.5 flex justify-between gap-[35px]">
            <div class="relative">
                <input type="text" class="h-[48px] bg-white w-[323px] rounded-full py-3 px-6 border border-[#DBDBDB]" placeholder="Search">
                <svg class="absolute right-6 top-1/2 -translate-y-1/2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9625 15.446C17.4941 14.9974 17.0383 14.5359 16.5955 14.062C16.2235 13.684 15.9995 13.409 15.9995 13.409L13.1995 12.072C14.3204 10.8006 14.9391 9.16398 14.9395 7.46899C14.9395 3.60999 11.7995 0.468994 7.93945 0.468994C4.07945 0.468994 0.939453 3.60999 0.939453 7.46899C0.939453 11.328 4.07945 14.469 7.93945 14.469C9.70245 14.469 11.3095 13.809 12.5425 12.73L13.8795 15.53C13.8795 15.53 14.1545 15.754 14.5325 16.126C14.9195 16.489 15.4285 16.98 15.9165 17.493L17.2745 18.885L17.8785 19.531L19.9995 17.41L19.3535 16.806C18.9745 16.434 18.4685 15.94 17.9625 15.446ZM7.93945 12.469C5.18245 12.469 2.93945 10.226 2.93945 7.46899C2.93945 4.71199 5.18245 2.46899 7.93945 2.46899C10.6965 2.46899 12.9395 4.71199 12.9395 7.46899C12.9395 10.226 10.6965 12.469 7.93945 12.469Z" fill="black"/></svg>
            </div>

            <div class="flex items-center flex-wrap">
                <button type="button" class="py-2 px-4 rounded-full border border-[#B1B1B1] bg-white text-center">
                    View all
                </button>
                <button type="button" class="py-2 px-4 rounded-full border border-transparent text-center">
                Category one
                </button>
                <button type="button" class="py-2 px-4 rounded-full border border-transparent text-center">
                Category two
                </button>
                <button type="button" class="py-2 px-4 rounded-full border border-transparent text-center">
                Category three
                </button>
                <button type="button" class="py-2 px-4 rounded-full border border-transparent text-center">
                Sort By: Date Category four
                </button>
            </div>

            <select name="" id="" class="py-4 w-[182px] border border-[#B1B1B1] rounded-[4px] px-[27px]">
                <option value="">Sort By: Date</option>
            </select>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="container flex flex-col gap-8">
            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center">
                <div>
                    <div class="text-[#919191]">CATEGORY</div>
                    <div class="text-[20px] mt-2">Event Name Goes Here</div>
                </div>

                <div class="flex gap-12 flex-wrap items-center text-base font-normal">
                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.20312 11H9.20312V13H7.20312V11ZM7.20312 15H9.20312V17H7.20312V15ZM11.2031 11H13.2031V13H11.2031V11ZM11.2031 15H13.2031V17H11.2031V15ZM15.2031 11H17.2031V13H15.2031V11ZM15.2031 15H17.2031V17H15.2031V15Z" fill="black"/><path d="M5.20312 22H19.2031C20.3061 22 21.2031 21.103 21.2031 20V6C21.2031 4.897 20.3061 4 19.2031 4H17.2031V2H15.2031V4H9.20312V2H7.20312V4H5.20312C4.10012 4 3.20312 4.897 3.20312 6V20C3.20312 21.103 4.10012 22 5.20312 22ZM19.2031 8L19.2041 20H5.20312V8H19.2031Z" fill="black"/></svg>
                        23rd March 2025
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2031 2C6.68913 2 2.20312 6.486 2.20312 12C2.20312 17.514 6.68913 22 12.2031 22C17.7171 22 22.2031 17.514 22.2031 12C22.2031 6.486 17.7171 2 12.2031 2ZM12.2031 20C7.79213 20 4.20312 16.411 4.20312 12C4.20312 7.589 7.79213 4 12.2031 4C16.6141 4 20.2031 7.589 20.2031 12C20.2031 16.411 16.6141 20 12.2031 20Z" fill="black"/><path d="M13.2031 7H11.2031V12.414L14.4961 15.707L15.9101 14.293L13.2031 11.586V7Z" fill="black"/></svg>

                        17:00
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2032 14C14.4092 14 16.2032 12.206 16.2032 10C16.2032 7.794 14.4092 6 12.2032 6C9.99719 6 8.20319 7.794 8.20319 10C8.20319 12.206 9.99719 14 12.2032 14ZM12.2032 8C13.3062 8 14.2032 8.897 14.2032 10C14.2032 11.103 13.3062 12 12.2032 12C11.1002 12 10.2032 11.103 10.2032 10C10.2032 8.897 11.1002 8 12.2032 8Z" fill="black"/><path d="M11.6232 21.814C11.7925 21.9349 11.9952 21.9998 12.2032 21.9998C12.4112 21.9998 12.614 21.9349 12.7832 21.814C13.0872 21.599 20.2322 16.44 20.2032 10C20.2032 5.589 16.6142 2 12.2032 2C7.79221 2 4.20321 5.589 4.20321 9.995C4.17421 16.44 11.3192 21.599 11.6232 21.814ZM12.2032 4C15.5122 4 18.2032 6.691 18.2032 10.005C18.2242 14.443 13.8152 18.428 12.2032 19.735C10.5922 18.427 6.18221 14.441 6.20321 10C6.20321 6.691 8.89421 4 12.2032 4Z" fill="black"/></svg>

                        Location Name Goes Here
                    </div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>
            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center">
                <div>
                    <div class="text-[#919191]">CATEGORY</div>
                    <div class="text-[20px] mt-2">Event Name Goes Here</div>
                </div>

                <div class="flex gap-12 flex-wrap items-center text-base font-normal">
                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.20312 11H9.20312V13H7.20312V11ZM7.20312 15H9.20312V17H7.20312V15ZM11.2031 11H13.2031V13H11.2031V11ZM11.2031 15H13.2031V17H11.2031V15ZM15.2031 11H17.2031V13H15.2031V11ZM15.2031 15H17.2031V17H15.2031V15Z" fill="black"/><path d="M5.20312 22H19.2031C20.3061 22 21.2031 21.103 21.2031 20V6C21.2031 4.897 20.3061 4 19.2031 4H17.2031V2H15.2031V4H9.20312V2H7.20312V4H5.20312C4.10012 4 3.20312 4.897 3.20312 6V20C3.20312 21.103 4.10012 22 5.20312 22ZM19.2031 8L19.2041 20H5.20312V8H19.2031Z" fill="black"/></svg>
                        23rd March 2025
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2031 2C6.68913 2 2.20312 6.486 2.20312 12C2.20312 17.514 6.68913 22 12.2031 22C17.7171 22 22.2031 17.514 22.2031 12C22.2031 6.486 17.7171 2 12.2031 2ZM12.2031 20C7.79213 20 4.20312 16.411 4.20312 12C4.20312 7.589 7.79213 4 12.2031 4C16.6141 4 20.2031 7.589 20.2031 12C20.2031 16.411 16.6141 20 12.2031 20Z" fill="black"/><path d="M13.2031 7H11.2031V12.414L14.4961 15.707L15.9101 14.293L13.2031 11.586V7Z" fill="black"/></svg>

                        17:00
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2032 14C14.4092 14 16.2032 12.206 16.2032 10C16.2032 7.794 14.4092 6 12.2032 6C9.99719 6 8.20319 7.794 8.20319 10C8.20319 12.206 9.99719 14 12.2032 14ZM12.2032 8C13.3062 8 14.2032 8.897 14.2032 10C14.2032 11.103 13.3062 12 12.2032 12C11.1002 12 10.2032 11.103 10.2032 10C10.2032 8.897 11.1002 8 12.2032 8Z" fill="black"/><path d="M11.6232 21.814C11.7925 21.9349 11.9952 21.9998 12.2032 21.9998C12.4112 21.9998 12.614 21.9349 12.7832 21.814C13.0872 21.599 20.2322 16.44 20.2032 10C20.2032 5.589 16.6142 2 12.2032 2C7.79221 2 4.20321 5.589 4.20321 9.995C4.17421 16.44 11.3192 21.599 11.6232 21.814ZM12.2032 4C15.5122 4 18.2032 6.691 18.2032 10.005C18.2242 14.443 13.8152 18.428 12.2032 19.735C10.5922 18.427 6.18221 14.441 6.20321 10C6.20321 6.691 8.89421 4 12.2032 4Z" fill="black"/></svg>

                        Location Name Goes Here
                    </div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>
            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center">
                <div>
                    <div class="text-[#919191]">CATEGORY</div>
                    <div class="text-[20px] mt-2">Event Name Goes Here</div>
                </div>

                <div class="flex gap-12 flex-wrap items-center text-base font-normal">
                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.20312 11H9.20312V13H7.20312V11ZM7.20312 15H9.20312V17H7.20312V15ZM11.2031 11H13.2031V13H11.2031V11ZM11.2031 15H13.2031V17H11.2031V15ZM15.2031 11H17.2031V13H15.2031V11ZM15.2031 15H17.2031V17H15.2031V15Z" fill="black"/><path d="M5.20312 22H19.2031C20.3061 22 21.2031 21.103 21.2031 20V6C21.2031 4.897 20.3061 4 19.2031 4H17.2031V2H15.2031V4H9.20312V2H7.20312V4H5.20312C4.10012 4 3.20312 4.897 3.20312 6V20C3.20312 21.103 4.10012 22 5.20312 22ZM19.2031 8L19.2041 20H5.20312V8H19.2031Z" fill="black"/></svg>
                        23rd March 2025
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2031 2C6.68913 2 2.20312 6.486 2.20312 12C2.20312 17.514 6.68913 22 12.2031 22C17.7171 22 22.2031 17.514 22.2031 12C22.2031 6.486 17.7171 2 12.2031 2ZM12.2031 20C7.79213 20 4.20312 16.411 4.20312 12C4.20312 7.589 7.79213 4 12.2031 4C16.6141 4 20.2031 7.589 20.2031 12C20.2031 16.411 16.6141 20 12.2031 20Z" fill="black"/><path d="M13.2031 7H11.2031V12.414L14.4961 15.707L15.9101 14.293L13.2031 11.586V7Z" fill="black"/></svg>

                        17:00
                    </div>

                    <div class="flex gap-1 items-center">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.2032 14C14.4092 14 16.2032 12.206 16.2032 10C16.2032 7.794 14.4092 6 12.2032 6C9.99719 6 8.20319 7.794 8.20319 10C8.20319 12.206 9.99719 14 12.2032 14ZM12.2032 8C13.3062 8 14.2032 8.897 14.2032 10C14.2032 11.103 13.3062 12 12.2032 12C11.1002 12 10.2032 11.103 10.2032 10C10.2032 8.897 11.1002 8 12.2032 8Z" fill="black"/><path d="M11.6232 21.814C11.7925 21.9349 11.9952 21.9998 12.2032 21.9998C12.4112 21.9998 12.614 21.9349 12.7832 21.814C13.0872 21.599 20.2322 16.44 20.2032 10C20.2032 5.589 16.6142 2 12.2032 2C7.79221 2 4.20321 5.589 4.20321 9.995C4.17421 16.44 11.3192 21.599 11.6232 21.814ZM12.2032 4C15.5122 4 18.2032 6.691 18.2032 10.005C18.2242 14.443 13.8152 18.428 12.2032 19.735C10.5922 18.427 6.18221 14.441 6.20321 10C6.20321 6.691 8.89421 4 12.2032 4Z" fill="black"/></svg>

                        Location Name Goes Here
                    </div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>
        </div>
    </section>
    <?php get_template_part( 'template-parts/view-lineup-medium' ) ?>


<?php endwhile; endif; ?>
 </main>
 <?php
 get_footer();
 