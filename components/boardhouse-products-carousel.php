<?php
$data = wp_parse_args($args, array(
		'id' => null,
        'amount' => null,
        'sale' => null
	)
);
?>
<div class="overflow-hidden relative product-carousel product-carousel-<?php echo $data['id'] ?>" data-slider="<?php echo $data['id'] ?>">
	<div class="swiper-wrapper">
		<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $data['amount'],
		);
        if ($data['sale']){
            $args['post__in'] = wc_get_product_ids_on_sale();
        }
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				?>
            <div class="swiper-slide h-auto">
                <?php wc_get_template_part( 'content', 'product' ); ?>
            </div>
        <?php
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
		?>
    </div>
    <div class="swiper-pagination mt-10 flex items-center justify-center gap-3 carousel-pagination-<?php echo $data['id'] ?>"></div>
</div>