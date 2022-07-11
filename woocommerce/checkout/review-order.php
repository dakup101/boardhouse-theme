<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<table class="shop_table woocommerce-checkout-review-order-table flex flex-col gap-5" style="border: none">
	<tbody>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="order-review-product border-top border-light-gray<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-name">
                        <?php
                        $variation = wc_get_product($_product->get_id());
                        $product = wc_get_product($variation->get_parent_id()) ;
                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                        ?>
                        <div class="flex gap-6 py-2">
                            <div class="product-img w-32">
		                        <?php
		                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
		                        ?>
                                <img class="w-full" src="<?php echo $image[0] ?>" alt="">
                            </div>

                            <div>
                                <p class="tracking-wider font-bold text-gray"><?php echo $product->get_attribute('pa_marka') ?></p>
		                        <?php echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a class="tracking-wider mb-3 font-bold text-xl mb-1" href="%s">%s</a>', $product_permalink, $product->get_name() ) : $product->get_name(), $cart_item ) ); ?>
                                <div class="item-dec text-gray">
                                    <div class="font-light mb-3">
				                        <?php
				                        $pkgDesc= apply_filters( 'woocommerce_cart_item_product_id', $cart_item['variation'], $cart_item, $cart_item_key );
				                        foreach ($pkgDesc as $key => $attr){
					                        $label = wc_attribute_label(str_replace('attribute_', '', $key));
					                        echo $label . ': ' . $attr;
				                        }
				                        ?>
                                    </div>
                                    <p class="font-light">Ilość: <?php echo $cart_item['quantity']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></p>
                                </div>
                                <div class="tracking-wider mt-5 font-bold text-xl ">
                                    <?php 								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
	<tfoot class="bg-light-gray/50 font-light text-lg px-6 py-3 flex flex-col gap-3">

		<tr class="cart-subtotal">
			<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td cl><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>
        <tr class="shipping-cost">
            <th><?php echo esc_html( 'Koszt wysyłki' ); ?></th>
            <td class="text-green tracking-wider"><?php echo WC()->cart->get_cart_shipping_total();; ?></td>
        </tr>
<!--		--><?php //if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
<!---->
<!--			--><?php //do_action( 'woocommerce_review_order_before_shipping' ); ?>
<!---->
<!--			--><?php //wc_cart_totals_shipping_html(); ?>
<!---->
<!--			--><?php //do_action( 'woocommerce_review_order_after_shipping' ); ?>
<!---->
<!--		--><?php //endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total text-xl">
			<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>
