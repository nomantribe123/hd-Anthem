<?php
/**
 * Template Name: Where to buy
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
   <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Where to Buy', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>


   <section class="mt-10">
        <div class="container flex gap-[33px] pb-[150px]">
            <div class="w-[583px] shrink-0">
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[40px] leading-[120%]">Find a Printer or Distributor for Your Anthem Clothing</div>
            </div>

            <div class="text-lg leading-[150%]">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.
            </div>
        </div>

        <div class="container mt-12 grid grid-cols-2 gap-[33px]">
            <div class="border border-[#B1B1B1] rounded-3xl p-8 min-h-[390px] flex flex-col gap-6">
                <div class="text-[40px] font-bold">
                I am a Trade Customer
                </div>
                <div class="text-lg">Amet pellentesque sit pulvinar lorem mi a, euismod risus rhoncus. Elementum ullamcorper nec.</div>

                <div class="flex gap-4">
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Printers 
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Embellishers
                    </div>
                </div>

                <div class="mt-auto">
                    <button type="button" class="btn bg-black text-white w-full">Continue as Trade Customer<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="currentColor"/></svg></button>
                </div>
            </div>

            <div class="border border-[#B1B1B1] rounded-3xl p-8 min-h-[390px] flex flex-col gap-6">
                <div class="text-[40px] font-bold">
                I am a Non-Trade Customer
                </div>
                <div class="text-lg">Amet pellentesque sit pulvinar lorem mi a, euismod risus rhoncus. Elementum ullamcorper nec.</div>

                <div class="flex gap-4">
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Companies
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Clubs
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Schools
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Teams
                    </div>
                    <div class="flex gap-1 items-center">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.5C4.486 0.5 0 4.986 0 10.5C0 16.014 4.486 20.5 10 20.5C15.514 20.5 20 16.014 20 10.5C20 4.986 15.514 0.5 10 0.5ZM10 18.5C5.589 18.5 2 14.911 2 10.5C2 6.089 5.589 2.5 10 2.5C14.411 2.5 18 6.089 18 10.5C18 14.911 14.411 18.5 10 18.5Z" fill="black"/><path d="M7.99902 12.087L5.70002 9.79203L4.28802 11.208L8.00103 14.913L14.707 8.20703L13.293 6.79303L7.99902 12.087Z" fill="black"/></svg>
                        Organisations
                    </div>
                </div>

                <div class="mt-auto">
                    <button type="button" class="btn bg-black text-white w-full">Continue as Non- Trade Customer<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="currentColor"/></svg></button>
                </div>
            </div>
        </div>
   </section>

   <?php get_template_part( 'template-parts/view-lineup-section' ) ?>
   <?php get_template_part( 'template-parts/sustainability-section' ) ?>
   <?php get_template_part( 'template-parts/blogs-section' ) ?>

            <?php
         endwhile;
     endif;
     ?>
 </main>
 <?php
 get_footer();
 