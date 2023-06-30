<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align  = is_rtl() ? 'right' : 'left';
$margin_side = is_rtl() ? 'left' : 'right';

foreach ( $items as $item_id => $item ) :
$product       = $item->get_product();
$sku           = '';
$purchase_note = '';
$image         = '';

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	continue;
}

if ( is_object( $product ) ) {
	$sku           = $product->get_sku();
	$purchase_note = $product->get_purchase_note();
	$image         = $product->get_image( $image_size );
}
?>
<tr class="email-order-item" style="padding: 10px 15px; border-bottom: 1px solid #dbdbdb">
    <td class="email-order-item-product">
        <?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
		if ($product->get_type() == 'variable' || $product->get_type() == 'variation'){
			
			$variation = wc_get_product($product->get_id());
			$product = wc_get_product($variation->get_parent_id()) ;
		}
		$qty          = $item->get_quantity();
		$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

		if ( $refunded_qty ) {
			$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
		} else {
			$qty_display = esc_html( $qty );
		}
		do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
		do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
        <div class="email-order-item-image">
            <?php
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
            ?>
            <img src="<?php echo $image[0] ?>" alt="">
        </div>
        <div class="email-order-item-desc">
            <?php echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a class="tracking-wider mb-3 font-bold text-xl mb-1" href="%s">%s</a>', $product_permalink, $product->get_name() ) : $product->get_name(), $item, $is_visible ) ); ?>
            <div class="email-order-item-desc-content text-gray" style="font-weight: 300">
                <div style="font-weight: 300">
                    <?php wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
                </div>
                <p class="font-weight: 300">Ilość:
                    <?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <span class="product-quantity">' . sprintf( '%s', $qty_display ) . '</span>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
                </p>
            </div>

        </div>
    </td>
    <td class="email-order-item-total">
        <?php echo $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </td>
</tr>
<?php

	if ( $show_purchase_note && $purchase_note ) {
		?>
<tr>
    <td colspan="3"
        style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
        <?php
				echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) );
				?>
    </td>
</tr>
<?php
	}
	?>

<?php endforeach; ?>