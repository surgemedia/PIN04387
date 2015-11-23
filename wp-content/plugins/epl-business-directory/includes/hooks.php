<?php

function epl_bd_display_options_filter($fields = null) {
	$fields[] = array(
		'label'		=>	__('Business Directory Option 1', 'epl-bd'),
		'fields'	=>	array(
			array(
				'name'	=>	'epl_bd_single_property',
				'label'	=>	__('Template type', 'epl-bd'),
				'type'	=>	'select',
				'opts'	=>	array(
					0	=>	__('Expanded', 'epl-bd'),
					1	=>	__('Condensed', 'epl-bd')
				),
			),
			
			array(
				'name'	=>	'epl_bd_single_map_position',
				'label'	=>	__('Map Location', 'epl-bd'),
				'type'	=>	'select',
				'opts'	=>	array(
					0	=>	__('Separate Map After Content', 'epl-bd'),
					1	=>	__('Map with Featured Image Before Content', 'epl-bd')
				),
			)
		),
	);

	$fields[] = array(
		'label'		=>	__('Business Directory Option 2', 'epl-bd'),
		'fields'	=>	array(
		
			array(
				'name'	=>	'epl_bd_property_card_style',
				'label'	=>	__('Property Card Style', 'epl-bd'),
				'type'	=>	'select',
				'opts'	=>	array( 
					0	=>	__('(Default) Details Right', 'epl-bd'),
					1	=>	__('Address Top', 'epl-bd'),
					2	=>	__('Slim List', 'epl-bd'),
					3	=>	__('Suburb Top', 'epl-bd')
				),
			)
		),
	);
	return $fields;
}

//add_filter('epl_display_options_filter', 'epl_bd_display_options_filter', 10, 3);

function epl_bd_license_options_filter($fields = null) {
	$fields[] = array(
		'label'		=>	'',
		'fields'	=>	array(
			array(
				'name'	=>	'business_directory',
				'label'	=>	'Business Directory license key',
				'type'	=>	'text'
			)
		)
	);
	return $fields;
}
add_filter('epl_license_options_filter', 'epl_bd_license_options_filter', 10, 3);