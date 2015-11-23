<?php
/**
 * Install Function
 *
 * @package     EPL BROCHURES
 * @subpackage  Functions/Install
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_brochures_install() {
	global $wpdb, $epl_options;
	$epl_settings = epl_settings();
	$new_fields_defaults = array(
		'epl_br_button_label'		=>	__('Brochure', 'epl-br'),
		'epl_br_header_logo'		=>	'http://easypropertylistings.com.au/epl-extensions-readme/brochures/brochure-header.png',
		'epl_br_office_details'		=>	'',
		'epl_br_disclaimer'		=>	'',
		'epl_br_theme_css'		=>	0,
		'epl_br_brochure_style'		=>	'default',
		'epl_br_attached_images'	=>	3,
		'epl_br_brochure_list_template'	=>	'default',
	);
	
	foreach($new_fields_defaults as $key	=>	$value) {
	
		if(!isset($epl_settings[$key])) {
		
			$epl_settings[$key] = $value;
			
		}
	}
	
	update_option( 'epl_settings', $epl_settings );
}
register_activation_hook( EPL_BR_PLUGIN_FILE, 'epl_brochures_install' );

/**
 * Delete plugin settings
 * @since	2.0.0
**/
function epl_brochures_uninstall() {
	global $wpdb, $epl_options;
	$epl_settings = epl_settings();
	$new_fields_defaults = array(
		'epl_br_button_label'		=>	__('Brochure', 'epl-br'),
		'epl_br_header_logo'		=>	'http://easypropertylistings.com.au/epl-extensions-readme/brochures/brochure-header.png',
		'epl_br_office_details'		=>	'',
		'epl_br_disclaimer'		=>	'',
		'epl_br_theme_css'		=>	0,
		'epl_br_brochure_style'		=>	'default',
		'epl_br_attached_images'	=>	3,
		'epl_br_brochure_list_template'	=>	'default',
	);
	
	foreach($new_fields_defaults as $key	=>	&$value) {
	
		if(isset($epl_settings[$key])) {
		
			unset($epl_settings[$key]);
			
		}
	}
	
	update_option( 'epl_settings', $epl_settings );
}
register_deactivation_hook( EPL_BR_PLUGIN_FILE, 'epl_brochures_uninstall' );

