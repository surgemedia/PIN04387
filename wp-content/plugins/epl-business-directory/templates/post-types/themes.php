<?php
/*
* Loading the templates for Business Directory
* If child Theme has single-business-directory.php or archive-business-directory.php they will be used
*/
 
function epl_bd_load_templates($template) {
	if( epl_is_builder_framework_theme() ) {
		$template_path = EPL_BD_PATH_TEMPLATES_POST_TYPES_ITHEMES;
	} else {
		$template_path = EPL_BD_PATH_TEMPLATES_POST_TYPES_DEFAULT;
	}
	$post_tpl	=	'';
	$epl_posts 	= array( 'business_directory' );
	
	if ( is_single() && in_array( get_post_type(), $epl_posts ) ) {
	
		$common_tpl		= 'single-business-directory.php';
		$post_tpl 		= 'single-'.get_post_type().'.php';
		$find[] 		= $post_tpl;
		$find[] 		= epl_template_path() . $post_tpl;
		$find[] 		= $common_tpl;
		$find[] 		= epl_template_path() . $common_tpl;
		
	} elseif ( is_post_type_archive( $epl_posts ) ) {
		$common_tpl		= 'archive-business-directory.php';
		$post_tpl 		= 'archive-'.get_post_type().'.php';
		$find[] 		=  $post_tpl;
		$find[] 		= epl_template_path() . $post_tpl;
		$find[] 		=  $common_tpl;
		$find[] 		= epl_template_path() . $common_tpl;
		
	} elseif ( is_tax ( 'business_category' ) ) {
		$term   		= get_queried_object();
		$common_tpl		= 'archive-business-directory.php';
		$post_tpl 		= 'taxonomy-' . $term->taxonomy . '.php';
		$find[] 		= 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
		$find[] 		= epl_template_path() . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
		$find[] 		= 'taxonomy-' . $term->taxonomy . '.php';
		$find[] 		= epl_template_path() . 'taxonomy-' . $term->taxonomy . '.php';
		$find[] 		= $common_tpl;
		$find[] 		= $post_tpl;
		$find[] 		= epl_template_path() . $common_tpl;
	}
	
	if ( $post_tpl ) {
		$template       = locate_template( array_unique( $find ) );
		if(!$template) {
			$template	=	$template_path . $common_tpl;
		}
	}
	return $template;
}
add_filter( 'template_include', 'epl_bd_load_templates' );
