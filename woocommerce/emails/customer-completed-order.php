<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<div class="email-title" style="text-align: center">
	<h1 style="text-align: center">Cześć <?php echo $order->get_billing_first_name()?>!</h1>
    <h2 style="text-align: center">Ukończyliśmy realizację<br>Twojego zamówienia</h2>
</div>
<div style="text-align: center">
    <img src="<?php echo THEME_IMG . 'mailing-icon.png' ?>" alt="">
</div>
<div class="email-order-info" style="text-align: center; margin: 25px 0">
    <p><strong>Numer Twojego zamówienia:</strong> <?php echo $order->get_order_number() ?></p>
    <p><strong>Data zamówienia:</strong> <?php echo date('d.m.Y',  strtotime($order->get_date_created())) ?></p>
</div>
<div class="email-order">
    <h3 style="color: #333"><strong>Twoje zamówienie</strong></h3>
    <?php do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>
</div>
<?php
/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );