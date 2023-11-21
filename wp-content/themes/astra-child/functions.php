<?php

/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

/**
 * Define Constants
 */

define('ASTRA_CHILD_DIR', trailingslashit(get_theme_file_path()));

/**
 * Include Custom Post Types
 */
require_once ASTRA_CHILD_DIR . 'inc/cpt/spectacles.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/spectacles-lieux.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/spectacles-calendrier.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/collaborateurs.php';
