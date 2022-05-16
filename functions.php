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
// Theme Core file init

require_once get_template_directory() . '/core/class-boardhouse-theme-core.php';

function Boardhouse_theme(): ? BoardhouseThemeCore
{
    /** @return */
    return BoardhouseThemeCore::get_instance();
}

Boardhouse_theme();

