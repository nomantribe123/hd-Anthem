<?php
/**
 * Template Name: FAQs
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main" class="page-gradient">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'FAQS', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

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
            </div>

        </div>
    </section>

    <section class="py-12">
        <div class="max-w-[1014px] mx-auto rounded-3xl px-[50px] py-12 flex flex-col gap-8 bg-white">
            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center opacity-[47%]">
                <div>
                    <div class="">CATEGORY</div>
                    <div class="text-lg mt-2">Question text goes here</div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>

            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center opacity-[47%]">
                <div>
                    <div class="">CATEGORY</div>
                    <div class="text-lg mt-2">Question text goes here</div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>

            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center opacity-[47%]">
                <div>
                    <div class="">CATEGORY</div>
                    <div class="text-lg mt-2">Question text goes here</div>
                </div>

                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.10131 7.39778C6.88164 7.61746 6.52554 7.61746 6.30586 7.39778L0.571001 1.66291C0.351333 1.44323 0.351333 1.08713 0.571001 0.867456L0.836171 0.602256C1.05584 0.382581 1.41199 0.382581 1.63167 0.602256L6.70359 5.67421L11.7755 0.602256C11.9952 0.382581 12.3513 0.382581 12.571 0.602256L12.8362 0.867456C13.0559 1.08713 13.0559 1.44323 12.8362 1.66291L7.10131 7.39778Z" fill="black"/>
                </svg>

            </div>

            <div class="py-5 px-6 rounded-lg border border-[#EAEAEA] flex justify-between flex-wrap items-center opacity-[47%]">
                <div>
                    <div class="">CATEGORY</div>
                    <div class="text-lg mt-2">Question text goes here</div>
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
 