<?php
/**
 * Testimonial Manager Functions
 *
 * @package     EPL-TM
 * @subpackage  Front/Display
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_tm_get_the_meta( $post_id = 0) {

	$post_id = absint( $post_id );
		if ( ! $post_id )
			$post_id = get_the_ID();

	global $epl_tm_meta;
	$epl_tm_meta = get_post_custom( $post_id );
	
	return $epl_tm_meta;
}

/*
* Store the Listing Unlimited meta values in a global $epl_tm_meta variable
*
* @access private
* @since 1.0
* @return void
*/
function epl_tm_get_post_meta( $post_id, $key = '', $single = false ) {
	return get_metadata('post', $post_id, $key, $single);
}

/**
* Get epl_tm_get_linked_listing_address
*
* Used when saving meta,
* 
* @require epl_tm_the_listing_address
* @return 
* @since 1.0
*/
function epl_tm_get_linked_listing_address( $post_id  = 0 ) {

	$post_id = absint( $post_id );
	if ( ! $post_id )
		$post_id = get_the_ID();

	if ( class_exists( 'Easy_Property_Listings' ) ) {
	
		$unique_id 		= get_post_meta( $post_id , 'property_unique_id', true);
		
		$message 		= __( 'No Listing Found or Address Set' , 'epl-lu' );
		
		if ( ! $unique_id )
			return;
		
		$post_types		= epl_get_active_post_types();
		if(!empty($post_types)) {
			 $post_types = array_keys($post_types);
		}
		
		$query = new WP_Query( array (
			'post_type'	=>	$post_types,
			'meta_query'	=>	array(
					array(
					'key' => 'property_unique_id',
					'value' => $unique_id,
					'compare' => '=='
					)
				)
			)
		);
		
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
					
					return epl_tm_the_listing_address( );

			}
		} else {
			
			return $message;
			
		}
		wp_reset_postdata();

	}
	
	return;
}

/**
* Add sub meta boxes to the post-edit page
*
* @since 1.0
*/
function epl_tm_the_listing_address( $post_id = 0 ) {

	$post_id = absint( $post_id );
		if ( ! $post_id )
			$post_id = get_the_ID();
		
	$address_keys = epl_tm_listing_address_init();

	$output_result = array();
	
	if ( !empty( $address_keys['keys'] ) ) {  
		foreach ( $address_keys['keys'] as $key => $value ) {

			$result = get_post_meta( $post_id , $value['name'], true);
			$address_keys['keys'][$key]['result'] = $result;
			
			switch( $value['type'] ) {
			
				case 'option' :
					// Nothing as this is a option
					break;
			
				case 'space':
					// Space after word separator
					$output_result[] = $result . ' ';
					break;
					
				case 'comma':
					$output_result[] =  $result . ', ';
					break;
					
				default :
					
					break;
			}
		}
	}

	
	$result = implode( '', $output_result );
	
	return $result;

}

/**
* Address Keys
*
* @since 1.0
*/
function epl_tm_listing_address_init( ) {

	$epl_listing_address_keys = array(
		'class'	=> 'epl-listing-address',
		'keys'	=>	array(
			array(
				'name'		=>	'property_address_display',
				'class'		=>	'epl-meta-option',
				'type'		=>	'option'
			),
	
			array(
				'name'		=>	'property_address_street_number',
				'class'		=>	'street-number',
				'type'		=>	'space'
			),
	
			array(
				'name'		=>	'property_address_street',
				'class'		=>	'street-name',
				'type'		=>	'comma'
			),
	
			array(
				'name'		=>	'property_address_suburb',
				'class'		=>	'suburb',
				'type'		=>	'space'
			),
	
			array(
				'name'		=>	'property_address_state',
				'class'		=>	'state',
				'type'		=>	'space'
			),
	
			array(
				'name'		=>	'property_com_display_suburb',
				'class'		=>	'epl-meta-option',
				'type'		=>	'option',
				'include'	=>	array('commercial', 'commercial_land', 'business')
			),
	
			array(
				'name'		=>	'property_address_postal_code',
				'class'		=>	'post-code',
				'type'		=>	'none'
			),
		
			array(
				'name'		=>	'property_address_country',
				'class'		=>	'country',
				'type'		=>	'none'
			),
	
			array(
				'name'		=>	'property_address_coordinates',
				'class'		=>	'coordinates',
				'type'		=>	'none'
			)
		)
	);
	return $epl_listing_address_keys;
}