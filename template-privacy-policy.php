<?php
/**
 * Template Name: Privacy Policy
 * The template for displaying pages
 *
 * @package Anthem
 * @since 1.0.0
 */

 get_header();

 ?>
 <main id="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/page-header', '', array('title' => 'Privacy Policy', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.') )  ?>


    <section class="my-[106px]">
        <div class="container flex justify-between flex-wrap">
            <div class="w-[320px]">
                <div class="text-[24px] font-bold">Table of contents</div>
                <div class="mt-4">
                    <div class="text-lg font-bold bg-[#F6F6F6] py-3 px-4">Headin 2</div>
                    <div class="text-lg py-3 pl-8">Headin 3</div>
                    <div class="text-lg py-3 pl-12">Headin 4</div>
                    <div class="text-lg py-3 pl-[64px]">Headin 5</div>
                    <div class="text-lg py-3 pl-[80px]">Headin 6</div>

                </div>
            </div>
            <div class="max-w-[768px]">
                <h2 class="font-bold text-[48px] mb-4">Heading 2</h2>
                <div>Mi tincidunt elit, id quisque ligula ac diam, amet. Vel etiam suspendisse morbi eleifend faucibus eget vestibulum felis. Dictum quis montes, sit sit. Tellus aliquam enim urna, etiam. Mauris posuere vulputate arcu amet, vitae nisi, tellus tincidunt. At feugiat sapien varius id.</div>
                <h3 class="my-6 text-[40px] font-bold">Heading 3</h3>
                <div>Eget quis mi enim, leo lacinia pharetra, semper. Eget in volutpat mollis at volutpat lectus velit, sed auctor. Porttitor fames arcu quis fusce augue enim. Quis at habitant diam at. Suscipit tristique risus, at donec. In turpis vel et quam imperdiet. Ipsum molestie aliquet sodales id est ac volutpat.</div>
                <div class="mt-4">Tristique odio senectus nam posuere ornare leo metus, ultricies. Blandit duis ultricies vulputate morbi feugiat cras placerat elit. Aliquam tellus lorem sed ac. Montes, sed mattis pellentesque suscipit accumsan. Cursus viverra aenean magna risus elementum faucibus molestie pellentesque. Arcu ultricies sed mauris vestibulum.</div>

                <h3 class="my-6 text-[32px] font-bold">Heading 4</h3>
                <div class="mt-4">Tristique odio senectus nam posuere ornare leo metus, ultricies. Blandit duis ultricies vulputate morbi feugiat cras placerat elit. Aliquam tellus lorem sed ac. Montes, sed mattis pellentesque suscipit accumsan. Cursus viverra aenean magna risus elementum faucibus molestie pellentesque. Arcu ultricies sed mauris vestibulum.</div>

                <h3 class="my-6 text-[24px] font-bold">Heading 5</h3>
                <div class="mt-4">Tristique odio senectus nam posuere ornare leo metus, ultricies. Blandit duis ultricies vulputate morbi feugiat cras placerat elit. Aliquam tellus lorem sed ac. Montes, sed mattis pellentesque suscipit accumsan. Cursus viverra aenean magna risus elementum faucibus molestie pellentesque. Arcu ultricies sed mauris vestibulum.</div>

                <h3 class="my-6 text-[20px] font-bold">Heading 6</h3>
                <div class="mt-4">Tristique odio senectus nam posuere ornare leo metus, ultricies. Blandit duis ultricies vulputate morbi feugiat cras placerat elit. Aliquam tellus lorem sed ac. Montes, sed mattis pellentesque suscipit accumsan. Cursus viverra aenean magna risus elementum faucibus molestie pellentesque. Arcu ultricies sed mauris vestibulum.</div>

            </div>
        </div>
    </section>

    <?php get_template_part( 'template-parts/view-lineup-medium' ) ?>


<?php endwhile; endif; ?>
 </main>
 <?php
 get_footer();
 