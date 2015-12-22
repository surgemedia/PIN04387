<?php
/**
 * @package     EPL-LU
 * @subpackage  Shotrcode/map
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.4
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only load on front
if( is_admin() ) {
	return;
}

/**
 * SHORTCODE :: [listing_unlimited_title]
 * This shortcode allows you to insert the suburb name into a widget.
 * For use on single suburb profiles as this returns the current post's title
 */
function epl_lu_shortcode_listing_unlimited_title( ) {

	global $epl_lu_title;
	$title = $epl_lu_title;
	
	return $title;
}
add_shortcode( 'listing_unlimited_title', 'epl_lu_shortcode_listing_unlimited_title' );
