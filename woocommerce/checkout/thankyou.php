<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

?>

<section class="w-7/12 mx-auto">
    <div class="woocommerce-order">
		<?php
		if ( $order ) :

			do_action( 'woocommerce_before_thankyou', $order->get_id() );
			?>

			<?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                   class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                       class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
            </p>

		<?php else : ?>
            <p class="text-5xl font-bold text-center mb-5">Otrzymaliśmy Twoje zamówienie</p>
            <p class="text-gray text-center mb-10">Dziękujemy za zakupy w naszym sklepie. Obsługa naszego sklepu
                potwierdza otrzymanie Twojego zamówienia.</p>

            <ul class="bg-light-gray/30 px-5 py-5 flex flex-col mb-5">
                <li class="py-3 flex flex-col gap-0.5 font-light">
                    <p class="text-sm"><?php esc_html_e( 'Numer zamówienia:', 'woocommerce' ); ?></p>
                    <p class="text-md"><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                </li>
                <li class="py-3 flex flex-col gap-0.5 font-light border-t border-light-gray">
                    <p class="text-sm">
						<?php esc_html_e( 'Data złożenia zamówienia:', 'woocommerce' ); ?>

                    </p>
                    <p><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                </li>
                <li class="py-3 flex flex-col gap-0.5 font-light border-t border-light-gray">
                    <p class="text-sm">
						<?php esc_html_e( 'Kwota zamówienia:', 'woocommerce' ); ?>

                    </p>
                    <p><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                </li>
                <li class="py-3 flex flex-col gap-0.5 font-light border-t border-light-gray">
                    <p class="text-sm">
						<?php esc_html_e( 'Dostawa:', 'woocommerce' ); ?>
                    </p>
                    <p><?php echo wp_kses_post( $order->get_shipping_method() ); ?></p>
                </li>
				<?php if ( $order->get_payment_method_title() ) : ?>
                    <li class="py-3 flex flex-col gap-0.5 font-light border-t border-light-gray">
                        <p class="text-sm">                        <?php esc_html_e( 'Metoda płatności:', 'woocommerce' ); ?>
                        </p>
                        <p><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></p>
                    </li>
				<?php endif; ?>

            </ul>
		<?php endif; ?>
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

		<?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

		<?php endif; ?>

    </div>
</section>
