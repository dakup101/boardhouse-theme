<?php /* Template Name: Blog */ ?>
<?php get_header() ?>
<main class="page-text pb-10">
    <figure class="relative w--full h-80">
        <img class="absolute w-full h-full top-0 left-0 object-cover object-center"
             src="<?php echo !empty($thumb = get_the_post_thumbnail_url()) ? $thumb : THEME_IMG . "default.jpg" ?>"
             alt="<?php the_title(); ?>" />
    </figure>
    <section class="container mx-auto">
        <div class="mt-8 mb-12">
            <?php  woocommerce_breadcrumb() ?>
        </div>
    </section>
    <section class="container mx-auto">
        <h1 class="font-light text-5xl my-10 w-full text-center">
            <?php echo get_the_title() ?>
        </h1>
        <div class="page-text">
            <?php echo get_the_content() ?>
        </div>
    </section>
</main>
<?php get_footer() ?>