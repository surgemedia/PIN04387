<?php
/*
 * POST TYPE :: Listing Unlimited
 */
  
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
function epl_lu_register_custom_post_type_listing_unlimited() {
	
	$labels = array(
		'name'				=>	__('Listing Unlimited' , 'epl-lu'),
		'singular_name'			=>	__('Listing Unlimited' , 'epl-lu'),
		'menu_name'			=>	__('Listing Unlimited' , 'epl-lu'),
		'add_new'			=>	__('Add New', 'epl-lu'),
		'add_new_item'			=>	__('Add New Listing Unlimited' , 'epl-lu'),
		'edit_item'			=>	__('Edit Listing Unlimited' , 'epl-lu'),
		'new_item'			=>	__('New Listing Unlimited' , 'epl-lu'),
		'update_item'			=>	__('Update Listing Unlimited' , 'epl-lu'),
		'all_items'			=>	__('Listing Unlimited' , 'epl-lu'),
		'view_item'			=>	__('View Listing Unlimited' , 'epl-lu'),
		'search_items'			=>	__('Search Listing Unlimited' , 'epl-lu'),
		'not_found'			=>	__('Listing Unlimited Not Found' , 'epl-lu'),
		'not_found_in_trash'		=>	__('Listing Unlimited Not Found in Trash' , 'epl-lu'),
		'parent_item_colon'		=>	__('Parent Listing Unlimited:' , 'epl-lu')
	);
	$args = array(
		'labels'			=>	$labels,
		'public'			=>	true,
		'publicly_queryable'		=>	false,
		'show_ui'			=>	true,
		'show_in_menu'			=>	true,
		'query_var'			=>	true,
		'rewrite'			=>	array( 'slug' => 'listing-unlimited' ),
		'menu_icon'			=>	'dashicons-analytics',
		'capability_type'		=>	'post',
		'has_archive'			=>	false,
		'hierarchical'			=>	false,
		'menu_position'			=>	'26.89',
		'supports'			=>	array( 'editor', 'thumbnail', 'revisions' )
	);
	

	register_post_type( 'listing_unlimited', $args );
}
add_action( 'init', 'epl_lu_register_custom_post_type_listing_unlimited', 0 );

/**
 * Manage Admin Property Post Type Columns: Heading
 *
 * @since 1.0
 * @return void
 */
function epl_lu_manage_columns_heading( $columns ) {
	$columns = array(
		'cb' 				=> '<input type="checkbox" />',
		'property_thumb'		=> __('Featured Image', 'epl-lu'),
		'title'				=> __('Property ID', 'epl-lu'),
		'address'			=> __('Address', 'epl-lu'),
		'listing'			=> __('Listing Unlimited Details', 'epl-lu'),
		'date'				=> __('Date', 'epl-lu')
	);
	return $columns;
}
add_filter( 'manage_edit-listing_unlimited_columns', 'epl_lu_manage_columns_heading' );

/**
 * Manage Admin Property Post Type Columns: Row Contents
 *
 * @since 1.0
 */
function epl_lu_manage_columns_value( $column, $post_id ) {
	global $post;
	switch( $column ) {
		/* If displaying the 'Featured' image column. */
		case 'property_thumb' :
			/* Get the featured Image */
			if( function_exists('the_post_thumbnail') )
				echo the_post_thumbnail('admin-list-thumb');
			break;
			
		case 'address' :
			/* Get the featured Image */
			echo epl_lu_get_linked_listing_address( $post_id );
				
			break;
			
		case 'listing' :
			/* Get the post meta. */
			$epl_lu_meta = get_post_custom();

			
			 epl_lu_the_meta_list_items( $post_id );
			
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_action( 'manage_listing_unlimited_posts_custom_column', 'epl_lu_manage_columns_value', 10, 2 );