<?php
/**
 * Add default settings to epl upon activation
 * @since	2.1
**/
function epl_tm_install() {

	global $wpdb, $epl_options;

	$epl_settings = epl_settings();

	$new_fields_defaults = array(
		'epl_tm_group_title'			=>	__( 'Testimonials', 'epl-tm'),
		'epl_tm_single_image_display'		=>	'on',
		'epl_tm_single_image_size'		=>	'thumbnail',
		'epl_tm_single_image_align'		=>	'alignleft',
		'epl_tm_single_location'		=>	'on',
		'epl_tm_loop_display_excerpt'		=>	'excerpt',
		'epl_tm_loop_image_display'		=>	'on',
		'epl_tm_loop_image_size'		=>	'thumbnail',
		'epl_tm_loop_image_align'		=>	'alignleft',
		'epl_tm_loop_location'			=>	'on',
		'epl_sd_show_testimonials'		=>	'yes',
		'epl_sd_testimonials_count'		=>	4,
	);
	
	foreach($new_fields_defaults as $key	=>	$value) {
		if(!isset($epl_settings[$key])) {
			$epl_settings[$key] = $value;
		}
	}
	update_option( 'epl_settings', $epl_settings );
}

register_activation_hook( EPL_TM_PLUGIN_FILE, 'epl_tm_install' );

/**
 * Delete plugin settings
 * @since	2.0.0
**/
function epl_tm_uninstall() {

	global $wpdb, $epl_options;

	$epl_settings = epl_settings();

	$new_fields_defaults = array(
		'epl_tm_group_title'			=>	__( 'Testimonials', 'epl-tm'),
		'epl_tm_single_image_display'		=>	'on',
		'epl_tm_single_image_size'		=>	'thumbnail',
		'epl_tm_single_image_align'		=>	'alignleft',
		'epl_tm_single_location'		=>	'on',
		'epl_tm_loop_display_excerpt'		=>	'excerpt',
		'epl_tm_loop_image_display'		=>	'on',
		'epl_tm_loop_image_size'		=>	'thumbnail',
		'epl_tm_loop_image_align'		=>	'alignleft',
		'epl_tm_loop_location'			=>	'on',
		'epl_sd_show_testimonials'		=>	'yes',
		'epl_sd_testimonials_count'		=>	4,
	);
	
	foreach($new_fields_defaults as $key	=>	&$value) {
		if(isset($epl_settings[$key])) {
			unset($epl_settings[$key]);
		}
	}
	update_option( 'epl_settings', $epl_settings );
}
register_deactivation_hook( EPL_TM_PLUGIN_FILE, 'epl_tm_uninstall' );