<?php
/**
 * Install Function
 *
 * @package     EPL SLIDER
 * @subpackage  Functions/Install
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_slider_install() {

	global $wpdb, $epl_options;

	$epl_settings = epl_settings();
	
	$new_fields_defaults =  array(
		'epl_slider_width'			=>	'',
		'epl_slider_height'			=>	'',
		'epl_allow_swipe'			=>	3,
		'epl_slider_reverseorder'		=>	'true',
		'epl_slider_controlNav'			=>	1,
		'epl_slider_keyboard'			=>	'true',
		'epl_slider_arrow_style'		=>	'a17.png',
		'epl_slider_popup'			=>	'false',
		'epl_slider_single_price_sticker'	=>	'false',
		'epl_slider_slideshow'			=>	'true',
		'epl_slider_transition'			=>	'fade_in_l',
		'epl_slider_pauseOnHover'		=>	1,
		'epl_slider_slideshowSpeed'		=>	7000,
		'epl_slider_animationSpeed'		=>	600,
		'epl_slider_use_thumbnails'		=>	'true',
		'epl_slider_thumb_width'		=>	'',
		'epl_slider_thumb_height'		=>	'',
		'epl_slider_spacingx'			=>	14,
		'epl_slider_spacingy'			=>	12,
		'epl_display_pieces'			=>	6,
		'epl_slider_thumb_orientation'		=>	1,
		'epl_slider_thumb_lanes'		=>	1,
		'epl_slider_enable_archive'		=>	0,
		'epl_slider_archive_image_size'		=>	'medium',
		'epl_slider_archive_wrapper_width'	=>	'',
		'epl_slider_archive_wrapper_height'	=>	'',
		'epl_slider_archive_price_sticker'	=>	'false',
	);
	
	foreach($new_fields_defaults as $key	=>	$value) {
		if(!isset($epl_settings[$key])) {
			$epl_settings[$key] = $value;
		}
	}
	update_option( 'epl_settings', $epl_settings );
}
register_activation_hook( EPL_SLIDER_PLUGIN_FILE, 'epl_slider_install' );

/**
 * Delete plugin settings
 * @since	2.0.0
**/
function epl_slider_uninstall() {

	global $wpdb, $epl_options;

	$epl_settings = epl_settings();

	$new_fields_defaults = array(
		'epl_slider_width'			=>	'',
		'epl_slider_height'			=>	'',
		'epl_allow_swipe'			=>	3,
		'epl_slider_reverseorder'		=>	'true',
		'epl_slider_controlNav'			=>	1,
		'epl_slider_keyboard'			=>	'true',
		'epl_slider_arrow_style'		=>	'a17.png',
		'epl_slider_popup'			=>	'false',
		'epl_slider_single_price_sticker'	=>	'false',
		'epl_slider_slideshow'			=>	'true',
		'epl_slider_transition'			=>	'fade_in_l',
		'epl_slider_pauseOnHover'		=>	1,
		'epl_slider_slideshowSpeed'		=>	7000,
		'epl_slider_animationSpeed'		=>	600,
		'epl_slider_use_thumbnails'		=>	'true',
		'epl_slider_thumb_width'		=>	'',
		'epl_slider_thumb_height'		=>	'',
		'epl_slider_spacingx'			=>	14,
		'epl_slider_spacingy'			=>	12,
		'epl_display_pieces'			=>	6,
		'epl_slider_thumb_orientation'		=>	1,
		'epl_slider_thumb_lanes'		=>	1,
		'epl_slider_enable_archive'		=>	0,
		'epl_slider_archive_image_size'		=>	'medium',
		'epl_slider_archive_wrapper_width'	=>	'',
		'epl_slider_archive_wrapper_height'	=>	'',
		'epl_slider_archive_price_sticker'	=>	'false',
	);
	
	foreach($new_fields_defaults as $key	=>	&$value) {
	
		if(isset($epl_settings[$key])) {
		
			unset($epl_settings[$key]);
			
		}
	}
	
	update_option( 'epl_settings', $epl_settings );

}
register_deactivation_hook( EPL_SLIDER_PLUGIN_FILE, 'epl_slider_uninstall' );
