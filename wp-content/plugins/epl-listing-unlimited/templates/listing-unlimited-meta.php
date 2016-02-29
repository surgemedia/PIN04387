<?php
/*
 * EPL-Listing Unlimited Meta
 * Compatibility with previous version
 */
global $listing_unlimited_meta;
$listing_unlimited_meta 	= get_post_custom();
$post_type 				= get_post_type();

// This global function allows the title to be passed to the [listing_unlimited_title] shortcode.
global $epl_lu_title;
$epl_lu_title 			= get_the_title();

// Set All Meta to blank unless meta content exists
$listing_unlimited_name = '';
	if(isset($listing_unlimited_meta['listing_unlimited_name'])) {
		if(isset($listing_unlimited_meta['listing_unlimited_name'][0])) {
			$listing_unlimited_name = $listing_unlimited_meta['listing_unlimited_name'][0];
		}	
	}
$listing_unlimited_state = '';
	if(isset($listing_unlimited_meta['listing_unlimited_state'])) {
		if(isset($listing_unlimited_meta['listing_unlimited_state'][0])) {
			$listing_unlimited_state = $listing_unlimited_meta['listing_unlimited_state'][0];
		}	
	}
$listing_unlimited_postcode = '';
	if(isset($listing_unlimited_meta['listing_unlimited_postcode'])) {
		if(isset($listing_unlimited_meta['listing_unlimited_postcode'][0])) {
			$listing_unlimited_postcode = $listing_unlimited_meta['listing_unlimited_postcode'][0];
		}	
	}
$listing_unlimited_video_url = '';
	if(isset($listing_unlimited_meta['listing_unlimited_video_url'])) {
		if(isset($listing_unlimited_meta['listing_unlimited_video_url'][0])) {
			$listing_unlimited_video_url = $listing_unlimited_meta['listing_unlimited_video_url'][0];
		}	
	}

$listing_unlimited_coords = '';
$listing_unlimited_coords = $listing_unlimited_name .' '. $listing_unlimited_state .' '. $listing_unlimited_postcode;