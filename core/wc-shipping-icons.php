<?php
add_action('woocommerce_product_options_general_product_data', 'my_custom_fields');
add_action('woocommerce_init', 'shipping_instance_form_fields_filters');
add_action( 'woocommerce_after_shipping_rate', 'shipping_instance_custom_desc' , 10, 2 );

function shipping_instance_form_fields_filters()
{
    $shipping_methods = WC()->shipping->get_shipping_methods();
    foreach($shipping_methods as $shipping_method) {
        add_filter('woocommerce_shipping_instance_form_fields_' . $shipping_method->id, 'shipping_instance_form_add_extra_fields');
    }
}

function shipping_instance_form_add_extra_fields($settings)
{
    $settings['shipping_icon'] = [
        'title' => 'Url to grafiki',
        'type' => 'text',
        'placeholder' => 'Podaj to link to grafiki z "Media"',
        'description' => ''
    ];

    return $settings;
}

function shipping_instance_custom_desc( $shipping_rate, $index ) {

    if( is_cart() ) return; // Exit on cart page

    $current_instance_ids = WC()->session->get( 'chosen_shipping_methods' );
    $current_instance_id = $current_instance_ids[0];


        $option_key = 'woocommerce_'.$shipping_rate->method_id.'_'.$shipping_rate->instance_id.'_settings';

        $instance_settings = get_option( $option_key );

        if( isset( $instance_settings[ 'shipping_icon' ] ) ) {

            ?>
            <div data-shipping_img = "<?php echo $instance_settings[ 'shipping_icon' ] ?>"></div>
            <?php

        }

        else{
            ?>
            <div data-shipping_img = "<?php echo THEME_IMG . '/lorry.svg' ?>"></div>
            <?php
        }



}
