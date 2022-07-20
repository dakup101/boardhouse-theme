<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<div class="mt-8 mb-12">
    <?php  woocommerce_breadcrumb() ?>
</div>

<section class="w-10/12 mx-auto">
    <h1 class="text-5xl my-10 w-full font-bold text-center">Twój Koszyk</h1>
	<p class="text-center text-xl font-light">Twój koszyk jest aktualnie pusty</p>
    <?php 
if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
    <p class="return-to-shop text-center">
        <a class="block mx-auto w-fit mt-5 mb-10 px-5 py-2 bg-green uppercase font-bold text-white transition-all hover:bg-orange"
            href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
            <?php
				/**
				 * Filter "Return To Shop" text.
				 *
				 * @since 4.6.0
				 * @param string $default_text Default text.
				 */
				echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Idź na zakupy', 'woocommerce' ) ) );
			?>
        </a>
    </p>
    <?php endif; ?>
</section>