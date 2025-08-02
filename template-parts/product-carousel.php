<?php if (!isset($args['no_container'])): ?>
<section class="mt-[80px] p-12">
    <div class="container">
<?php endif; ?>
        <div class="flex flex-wrap items-center justify-between gap-10">
            <div>
                <div class="text-[40px]">Image Carousel of Products</div>
                <div class="mt-4 text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
            </div>

            <button type="button" class="btn px-[27px] border border-black">
            View All Our Line-Up
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.05129 8.55129L5 9.5L9.5 5L5 0.5L4.05129 1.44871L6.93164 4.32906H0.5V5.67094H6.93164L4.05129 8.55129Z" fill="black"/>
                </svg>
            </button>
        </div>

        <div class="mt-12 grid grid-cols-4 gap-[37px]">
            <div>
                <figure class="relative">
                    <img src="<?php echo get_template_directory_uri(  ) . '/assets/image/homepage/carousel-1.jpg' ?>" class="h-[365px] w-full rounded-3xl object-cover" alt="">
                    <figcaption class="absolute text-sm h-9 bottom-3 inset-x-3 w-[calc(100%-24px]] mx-auto rounded-full border border-black flex items-center justify-center bg-[#FFFFFF05] backdrop-blur-[35px]">
                    Quick View
                    </figcaption>
                </figure>

                <div class="mt-4">
                    <div class="text-lg">Product name</div>
                    <div class="text-sm mt-1">
                    #12345 (Item Number)
                    </div>
                    <div class="text-sm mt-1">Size: XS - 6XL</div>
                </div>
            </div>
        </div>
<?php if (!isset($args['no_container'])): ?>

    </div>
</section>
<?php endif; ?>
