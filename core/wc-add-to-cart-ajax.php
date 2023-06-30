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
    if ($variation ) {
        $variation_obj = new WC_Product_variation($variation);
        $inStock = $variation_obj->get_stock_quantity();
        $is_low_and_backorder = $variation_obj->is_on_backorder() && $variation_obj->get_stock_quantity() <= 0;

        if ($quantity > $inStock && !$is_low_and_backorder) {
            echo json_encode(array(
                'err' => 'stock',
                'msg' => 'Brak wybranej ilości produktu w magazynie. Proszę zmienić ilośc produktu',
                'info' => array(
                    'inStock' => $inStock,
                    'qty' => $quantity
                )
            ));
            wp_die();
            return;
        }
        else $result = $woocommerce->cart->add_to_cart( $product, $quantity, $variation );
    } 
    else {
        $wc_product = wc_get_product($product);
        $inStock = $wc_product->get_stock_quantity();
        $is_low_and_backorder =  $wc_product->is_on_backorder() && $wc_product->get_stock_quantity() <= 0;

        if ($quantity > $inStock && !$is_low_and_backorder) {
            echo json_encode(array(
                'err' => 'stock',
                'msg' => 'Brak wybranej ilości produktu w magazynie. Proszę zmienić ilośc produktu',
                'info' => array(
                    'inStock' => $inStock,
                    'qty' => $quantity
                )
            ));
            wp_die();
            return;
        }
        else $result = $woocommerce->cart->add_to_cart( $product, $quantity);
    }
    echo json_encode(array($result));
    wp_die();
}

function add_to_cart_simple_ajax(){
    $status = count_user_cart();
    echo json_encode($status);
    wp_die();
}

function get_stock_variations_from_product($cur_var_id){
    global $product;
    $variations = $product->get_available_variations();
    foreach($variations as $variation){
         $variation_id = $variation['variation_id'];
         if ($variation_id == $cur_var_id){
            $variation_obj = new WC_Product_variation($variation_id);
            return $variation_obj->get_stock_quantity();
         }
    }
}