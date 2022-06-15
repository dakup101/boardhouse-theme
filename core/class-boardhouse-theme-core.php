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
	    require THEME_DIR . 'core/register-menus.php';
	    require THEME_DIR . 'core/menu-array.php';
	    require THEME_DIR . 'core/remove-jquery-migrate.php';
	    require THEME_DIR . 'core/manufacturer-taxonomy.php';
    }

	function theme_scripts(){
		wp_enqueue_style( 'tailwind', THEME_URI.'assets/compiled/tailwind.css');
		wp_enqueue_style( 'theme', THEME_URI.'assets/compiled/theme.css');
		wp_enqueue_script('theme', THEME_URI.'assets/compiled/theme.js');
	}
}