<?php
add_action('init', 'cart_status_ajax_init');

function cart_status_ajax_init(){
    add_action( 'wp_ajax_nopriv_fetch_status', 'cart_status_ajax' );
    add_action( 'wp_ajax_fetch_status', 'cart_status_ajax' );
}

function cart_status_ajax(){
    $status = count_user_cart();
    echo json_encode($status);
    wp_die();
}