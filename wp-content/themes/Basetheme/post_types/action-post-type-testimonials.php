<?php 
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Testimonials', 'text_domain' ),
		'name_admin_bar'      => __( 'Testimonial', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Testimonials', 'text_domain' ),
		'add_new_item'        => __( 'Company Name', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Testimonial', 'text_domain' ),
		'edit_item'           => __( 'Edit Testimonial', 'text_domain' ),
		'update_item'         => __( 'Update Testimonial', 'text_domain' ),
		'view_item'           => __( 'View Testimonial', 'text_domain' ),
		'search_items'        => __( 'Search Testimonial', 'text_domain' ),
		'not_found'           => __( 'Testimonial Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Testimonial Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Testimonials', 'text_domain' ),
		'description'         => __( 'Write your Testimonial', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array('title', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-awards',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'Testimonials', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );