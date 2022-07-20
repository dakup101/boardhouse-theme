<?php
function count_user_cart(){
    global $woocommerce;
    // Free delivery and totals
    $free_shipping_settings = get_option('woocommerce_free_shipping_1_settings');
    $amount_for_free_shipping = $free_shipping_settings['min_amount'];
    $total = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
    // check difference and %
    $difference = $amount_for_free_shipping - $total;
    $percent = ($total / $amount_for_free_shipping) * 100;
    if ($difference > 0){
        return array(
            'remains' => number_format($difference, 2, '.', ''),
            'percent' => number_format($percent, 2, '.', '')
        );
    }    
    else{
        return array(
            'remains' => 0,
            'percent' => 100
        );
    }
    
}

