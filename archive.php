<?php
get_header();

// Get the archive title and description
$archive_title = get_the_archive_title();
$archive_description = get_the_archive_description();
?>

<section class=py-12 lg:py-30">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <header class="mb-12 text-center">
                <h1 class="text-3xl lg:text-4xl font-medium mb-4"><?php echo wp_kses_post($archive_title); ?></h1>
                <?php if ($archive_description) : ?>
                    <div class="text-lg text-gray-600">
                        <?php echo wp_kses_post($archive_description); ?>
                    </div>
                <?php endif; ?>
            </header>

            <?php if (have_posts()) : ?>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-2">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
                                    <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-105')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <header class="mb-4">
                                    <div class="text-sm mb-2">
                                        <?php echo get_the_date(); ?>
                                    </div>
                                    <h2 class="text-xl font-medium mb-2">
                                        <a href="<?php the_permalink(); ?>" class="hover:transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                </header>

                                <div class="text-gray-600 mb-4">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                </div>

                                <footer class="flex items-center justify-between">
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center transition-colors">
                                        Read More
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L16 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z" fill="currentColor"/>
                                        </svg>
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="mt-12">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '&larr; Previous',
                        'next_text' => 'Next &rarr;',
                        'class' => 'flex justify-center gap-2',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="text-center py-12">
                    <p class="text-lg text-gray-600">No posts found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?> 