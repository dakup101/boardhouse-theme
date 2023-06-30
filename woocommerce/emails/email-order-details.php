<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';
?>

<div style="margin-bottom: 40px;">
    <table
        style="width: 100%; position: relative; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
        <thead style="display: flex; width: 100%">
            <tr style="display: flex; padding: 10px 15px; border-bottom: 1px solid #333333; width: 100%;">
                <th style=" width: 70%; text-align: left;">Produkt</th>
                <th style="width: 30%; text-align: left">Cena</th>
            </tr>
        </thead>
        <tbody style="width: 100% border-bottom: 1px solid #333333">
            <?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
        </tbody>
        <tfoot style="width: 100%">
            <?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $total ) {
					$i++;
					?>
            <tr style="width: 100%; display: flex; padding: 10px 15px; border-bottom: 1px solid #dbdbdb">
                <th class="td" scope="row" colspan="2"
                    style="width: 50%; text-align:<?php echo esc_attr( $text_align ); ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 4px;' : ''; ?>">
                    <?php echo wp_kses_post( $total['label'] ); ?></th>
                <td class="td"
                    style="width: 50%; text-align:<?php echo esc_attr( $text_align ); ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 4px;' : ''; ?>">
                    <?php echo wp_kses_post( $total['value'] ); ?></td>
            </tr>
            <?php
				}
			}
			if ( $order->get_customer_note() ) {
				?>
            <tr style="width: 100%; display: flex; padding: 10px 15px; border-bottom: 1px solid #dbdbdb">
                <th class="td" scope="row" colspan="2"
                    style="width: 50%; text-align:<?php echo esc_attr( $text_align ); ?>;">
                    <?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
                <td class="td" style="width: 50%; text-align:<?php echo esc_attr( $text_align ); ?>;">
                    <?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
            </tr>
            <?php
			}
			?>
        </tfoot>
    </table>
    <style>
    table {
        flex-direction: column;
    }
    </style>
</div>