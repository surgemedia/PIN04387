<?php
function epl_lu_license_options_filter($fields = null) {
	$fields[] = array(
		'label'		=>	'',
		'fields'	=>	array(
			array(
				'name'	=>	'listing_unlimited',
				'label'	=>	'Listing Unlimited license key',
				'type'	=>	'text'
			)
		)
	);
	
	return $fields;
}
add_filter('epl_license_options_filter', 'epl_lu_license_options_filter', 10, 3);

function epl_lu_extensions_options_filter($epl_fields = null) {
	$fields = array();
	$epl_lu_fields = array(
		'label'		=>	__('Listing Unlimited','epl-lu'),
	);
	
	$fields[] = array(
		'label'		=>	__('Labels','epl-lu'),
		
		'fields'	=>	array(
			
			array(
				'name'	=>	'epl_lu_group_title',
				'label'	=>	__('Title for extra info fields','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_video_label',
				'label'	=>	__('YouTube Video URL','epl-lu'),
				'type'	=>	'url'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_1',
				'label'	=>	__('Extra Info Label 1','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_2',
				'label'	=>	__('Extra Info Label 2','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_3',
				'label'	=>	__('Extra Info Label 3','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_4',
				'label'	=>	__('Extra Info Label 4','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_5',
				'label'	=>	__('Extra Info Label 5','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_6',
				'label'	=>	__('Extra Info Label 6','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_7',
				'label'	=>	__('Extra Info Label 7','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_8',
				'label'	=>	__('Extra Info Label 8','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_9',
				'label'	=>	__('Extra Info Label 9','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_10',
				'label'	=>	__('Extra Info Label 10','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_11',
				'label'	=>	__('Extra Info Label 11','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_12',
				'label'	=>	__('Extra Info Label 12','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_13',
				'label'	=>	__('Extra Info Label 13','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_14',
				'label'	=>	__('Extra Info Label 14','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_15',
				'label'	=>	__('Extra Info Label 15','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_16',
				'label'	=>	__('Extra Info Label 16','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_17',
				'label'	=>	__('Extra Info Label 17','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_18',
				'label'	=>	__('Extra Info Label 18','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_19',
				'label'	=>	__('Extra Info Label 19','epl-lu'),
				'type'	=>	'text'
			),
			
			array(
				'name'	=>	'epl_lu_label_list_item_20',
				'label'	=>	__('Extra Info Label 20','epl-lu'),
				'type'	=>	'text'
			)
		)
	);
	$epl_lu_fields['fields'] = $fields;
	$epl_fields['listing_unlimited'] = $epl_lu_fields;
	return $epl_fields;
}
add_filter('epl_extensions_options_filter_new', 'epl_lu_extensions_options_filter', 10, 1);
