<?php get_header(); ?>

<div class=py-24">
    <div class="container">
        <div class="lg:w-2/3 xl:w-3/5 mx-auto text-center">
            <h1 class="text-8xl font-black mb-6">404</h1>
            <p class="text-lg text-gray-600 mb-12">Sorry, the page you are looking for doesn't exist or has been moved.</p>
            
            
            <!-- Search Form -->
            <div class="relative w-full sm:w-96 mx-auto mb-12">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
                    <input type="search" name="s" placeholder="Search our site..."
                           class="h-11 w-full border-[#9B9B9B] focus:border-black pr-12"
                           style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) -32.42%, rgba(49, 52, 74, 0.1406) 100%);">
                    <input type="hidden" name="post_type" value="any">
                    <button type="submit" class="absolute top-1/2 right-4 -translate-y-1/2">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C11.775 17.9996 13.4988 17.4054 14.897 16.312L19.293 20.708L20.707 19.294L16.311 14.898C17.405 13.4997 17.9996 11.7754 18 10C18 5.589 14.411 2 10 2C5.589 2 2 5.589 2 10C2 14.411 5.589 18 10 18ZM10 4C13.309 4 16 6.691 16 10C16 13.309 13.309 16 10 16C6.691 16 4 13.309 4 10C4 6.691 6.691 4 10 4Z" fill="currentColor"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Helpful Links -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold mb-6">You might want to check these pages:</h3>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="inline-block px-6 py-3  text-white font-medium rounded hover:brightness-90 transition-all">
                        Back to Homepage
                    </a>
                    <a href="<?php echo esc_url(home_url('/our-workwear')); ?>" 
                       class="inline-block px-6 py-3 bg-white font-medium rounded border border-black hover: hover:text-white transition-all">
                        Browse Our Workwear
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
