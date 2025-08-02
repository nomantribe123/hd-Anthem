<?php
/**
 * Template Name: Product
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

     <section class="mt-12">
        <div class="container flex gap-[71px]">
            <div class="flex flex-col gap-2 w-[616px] shrink-0">
                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/image-1.jpeg' ?>" class="max-w-full object-cover aspect-[616/424] rounded-t-[24px]" alt="">
                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/image-2.jpg' ?>" class="max-w-full object-cover aspect-[616/424] border border-[#E4E4E4]" alt="">
                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/image-3.jpeg' ?>" class="max-w-full object-cover aspect-[616/424] rounded-b-[24px]" alt="">
            </div>
            <div>
                <?php get_template_part( 'template-parts/breadcrumbs' ) ?>

                <div class="mt-[27px] font-normal">
                Product Code: <span class="font-bold">AM002</span>
                </div>

                <div class="w-5 h-[1px] bg-black my-2"></div>

                <h1 class="text-[40px] font-normal leading-[120%]">Anthems Men's Zip Hoodie</h1>

                <div class="mt-[27px]">
                    <div class="text-lg"><span class="font-bold">Colour</span>: Grey</div>
                    <div class="mt-4">
                        <div class="flex space-x-4 items-center">
                            <label class="relative">
                                <input type="radio" name="color" value="gray" class="sr-only peer" checked>
                                <div class="w-8 h-8 rounded-full bg-[#C1BFC7] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="red" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#BE4644] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="rose" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#C64D6D] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="blue" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#334D91] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="gray" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#1E2B25] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="green" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#46804F] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>
                            <label>
                                <input type="radio" name="color" value="yellow" class="sr-only peer">
                                <div class="w-8 h-8 rounded-full bg-[#DDC952] peer-checked:ring-2 peer-checked:ring-black peer-checked:ring-offset-2 peer-checked:ring-offset-white"></div>
                            </label>

                            <button type="button" class="flex gap-1 items-center px-4 py-2.5 rounded-full border border-[#F0F0F0] bg-[#F3F3F3] text-sm">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.04134 3.79171H5.95801V5.95837H3.79134V7.04171H5.95801V9.20837H7.04134V7.04171H9.20801V5.95837H7.04134V3.79171Z" fill="black"/><path d="M6.49967 1.08337C3.51292 1.08337 1.08301 3.51329 1.08301 6.50004C1.08301 9.48679 3.51292 11.9167 6.49967 11.9167C9.48642 11.9167 11.9163 9.48679 11.9163 6.50004C11.9163 3.51329 9.48642 1.08337 6.49967 1.08337ZM6.49967 10.8334C4.11038 10.8334 2.16634 8.88933 2.16634 6.50004C2.16634 4.11075 4.11038 2.16671 6.49967 2.16671C8.88897 2.16671 10.833 4.11075 10.833 6.50004C10.833 8.88933 8.88897 10.8334 6.49967 10.8334Z" fill="black"/></svg>

                                Expand Colours
                            </button>
                        </div>

                        <button type="button" class="btn bg-black text-white w-full h-[61px] mt-8">Where to Buy <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.84047 9.84046L6 11L11.5 5.5L6 0L4.84047 1.15953L8.36089 4.67996H0.5V6.32004H8.36089L4.84047 9.84046Z" fill="white"/></svg>
                        </button>
                    </div>

                    <div class="mt-[27px] flex flex-col gap-y-5">
                        <div class="text-lg font-bold">Description</div>
                        <div class="leading-[150%]">The best things come in threes: ethically sourced, in exceptional fabrics and ready to embellish. The men’s Anthem full-zip hoodie in soft-feel organic cotton with recycled polyester is available in a cool collection of colours with exceptional details and a high-quality finish. </div>
                        <div class="flex flex-wrap gap-6">
                            <div class="text-lg font-bold">Oversized Fit</div>
                            <div class="text-lg font-bold">Sizes : <span class="font-normal">XS - 6XL</span></div>
                            <div class="text-lg font-bold">Weight : <span class="font-normal">170 GSM</span></div>
                        </div>

                        <div class="text-lg font-bold">Fabric</div>
                        <div class="leading-[150%]">100% Organic Cotton,  Marls: 60% Organic Cotton  <br> 40% Recycled Polyester </div>

                        <div class="flex flex-wrap gap-10">
                            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-1.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-2.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-3.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-4.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                            <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/logo-5.png' ?>" class="object-cover w-[88px] h-[88px]" alt="">
                        </div>


                        <div class="text-lg font-bold">Care Instructions</div>
                        <div class="leading-[150%]">
                            Lorem ipsum dolor sit amet consectetur. In feugiat risus cursus id.
                        
                            <div class="mt-4 flex gap-10 flex-wrap">
                                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/label-1.svg' ?>" class="object-cover w-[46px] h-[46px]" alt="">
                                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/label-2.svg' ?>" class="object-cover w-[46px] h-[46px]" alt="">
                                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/label-3.svg' ?>" class="object-cover w-[46px] h-[46px]" alt="">
                                <img src="<?php echo get_stylesheet_directory_uri(  ) . '/assets/image/product/label-4.svg' ?>" class="object-cover w-[46px] h-[46px]" alt="">
                            </div>
                        </div>

                        <button type="button" class="btn rounded-full w-full border border-[#B1B1B1] bg-[#F9F9F9] h-[56px]">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 16L16 11H13V4H11V11H8L12 16Z" fill="black"/><path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z" fill="black"/></svg>
                            Size Chart Download
                        </button>

                        <button type="button" class="btn rounded-full w-full border border-[#B1B1B1] bg-[#F9F9F9] h-[56px]">
                            Link to Asset Downloads 
                            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.84047 9.84046L6 11L11.5 5.5L6 0L4.84047 1.15953L8.36089 4.67996H0.5V6.32004H8.36089L4.84047 9.84046Z" fill="currentColor"/>
                            </svg>
                        </button>


                    </div>
                </div>

            </div>
        </div>
     </section>    
     
     <?php get_template_part( 'template-parts/where-to-buy-section' ) ?>

     <section class="mt-[120px] mb-10">
        <div class="container rounded-3xl relative p-8 overflow-none">
            <div class="w-[482px] bg-[#FFFFFF8F] backdrop-blur-[22px] rounded-2xl p-4 mr-auto max-w-full">
              <?php get_template_part( 'template-parts/sustainability-content', '', array('is_small' => true, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius faucibus massa sollicitudin amet augue. Nibh metus a semper purus mauris duis. Lorem eu neque, tristique quis duis. ') ) ?>
            </div>

            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/image/product/sustainability.jpg' ?>" class="absolute top-0 right-0 w-full h-full object-cover z-[-1] pointer-events-none rounded-3xl" alt="">
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
 