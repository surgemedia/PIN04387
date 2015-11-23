<?php
/*
Loading the templates
Needs to work with other themes. These template files are a function that iThemes Builder needs to render the template.
*/

// Load Custom Template from Plugin Directory
function epl_tm_load_core_single_templates($single_template) {

	$template_path = EPL_TM_PLUGIN_PATH_TEMPLATES . 'post-types/default/';
	if( class_exists( 'Easy_Property_Listings' ) ) {
		if(epl_is_builder_framework_theme()) {
			$template_path = EPL_TM_PLUGIN_PATH_TEMPLATES . 'post-types/ithemes/';
		} 
	}

	// Load Template from Child Theme Directory
	if ( $single_template_child = locate_template( 'single-testimonial.php' ) ) {
	
		global $post;
		if (  $post->post_type == 'testimonial'  ) {
			$single_template = $single_template_child;
		}
		return $single_template;
	}
	else {
		global $post;
		if (  $post->post_type == 'testimonial'  ) {
			$single_template = $template_path.'single-testimonial.php';
		}
		return $single_template;
	}

}

// Archive Templates
function epl_tm_load_core_archive_templates( $archive_template ) {

	$template_path = EPL_TM_PLUGIN_PATH_TEMPLATES . 'post-types/default/';	
	if( class_exists( 'Easy_Property_Listings' ) ) {
		if(epl_is_builder_framework_theme()) {
			$template_path = EPL_TM_PLUGIN_PATH_TEMPLATES . 'post-types/ithemes/';
		} 
	}
	
	// Load Template from Child Theme Directory
	if ( $archive_template_child = locate_template( 'archive-testimonial.php' ) ) {
	
		global $post;
		if (  $post->post_type == 'testimonial'  ) {
			$archive_template = $archive_template_child;
		}
		return $archive_template;
	}
	else {
		global $post;
		if (  is_post_type_archive ( 'testimonial' )  ) {
			$archive_template = $template_path.'archive-testimonial.php';
		}
		return $archive_template;
	}
	
}


add_filter( 'single_template', 'epl_tm_load_core_single_templates' );
add_filter( 'archive_template', 'epl_tm_load_core_archive_templates' );
