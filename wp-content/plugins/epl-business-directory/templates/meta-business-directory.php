<?php
/*
 * Custom meta for - Business Directory
 */

// Store All Meta
$meta 		= get_post_custom();
$post_type 	= get_post_type();

//Defaults
$epl_bd_name_first		=	'';
$epl_bd_name_last		=	'';
$epl_bd_phone			=	'';
$epl_bd_email			=	'';
$epl_bd_address_street_no	=	'';
$epl_bd_address_street_name	=	'';
$epl_bd_address_street_name_2	=	'';
$epl_bd_address_suburb		=	'';
$epl_bd_address_postcode	=	'';
$epl_bd_address_state		=	'';
$epl_bd_address_coords		=	'';
$epl_bd_website			=	'';
$epl_bd_notes			=	'';

if(isset($meta['epl_bd_name_first'])) {
	if(isset($meta['epl_bd_name_first'][0])) {
		$epl_bd_name_first = $meta['epl_bd_name_first'][0];
	}
}

if(isset($meta['epl_bd_name_last'])) {
	if(isset($meta['epl_bd_name_last'][0])) {
		$epl_bd_name_last = $meta['epl_bd_name_last'][0];
	}
}

if(isset($meta['epl_bd_phone'])) {
	if(isset($meta['epl_bd_phone'][0])) {
		$epl_bd_phone = $meta['epl_bd_phone'][0];
	}
}

if(isset($meta['epl_bd_email'])) {
	if(isset($meta['epl_bd_email'][0])) {
		$epl_bd_email = $meta['epl_bd_email'][0];
	}	
}

if(isset($meta['epl_bd_address_street_no'])) {
	if(isset($meta['epl_bd_address_street_no'][0])) {
		$epl_bd_address_street_no = $meta['epl_bd_address_street_no'][0];
	}
}

if(isset($meta['epl_bd_address_street_name'])) {
	if(isset($meta['epl_bd_address_street_name'][0])) {
		$epl_bd_address_street_name = $meta['epl_bd_address_street_name'][0];
	}
}

if(isset($meta['epl_bd_address_street_name_2'])) {
	if(isset($meta['epl_bd_address_street_name_2'][0])) {
		$epl_bd_address_street_name_2 = $meta['epl_bd_address_street_name_2'][0];
	}
}

if(isset($meta['epl_bd_address_suburb'])) {
	if(isset($meta['epl_bd_address_suburb'][0])) {
		$epl_bd_address_suburb = $meta['epl_bd_address_suburb'][0];
	}
}

if(isset($meta['epl_bd_address_postcode'])) {
	if(isset($meta['epl_bd_address_postcode'][0])) {
		$epl_bd_address_postcode = $meta['epl_bd_address_postcode'][0];
	}
}

if(isset($meta['epl_bd_address_state'])) {
	if(isset($meta['epl_bd_address_state'][0])) {
		$epl_bd_address_state = $meta['epl_bd_address_state'][0];
	}
}

if(isset($meta['epl_bd_address_coords'])) {
	if(isset($meta['epl_bd_address_coords'][0])) {
		$epl_bd_address_coords = $meta['epl_bd_address_coords'][0];
	}
}

if(isset($meta['epl_bd_website'])) {
	if(isset($meta['epl_bd_website'][0])) {
		$epl_bd_website = $meta['epl_bd_website'][0];
	}
}

if(isset($meta['epl_bd_notes'])) {
	if(isset($meta['epl_bd_notes'][0])) {
		$epl_bd_notes = $meta['epl_bd_notes'][0];
	}
}	