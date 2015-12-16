<?php 
// Register Custom Post Type
function tips_pt() {

	$labels = array(
		'name'                  => _x( 'Tips', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Tip', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Tips', 'text_domain' ),
		'name_admin_bar'        => __( 'Tips', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Tip:', 'text_domain' ),
		'all_items'             => __( 'All Tips', 'text_domain' ),
		'add_new_item'          => __( 'Add New Tip', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Tip', 'text_domain' ),
		'edit_item'             => __( 'Edit Tip', 'text_domain' ),
		'update_item'           => __( 'Update Tip', 'text_domain' ),
		'view_item'             => __( 'View Tip', 'text_domain' ),
		'search_items'          => __( 'Search Tip', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'items_list'            => __( 'Tips list', 'text_domain' ),
		'items_list_navigation' => __( 'Tips list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Tips list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Tip', 'text_domain' ),
		'description'           => __( 'property tips', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'tips', $args );

}
add_action( 'init', 'tips_pt', 0 );


// Register Custom Taxonomy
function type_of_tip() {

	$labels = array(
		'name'                       => _x( 'Type Of Tips', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type Of Tip', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Type Of Tip', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'type_of_tip', array( 'tips' ), $args );

}
add_action( 'init', 'type_of_tip', 0 );