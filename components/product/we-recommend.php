<?php
	global $post;

	$promo_title = null;
	$promo_show = false;
	$promo_img = null;
	$promo_link = null;
	$promo_products = array();


	$terms = get_the_terms( $post->ID, 'product_cat' );
	foreach ($terms as $term) {
		$product_cat_id = $term->term_id;
	
		$promo_show = get_field('wyswietlij_promocje', $term) == 1 ? true : false;
		if ($promo_show) {
			$promo_title = get_field('tytul_promowania', $term);
			$promo_img = get_field('banerek_promowania', $term);
			$promo_link = get_field('link_banerka', $term);
			$products = get_field('products', $term);
			foreach($products as $product) $promo_products[] = $product['product'];
			break;
		}
		// break;
	}
?>
<?php if ($promo_show) : ?>
<div class="text-lg font-bold"><?php echo $promo_title ?></div>

<div class="flex mt-5 flex-col gap-3">
    <?php
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 5,
		'post__in' => $promo_products,
		'orderby' => "rand",
		'meta_query' => array(
			'relation' => "OR",
			array(
				'key' => '_stock_status',
				'value' => 'instock',
        	),
			array(
				'key' => '_backorders',
				'value' => 'yes'
        	),
		)
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

<a href="<?php echo $promo_link ?>">
    <img src="<?php echo $promo_img ?>" alt="" class="mt-3 w-full">
</a>
<?php endif; ?>