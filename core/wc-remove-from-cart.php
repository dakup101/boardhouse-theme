<?php
add_action('init', 'ajax_remove_from_cart_init');

function ajax_remove_from_cart_init(){
    add_action( 'wp_ajax_nopriv_cart_remove', 'ajax_remove_from_cart' );
    add_action( 'wp_ajax_cart_remove', 'ajax_remove_from_cart' );
}

function ajax_remove_from_cart(){
    $product_id = $_POST['product_id'];
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $cart_item['product_id'] == $product_id ) {
             WC()->cart->remove_cart_item( $cart_item_key );
             echo json_encode("Remove success");
             wp_die();
        }
   }
   echo json_encode( "Remove failure" );
   wp_die();
}