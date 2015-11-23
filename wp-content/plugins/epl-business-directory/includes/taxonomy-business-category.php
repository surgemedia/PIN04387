<?php
/**
 * TAXONOMY :: Business Type
 *
 * @package     EPL-BD
 * @subpackage  Taxonomy/Features
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
function epl_bd_register_taxonomy_business_category() {
	$labels = array(
		'name'                       => _x( 'Business Category', 'Taxonomy General Name', 'epl' ),
		'singular_name'              => _x( 'Business Category', 'Taxonomy Singular Name', 'epl' ),
		'menu_name'                  => __( 'Category', 'epl' ),
		'all_items'                  => __( 'All Business Categories', 'epl' ),
		'parent_item'                => __( 'Parent Business Category', 'epl' ),
		'parent_item_colon'          => __( 'Parent Business Category:', 'epl' ),
		'new_item_name'              => __( 'New Business Category', 'epl' ),
		'add_new_item'               => __( 'Add New Business Category', 'epl' ),
		'edit_item'                  => __( 'Edit Business Category', 'epl' ),
		'update_item'                => __( 'Update Business Category', 'epl' ),
		'separate_items_with_commas' => __( 'Separate Business Category with commas', 'epl' ),
		'search_items'               => __( 'Search Business Categories', 'epl' ),
		'add_or_remove_items'        => __( 'Add or remove Business Categories', 'epl' ),
		'choose_from_most_used'      => __( 'Choose from the most used Business Category', 'epl' ),
		'not_found'                  => __( 'Business Category Not Found', 'epl' ),
	);
	$rewrite = array(
		'slug'                       => 'business-category',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'business_category', 'business_directory' , $args );
}
add_action( 'init', 'epl_bd_register_taxonomy_business_category', 0 );