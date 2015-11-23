<?php
/**
 * Business Directory Template Functions
 *
 * @package     EPL-BD
 * @subpackage  Taxonomy/Features
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * TEMPLATE - Business Directory Template Functions
 */

// TEMPLATE - Business Directory Single
function epl_business_directory_single() {
	epl_business_get_template_part('content-business-directory-single.php');
}

// TEMPLATE - Business Directory Archive
function epl_business_directory_archive() { 
	epl_business_get_template_part('loop-business-directory-archive.php');
}

// TEMPLATE - Business Directory Widget : Default
function epl_business_directory_widget( $display , $d_image = 'medium' ) {	
	include( EPL_BD_PATH . 'templates/content/widget-business-directory.php' );
}

// TEMPLATE - Business Directory Widget : List
function epl_business_directory_widget_list() {	
	include( EPL_BD_PATH . 'templates/content/widget-business-directory-list.php' );
}

// TEMPLATE - Business Directory Category List
function epl_business_directory_category_list() { 
	epl_business_get_template_part('content-business-directory-category-list.php');
}

/*
* Attempts to load templates in order of priority
*/
function epl_business_get_template_part($template) {

	global $epl_author;
	$default		= $template;
	$find[] 		= epl_template_path() . $template;
	$template       = locate_template( array_unique( $find ) );
	if(!$template) {
		$template	=	EPL_BD_PATH_TEMPLATES_CONTENT . $default;
	}
	include( $template);
}

/*
** Get business directory meta
*/
function epl_business_get_meta($key) {
	
	global $epl_bd_meta;
	if(isset($epl_bd_meta[$key])) {

		if(isset($epl_bd_meta[$key][0])) {

			return $epl_bd_meta[$key][0];

		}	

	}
	
	return '';
}

/*
** globalize bd meta, avoid queries
*/
function epl_business_decalre_global_meta() {
	global $epl_bd_meta;
	$epl_bd_meta	=	get_post_custom();
}
add_action('wp','epl_business_decalre_global_meta');

/*
** get category list of business directories
*/
function epl_business_get_category_list() {
	global $post;
	return get_the_term_list($post->ID, 'business_category', ' ', ' ', ' ' );
}