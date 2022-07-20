<?php
add_action('init', 'return_html_cart_init');

function return_html_cart_init(){
    add_action( 'wp_ajax_nopriv_html_cart', 'return_html_cart' );
    add_action( 'wp_ajax_html_cart', 'return_html_cart' );
}

function return_html_cart(){
    $html = show_cart_html();
    echo $html;
    wp_die();
}