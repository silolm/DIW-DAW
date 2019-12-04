<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core.php and provides some helper functions using custom functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Higher_Education
 */

//define theme version
if ( !defined( 'HIGHER_EDUCATION_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();

	define ( 'HIGHER_EDUCATION_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Implement the core functions
 */
require trailingslashit( get_template_directory() ) . 'inc/core.php';