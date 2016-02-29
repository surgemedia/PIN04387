<?php
/**
 * TAXONOMY : Department
 *
 * @package     EPL
 * @subpackage  Taxonomy/Department
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_tm_register_taxonomy_departments() {
	$labels = array(
		'name'                       => _x( 'Department', 'Taxonomy General Name', 'epl' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'epl' ),
		'menu_name'                  => __( 'Departments', 'epl' ),
		'all_items'                  => __( 'All Departments', 'epl' ),
		'parent_item'                => __( 'Parent Department', 'epl' ),
		'parent_item_colon'          => __( 'Parent Department:', 'epl' ),
		'new_item_name'              => __( 'New Department Name', 'epl' ),
		'add_new_item'               => __( 'Add New Department', 'epl' ),
		'edit_item'                  => __( 'Edit Department', 'epl' ),
		'update_item'                => __( 'Update Department', 'epl' ),
		'separate_items_with_commas' => __( 'Separate Department with commas', 'epl' ),
		'search_items'               => __( 'Search Department', 'epl' ),
		'add_or_remove_items'        => __( 'Add or remove Department', 'epl' ),
		'choose_from_most_used'      => __( 'Choose from the most used Department', 'epl' ),
		'not_found'                  => __( 'Department Not Found', 'epl' ),
	);
	$rewrite = array(
		'slug'                       => 'department',
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
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'department', array( 'directory' , 'testimonial' ) , $args );
}
add_action( 'init', 'epl_tm_register_taxonomy_departments', 0 );
