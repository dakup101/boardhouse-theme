<?php 
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $qty = $_product->get_stock_quantity();
        if ($qty < 5) $availability['availability'] = __($qty . ' w magazynie', 'woocommerce');
        else $availability['availability'] = __('Duża ilość magazynie', 'woocommerce');
    }
    // Change Out of Stock Text
    // if ( ! $_product->is_in_stock() ) {
    //     $availability['availability'] = __('Sold Out', 'woocommerce');
    // }
    return $availability;
}