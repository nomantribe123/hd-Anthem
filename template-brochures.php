<?php
/**
 * Template Name: Brochure
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main" class="page-gradient">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Brochure Downloads', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>

    <section class="bg-white rounded-3xl py-20">
        <div class="container">
            <div class="py-6 px-[84px] flex items-center gap-[48px]">
                <img class="w-[672px] max-w-full aspect-[672/400] object-cover" src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/brochure/image-1.jpeg' ?>" alt="">

                <div class="max-w-[455px]">
                    <div class="text-[24px]">Download Brochure</div>
                    <div class="mt-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</div>

                    <div class="flex mt-6">
                        <button type="button" class="btn p-4 border border-[#B1B1B1]">
                            Download Link
                            <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 12L14.5 7H11.5V0H9.5V7H6.5L10.5 12Z" fill="black"/>
                                <path d="M18.5 14H2.5V7H0.5V14C0.5 15.103 1.397 16 2.5 16H18.5C19.603 16 20.5 15.103 20.5 14V7H18.5V14Z" fill="black"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="py-6 px-[84px] flex items-center gap-[48px] mt-[48px]">

                <div class="max-w-[455px]">
                    <div class="text-[24px]">View our Promo Assets</div>
                    <div class="mt-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</div>

                    <div class="flex mt-6">
                        <button type="button" class="btn px-6 py-3 border border-[#B1B1B1]">
                            Link to Norty Website
                            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.55129 8.55129L4.5 9.5L9 5L4.5 0.5L3.55129 1.44871L6.43164 4.32906H0V5.67094H6.43164L3.55129 8.55129Z" fill="black"/></svg>

                        </button>
                    </div>
                </div>

                <img class="w-[672px] max-w-full aspect-[672/400] object-cover" src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/brochure/image-2.jpeg' ?>" alt="">

            </div>

            <div class="py-[64px]">
                <div class="max-w-[1066px] mx-auto flex justify-between flex-wrap items-center">
                    <div class="max-w-[440px]">
                        <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_11149_10499" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="78" height="78">
                        <path d="M0.290039 0.5H77.7094V77.5H0.290039V0.5Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_11149_10499)">
                        <path d="M66.2179 23.0586L75.4417 29.8262V75.2441H2.55859V29.8262L11.7824 23.0586" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M26.9033 11.7793L39.0001 2.75586L51.0969 11.7793" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <path d="M11.7822 43.3613V11.7793H66.2177V43.3613" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <mask id="mask1_11149_10499" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="78" height="78">
                        <path d="M0.290039 0.5H77.7094V77.5H0.290039V0.5Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask1_11149_10499)">
                        <path d="M2.55859 38.8496L39.0001 56.8965L75.4417 38.8496" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <path d="M25.3906 25.3145H52.6084" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.3906 34.3379H38.9995" stroke="black" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div class="mt-5 text-[24px]">Email</div>
                        <div class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.</div>

                        <div class="mt-5 text-[24px] underline">hello@anthemclothing.com</div>
                    </div>

                    <div class="max-w-[440px]">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_11149_10530" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="80" height="80">
                        <path d="M0 7.62939e-06H80V80H0V7.62939e-06Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_11149_10530)">
                        <path d="M40.6472 59.8188L41.7702 58.6958C43.2935 57.1725 45.763 57.1725 47.2863 58.6958L53.4133 64.8228C54.9366 66.3461 54.9366 68.8156 53.4133 70.3389L50.3499 73.4024C32.3216 91.4306 -11.3804 47.7286 6.64787 29.7003L9.71428 26.6339C11.2363 25.1119 13.7037 25.1106 15.2274 26.6311L21.3608 32.7519C22.8868 34.2746 22.888 36.7464 21.3638 38.2706L20.2315 39.403C11.8896 47.7449 32.3054 68.1606 40.6472 59.8188Z" stroke="black" stroke-miterlimit="10"/>
                        <path d="M58.0692 2.36987C47.2392 2.36987 38.4598 11.1492 38.4598 21.9792C38.4598 25.1399 39.2087 28.1252 40.5368 30.7692L37.9404 42.1839L49.4079 39.5755C52.02 40.8638 54.9596 41.5886 58.0692 41.5886C68.8992 41.5886 77.6786 32.8092 77.6786 21.9792C77.6786 11.1492 68.8992 2.36987 58.0692 2.36987Z" stroke="black" stroke-miterlimit="10"/>
                        <path d="M49.1533 21.2362L55.5536 27.6365L66.898 16.2922" stroke="black" stroke-miterlimit="10"/>
                        </g>
                        </svg>


                        <div class="mt-5 text-[24px]">Phone</div>
                        <div class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.</div>

                        <div class="mt-5 text-[24px] underline">+44 01234 56789</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/view-lineup-medium' ) ?>


<?php endwhile; endif; ?>
 </main>
 <?php
 get_footer();
 