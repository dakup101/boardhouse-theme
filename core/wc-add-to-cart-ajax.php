<?php
add_action('init', 'add_to_cart_ajax_init');

function add_to_cart_ajax_init(){
    //Variable
    add_action( 'wp_ajax_nopriv_add_variable', 'add_to_cart_variable_ajax' );
    add_action( 'wp_ajax_add_variable', 'add_to_cart_variable_ajax' );
    //Simple
    add_action( 'wp_ajax_nopriv_add_simple', 'add_to_cart_simple_ajax' );
    add_action( 'wp_ajax_fetch_add_simple', 'add_to_cart_simple_ajax' );
}

function add_to_cart_variable_ajax(){
    global $woocommerce;
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;
    $product = isset($_POST['product_id']) ? (int) apply_filters('woocommerce_add_to_cart_product_id', $_POST['product_id']) : null; 
    $variation = isset($_POST['variation_id']) ? (int) apply_filters('woocommerce_add_to_cart_product_id', $_POST['variation_id']) : null;
    $result = null;
    if ($variation )$result = $woocommerce->cart->add_to_cart( $product, $quantity, $variation );
    else $result = $woocommerce->cart->add_to_cart( $product, $quantity);
    echo json_encode(array($result));
    wp_die();
}

function add_to_cart_simple_ajax(){
    $status = count_user_cart();
    echo json_encode($status);
    wp_die();
}