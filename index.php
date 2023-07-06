<?php /* Template Name: Blog */ ?>
<?php get_header() ?>
<main class="page-text pb-10">
    <section class="container mx-auto">
        <div class="mt-8 mb-12">
            <?php  woocommerce_breadcrumb() ?>
        </div>
    </section>
    <section class="container mx-auto">
        <h1 class="font-light text-5xl my-10 w-full text-center">
            <?php echo get_the_title(get_option('page_for_posts')) ?>
        </h1>
    </section>
    <section class="container grid grid-cols-4 gap-10 mx-auto">



        <?php if ( have_posts() ) : ?>

        <?php
// Start the loop
while ( have_posts() ) :
    the_post();
    ?>

        <article id="post-<?php the_ID(); ?>"
                 class="col-span-4 md:col-span-2 lg:col-span-1 border-light-gray border hover:border-green hover:text-green transition-all"
                 <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>"
               class="post-link">
                <figure class="relative w--full h-64">
                    <img class="absolute w-full h-full top-0 left-0 object-cover object-center"
                         src="<?php echo !empty($thumb = get_the_post_thumbnail_url()) ? $thumb : THEME_IMG . "default.jpg" ?>"
                         alt="<?php the_title(); ?>" />
                </figure>
                <h2 class="post-title p-5 text-xl"><?php the_title(); ?></h2>
            </a>
        </article>

        <?php endwhile; ?>



        <?php else : ?>

        <article class="col-span-4 text-lg">
            <p><?php _e( 'Brak wpisów', 'textdomain' ); ?></p>
        </article>

        <?php endif; ?>
    </section>
    <?php if ( have_posts() ) : ?>
    <section class="container mx-auto mt-10">
        <div class="pagination">
            <?php
    // Pagination
    the_posts_pagination(
        array(
            'prev_text' => __( '<<', 'textdomain' ),
            'next_text' => __( '>>', 'textdomain' ),
            'screen_reader_text' => __( 'Posts navigation', 'textdomain' ),
            'mid_size' => 2,
        )
    );
    ?>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php get_footer() ?>