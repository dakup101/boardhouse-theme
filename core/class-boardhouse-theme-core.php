<?php

/**  @noinspection PhpIncludeInspection  */

final class BoardhouseThemeCore
{
    private static $instance = null;

    public function __construct()
    {
        $this->hooks();
    }
    public function hooks()
    {
	    add_action('after_setup_theme', array($this, 'setup'));
	    add_action('after_setup_theme', array($this, 'theme_functions'));
    }

    public static function get_instance(): ?BoardhouseThemeCore
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function setup() {
        load_theme_textdomain('boardhouse-theme', THEME_DIR . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
	    add_theme_support( 'woocommerce' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );
    }

	function theme_functions(){
		require THEME_DIR . 'core/register-menus.php';
		require THEME_DIR . 'core/menu-array.php';
		require THEME_DIR . 'core/remove-jquery-migrate.php';
		require THEME_DIR . 'core/manufacturer-taxonomy.php';
		require THEME_DIR . 'core/update-product-price-with-variation-price.php';
		require THEME_DIR . 'core/single-product-summary.php';
		require THEME_DIR . 'core/checkout-hooks.php';
		require THEME_DIR . 'core/allow-svg.php';
		require THEME_DIR . 'core/register-widgets.php';
        require THEME_DIR . 'core/wc-jquery-events-to-dom.php';
        require THEME_DIR . 'core/wc-shipping-icons.php';
		require THEME_DIR . 'core/wc-fields-validation.php';
		require THEME_DIR . 'core/wc-profile-menu.php';
		
		// Not actions functions

		require THEME_DIR . 'core/global/count-cart.php';
		require THEME_DIR . 'core/global/show-cart.php';

		// Ajaxes

		require THEME_DIR . 'core/wc-cart-status-ajax.php';
		require THEME_DIR . 'core/wc-add-to-cart-ajax.php';
		require THEME_DIR . 'core/ajax-return-html-cart.php';


		add_filter ( 'woocommerce_product_thumbnails_columns', 'bbloomer_change_gallery_columns' );

		function bbloomer_change_gallery_columns() {
			return 1;
		}

		/**
		 * Setup function that will send notices to frontend
		 */

		add_action('wc_ajax_get_notices', 'get_notices');

		function get_notices(){
			$data['notices'] = wc_print_notices(true) ;
			wp_send_json( $data );
			wc_clear_notices();
		}
	}
}