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
define('ASTRA_CHILD_DIR', trailingslashit(get_theme_file_path()));

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);

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

/**
 * Remove autosave
 */
add_action('wp_print_scripts', 'no_autosave');
function no_autosave()
{
	wp_deregister_script('autosave');
}

/**
 * French date : "Vendredi 1er Décembre 2023"
 */
function full_textual_date_fr($date)
{
	$mois = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
	$jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

	return $jours[date("w", $date)] . " " . date("j", $date) . (date("j", $date) == 1 ? "er " : " ") . $mois[date("n", $date) - 1] . " " . date("Y", $date);
}
