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

function theme_scripts(){
	wp_enqueue_style( 'tailwind', THEME_URI.'assets/compiled/tailwind.css');
	wp_enqueue_style( 'theme', THEME_URI.'assets/compiled/theme.css');
	wp_enqueue_script('theme', THEME_URI.'assets/compiled/theme.js');
}
add_action('wp_enqueue_scripts', 'theme_scripts');


add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
	if (is_cart()) :
		?>
		<script>
            jQuery( 'div.woocommerce' ).on( 'change', '.qty', function () {
                jQuery( "[name='update_cart']" ).trigger( "click" );
            } );
		</script>
	<?php
	endif;
}

function is_not_hidden_attr($term_name): bool {
    if ($term_name!=="pa_rocznik" &&
        $term_name!=="pa_dla-kogo" &&
        $term_name!=="pa_rozmiar-deski"
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
    $defaults['delimiter'] = '';
    return $defaults;
}

add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );
