<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$user = wp_get_current_user();
$has_orders = false;
$order_count = 0;
$args = array(
    'customer_id' => $user->ID,
    'limit' => -1, // to retrieve _all_ orders by this user
);
$orders = wc_get_orders($args);
if ($orders) $has_orders = true;

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<h2 class="text-2xl border-b-2 mb-5 border-dark w-full font-bold">Panel konta</h2>

<p class="text-gray font-light mb-5">
    <?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses( __( 'Witaj <span class="font-bold">%1$s</span>', 'woocommerce' ), $allowed_html ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<h2 class="text-xl <?php echo $has_orders ? 'border-b-2 mb-5' : 'mb-2' ?> w-full font-bold">Ostatnie zamówienia</h2>
<?php 
do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
<table class="w-full">
    <thead>
        <tr class="border-b border-light-gray">
            <th class="text-gray text-sm font-bold py-3"><span class="nobr">nr zamówienia</span></th>
            <th class="text-gray text-sm font-bold py-3"><span class="nobr">data</span></th>
            <th class="text-gray text-sm font-bold py-3"><span class="nobr">suma zamówienia</span></th>
            <th class="text-gray text-sm font-bold py-3"><span class="nobr">status zamówienia</span></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php
			foreach ( $orders as $customer_order ) {
				if ($order_count < 5) :
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
        <tr class="text-sm font-light border-b border-light-gray">
            <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
            <td class="text-center py-3">
                <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
                <?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

                <?php elseif ( 'order-number' === $column_id ) : ?>
                <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                    <?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
                </a>

                <?php elseif ( 'order-date' === $column_id ) : ?>
                <time
                    datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

                <?php elseif ( 'order-status' === $column_id ) : ?>
                <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

                <?php elseif ( 'order-total' === $column_id ) : ?>
                <?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s', '%1$s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								?>

                <?php elseif ( 'order-actions' === $column_id ) : ?>
                <?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										echo '<a href="' . esc_url( $action['url'] ) . '" class="text-green underline font-bold">szczegóły</a>';
									}
								}
								?>
                <?php endif; ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php
		endif;
		$order_count ++;
			}
			?>
    </tbody>
</table>
<?php else : ?>
<div class="text-orange flex gap-3 items-center">
    <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="fill-orange w-4 h-4">
        <path class="fill-orange"
            d="M7,1.17c3.22,0,5.83,2.62,5.83,5.83s-2.62,5.83-5.83,5.83S1.17,10.22,1.17,7,3.78,1.17,7,1.17Zm0-1.17C3.13,0,0,3.13,0,7s3.13,7,7,7,7-3.13,7-7S10.87,0,7,0Zm0,3.35c.4,0,.73,.33,.73,.73s-.33,.73-.73,.73-.73-.33-.73-.73,.33-.73,.73-.73Zm1.17,7.15h-2.33v-.58c.28-.1,.58-.12,.58-.43v-2.61c0-.31-.3-.36-.58-.46v-.58h1.75v3.65c0,.31,.3,.33,.58,.43v.58Z" />
    </svg>
    <span class="block mt-0.5">Lista zamówień jest pusta</span>
</div>
<a class="px-5 py-2 block mt-2 w-fit font-bold uppercase text-white bg-green transition-all hover:bg-orange"
    href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">Idź na zakupy</a>
<?php endif; ?>
<h2 class="text-xl mt-5 mb-3 w-full font-bold">Moje dane</h2>
<?php 
$customer = new WC_Customer($user->ID);
$name = $customer->get_billing_first_name() . ' ' . $customer->get_billing_last_name();
$addr1 = $customer->get_billing_address_1();
$addr2 = $customer->get_billing_postcode() . ' ' . $customer->get_billing_city();
?>

<p class="text-gray font-light"><?php echo $name ?></p>
<p class="text-gray font-light"><?php echo $addr1 ?></p>
<p class="text-gray font-light"><?php echo $addr2 ?></p>
<a class="text-green underline font-bold mt-3 block" href="<?php echo get_home_url() . '/moje-konto/edit-account/' ?>">edytuj dane konta</a>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */