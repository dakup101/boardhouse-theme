<?php

/**  @noinspection PhpIncludeInspection  */

final class BoardhouseThemeCore
{
    private static $instance = null;

    public function __construct()
    {
        $this->hooks();
        $this->includes();

    }
    public function hooks()
    {
        add_action('after_setup_theme', array($this, 'setup'));
    }

    public function includes()
    {
// not avaliable
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
        require THEME_DIR . 'core/register-menus.php';
    }
}