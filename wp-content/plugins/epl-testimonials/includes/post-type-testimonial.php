<?php
/**
 * POST TYPE : Testimonial
 * Add sub meta boxes to the post-edit page
 *
 * @since 1.0
 */
function epl_tm_register_custom_post_type_testimonial() {
	$labels = array(
		'name'				=>	__('Testimonials', 'epl'),
		'singular_name'			=>	__('Testimonial', 'epl'),
		'menu_name'			=>	__('Testimonials', 'epl'),
		'add_new'			=>	__('Add New', 'epl'),
		'add_new_item'			=>	__('Add New Testimonial', 'epl'),
		'edit_item'			=>	__('Edit Testimonial', 'epl'),
		'new_item'			=>	__('New Testimonial', 'epl'),
		'update_item'			=>	__('Update Testimonial', 'epl'),
		'all_items'			=>	__('All Testimonials', 'epl'),
		'view_item'			=>	__('View Testimonial', 'epl'),
		'search_items'			=>	__('Search Testimonial', 'epl'),
		'not_found'			=>	__('Testimonial Not Found', 'epl'),
		'not_found_in_trash'		=>	__('Testimonial Not Found in Trash', 'epl'),
		'parent_item_colon'		=>	__('Parent Testimonial:', 'epl')
	);
	$args = array(
		'labels'			=>	$labels,
		'public'			=>	true,
		'publicly_queryable'		=>	true,
		'show_ui'			=>	true,
		'show_in_menu'			=>	true,
		'query_var'			=>	true,
		'rewrite'			=>	array( 'slug' => 'testimonial' ),
		'menu_icon'           		=> 	'dashicons-format-chat',
		'capability_type'		=>	'post',
		'has_archive'			=>	true,
		'hierarchical'			=>	false,
		'menu_position'			=>	'26.85',
		'taxonomies'			=>	array( 'location' , 'department' ),
		'supports'			=>	array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' , 'revisions' )
	);
	register_post_type( 'testimonial', $args );

}
add_action( 'init', 'epl_tm_register_custom_post_type_testimonial', 0 );

if ( is_admin() ) {
	// Manage Listing Columns
	function epl_tm_manage_columns_heading( $columns ) {
		$columns = array(
			'cb' 		=> '<input type="checkbox" />',
			'thumb' 	=> __('Testimonial Image', 'epl'),
			'title' 	=> __('Title', 'epl'),
			'address'	=> __('Linked Address', 'epl-lu'),
			'author' 	=> __('Linked Author', 'epl'),
			'department' 	=> __('Department', 'epl'),
			'date' 		=> __('Date', 'epl'),
		);
		
		/** Remove a Suburb Taxonomy if Core is not active **/
		$location_exist = taxonomy_exists('location');
		if ( ! $location_exist ) {
			unset(
				$columns['suburb']
			);
		}
		
		return $columns;
	}
	add_filter( 'manage_edit-testimonial_columns', 'epl_tm_manage_columns_heading' ) ;
	function epl_tm_manage_columns_value( $column, $post_id ) {
		global $post;
		switch( $column ) {	
			/* If displaying the 'Featured' image column. */
			case 'thumb' :
				/* Get the featured Image */
				if( function_exists('the_post_thumbnail') )
					echo the_post_thumbnail('admin-list-thumb');
				break;
			
			/* If displaying the 'Featured' image column. */
			case 'address' :
				/* Get the featured Image */
				echo epl_tm_get_linked_listing_address( $post_id );
					
				break;
			/* If displaying the 'department' column. */
			case 'department' :
				/* Get the genres for the post. */
				$terms = get_the_terms( $post_id, 'department' );
				/* If terms were found. */
				if ( !empty( $terms ) ) {
					$out = array();
					/* Loop through each term, linking to the 'edit posts' page for the specific term. */
					foreach ( $terms as $term ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'department' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'department', 'display' ) )
						);
					}
					/* Join the terms, separating them with a comma. */
					echo join( ', ', $out );
				}
				/* If no terms were found, output a default message. */
				else {
					_e( 'No Department Set' );
				}
				break;
				
			/* Just break out of the switch statement for everything else. */
			default :
				break;
		}
	}
	add_action( 'manage_testimonial_posts_custom_column', 'epl_tm_manage_columns_value', 10, 2 );
}