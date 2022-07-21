<?php
add_action('init', 'return_cart_count_init');

function return_cart_count_init(){
    add_action( 'wp_ajax_nopriv_cart_count', 'return_cart_count' );
    add_action( 'wp_ajax_cart_count', 'return_cart_count' );
}

function return_cart_count(){
    $cartItemsCount =  WC()->cart->get_cart_contents_count();
    echo $cartItemsCount;
    wp_die();
}