<?php
/**
 * Template Name: Homepage
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main">
     
 <?php
     if ( have_posts() ) :
         while ( have_posts() ) :
             the_post();
             ?>
    <section class="mt-10">
        <div class="container">
            <div class="relative min-h-[623px] flex px-12 overflow-hidden rounded-3xl">
                <img class="w-[1348px] object-cover rounded-3xl inset-0 absolute z-10" src="<?php echo get_template_directory_uri() . '/assets/image/homepage/slider-bg.jpg' ?>" alt="">
                <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_36.11%,rgba(255,255,255,0.7)_144.93%)]"></div>
                <div class="p-12 mt-[220px] max-w-[600px] relative z-20">
                    <div class="text-5xl leading-[120%]">Welcome to Anthem</div>
                    <div class="leading-[150%] mt-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros</div>
                    <div class="mt-12">
                        <button type="button" class="btn border border-black text-black px-[38px]">
                            View Our Line-Up <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-20">
        <div class="container">
            <div class="flex items-center gap-20">
                <div class="pl-[64px]"> 
                    <div class="w-5 h-[1px] bg-black mb-6"></div>
                    <div class="text-[40px] leading-[120%]">(Introduction)Anthem products are available through a network of distributors</div>
                    <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>
                    <div class="mt-8">
                        <button type="button" class="btn border border-black text-black px-[38px]">
                        More About Us <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                        </button>
                    </div>
                </div>
                <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/image-1.png' ?>" class="w-[43.8%] max-w-[594px] shrink-0" alt="">
            </div>
        </div>
    </section>

   <?php get_template_part( 'template-parts/view-lineup-section' ) ?>
   <?php get_template_part( 'template-parts/sustainability-section' ) ?>

    <section class="mt-20 relative min-h-[975px]">
        <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/anthem-bg.png' ?>" class="pointer-events-none w-full h-full object-cover inset-0 absolute z-10" alt="">

        <div class="container flex gap-[120px] items-center relative z-20">
            <div class="p-8 bg-[#FFFFFF05] shadow-[0px_8px_30px_0px_rgba(0,0,0,0.05)] backdrop-blur-[30px]">
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[40px] leading-[120%]">Where to Buy</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>

                <div class="mt-[80px]">
                    <button type="button" class="btn border border-black text-black px-[102px]">
                    Where to Buy <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                    </button>
                </div>
            </div>

            <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/image-3.jpg' ?>" class="w-[40%] max-w-[543px] aspect-[543/697] rounded-3xl shrink-0 object-cover" alt="">
        </div>
    </section>

<?php get_template_part( 'template-parts/blogs-section' ) ?>

    <section class="mt-[80px]">
        <div class="container">
            <div class="max-w-[460px] text-center flex flex-col items-center mx-auto">
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[48px] leading-[120%]">Social Feed</div>
                <div class="mt-6 text-lg leading-[150%]">Amet pellentesque sit pulvinar lorem mi a, euismod risus rhoncus. Elementum ullamcorper nec.</div>


                <div class="flex gap-2 mt-6">
                    <div class="border border-[#F0F0F0] bg-[#F4F4F4] rounded-3xl py-[6px] px-[12px] text-sm font-normal">Youtube</div>
                    <div class="border border-[#F0F0F0] bg-[#F4F4F4] rounded-3xl py-[6px] px-[12px] text-sm font-normal">Instagram</div>
                    <div class="border border-[#F0F0F0] bg-[#F4F4F4] rounded-3xl py-[6px] px-[12px] text-sm font-normal">Facebook</div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-8">
                <div class="flex flex-col gap-8">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/social-1.jpg' ?>" class="h-[630px] object-cover rounded-3xl" alt="">
                </div>
                <div class="flex flex-col gap-8">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/social-2.jpg' ?>" class="h-[234px] object-cover rounded-3xl" alt="">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/social-3.jpg' ?>" class="h-[365px] object-cover rounded-3xl" alt="">
                </div>
                <div class="flex flex-col gap-8">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/social-4.jpg' ?>" class="h-[356px] object-cover rounded-3xl" alt="">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/social-5.jpg' ?>" class="h-[234px] object-cover rounded-3xl" alt="">
                </div>
            </div>
        </div>
    </section>

 <?php get_template_part( 'template-parts/product-carousel' ) ?>
            <?php
         endwhile;
     endif;
     ?>
 </main>
 <?php
 get_footer();
 