<?php
/**
 * Template Name: Sustainability
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main" class="page-gradient">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Sustainability', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

    <section class="my-[76px]">
        <div class="container flex justify-between gap-5 items-center flex-wrap md:flex-nowrap">
            <div>
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[48px] leading-[120%] pr-20">
                    Certified Organic & 
                    Planet-Friendly Fabrics
                </div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>

                <div class="mt-8 flex flex-col gap-8">
                    <div class="flex gap-6">
                        <svg width="40" height="44" viewBox="0 0 40 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.45312 42.7785H38.6" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M30.7427 14.8536C27.981 14.8536 25.7422 17.0415 25.7422 19.7404C25.7422 22.4376 27.9832 24.6273 30.7427 24.6273C33.5044 24.6273 35.7432 22.4394 35.7432 19.7404V14.8536H30.7427Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.4921 4.34648C14.5391 6.25497 14.5391 9.34918 16.4921 11.2577C18.4438 13.1648 21.612 13.1648 23.5636 11.2577C25.5167 9.34918 25.5167 6.25497 23.5636 4.34648L20.0275 0.89093L16.4921 4.34648Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.31105 14.8535C12.0728 14.8535 14.3116 17.0414 14.3116 19.7403C14.3116 22.4375 12.0714 24.6272 9.31105 24.6272C6.54932 24.6272 4.31055 22.4393 4.31055 19.7403V14.8535H9.31105Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.0566 23.3997L20.0274 30.2122" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M26.9988 23.3997L20.0273 30.2122" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.0273 12.688V34.4011" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.3591 37.5115C12.7633 37.3054 12.1218 37.1934 11.4532 37.1934C8.29709 37.1934 5.73828 39.6939 5.73828 42.7785H11.4532H22.883H34.3127C34.3127 39.6939 31.7546 37.1934 28.5978 37.1934C27.9299 37.1934 27.2884 37.3054 26.6926 37.5115C25.1211 35.614 22.7179 34.4009 20.0255 34.4009C17.3332 34.4009 14.9307 35.614 13.3591 37.5115Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div>
                            <div class="text-[24px]">
                            Certified Organic Cotton
                            </div>
                            <div class="mt-2 text-base font-normal">Lorem ipsum dolor sit amet </div>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_10486_12087" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="43" height="43">
                            <path d="M0 3.8147e-06H43V43H0V3.8147e-06Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_10486_12087)">
                            <path d="M32.5254 7.50916L30.3514 3.78059C29.3931 2.13694 27.6308 1.12904 25.7281 1.13651L17.7109 1.1665L24.5091 12.1935L22.2671 13.5036C21.6227 13.8801 21.8357 14.8611 22.5781 14.9366L30.6931 15.7619C31.6249 15.8567 32.5101 15.3347 32.8783 14.4735L36.0458 7.06262C36.3379 6.37915 35.5894 5.71879 34.9476 6.09369L32.5254 7.50916Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M29.4319 38.2442L33.7396 37.9751C35.6386 37.8565 37.3303 36.7342 38.1777 35.0305L41.7495 27.853L28.8443 28.9781L28.68 26.3866C28.6328 25.6418 27.6606 25.3917 27.2599 26.0214L22.8797 32.9025C22.3768 33.6926 22.4459 34.7179 23.0503 35.4334L28.2508 41.5905C28.7303 42.1582 29.6565 41.7857 29.6095 41.0441L29.4319 38.2442Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.8915 24.428L11.6108 16.96C11.2341 16.1025 10.3437 15.5894 9.41287 15.6935L1.40328 16.5891C0.66472 16.6717 0.458875 17.6485 1.10136 18.022L3.52666 19.4323L1.35356 23.1613C0.395467 24.8053 0.386901 26.8354 1.33097 28.4873L5.30771 35.4488L11.553 24.0995L13.7979 25.4048C14.443 25.7799 15.1917 25.1112 14.8915 24.428Z" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.7119 1.16791C15.5761 1.17631 13.609 2.33344 12.5649 4.19672L9.26725 10.0195C8.8826 10.6987 9.12321 11.5612 9.80399 11.9432L15.4424 15.1062C16.1197 15.4861 16.9766 15.2466 17.3587 14.5707L21.5 7.49986" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5.30859 35.4473C6.36839 37.3017 8.34455 38.443 10.4804 38.4334L17.1721 38.4336C17.9528 38.4336 18.5847 37.7992 18.5816 37.0185V30.5536C18.5784 29.7772 17.9216 29.1495 17.1451 29.15H9" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M41.7486 27.8532C42.6998 25.9408 42.5487 23.6637 41.3524 21.8943L37.6293 16.3339C37.1951 15.6853 36.3162 15.5132 35.6694 15.9501L30.312 19.5687C29.6685 20.0034 29.4979 20.8767 29.9304 21.5216L34.5 28.5" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>


                        <div>
                            <div class="text-[24px]">
                            Recycled Polyster
                            </div>
                            <div class="mt-2 text-base font-normal">Lorem ipsum dolor sit amet </div>
                        </div>

                    </div>
                </div>

            </div>

            <img class="w-[664px] rounded-3xl aspect-[676/507] object-cover" src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/sustainability/image-1.jpeg' ?>" alt="">

        </div>
    </section>

    <section class="my-[76px]">
        <div class="container py-[64px] flex flex-wrap gap-[80px] justify-between items-center">
            <div class="max-w-[479px]">
                <div class="text-[32px] leading-[120%]">Ethical Production & Responsible Sourcing</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.</div>
            </div>

            <div class="flex flex-col gap-20">
                <div class="flex gap-8 flex-wrap"></div>
                <div class="flex gap-8 flex-wrap"></div>
            </div>
        </div>
   </section>

    <section class="my-[76px] bg-white rounded-3xl py-[100px]">
        <div class="container flex justify-between items-center gap-20">
            <img class="w-[602px] max-w-full object-cover rounded-3xl aspect-[602/459]" src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/sustainability/image-2.png' ?>" alt="">

            <div>
                <div class="w-5 h-[1px] bg-black mb-6"></div>
                <div class="text-[48px] leading-[120%]">Header 2</div>
                <div class="mt-6 text-lg leading-[150%]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. Nibh scelerisque ac adipiscing velit non nulla in amet pellentesque. Sit turpis pretium eget maecenas. Vestibulum dolor mattis consectetur eget commodo vitae.</div>
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
 