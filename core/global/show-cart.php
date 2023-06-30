<?php

function show_cart_html(){
    ob_start();
    ?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>
    <div class="flex flex-col">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <div class="flex flex-col cart-content-popup mt-6 px-6 lg:px-20">
            <?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if ($_product -> get_type() == 'variable' || $_product -> get_type() == 'variation'){
					$variation = wc_get_product($_product->get_id());
					$product = wc_get_product($variation->get_parent_id()) ;
				}
				else{
					$product = $_product;
				}
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
            <div
                class="flex pb-3 mb-3 items-center justify-between border-b border-light-gray woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <div class="flex gap-4 items-center">
                    <div class="product-img w-28">
                        <?php
                     $image =wp_get_attachment_image( $product->get_image_id(), 'medium' );
                     echo $image;
                    ?>

                    </div>
                    <div>
                        <p class="tracking-wider font-bold text-gray"><?php echo $product->get_attribute('pa_marka'); ?>
                        </p>
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
                        </div>
                    </div>
                </div>

                <div class="flex gap-1 items-end flex-col">
                    <div class="product-subtotal text-xl font-bold mt-16"
                        data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
                    </div>
                    <p class="font-light">Ilość:
                        <?php echo $cart_item['quantity']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
                    </p>
                    <div class="product-remove mt-5">
                        <?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="flex gap-2 hover:underline transition-all" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.67 20"><defs><style>.b{fill:#1e1e1f;fill-rule:evenodd;}</style></defs><path class="b" d="M14.17,20H2.5c-.92,0-1.67-.75-1.67-1.67V4.17H0v-1.67H5V1.25c0-.69,.56-1.25,1.25-1.25h4.17c.69,0,1.25,.56,1.25,1.25v1.25h5v1.67h-.83v14.17c0,.92-.75,1.67-1.67,1.67Zm0-15.83H2.5v13.75c0,.23,.19,.42,.42,.42H13.75c.23,0,.42-.19,.42-.42V4.17Zm-7.5,3.33c0-.46-.37-.83-.83-.83s-.83,.37-.83,.83v7.5c0,.46,.37,.83,.83,.83s.83-.37,.83-.83V7.5Zm5,0c0-.46-.37-.83-.83-.83s-.83,.37-.83,.83v7.5c0,.46,.37,.83,.83,.83s.83-.37,.83-.83V7.5Zm-1.67-5.83h-3.33v.83h3.33v-.83Z"/></svg>
                                        Usuń
                                        </a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
                    </div>
                </div>
            </div>
            <?php
				}
			}
			?>
        </div>
        <div class="px-6 lg:px-20 py-6">
            <?php get_template_part( '/components/boardhouse-cart-status'); ?>
        </div>
        <div
            class="cart_totals py-6 px-6 lg:px-20 bg-light-gray/50 <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

            <div class="grid lg:hidden grid-cols-1 mb-2 sm:grid-cols-2 sm:gap-5">
                <div>
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' )) ?>"
                        class="mt-5 bg-none border-2 border-dark hover:text-white hover:bg-orange hover:border-orange transition-all text-dark flex items-center justify-center font-bold w-full h-12 uppercase wc-forward">
                        <?php esc_html_e( 'Powrót do sklepu', 'woocommerce' ); ?>
                    </a>
                </div>
                <div class="wc-proceed-to-checkout">
                    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                </div>
            </div>

            <table class="w-full px-6 py-3 flex gap-6 flex-col font-light text-lg">

                <tr class="flex justify-between gap-3">
                    <td><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></td>
                    <td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <tr class="flex justify-between gap-3 coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <td><?php wc_cart_totals_coupon_label( $coupon ); ?></td>
                    <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
                        <?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="shipping-cos flex justify-between gap-3t">
                    <th class="font-medium"><?php echo esc_html( 'Koszt wysyłki' ); ?></th>
                    <td class="text-green font-medium tracking-wider">
                        <?php echo WC()->cart->get_cart_shipping_total();; ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <tr class="flex justify-between gap-3">
                    <td><?php echo esc_html( $fee->name ); ?></td>
                    <td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?>
                    </td>
                </tr>
                <?php endforeach; ?>

                <?php
		        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text  = '';

                    if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                        /* translators: %s location. */
                        $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                    }

                    if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                        foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                            ?>
                <tr class="flex justify-between gap-3 tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <td><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                    <td data-title="<?php echo esc_attr( $tax->label ); ?>">
                        <?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                </tr>
                <?php
                        }
                    } else {
                        ?>
                <tr class="flex justify-between gap-3">
                    <td><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                    <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>">
                        <?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
                <?php
                    }
                }
                ?>

                <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

                <tr class="flex justify-between gap-3 text-xl">
                    <td><?php esc_html_e( 'Total', 'woocommerce' ); ?></td>
                    <td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                        <?php wc_cart_totals_order_total_html(); ?></td>
                </tr>

                <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

            </table>

            <div class="hidden lg:grid grid-cols-1 sm:grid-cols-2 gap-1 sm:gap-5">
                <div>
                    <a data-close-pop-up-proceed href="<?php echo get_permalink( wc_get_page_id( 'shop' )) ?>"
                        class="mt-5 bg-none border-2 border-dark hover:text-white hover:bg-orange hover:border-orange transition-all text-dark flex items-center justify-center font-bold w-full h-12 uppercase wc-forward">
                        <?php esc_html_e( 'Powrót do sklepu', 'woocommerce' ); ?>
                    </a>
                </div>
                <div class="wc-proceed-to-checkout">
                    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
<?php
    return ob_get_clean();
}