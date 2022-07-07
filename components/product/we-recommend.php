<div class="text-lg font-bold">Polecamy dobrać wiązania</div>

<div class="flex mt-5 flex-col gap-3">
	<?php
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 3,
		'post__in' => array(46, 29, 44)
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) : $loop->the_post();
			?>
            <div>
				<?php wc_get_template_part( 'content', 'product-recommend' ); ?>
            </div>
		<?php
		endwhile;
	} else {
		echo __( 'No products found' );
	}
	wp_reset_postdata();
	?>
</div>