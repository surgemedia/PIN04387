<?php
/* 
Loading the templates
*/
 
// Load Custom Template from Plugin Directory
function epl_lu_load_core_single_templates($single_template) {

	/* Default template */
	$template_path = EPL_LU_PLUGIN_DIR . 'templates/post-types/default/';
	if( class_exists( 'Easy_Property_Listings' ) ) {
		if(epl_is_builder_framework_theme()) {
			$template_path = EPL_LU_PLUGIN_DIR . 'templates/post-types/ithemes/';
		} 
	}
	// Load Template from Child Theme Directory
	if ( $single_template_child = locate_template( 'single-listing-unlimited.php' ) ) {
	
		global $post;
		if (  $post->post_type == 'listing_unlimited'  ) {
			$single_template = $single_template_child;
		}
		return $single_template;
	}
	else {
		global $post;
		if (  $post->post_type == 'listing_unlimited'  ) {
			$single_template = $template_path.'single-listing-unlimited.php';
		}
		return $single_template;
	}
	
}
// Archive Templates
function epl_lu_load_core_archive_templates( $archive_template ) {

	$template_path = EPL_LU_PLUGIN_DIR . 'templates/post-types/default/';
	if( class_exists( 'Easy_Property_Listings' ) ) {
		if(epl_is_builder_framework_theme()) {
			$template_path = EPL_LU_PLUGIN_DIR . 'templates/post-types/ithemes/';
		} 
	}
	
	// Load Template from Child Theme Directory
	if ( $archive_template_child = locate_template( 'archive-listing-unlimited.php' ) ) {
	
		global $post;
		if (  $post->post_type == 'listing_unlimited'  ) {
			$archive_template = $archive_template_child;
		}
		return $archive_template;
	}
	else {
		global $post;
		if ( is_post_type_archive ( 'listing_unlimited' ) ) {
			$archive_template = $template_path.'archive-listing-unlimited.php';
		}
		return $archive_template;
	}
	
}
add_filter( 'single_template', 'epl_lu_load_core_single_templates' );
add_filter( 'archive_template', 'epl_lu_load_core_archive_templates' );