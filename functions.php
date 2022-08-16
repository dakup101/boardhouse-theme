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