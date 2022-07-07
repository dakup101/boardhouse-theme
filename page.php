<?php get_header() ?>
<main>
    <section class="container mx-auto">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
    </section>
</main>
<?php get_footer() ?>

