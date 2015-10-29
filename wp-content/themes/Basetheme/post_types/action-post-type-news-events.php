<?php 
// Register Custom Post Type
function news_events() {

	$labels = array(
		'name'                => _x( 'News & Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'News & Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'News & Events', 'text_domain' ),
		'name_admin_bar'      => __( 'News & Event', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All News & Events', 'text_domain' ),
		'add_new_item'        => __( 'Add New News & Event', 'text_domain' ),
		'add_new'             => __( 'Add News & Event', 'text_domain' ),
		'new_item'            => __( 'New News & Event', 'text_domain' ),
		'edit_item'           => __( 'Edit News & Event', 'text_domain' ),
		'update_item'         => __( 'Update News & Event', 'text_domain' ),
		'view_item'           => __( 'View News & Event', 'text_domain' ),
		'search_items'        => __( 'Search News & Event', 'text_domain' ),
		'not_found'           => __( 'News & Events not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'News & Events not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'News & Events', 'text_domain' ),
		'description'         => __( 'News & Events Description', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'News & Events', $args );

}

// Hook into the 'init' action
add_action( 'init', 'news_events', 0 );