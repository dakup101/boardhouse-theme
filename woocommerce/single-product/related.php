<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

<section class="related products">
    <div class="grid grid-cols-1 sm:grid-cols-3 items-center my-12">
        <div class="hidden sm:block"></div>
        <h2 class="text-center font-medium uppercase tracking-wider text-2xl ">Może ci się spodobać też</h2>
        <div class="flex justify-center sm:justify-end">
            <a class="font-light underline text-orange hover:text-green transition-all"
                href="<?php echo get_home_url() . '/sklep' ?>">Zobacz wszystkie produkty</a>
        </div>
    </div>

    <div class="overflow-hidden relative product-carousel product-carousel-4" data-slider="4">
        <div class="swiper-wrapper">
            <?php $data_count = 1 ?>
            <?php foreach ( $related_products as $related_product ) : ?>
            <div class="swiper-slide h-auto" data-hash="slide<?php echo $data_count; ?>">
                <?php
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
				?>
                <?php wc_get_template_part( 'content', 'product' ); ?>
            </div>
            <?php $data_count++; endforeach; ?>
        </div>
        <div class="swiper-pagination mt-10 flex items-center justify-center gap-3 carousel-pagination-4"></div>
    </div>

</section>
<?php
endif;

wp_reset_postdata();