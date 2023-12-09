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
define('ASTRA_CHILD_DIR', trailingslashit(get_theme_file_path()));

/**
 * Enqueue styles
 */

function enqueue_parent_style()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_parent_style');

function enqueue_child_style()
{
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
	wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
	wp_enqueue_style('home-style', get_stylesheet_directory_uri() . '/assets/css/home.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/home.css'));
	wp_enqueue_style('list-spectacles-&-actualites-style', get_stylesheet_directory_uri() . '/assets/css/list-spectacles-actualites.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/list-spectacles-actualites.css'));
	wp_enqueue_style('list-calendriers-style', get_stylesheet_directory_uri() . '/assets/css/list-calendriers.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/list-calendriers.css'));
	wp_enqueue_style('single-spectacle-style', get_stylesheet_directory_uri() . '/assets/css/single-spectacle.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/single-spectacle.css'));
	wp_enqueue_style('list-collaborateurs-style', get_stylesheet_directory_uri() . '/assets/css/list-collaborateurs.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/list-collaborateurs.css'));
	wp_enqueue_style('espace-pro-style', get_stylesheet_directory_uri() . '/assets/css/espace-pro.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/espace-pro.css'));
	wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'enqueue_child_style', 15);

function child_enqueue_admin_styles()
{
	wp_enqueue_style('astra-child-theme-admin-style', get_stylesheet_directory_uri() . '/assets/css/admin-style.css');
}

add_action('admin_enqueue_scripts', 'child_enqueue_admin_styles', 15);

/**
 * Enqueue scripts
 */
function child_enqueue_scripts()
{
	wp_enqueue_script('jquery');
	wp_register_script('spectacle_breadcrumb', get_theme_file_uri('/assets/js/spectacle_breadcrumb.js'), '', false, true);
	wp_enqueue_script('spectacle_breadcrumb');
}

add_action('wp_enqueue_scripts', 'child_enqueue_scripts');

function child_enqueue_admin_scripts()
{
	wp_register_script('metaboxes', get_theme_file_uri('/assets/js/metaboxes.js'), '', false, true);
	wp_enqueue_script('metaboxes');
}

add_action('admin_enqueue_scripts', 'child_enqueue_admin_scripts');

/**
 * Include Custom Post Types
 */
require_once ASTRA_CHILD_DIR . 'inc/cpt/cpt_spectacles.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/cpt_lieux.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/cpt_calendriers.php';
require_once ASTRA_CHILD_DIR . 'inc/cpt/cpt_collaborateurs.php';

/**
 * Include Metaboxes
 */
require_once ASTRA_CHILD_DIR . 'inc/metaboxes/mb_generator.php';
require_once ASTRA_CHILD_DIR . 'inc/metaboxes/mb_spectacle.php';
require_once ASTRA_CHILD_DIR . 'inc/metaboxes/mb_lieu.php';
require_once ASTRA_CHILD_DIR . 'inc/metaboxes/mb_calendrier.php';
require_once ASTRA_CHILD_DIR . 'inc/metaboxes/mb_collaborateur.php';

/**
 * Remove native custom fields metabox
 */
function remove_custom_meta_form()
{
	remove_meta_box('postcustom', 'post', 'normal');
	remove_meta_box('postcustom', 'page', 'normal');
	remove_meta_box('postcustom', 'spectacle', 'normal');
	remove_meta_box('postcustom', 'lieu', 'normal');
	remove_meta_box('postcustom', 'calendrier', 'normal');
	remove_meta_box('postcustom', 'collaborateur', 'normal');
}
add_action('admin_menu', 'remove_custom_meta_form');

/**
 * Include Shortcodes
 */
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacle_calendrier.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_calendriers.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacle_breadcrumb.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacles.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacles_essentiels_du_lyon.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacle_informations.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_spectacle_hgroup.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_espace_pro.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_collaborateurs.php';
require_once ASTRA_CHILD_DIR . 'inc/shortcodes/sc_actualites.php';

/**
 * Remove autosave
 */
add_action('wp_print_scripts', 'no_autosave');
function no_autosave()
{
	wp_deregister_script('autosave');
}

/**
 * Remove menus
 */

add_filter('admin_menu', 'remove_menus');
function remove_menus()
{
	remove_menu_page('edit-comments.php');
	remove_submenu_page('admin.php?page=astra', 'admin.php?page=theme-builder-free');
}

/**
 * Activate Alignfull & Alignwide
 */

function themeprefix_setup()
{
	add_theme_support('align-wide');
}
add_action('after_setup_theme', 'themeprefix_setup', 10, 2);

/**
 * Astra Breakpoints
 */

add_filter('astra_tablet_breakpoint', function () {
	return 1920;
});

add_filter('astra_mobile_breakpoint', function () {
	return 921;
});
