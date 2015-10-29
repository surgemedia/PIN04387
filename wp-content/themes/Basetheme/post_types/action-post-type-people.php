<?php 
// Register Custom Taxonomy
function people_groups() {

	$labels = array(
		'name'                       => _x( 'People Groups', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'People Group', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'People Group', 'text_domain' ),
		'all_items'                  => __( 'All People Groups', 'text_domain' ),
		'parent_item'                => __( 'Parent People Group', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent People Group:', 'text_domain' ),
		'new_item_name'              => __( 'New People Group', 'text_domain' ),
		'add_new_item'               => __( 'Add People Group', 'text_domain' ),
		'edit_item'                  => __( 'Edit People Group', 'text_domain' ),
		'update_item'                => __( 'Update People Group', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
$rewrite = array(
		'slug'                       => 'people_group',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'people_group', array( 'people' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'people_groups', 0 );

// Register Custom Post Type
function people_post() {

	$labels = array(
		'name'                => _x( 'Management Team', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Management Team', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'people', 'text_domain' ),
		'description'         => __( 'Key People at Sharpe', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( 'people_group' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'people', $args );

}

// Hook into the 'init' action
add_action( 'init', 'people_post', 0 );
//wremoveOtherPosts('people');

