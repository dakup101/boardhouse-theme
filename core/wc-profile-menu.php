<?php
function wpb_woo_my_account_order() {
	$myorder = array(
        'dashboard'          => __( 'Panel konta', 'woocommerce' ),
		'edit-account'       => __( 'Moje dane', 'woocommerce' ),
        'edit-address'       => __( 'Moje adresy', 'woocommerce' ),
		'orders'             => __( 'Moje zamówienia', 'woocommerce' ),
        'opinions'           => __( 'Centrum opinii', 'woocommerce' ),
        'accepts'           => __( 'Zgody formalne', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);

	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );