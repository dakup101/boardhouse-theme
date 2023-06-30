<?php
/**
	 * Customer processing order email
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
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
	<h2 style="text-align: center">Twoje zamówienie zostało przyjęte<br>i jest przetwarzane</h2>
</div>
<div class="email-order-info" style="text-align: center; margin: 25px 0">
	<p><strong>Numer Twojego zamówienia:</strong> <?php echo $order->get_order_number() ?></p>
	<p><strong>Data zamówienia:</strong> <?php echo date('d.m.Y',  strtotime($order->get_date_created())) ?></p>
</div>
<div class="email-order">
	<?php do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>
</div>

<?php
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
do_action( 'woocommerce_email_footer', $email );