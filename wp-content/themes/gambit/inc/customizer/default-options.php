<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package Gambit
 */

/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function gambit_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'gambit_theme_options', array() ), gambit_default_options() );

	// Return theme options.
	return $theme_options;

}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function gambit_default_options() {

	$default_options = array(
		'site_title'						=> true,
		'site_description'					=> false,
		'theme_width' 						=> 'boxed-layout',
		'theme_layout' 						=> 'content-center',
		'blog_title'						=> esc_html__( 'Latest Posts', 'gambit' ),
		'post_layout'						=> 'small-image',
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 25,
		'meta_date'							=> true,
		'meta_author'						=> true,
		'meta_category'						=> true,
		'post_image'						=> true,
		'meta_tags'							=> true,
		'post_navigation'					=> true,
		'slider_magazine' 					=> false,
		'slider_blog' 						=> false,
		'slider_category' 					=> 0,
		'slider_limit' 						=> 8,
		'slider_animation' 					=> 'slide',
		'slider_speed' 						=> 7000,
	);

	return $default_options;
}
