<?php
/**
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

add_action( 'woocommerce_single_product_summary', 'summary_product_info', 34 );
function summary_product_info() {
	wc_get_template_part( 'content', 'single-product-info' );
}