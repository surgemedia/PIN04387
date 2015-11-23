<?php
/**
 * Property Price Function
 *
 * @package     EPL-LU
 * @subpackage  Front/Display
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_lu_get_the_meta( $post_id = 0) {

	$post_id = absint( $post_id );
		if ( ! $post_id )
			$post_id = get_the_ID();

	global $epl_lu_meta;
	$epl_lu_meta = get_post_custom( $post_id );
	
	return $epl_lu_meta;
	
}

/*
* Store the Listing Unlimited meta values in a global $epl_lu_meta variable
*
* @access private
* @since 1.0
* @return void
*/
function epl_lu_get_post_meta( $post_id, $key = '', $single = false ) {
	return get_metadata('post', $post_id, $key, $single);
}

/**
* Get epl_lu_get_linked_listing_address
*
* Used when saving meta,
* 
* @require epl_lu_the_listing_address
* @return 
* @since 1.0
*/
function epl_lu_get_linked_listing_address( $post_id  = 0 ) {

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
			'post_type'		=>	$post_types,
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
					return epl_lu_the_listing_address( );
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
function epl_lu_the_listing_address( $post_id = 0 ) {

	$post_id = absint( $post_id );
		if ( ! $post_id )
			$post_id = get_the_ID();
		
	$address_keys = epl_lu_listing_address_init();

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
function epl_lu_listing_address_init( ) {

	$epl_listing_address_keys = array(
		'class'			=> 'epl-listing-address',
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


/*
* Output the custom meta in a list
*
* @access private
* @since 1.0
* @return void
*/
function epl_lu_the_meta_list_items( $post_id = 0 ) {
	
	$epl_lu_meta = epl_lu_get_the_meta( $post_id );
	if ( !empty($epl_lu_meta) ) {
		$output = '<ul class="epl-tab-section epl-lu-tab-section">';
			foreach ( $epl_lu_meta as $k=>$list_item ) {
				if(!empty($list_item) && ( strpos($k, 'listing_unlimited_list_item_') === 0 ) && $list_item[0] != '') {
					$output .= '<li><span class="list-label">' . epl_lu_meta_list(str_replace("listing_unlimited_list_item_", "", $k)) . '</span> ' . $list_item[0] . '</li>';
				}
			}
		$output .= '</ul>';
		echo $output;
	}
}


/**
 * Post Type: Profile Location Label
 *
 * @since 1.0
 * @return String
 */
function epl_lu_meta_label() {
	$label_listing_unlimited = '';
	$epl_settings = epl_settings();
	
	if(!empty($epl_settings) && isset($epl_settings['epl_lu_post_type_name'])) {
		$label_listing_unlimited = trim($epl_settings['epl_lu_post_type_name']);
	}
	if(empty($label_listing_unlimited)) {
		$label_listing_unlimited = 'Listing Unlimited';
	}	
	return $label_listing_unlimited;
}

/**
 * Post Type: List Label
 *
 * @since 1.0
 * @return String
 */
function epl_lu_meta_list($i='') {
	if($i != '') {
		$label_lu_list_item_i = '';
		$epl_settings = epl_settings();
	
		if(!empty($epl_settings) && isset($epl_settings['epl_lu_label_list_item_'.$i])) {
			$label_lu_list_item_i = trim($epl_settings['epl_lu_label_list_item_'.$i]);
		}
		if(empty($label_lu_list_item_i)) {
			$label_lu_list_item_i = 'Bullet List Name ' . $i;
		}	
		return $label_lu_list_item_i;
	}
}

/**
 * Post Type: Tab Label
 *
 * @since 1.0
 * @return String
 */
function epl_lu_meta_tab($i='') {
	$label_lu_tab_item_i = '';
	$epl_settings = epl_settings();

	if(!empty($epl_settings) && isset($epl_settings['epl_lu_label_tab_'.$i])) {
		$label_lu_tab_item_i = trim($epl_settings['epl_lu_label_tab_'.$i]);
	}
	if(empty($label_lu_tab_item_i)) {
		$label_lu_tab_item_i = 'Tab Name ' . $i;
	}
	return $label_lu_tab_item_i;
}




/**
* Get Listing Unlimited ID
*
* DESC
* 
* @require epl_lu_the_listing_address
* @return 
* @since 1.0
*/
function epl_lu_listing_unlimited_id( ) {

	global $post;
	$unique_id = get_post_meta( $post->ID , 'property_unique_id', true);

	$query = new WP_Query( array (
		'post_type'		=>	'listing_unlimited',
		'meta_query'	=>	array(
				array(
				'key' => 'property_unique_id',
				'value' => $unique_id,
				'compare' => '=='
				)
			)
		)
	);
	$listing_unlimited_id = '';
	if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				
				$listing_unlimited_id = get_the_ID();
				
			}
	}

	wp_reset_postdata();

	return $listing_unlimited_id;

}
//add_action('epl_single_extensions', 'epl_lu_single_action');

/**
 * Image Replacement
 * 
 * Hooks into Easy Property Listings Core action epl_single_featured_image
 *
 * @since 1.0
 * @return String
 */
function epl_lu_listing_featured_image( $post_id = 0 , $image_size = 'index_thumbnail' , $image_class = 'index-thumbnail' ) {

	$post_id = epl_lu_listing_unlimited_id();

	if ( $post_id != 0 && '' != get_the_post_thumbnail( $post_id ) ) {

			?>
				<div class="entry-image">
					<div class="epl-featured-image it-featured-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo get_the_post_thumbnail( $post_id , $image_size , array( 'class' => $image_class ) ); ?>
						</a>
					</div>
				</div>
			<?php 
			
			
	}

}
add_action( 'epl_single_featured_image' , 'epl_lu_listing_featured_image' );




function epl_lu_remove_featured_image( $post_id = 0) {

	$post_id = epl_lu_listing_unlimited_id();

	
	if ( $post_id != 0 && '' != get_the_post_thumbnail( $post_id ) ) {

	remove_action( 'epl_single_featured_image' , 'epl_single_listing_featured_image');

	}
	
}
add_action( 'epl_single_featured_image' , 'epl_lu_remove_featured_image' , 1 , 1);

function epl_lu_listing_gallery( $post_id = 0 ) {
	$post_id = epl_lu_listing_unlimited_id();

	if ( $post_id != 0 ) {
		if(has_action('epl_lu_listing_unlimited_gallery')) {
			do_action('epl_lu_listing_unlimited_gallery',$post_id);
		} else {
			echo get_the_post_thumbnail($post_id,'large');
		}
		
	}
	
	else {
		$post_id = get_the_id();
		if(has_action('epl_lu_default_gallery')) {
			do_action('epl_lu_default_gallery',$post_id);
		} else {
			echo get_the_post_thumbnail($post_id,'large');
		}
	}
}

remove_action( 'epl_single_featured_image' , 'epl_lu_listing_featured_image');

add_action( 'epl_lu_featured_image_slider' , 'epl_lu_listing_gallery',1 );


add_action('epl_below_features' , 'epl_lu_single_action');


/** 
 * @hooked property_after_content
**/
function epl_lu_property_video() {

	$post_id = epl_lu_listing_unlimited_id();
	$listing_unlimited_video = get_metadata('post', $post_id, 'listing_unlimited_video', false );
	
	if($listing_unlimited_video[0] != '') {
		$videoID = epl_get_youtube_id_from_url($listing_unlimited_video[0]);
		echo '<div class="videoContainer">';
			// Echo the embed code via oEmbed
			echo wp_oembed_get( ('http://www.youtube.com/watch?v=' . $videoID) , array('width'=>600)  ); 
		echo '</div>';
	}
}
add_action('epl_property_content_after','epl_lu_property_video');

function epl_lu_admin_enqueue_scripts($screen) {
	
	$current_dir_path = plugins_url('',__DIR__);
	
	wp_enqueue_script( 	'epl-lu-admin-scripts',	$current_dir_path . '/js/epl-lu-admin.js', 	array('jquery') );	
}
add_action( 'admin_enqueue_scripts', 'epl_lu_admin_enqueue_scripts' );
