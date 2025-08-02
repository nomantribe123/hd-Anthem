<section class="mt-[80px] p-12">
    <div class="container">
        <div class="flex flex-wrap items-center justify-between gap-10">
            <div>
                <div class="text-[40px]">The Thread Title Goes Here</div>
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