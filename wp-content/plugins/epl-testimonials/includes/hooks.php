<?php
/**
 * Testimonial Manager extension settings hooked to Easy Property Listings
 *
 * @since 1.0
 */
function epl_tm_license_options_filter($fields = null) {
	$fields[] = array(
		'label'		=>	'',
		'fields'	=>	array(
			array(
				'name'	=>	'testimonial_manager',
				'label'	=>	'Testimonial Manager license key',
				'type'	=>	'text'
			)
		)
	);
	
	return $fields;
}
add_filter('epl_license_options_filter', 'epl_tm_license_options_filter', 10, 3);


function epl_tm_display_options_filter($epl_fields = null) {

	/*
	 * EPL Testimonial Manager - Basic Settings
	 */
	$fields = array();
	$epl_tm_fields = array(
		'label'		=>	__('Testimonials','epl')
	);
	
	$sizes = epl_get_thumbnail_sizes();
		foreach ($sizes as $k => &$v) {
			$v = $k.' ('.$v[0].' x '.$v[1]. ')';
		}
	
	$fields[] = array(
		'label'		=>	'Settings', // Tab title
		'intro'		=>	__('Adjust your testimonial settings below and press save changes.' , 'epl'),
		'fields'	=>	apply_filters('epl_tm_settings_tab', array(
			array(
				'name'		=>	'epl_tm_group_title',
				'label'		=>	__('Title for linked listing' , 'epl-tm'),
				'type'		=>	'text'
			)
		) )
	);
	
	$fields[] = array(
		'label'		=>	'Single', // Tab title
		'intro'		=>	__('Adjust how the single testimonial displays below' , 'epl'),
		'fields'	=>	apply_filters('epl_tm_single_settings_tab', array(
			
			array(
				'name'		=>	'epl_tm_single_image_display',
				'label'		=>	__('Display the featured image?' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	array(
					'on'		=>	__('Enable' , 'epl-tm'),
					'off'		=>	__('Disable' , 'epl-tm'),
				)
			),
			
			array(
				'name'		=>	'epl_tm_single_image_size',
				'label'		=>	__('Image size' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	$sizes
			),
			
			array(
				'name'	=>	'epl_tm_single_image_align',
				'label'	=>	__('Featured image alignment' , 'epl-tm'),
				'type'	=>	'select',
				'opts'	=>	array(
					'alignnone'	=>	__('None' , 'epl-tm'),
					'alignleft'	=>	__('Left' , 'epl-tm'),
					'aligncenter'	=>	__('Center' , 'epl-tm'),
					'alignright'	=>	__('Right' , 'epl-tm')
				)
			),
			
			array(
				'name'		=>	'epl_tm_single_location',
				'label'		=>	__('Display location in testimonial?' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	array(
					'on'		=>	__('Enable' , 'epl-tm'),
					'off'		=>	__('Disable' , 'epl-tm')
				),
			)
		) )
	);
	
	$fields[] = array(
		'label'		=>	'Archive', // Tab title
		'intro'		=>	__('Adjust how the archive testimonial displays below' , 'epl'),
		'fields'	=>	apply_filters('epl_tm_archive_settings_tab',  array(

			array(
				'name'		=>	'epl_tm_loop_display_excerpt',
				'label'		=>	__('Display Excerpt or full content' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	array(
					'excerpt'	=>	__('Excerpt only' , 'epl-tm'),
					'full'		=>	__('Full Testimonial Content' , 'epl-tm')
				),
			),
			
			array(
				'name'		=>	'epl_tm_loop_image_display',
				'label'		=>	__('Display the featured image on a single testimonial' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	array(
					'on'		=>	__('Enable' , 'epl-tm'),
					'off'		=>	__('Disable' , 'epl-tm'),
				)
			),
			
			array(
				'name'		=>	'epl_tm_loop_image_size',
				'label'		=>	__('Image size' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	$sizes
			),
			
			array(
				'name'	=>	'epl_tm_loop_image_align',
				'label'	=>	__('Featured image alignment' , 'epl-tm'),
				'type'	=>	'select',
				'opts'	=>	array(
					'alignnone'	=>	__('None' , 'epl-tm'),
					'alignleft'	=>	__('Left' , 'epl-tm'),
					'aligncenter'	=>	__('Center' , 'epl-tm'),
					'alignright'	=>	__('Right' , 'epl-tm')
				)
			),
			
			array(
				'name'		=>	'epl_tm_loop_location',
				'label'		=>	__('Display location in testimonial?' , 'epl-tm'),
				'type'		=>	'select',
				'opts'		=>	array(
					'on'		=>	__('Enable' , 'epl-tm'),
					''		=>	__('Disable' , 'epl-tm')
				),
			)
		) )
	);
	
	
	$epl_tm_fields['fields'] = $fields;
	$epl_fields['testimonial_manager'] = $epl_tm_fields;
	return $epl_fields;
}
add_filter('epl_extensions_options_filter_new', 'epl_tm_display_options_filter', 10, 3);

// add options to staff directory extension 

function epl_tm_staff_dir_single_opts($fields) {

	$opts_sd_listing_count = array('-1'	=>	'all');
	for($i=4; $i<=60; $i++) {
		$opts_sd_listing_count[$i] = $i;
	}
	
	$tm_fields = array(
		array(
			'name'	=>	'epl_sd_show_testimonials',
			'label'	=>	'Show Testimonials',
			'type'	=>	'radio',
			'opts'	=>	array(
				'yes'	=>	__('Yes','epl'),
				'no'	=>	__('No','epl')
			),
			'default'	=>	'no'
		),
		array(
			'name'	=>	'epl_sd_testimonials_count',
			'label'	=>	'Number of Testimonials',
			'type'	=>	'select',
			'opts'	=>	$opts_sd_listing_count,
			'help'	=>	'Number Testimonials displayed for each staff member.'
		)
	);
	
	return array_merge($fields,$tm_fields);
}

add_filter('epl_sd_single_tab_settings','epl_tm_staff_dir_single_opts');

function epl_tm_filter_dashboard_widget_posts($posts) {
	$posts[] = 'testimonial';
	return $posts;
}
add_filter('epl_filter_dashboard_widget_posts','epl_tm_filter_dashboard_widget_posts');

