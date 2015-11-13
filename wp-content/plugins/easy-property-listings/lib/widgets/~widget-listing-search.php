<?php
/**
 * WIDGET :: Property Search
 *
 * @package     EPL
 * @subpackage  Widget/Search
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class EPL_Widget_Property_Search extends WP_Widget {

	function __construct() {
		parent::WP_Widget( false, $name = __('EPL - Listing Search', 'epl') );
	}

	function widget($args, $instance) {	
		$defaults = array(
			'title'					=>	'',
			'post_type'				=>	array('property'),
			'style'					=>	'default',
			'property_status'		=>	'any',
			'search_location'		=>	'on',
			'search_city'			=>	'off',
			'search_state'			=>	'off',
			'search_country'		=>	'off',
			'search_postcode'		=>	'off',
			'search_house_category'	=>	'on',
			'search_price'			=>	'on',
			'search_bed'			=>	'on',
			'search_bath'			=>	'on',
			'search_rooms'			=>	'off',
			'search_car'			=>	'on',
			'search_other'			=>	'on',
			'search_id'				=>	'off',
			'search_land_area'		=>	'off',
			'search_building_area'	=>	'off',
			'submit_label'			=>	__('Find me a Property!','epl')
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		extract( $args );
		
		echo $before_widget;
		
		$title	= apply_filters('widget_title', $instance['title']);
		if ( $title )
			echo $before_title . $title . $after_title;			
		
		$instance['show_title'] = false;
		echo epl_shortcode_listing_search_callback($instance);
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['post_type'] 			= $new_instance['post_type'];
		$instance['property_status'] 		= strip_tags($new_instance['property_status']);
		$instance['style'] 			= strip_tags($new_instance['style']);
		$instance['search_location'] 		= strip_tags($new_instance['search_location']);
		$instance['search_city'] 		= strip_tags($new_instance['search_city']);
		$instance['search_state'] 		= strip_tags($new_instance['search_state']);
		$instance['search_country'] 		= strip_tags($new_instance['search_country']);
		$instance['search_postcode'] 		= strip_tags($new_instance['search_postcode']);
		$instance['search_house_category'] 	= strip_tags($new_instance['search_house_category']);
		$instance['search_price'] 		= strip_tags($new_instance['search_price']);
		$instance['search_bed'] 		= strip_tags($new_instance['search_bed']);
		$instance['search_bath'] 		= strip_tags($new_instance['search_bath']);
		$instance['search_rooms'] 		= strip_tags($new_instance['search_rooms']);
		$instance['search_car'] 		= strip_tags($new_instance['search_car']);
		$instance['search_id'] 			= strip_tags($new_instance['search_id']);
		$instance['search_other'] 		= strip_tags($new_instance['search_other']);
		$instance['search_land_area'] 		= strip_tags($new_instance['search_land_area']);
		$instance['search_building_area'] 	= strip_tags($new_instance['search_building_area']);
		$instance['submit_label'] 		= strip_tags($new_instance['submit_label']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'title'					=>	'',
			'post_type'				=>	array('property'),
			'style'					=>	'default',
			'property_status'		=>	'any',
			'search_location'		=>	'on',
			'search_city'			=>	'off',
			'search_state'			=>	'off',
			'search_country'		=>	'off',
			'search_postcode'		=>	'off',
			'search_house_category'	=>	'on',
			'search_price'			=>	'on',
			'search_bed'			=>	'on',
			'search_bath'			=>	'on',
			'search_rooms'			=>	'off',
			'search_car'			=>	'on',
			'search_other'			=>	'on',
			'search_id'				=>	'off',
			'search_land_area'		=>	'off',
			'search_building_area'	=>	'off',
			'submit_label'			=>	__('Find me a Property!','epl')
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 	
	
		$title				=	esc_attr($instance['title']);
		$post_types			=	$instance['post_type'];

		$property_status	=	esc_attr($instance['property_status']);
		$style				=	esc_attr($instance['style']);
		$search_location	=	esc_attr($instance['search_location']);
		$search_city		=	esc_attr($instance['search_city']);
		$search_state		=	esc_attr($instance['search_state']);
		$search_country		=	esc_attr($instance['search_country']);
		$search_postcode	=	esc_attr($instance['search_postcode']);
		$search_house_category	=	esc_attr($instance['search_house_category']);
		$search_price		=	esc_attr($instance['search_price']);
		$search_bed		=	esc_attr($instance['search_bed']);
		$search_bath		=	esc_attr($instance['search_bath']);
		$search_rooms		=	esc_attr($instance['search_rooms']);
		$search_car		=	esc_attr($instance['search_car']);
		$search_id		=	esc_attr($instance['search_id']);
		$search_other		=	esc_attr($instance['search_other']);
		$search_land_area	=	esc_attr($instance['search_land_area']);
		$search_building_area	=	esc_attr($instance['search_building_area']);
		$submit_label		=	esc_attr($instance['submit_label']);
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'epl'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style', 'epl'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<?php
					$status_list = array(
						'default'	=>	__('Default' , 'epl'),
						'wide'		=>	__('Wide' , 'epl'),
						'slim'		=>	__('Slim' , 'epl')
					);
					
					foreach($status_list as $k=>$v) {
						$selected = '';
						if(isset($style) && $k == $style) {
							$selected = 'selected="selected"';
						}
						echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'epl').'</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Listing Type, hold CTRL to select multiple and enable tabs', 'epl'); ?></label> 
			<select multiple class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>[]">
				<?php
					$supported_post_types = epl_get_active_post_types();
					if(!empty($supported_post_types)) {
						foreach($supported_post_types as $k=>$v) {
							$selected = '';
							if(in_array($k,$post_types)) {
								$selected = 'selected="selected"';
							}
							echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'epl').'</option>';
						}
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('property_status'); ?>"><?php _e('Status:', 'epl'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('property_status'); ?>" name="<?php echo $this->get_field_name('property_status'); ?>">
				<?php
					$status_list = array(
						''		=>	__('Any' , 'epl'),
						'current'	=>	__('Current' , 'epl'),
						'sold'		=>	apply_filters( 'epl_sold_label_status_filter' , __('Sold', 'epl') ),
						'leased'	=>	apply_filters( 'epl_leased_label_status_filter' , __('Leased', 'epl') )
					);
					
					foreach($status_list as $k=>$v) {
						$selected = '';
						if(isset($property_status) && $k == $property_status) {
							$selected = 'selected="selected"';
						}
						echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'epl').'</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<input id="<?php echo $this->get_field_id('search_id'); ?>" name="<?php echo $this->get_field_name('search_id'); ?>" type="checkbox" <?php if(isset($search_id) && $search_id == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_id'); ?>"><?php _e('Property ID', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_location'); ?>" name="<?php echo $this->get_field_name('search_location'); ?>" type="checkbox" <?php if(isset($search_location) && $search_location == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_location'); ?>"><?php _e('Location', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_city'); ?>" name="<?php echo $this->get_field_name('search_city'); ?>" type="checkbox" <?php if(isset($search_city) && $search_city == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_city'); ?>"><?php _e('City', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_state'); ?>" name="<?php echo $this->get_field_name('search_state'); ?>" type="checkbox" <?php if(isset($search_state) && $search_state == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_state'); ?>"><?php _e('State', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_country'); ?>" name="<?php echo $this->get_field_name('search_country'); ?>" type="checkbox" <?php if(isset($search_country) && $search_country == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_country'); ?>"><?php _e('Country', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_postcode'); ?>" name="<?php echo $this->get_field_name('search_postcode'); ?>" type="checkbox" <?php if(isset($search_postcode) && $search_postcode == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_postcode'); ?>"><?php echo epl_display_label_postcode(); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_house_category'); ?>" name="<?php echo $this->get_field_name('search_house_category'); ?>" type="checkbox" <?php if(isset($search_house_category) && $search_house_category == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_house_category'); ?>"><?php _e('House Category', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_price'); ?>" name="<?php echo $this->get_field_name('search_price'); ?>" type="checkbox" <?php if(isset($search_price) && $search_price == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_price'); ?>"><?php _e('Price', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_bed'); ?>" name="<?php echo $this->get_field_name('search_bed'); ?>" type="checkbox" <?php if(isset($search_bed) && $search_bed == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_bed'); ?>"><?php _e('Bedroom', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_bath'); ?>" name="<?php echo $this->get_field_name('search_bath'); ?>" type="checkbox" <?php if(isset($search_bath) && $search_bath == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_bath'); ?>"><?php _e('Bathroom', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_rooms'); ?>" name="<?php echo $this->get_field_name('search_rooms'); ?>" type="checkbox" <?php if(isset($search_rooms) && $search_rooms == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_rooms'); ?>"><?php _e('Rooms', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_car'); ?>" name="<?php echo $this->get_field_name('search_car'); ?>" type="checkbox" <?php if(isset($search_car) && $search_car == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_car'); ?>"><?php _e('Car', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_land_area'); ?>" name="<?php echo $this->get_field_name('search_land_area'); ?>" type="checkbox" <?php if(isset($search_land_area) && $search_land_area == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_land_area'); ?>"><?php _e('Land Area', 'epl'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('search_building_area'); ?>" name="<?php echo $this->get_field_name('search_building_area'); ?>" type="checkbox" <?php if(isset($search_building_area) && $search_building_area == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_building_area'); ?>"><?php _e('Building Area', 'epl'); ?></label>
		</p>
		
		<p>
			<input id="<?php echo $this->get_field_id('search_other'); ?>" name="<?php echo $this->get_field_name('search_other'); ?>" type="checkbox" <?php if(isset($search_other) && $search_other == 'on') { echo 'checked="checked"'; } ?> />
			<label for="<?php echo $this->get_field_id('search_other'); ?>"><?php _e('Other Search Options', 'epl'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('submit_label'); ?>"><?php _e('Submit Label', 'epl'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('submit_label'); ?>" name="<?php echo $this->get_field_name('submit_label'); ?>" type="text" value="<?php echo $submit_label; ?>" />
		</p>
		<?php 
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("EPL_Widget_Property_Search");') );

//Property Search Query
function epl_search_pre_get_posts( $query ) {
	if ( is_admin() || !$query->is_main_query() ) {
		return;
	}
	
	if( epl_is_search() ) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$query->init();
		$query->set('posts_per_page', get_option('posts_per_page'));
		$query->set('paged', $paged);
		
		extract($_REQUEST);
		if(isset($property_id) ) {
			if(is_numeric($property_id)) {
				$query->set( 'post__in', array(intval($property_id)) );
			} else {
				$query->set( 'epl_post_title', sanitize_text_field($property_id) );
			}
				
		}
		
		if(isset($post_type) && !empty($post_type)) {
			$query->set('post_type', $post_type);
		} else {
			$epl_post_types = epl_get_active_post_types();
			if(!empty($epl_post_types)) {
				$epl_post_types = array_keys($epl_post_types);
				$query->set('post_type', $epl_post_types);
			}
		}

		$meta_query = array();
		if(isset($property_security_system) && !empty($property_security_system)) {
			$meta_query[] = array(
				'key'		=>	'property_security_system',
				'value'		=>	array('yes', '1'),
				'compare'	=>	'IN'
			);
		}
		if(isset($property_air_conditioning) && !empty($property_air_conditioning)) {
			$meta_query[] = array(
				'key'		=>	'property_air_conditioning',
				'value'		=>	array('yes', '1'),
				'compare'	=>	'IN'
			);
		}
		if(isset($property_pool) && !empty($property_pool)) {
			$meta_query[] = array(
				'key'		=>	'property_pool',
				'value'		=>	array('yes', '1'),
				'compare'	=>	'IN'
			);
		}
		if(isset($property_bedrooms_min) && !empty($property_bedrooms_min)) {
			$meta_query[] = array(
				'key'		=>	'property_bedrooms',
				'value'		=>	$property_bedrooms_min,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		if(isset($property_bedrooms_max) && !empty($property_bedrooms_max)) {
			$meta_query[] = array(
				'key'		=>	'property_bedrooms',
				'value'		=>	$property_bedrooms_max,
				'type'		=>	'numeric',
				'compare'	=>	'<='
			);
		}
		if(isset($property_land_area_min) && !empty($property_land_area_min)) {
			$meta_query[] = array(
				'key'		=>	'property_land_area',
				'value'		=>	$property_land_area_min,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		if(isset($property_land_area_max) && !empty($property_land_area_max)) {
			$meta_query[] = array(
				'key'		=>	'property_land_area',
				'value'		=>	$property_land_area_max,
				'type'		=>	'numeric',
				'compare'	=>	'<='
			);
		}
		if((isset($property_land_area_max) && !empty($property_land_area_max)) || 
			(isset($property_land_area_min) && !empty($property_land_area_min))) {
			
			$meta_query[] = array(
				'key'		=>	'property_land_area_unit',
				'value'		=>	$property_land_area_unit
			);
		}
		
		if(isset($property_building_area_min) && !empty($property_building_area_min)) {
			$meta_query[] = array(
				'key'		=>	'property_building_area',
				'value'		=>	$property_building_area_min,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		if(isset($property_building_area_max) && !empty($property_building_area_max)) {
			$meta_query[] = array(
				'key'		=>	'property_building_area',
				'value'		=>	$property_building_area_max,
				'type'		=>	'numeric',
				'compare'	=>	'<='
			);
		}
		if((isset($property_building_area_max) && !empty($property_building_area_max)) || 
			(isset($property_building_area_min) && !empty($property_building_area_min))) {
			
			$meta_query[] = array(
				'key'		=>	'property_building_area_unit',
				'value'		=>	$property_building_area_unit
			);
		}
		
		if(isset($property_bathrooms) && !empty($property_bathrooms)) {
			$meta_query[] = array(
				'key'		=>	'property_bathrooms',
				'value'		=>	$property_bathrooms,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		
		if(isset($property_rooms) && !empty($property_rooms)) {
			$meta_query[] = array(
				'key'		=>	'property_rooms',
				'value'		=>	$property_rooms,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		
		
		if(isset($property_carport) && !empty($property_carport)) {
			$meta_query[] = array(
				'relation' => 'OR',
				array(
					'key'		=>	'property_carport',
					'value'		=>	$property_carport,
					'type'		=>	'numeric',
					'compare'	=>	'>='
				),
				array(
					'key'		=>	'property_garage',
					'value'		=>	$property_carport,
					'type'		=>	'numeric',
					'compare'	=>	'>='
				)
			);
		}
		if(isset($property_category) && !empty($property_category)) {
			$meta_query[] = array(
				'key'		=>	'property_category',
				'value'		=>	$property_category,
				'compare'	=>	'='
			);
		}
		
		if( isset($post_type) && ($post_type == 'rental' || $post_type == 'commercial' || $post_type == 'business' || $post_type == 'holiday_rental' || $post_type == 'commercial_land') ) {
			$key = 'property_rent';
		} else {
			$key = 'property_price';
		}			
		if(isset($property_price_from) && !empty($property_price_from)) {
			$meta_query[] = array(
				'key'		=>	$key,
				'value'		=>	$property_price_from,
				'type'		=>	'numeric',
				'compare'	=>	'>='
			);
		}
		if(isset($property_price_to) && !empty($property_price_to)) {
			$meta_query[] = array(
				'key'		=>	$key,
				'value'		=>	$property_price_to,
				'type'		=>	'numeric',
				'compare'	=>	'<='
			);
		}
		
		if(isset($property_status) && !empty($property_status)) {
			$meta_query[] = array(
				'key'		=>	'property_status',
				'value'		=>	$property_status,
				'compare'	=>	'='
			);
		}
		
		if(isset($property_address_city) && !empty($property_address_city)) {
			$meta_query[] = array(
				'key'		=>	'property_address_city',
				'value'		=>	$property_address_city,
				'compare'	=>	'='
			);
		}
		
		if(isset($property_address_state) && !empty($property_address_state)) {
			$meta_query[] = array(
				'key'		=>	'property_address_state',
				'value'		=>	$property_address_state,
				'compare'	=>	'='
			);
		}

		if(isset($property_address_country) && !empty($property_address_country)) {
			$meta_query[] = array(
				'key'		=>	'property_address_country',
				'value'		=>	$property_address_country,
				'compare'	=>	'='
			);
		}

		if(isset($property_address_postal_code) && !empty($property_address_postal_code)) {
			$meta_query[] = array(
				'key'		=>	'property_address_postal_code',
				'value'		=>	$property_address_postal_code,
				'compare'	=>	'='
			);
		}
		
		if(!empty($meta_query)) {
			$query->set('meta_query', $meta_query);;
		}
		
		$tax_query = array();
		if(isset($property_location) && !empty($property_location)) {
			$tax_query[] = array(
				'taxonomy'	=>	'location',
				'field'		=>	'id',
				'terms'		=>	$property_location
			);
		}
		
		if(!empty($tax_query)) {
			$query->set('tax_query', $tax_query);;
		}
		$query->parse_query();
	}
}
add_action( 'pre_get_posts', 'epl_search_pre_get_posts' );

//Is Property Search
function epl_is_search() {
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'epl_search') {
		return true;
	}
	return false;
}

function epl_get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
	if( empty($key) ) {
		return;
	}
	
	global $wpdb;	
	$results = $wpdb->get_results( $wpdb->prepare( "SELECT distinct(pm.`meta_value`) FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.`ID` = pm.`post_id` WHERE pm.`meta_key` = '%s' AND p.`post_status` = '%s' AND p.`post_type` = '%s' AND pm.`meta_value` != ''", $key, $status, $type ));
	if(!empty($results)) {
		$return = array();
		foreach($results as $result) {
			$return[] = $result->meta_value;
		}
		return $return;
	}
}

function epl_esc_like ($text) {
	 return addcslashes( $text, '_%\\' );
}
function epl_listings_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $epl_post_title = $wp_query->get( 'epl_post_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( epl_esc_like( $epl_post_title ) ) . '%\'';
    }
    return $where;
}
add_filter( 'posts_where', 'epl_listings_where', 10, 2 );
