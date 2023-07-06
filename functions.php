<?php

/**
 * boardhouse-theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Boardhouse_theme
 *  @noinspection PhpIncludeInspection
 * @since 1.0.0
 */
$boardhouse_theme_theme = wp_get_theme('boardhouse-theme');

define('THEME_DIR', trailingslashit(get_template_directory()));
define('THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));
define('THEME_IMG', trailingslashit(esc_url(get_template_directory_uri().'/assets/img')));
// Theme Core file init

require_once get_template_directory() . '/core/class-boardhouse-theme-core.php';

function Boardhouse_theme(): ? BoardhouseThemeCore
{
    /** @return */
    return BoardhouseThemeCore::get_instance();
}
Boardhouse_theme();

add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts(){
	wp_enqueue_style( 'tailwind', THEME_URI.'assets/compiled/tailwind.css');
	wp_enqueue_style( 'theme', THEME_URI.'assets/compiled/theme.css');
	wp_enqueue_script('theme', THEME_URI.'assets/compiled/theme.js');
    wp_enqueue_style('cookies', THEME_URI.'assets/cookies/divante.cookies.min.css');

}

function is_not_hidden_attr($term_name): bool {
    if ($term_name!=="pa_rocznik" &&
        $term_name!=="pa_dla-kogo" &&
        $term_name!=="pa_rozmiar-deski" &&
        $term_name!=="pa_rozmiar-kol"
    ) return false;
    return true;
}

add_filter( 'woocommerce_page_title', function( $title = '' ) {
    if ( is_tax('product_cat') ) {
        $product_cat_obj = get_queried_object();
        $title .= !empty($product_cat_obj->count) ? ' <span class="text-3xl text-light-gray ml-1">('.$product_cat_obj->count .')</span>' : '';
    }
    return $title;
});

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = '<svg class="rotate-180 fill-light-gray" xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 24 24"><path d="M3 12l18-12v24z"/></svg>';
    return $defaults;
}

add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );

add_filter( 'yith_wcan_skip_layered_nav_query', '__return_true' );

add_action( 'before_delete_post', function( $id ) {
    $product = wc_get_product( $id );
    if ( ! $product ) {
        return;
    }
    $all_product_ids         = [];
    $product_thum_id_holder  = [];
    $gallery_image_id_holder = [];
    $thum_id                 = get_post_thumbnail_id( $product->get_id() );
    if ( function_exists( 'dokan' ) ) {
        $vendor = dokan()->vendor->get( dokan_get_current_user_id() );
        if ( ! $vendor instanceof WeDevs\Dokan\Vendor\Vendor || $vendor->get_id() === 0 ) {
            return;
        }
        $products = $vendor->get_products();
        if ( empty( $products->posts ) ) {
            return;
        }
        foreach ( $products->posts as $post ) {
            array_push( $all_product_ids, $post->ID );
        }
    } else {
        $args     = [ 'posts_per_page' => '-1' ];
        $products = wc_get_products( $args );
        foreach ( $products as $product ) {
            array_push( $all_product_ids, $product->get_id() );
        }
    }
    foreach ( $all_product_ids as $product_id ) {
        if ( intval( $product_id ) !== intval( $id ) ) {
            array_push( $product_thum_id_holder, get_post_thumbnail_id( $product_id ) );
            $wc_product        = wc_get_product( $product_id );
            $gallery_image_ids = $wc_product->get_gallery_image_ids();
            if ( empty( $gallery_image_ids ) ) {
                continue;
            }
            foreach ( $gallery_image_ids as $gallery_image_id ) {
                array_push( $gallery_image_id_holder, $gallery_image_id );
            }
        }
    }
    if ( ! in_array( $thum_id, $product_thum_id_holder ) && ! in_array( $thum_id, $gallery_image_id_holder ) ) {
        wp_delete_attachment( $thum_id, true );
        if ( empty( $thum_id ) ) {
            return;
        }
        $gallery_image_ids = $product->get_gallery_image_ids();
        if ( empty( $gallery_image_ids ) ) {
            return;
        }
        foreach ( $gallery_image_ids as $gallery_image_id ) {
            wp_delete_attachment( $gallery_image_id, true );
        }
    }
} );

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['wantFV'] ) ) {
        add_post_meta( $order_id, 'fv_is', sanitize_text_field('Tak') );
        add_post_meta( $order_id, 'fv_name', sanitize_text_field('Nie'));
        if ( ! empty( $_POST['billing_company'] ) ) {
            add_post_meta( $order_id, 'fv_client', sanitize_text_field( $_POST['billing_company'] ) );
        }
        if ( ! empty( $_POST['billing_tax_no'] ) ) {
            add_post_meta( $order_id, 'fv_nip', sanitize_text_field( $_POST['billing_tax_no'] ) );
        }
        if ( ! empty( $_POST['fv_name'] ) ) {
            update_post_meta( $order_id, 'fv_name', sanitize_text_field($_POST['fv_name']));
        }
        if ( ! empty( $_POST['fv_address'] ) ) {
            update_post_meta( $order_id, 'fv_address', sanitize_text_field($_POST['fv_address']));
        }
        if ( ! empty( $_POST['fv_city'] ) ) {
            update_post_meta( $order_id, 'fv_city', sanitize_text_field($_POST['fv_city']));
        }
        if ( ! empty( $_POST['fv_postcode'] ) ) {
            update_post_meta( $order_id, 'fv_postcode', sanitize_text_field($_POST['fv_postcode']));
        }
    }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );

function wps_select_checkout_field_display_admin_order_meta( $order ) {
   
    $want_fv = $order->get_meta('fv_is');
    $fv_name = $order->get_meta('fv_name');
    $fv_client = $order->get_meta('fv_client');
    $fv_nip = $order->get_meta('fv_nip');
    $fv_address = $order->get_meta('fv_address');
    $fv_city = $order->get_meta('fv_city');
    $fv_postcode = $order->get_meta('fv_postcode');

    if ($fv_client == "Osoba Prywatna") $fv_nip = null;
    if ( ! empty($want_fv) ) {
        echo "<h3>Info do Faktury:</h3>";
        echo '<p><strong>'.__('Faktura').':</strong> ' . $want_fv . '</p>';        
        if ( ! empty($fv_client) ) {
            echo '<p><strong>'.__('Odbiorca').':</strong> ' . $fv_client . '</p>';
        }
        if ( ! empty($fv_nip) ) {
            echo '<p><strong>'.__('NIP').':</strong> ' . $fv_nip . '</p>';
        }
        if ( ! empty($fv_name) ) {
            echo '<p><strong>'.__('Podmiot').':</strong> ' . $fv_name . '</p>';
        }
        if ( ! empty($fv_address) ) {
            echo '<p><strong>'.__('Adres').':</strong> ' . $fv_address . '</p>';
        }
        if ( ! empty($fv_city) ) {
            echo '<p><strong>'.__('Miasto').':</strong> ' . $fv_city . '</p>';
        }
        if ( ! empty($fv_postcode) ) {
            echo '<p><strong>'.__('Kod Pocztowy').':</strong> ' . $fv_postcode . '</p>';
        }
    }
}

add_filter( 'wc_add_to_cart_message_html', '__return_false' );
add_filter( 'woocommerce_cart_item_removed_notice_type', '__return_false' );

/**
 * Add custom order meta to WooCommerce emails
 *
 * @author Misha Rudrastyh
 * @link https://rudrastyh.com/woocommerce/order-meta-in-emails.html
 */
add_action( 'woocommerce_email_order_meta', 'misha_add_email_order_meta', 10, 3 );

function misha_add_email_order_meta( $order, $sent_to_admin, $plain_text ){

	// this order meta checks if order is marked as a gift
	$is_gift = $order->get_meta( 'fv_is' );

	// we won't display anything if it is not a gift
	if( empty( $is_gift ) ) {
		return;
	}

	// ok, if it is the gift order, get all the other fields
	$gift_wrap = esc_html( $order->get_meta( 'fv_nip' ) );
	$gift_recipient = esc_html( $order->get_meta( 'fv_client' ) );
	$gift_message = esc_html( $order->get_meta( 'fv_name' ) );
    $fv_address = esc_html( $order->get_meta( 'fv_address' ) );
    $fv_city = esc_html( $order->get_meta( 'fv_city' ) );
    $fv_postcode = esc_html( $order->get_meta( 'fv_postcode' ) );


	// ok, we will add the separate version for plaintext emails
	if ( false === $plain_text ) {

		// you shouldn't have to worry about inline styles, WooCommerce adds them itself depending on the theme you use
		?>
<div style="width: 100%;">
    <h2>Informacje dotyczące FV</h2>
    <ul>
        <li><strong>Faktura?</strong> Tak</li>
        <?php if (!empty($gift_wrap)) : ?>
        <li><strong>NIP:</strong> <?php echo $gift_wrap ?></li>
        <?php endif; ?>
        <li><strong>Odbiorca:</strong> <?php echo $gift_recipient ?></li>
        <li><strong>Podmiot</strong> <?php echo $gift_message ?></li>
        <li><strong>Adres:</strong> <?php echo $fv_address ?></li>
        <li><strong>Miasto:</strong> <?php echo $fv_city ?></li>
        <li><strong>Kod pocztowy:</strong> <?php echo $fv_postcode ?></li>

    </ul>
</div>
<?php
	} else {
		echo "\nGIFT INFORMATION\n"
		. "Faktura: Yes\n"
		. "NIP: $gift_wrap\n"
		. "Odbiorca: $gift_recipient\n"
		. "Podmiot: $gift_message\n"
        . "Adres: $fv_address\n"
        . "Miasto: $fv_city\n"
        . "Kod pocztowy: $fv_postcode\n";
	}

}

add_filter( 'woocommerce_email_recipient_cancelled_order', 'wc_cancelled_order_add_customer_email', 10, 2 );
add_filter( 'woocommerce_email_recipient_failed_order', 'wc_cancelled_order_add_customer_email', 10, 2 );
function wc_cancelled_order_add_customer_email( $recipient, $order ){
    // Avoiding errors in backend (mandatory when using $order argument)
    if ( ! is_a( $order, 'WC_Order' ) ) return $recipient;

    return $recipient .= "," . $order->get_billing_email();
}



// *****************
// ACF CUSTOM FIELD FOR PRODUCT VARIATION
// *****************

// Render fields at the bottom of variations - does not account for field group order or placement.
add_action( 'woocommerce_product_after_variable_attributes', function( $loop, $variation_data, $variation ) {
    global $abcdefgh_i; // Custom global variable to monitor index
    $abcdefgh_i = $loop;
    // Add filter to update field name
    add_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
    
    // Loop through all field groups
    $acf_field_groups = acf_get_field_groups();
    foreach( $acf_field_groups as $acf_field_group ) {
        foreach( $acf_field_group['location'] as $group_locations ) {
            foreach( $group_locations as $rule ) {
                // See if field Group has at least one post_type = Variations rule - does not validate other rules
                if( $rule['param'] == 'post_type' && $rule['operator'] == '==' && $rule['value'] == 'product_variation' ) {
                    // Render field Group
                    acf_render_fields( $variation->ID, acf_get_fields( $acf_field_group ) );
                    break 2;
                }
            }
        }
    }
    
    // Remove filter
    remove_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
}, 10, 3 );

// Filter function to update field names
function  acf_prepare_field_update_field_name( $field ) {
    global $abcdefgh_i;
    $field['name'] = preg_replace( '/^acf\[/', "acf[$abcdefgh_i][", $field['name'] );
    return $field;
}
    
// Save variation data
add_action( 'woocommerce_save_product_variation', function( $variation_id, $i = -1 ) {
    // Update all fields for the current variation
    if ( ! empty( $_POST['acf'] ) && is_array( $_POST['acf'] ) && array_key_exists( $i, $_POST['acf'] ) && is_array( ( $fields = $_POST['acf'][ $i ] ) ) ) {
        foreach ( $fields as $key => $val ) {
            update_field( $key, $val, $variation_id );
        }
    }
}, 10, 2 );

//add ACF rule
add_filter('acf/location/rule_values/post_type', 'acf_location_rule_values_Post');
function acf_location_rule_values_Post( $choices ) {
	$choices['product_variation'] = 'Product Variation';
    //print_r($choices);
    return $choices;
}


add_filter( 'woocommerce_package_rates', 'product_category_hide_shipping_methods', 90, 2 );
function product_category_hide_shipping_methods( $rates, $package ){

    // HERE set your product categories in the array (IDs, slugs or names)
    $categories = array(
		'longboard-longboard',
		'balance-board',
		'cruiser',
		'surfskate',
		'hulajnogi-elektryczne',
		'hulajnogi-rekreacyjne',
		'hulajnogi-wyczynowe',
		'deski-snowboardowe',
		'sup-sup'
	);
    $found = false;

    // Loop through each cart item Checking for the defined product categories
    foreach( $package['contents'] as $cart_item ) {
        if ( has_term( $categories, 'product_cat', $cart_item['product_id'] ) ){
            $found = true;
            break;
        }
    }

    $rates_arr = array();
    if ( $found ) {
        foreach($rates as $rate_id => $rate) { 
            if ('flexible_shipping_single' !== $rate->method_id) {
				echo $rate->method_id . "<br>";
                $rates_arr[ $rate_id ] = $rate;
            }
        }
    }
    return !empty( $rates_arr ) ? $rates_arr : $rates;
}

add_filter( 'woocommerce_available_payment_gateways', 'disable_cod_payment_gateway' );

function disable_cod_payment_gateway( $gateways ) {

    // Define the product tag slug for which the COD payment method needs to be disabled
    $product_tag_slug = 'przedsprzedaz';

    // If the cart is not empty and contains products with the specified tag
    if ( ! is_admin() && is_checkout() && has_term( $product_tag_slug, 'product_tag' ) ) {

        // If the COD payment method is available, remove it from the available payment gateways
        if ( isset( $gateways['cod'] ) ) {
            unset( $gateways['cod'] );
        }
    }

    return $gateways;
}

add_action('init', 'restore_default_editor');
function restore_default_editor() {
    add_post_type_support('post', 'editor');
}