<?php
/**
 * Template Name: Our lineup - Parent
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
   <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Our Line-Up', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

   <section class="mt-[80px]">
        <div class="container">
            <div class="flex gap-5 justify-center flex-wrap">
                <div class="relative h-[664px] flex items-end w-[calc(50%-10px)]">
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/social-5.jpg' ?>" class="absolute z-10 h-[664px] w-full object-cover rounded-3xl" alt="">

                    <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_34%,rgba(255,255,255,0.756)_101%)]"></div>
                    <div class="p-12 max-w-[600px] relative z-20 flex flex-col">
                        <div class="w-5 h-[1px] bg-black mb-6"></div>
                        <div class="text-[40px] leading-[120%]">T-Shirts</div>
                        <div class="leading-[150%] mt-6 text-lg">Amet pellentesque sit pulvinar lorem mi.</div>
                        <div class="mt-12">
                            <button type="button" class="btn bg-[#FFFFFF0F] backdrop-blur-[35px] border border-black text-black px-[75px]">
                                View All <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="relative h-[664px] flex items-end w-[calc(50%-10px)]">
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/social-5.jpg' ?>" class="absolute z-10 h-[664px] w-full object-cover rounded-3xl" alt="">

                    <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_34%,rgba(255,255,255,0.756)_101%)]"></div>
                    <div class="p-12 max-w-[600px] relative z-20 flex flex-col">
                        <div class="w-5 h-[1px] bg-black mb-6"></div>
                        <div class="text-[40px] leading-[120%]">T-Shirts</div>
                        <div class="leading-[150%] mt-6 text-lg">Amet pellentesque sit pulvinar lorem mi.</div>
                        <div class="mt-12">
                            <button type="button" class="btn bg-[#FFFFFF0F] backdrop-blur-[35px] border border-black text-black px-[75px]">
                                View All <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="relative h-[664px] flex items-end w-[calc(50%-10px)]">
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/social-5.jpg' ?>" class="absolute z-10 h-[664px] w-full object-cover rounded-3xl" alt="">

                    <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_34%,rgba(255,255,255,0.756)_101%)]"></div>
                    <div class="p-12 max-w-[600px] relative z-20 flex flex-col">
                        <div class="w-5 h-[1px] bg-black mb-6"></div>
                        <div class="text-[40px] leading-[120%]">T-Shirts</div>
                        <div class="leading-[150%] mt-6 text-lg">Amet pellentesque sit pulvinar lorem mi.</div>
                        <div class="mt-12">
                            <button type="button" class="btn bg-[#FFFFFF0F] backdrop-blur-[35px] border border-black text-black px-[75px]">
                                View All <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="relative h-[664px] flex items-end w-[calc(50%-10px)]">
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/social-5.jpg' ?>" class="absolute z-10 h-[664px] w-full object-cover rounded-3xl" alt="">

                    <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_34%,rgba(255,255,255,0.756)_101%)]"></div>
                    <div class="p-12 max-w-[600px] relative z-20 flex flex-col">
                        <div class="w-5 h-[1px] bg-black mb-6"></div>
                        <div class="text-[40px] leading-[120%]">T-Shirts</div>
                        <div class="leading-[150%] mt-6 text-lg">Amet pellentesque sit pulvinar lorem mi.</div>
                        <div class="mt-12">
                            <button type="button" class="btn bg-[#FFFFFF0F] backdrop-blur-[35px] border border-black text-black px-[75px]">
                                View All <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="relative h-[664px] flex items-end w-[calc(50%-10px)]">
                    <img src="<?php echo get_template_directory_uri() . '/assets/image/homepage/social-5.jpg' ?>" class="absolute z-10 h-[664px] w-full object-cover rounded-3xl" alt="">

                    <div class="absolute z-[15] w-full h-full bottom-0 right-0 bg-[linear-gradient(180deg,transparent_34%,rgba(255,255,255,0.756)_101%)]"></div>
                    <div class="p-12 max-w-[600px] relative z-20 flex flex-col">
                        <div class="w-5 h-[1px] bg-black mb-6"></div>
                        <div class="text-[40px] leading-[120%]">T-Shirts</div>
                        <div class="leading-[150%] mt-6 text-lg">Amet pellentesque sit pulvinar lorem mi.</div>
                        <div class="mt-12">
                            <button type="button" class="btn bg-[#FFFFFF0F] backdrop-blur-[35px] border border-black text-black px-[75px]">
                                View All <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/></svg>
                            </button>
                        </div>
                    </div>
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
 