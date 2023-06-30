<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
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

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<div class="email-title" style="text-align: center">
	<h1 style="text-align: center">Cześć <?php echo $order->get_billing_first_name()?>!</h1>
    <h2 style="text-align: center">Twoje zamówienie jest wstrzymane<br>do momentu opłaty</h2>
</div>
<div style="text-align: center">
    <img src="<?php echo THEME_IMG . 'mailing-icon.png' ?>" alt="">
</div>
<div class="email-order-info" style="text-align: center; margin: 25px 0">
    <p><strong>Numer Twojego zamówienia:</strong> <?php echo $order->get_order_number() ?></p>
    <p><strong>Data zamówienia:</strong> <?php echo date('d.m.Y',  strtotime($order->get_date_created())) ?></p>
</div>
<div class="email-order">
<?php
	
	    if ( 'bacs' === $order->get_payment_method() ) {
        echo '<h2>Konto do wpłat:</h2>';
        echo '<p><b>Bank: Bank</b>: Santander Bank </p>';
        echo '<p><b>Numer konta</b>: 53109020530000000115283469</p>';
    }
	?>
    <h3 style="color: #333"><strong>Twoje zamówienie</strong></h3>
    <?php do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>
</div>
<?php
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}
do_action( 'woocommerce_email_footer', $email );