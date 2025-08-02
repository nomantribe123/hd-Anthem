<?php
/**
 * Template Name: Our Story
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main" class="page-gradient">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Our Story', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

   <section class="mt-[78px] bg-white pb-[50px] pt-[64px]">
        <div class="container flex flex-wrap gap-[92px] justify-between items-center">
            <div class="max-w-[592px]">
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[48px] leading-[120%]">Where to Buy</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>

            </div>
            <img class="w-[644px] max-w-full rounded-3xl object-cover aspect-[664/507]" src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/our-story/image-1.jpeg' ?>" alt="">
        </div>
   </section>

   <section class="my-[76px]">
        <div class="container p-[51px] bg-white rounded-3xl">
            <div class="flex items-center gap-20">
                <img src="<?php echo get_template_directory_uri() . '/assets/image/our-story/image-2.jpeg' ?>" class="w-[36.2%] aspect-[491/630] object-cover max-w-[491px] shrink-0 rounded-3xl" alt="">

                <div class="pl-[64px]"> 
                <?php get_template_part( 'template-parts/sustainability-content' ) ?>
                </div>
            </div>
        </div>
   </section>

   <section class="bg-white py-[172px]">
        <div class="container flex items-center gap-10 justify-between">
            <div class="max-w-[592px]">
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[48px] leading-[120%]">Norty Link</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>
            </div>

            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/our-story/norty.png' ?>" class="max-w-[572px]" alt="">
        </div>
   </section>

   <section class="my-[76px]">
        <div class="container py-[64px] flex flex-wrap gap-[80px] justify-between items-center">
            <div class="max-w-[479px]">
                <div class="text-[32px] leading-[120%]">Our Values</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.</div>
            </div>

            <div class="flex flex-col gap-20">
                <div class="flex gap-8 flex-wrap"></div>
                <div class="flex gap-8 flex-wrap"></div>
            </div>
        </div>
   </section>

   <section class="my-[76px]">
        <div class="container bg-white p-12 rounded-3xl">
            <?php get_template_part( 'template-parts/product-carousel', '', array('no_container' => true) ) ?>
        </div>
   </section>

   <section class="my-[76px]">
        <div class="container bg-white p-12 rounded-3xl">
            <div class="flex flex-wrap items-center justify-between gap-10">
                <div>
                    <div class="text-[40px]">Read More About Our Sustainability Promise</div>
                    <div class="mt-4 text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
                </div>

                <button type="button" class="btn px-2 border border-black">
                    View All The Thread Posts
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/>
                    </svg>
                </button>
            </div>

            <?php get_template_part('template-parts/blogs-section-content') ?>

        </div>
    </section>

    <?php get_template_part( 'template-parts/view-lineup-medium' ) ?>


<?php endwhile; endif; ?>
 </main>
 <?php
 get_footer();
 