<?php
/*
 * POST TYPE :: Business Directory : business_directory
 */
function epl_bd_register_custom_post_type_business_directory() {
	$labels = array(
		'name'			=>	__('Business Directory', 'epl'),
		'singular_name'		=>	__('Business', 'epl'),
		'menu_name'		=>	__('Business Directory', 'epl'),
		'add_new'		=>	__('Add New', 'epl'),
		'add_new_item'		=>	__('Add New Business', 'epl'),
		'edit_item'		=>	__('Edit Business', 'epl'),
		'new_item'		=>	__('New Business', 'epl'),
		'update_item'		=>	__('Update Business', 'epl'),
		'all_items'		=>	__('All Businesses', 'epl'),
		'view_item'		=>	__('View Business', 'epl'),
		'search_items'		=>	__('Search Business', 'epl'),
		'not_found'		=>	__('Business Not Found', 'epl'),
		'not_found_in_trash'	=>	__('Business Not Found in Trash', 'epl'),
		'parent_item_colon'	=>	__('Parent Business:', 'epl')
	);
	$args = array(
		'labels'		=>	$labels,
		'public'		=>	true,
		'publicly_queryable'	=>	true,
		'show_ui'		=>	true,
		'show_in_menu'		=>	true,
		'query_var'		=>	true,
		'rewrite'		=>	array( 'slug' => 'business-directory' ),
		'menu_icon'           	=> 'dashicons-megaphone',
		'capability_type'	=>	'post',
		'has_archive'		=>	true,
		'hierarchical'		=>	false,
		'menu_position'		=>	'26.87',
		'taxonomies'		=>	array( 'business_category' ),
		'supports'		=>	array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' , 'revisions' , 'comments' )
	);
	register_post_type( 'business_directory', $args );
}
add_action( 'init', 'epl_bd_register_custom_post_type_business_directory', 0 );

if ( is_admin() ) {
	// Manage Listing Columns
	function epl_bd_manage_business_directory_columns_heading( $columns ) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Address' ),
			'details' => __( 'Details' ),
			'category' => __( 'Category' ),
			'comments' => __('<span title="Comments" class="comment-grey-bubble"></span>', 'epl'),
			'author' => __( 'Author' ),
			'date' => __( 'Date' )
		);
		
		return $columns;
	}
	add_filter( 'manage_edit-business_directory_columns', 'epl_bd_manage_business_directory_columns_heading' ) ;
	 
	function epl_bd_manage_business_directory_columns_value( $column, $post_id ) {
		global $post;
		switch( $column ) {	
			/* If displaying the 'Geocoding Debug column. */
			case 'details' :
				/* Get the post meta. */
				$bd_fname = get_post_meta( $post_id, 'epl_bd_name_first', true );
				$bd_lname = get_post_meta( $post_id, 'epl_bd_name_last', true );
				$bd_phone = get_post_meta( $post_id, 'epl_bd_phone', true );
				$bd_email = get_post_meta( $post_id, 'epl_bd_email', true );
				$bd_web = get_post_meta( $post_id, 'epl_bd_website', true );
				
				/* Echo Details. */
				echo '<div class="epl_bd_name">';
					echo '<span class="epl_bd_name_first">' , $bd_fname , ' </span>';
					echo '<span class="epl_bd_name_last">' , $bd_lname , '</span>';
				echo '</div>';
				echo '<div class="epl_bd_phone">' , $bd_phone , '</div>';
				echo '<div class="epl_bd_email"><a href="mailto:' , $bd_email , '">' , $bd_email , '</a></div>';
				echo '<div class="epl_bd_website"><a href="' , $bd_web , '" target="_blank">' , $bd_web , '</a></div>';
				break;	
			/* If displaying the 'Geocoding Debug column. */
			case 'category' :
				/* Get the post meta. */
				$bd_category = get_the_term_list( $post->ID, 'business_category', '', ', ', '' );
				echo '<div class="type_category">' , $bd_category , '</div>';
				break;
				
			/* Just break out of the switch statement for everything else. */
			default :
				break;
		}
	}
	add_action( 'manage_business_directory_posts_custom_column', 'epl_bd_manage_business_directory_columns_value', 10, 2 );
	 

}