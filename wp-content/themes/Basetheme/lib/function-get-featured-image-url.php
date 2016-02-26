<?php
/*=========================================
=         get featured image url            =
=========================================*/
//Call inside the loop

function getFeaturedUrl($id = NULL, $size = 'full'){
	if(NULL != $id){
		$thumb_id = has_post_thumbnail($id) ? get_post_thumbnail_id($id) : false;
	} else {
		$thumb_id = has_post_thumbnail() ? get_post_thumbnail_id() : false;
	}
	if($thumb_id){
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
		$thumb_url = $thumb_url_array[0];
	}

	return ($thumb_id)?$thumb_url:get_field('default_image','option');
}