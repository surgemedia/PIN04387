<?php

	require_once('../config.php');
	require_once('functions.php');
	require_once('class-chunks.php'); 
	
	$feedsync_hook->do_action('init');
	global $feedsync_db;
	set_time_limit(0);



	// Zip Processor
	$z_ex = array_filter(glob(INPUT_PATH.'/*.zip'),'is_file');
	if(!empty($z_ex)) {
		$z_ex = array_map('trim', $z_ex);
	
	
		if ( class_exists('ZipArchive')  ) {
			$zip = new ZipArchive;
	

				foreach($z_ex as $z) {
					if( $zip->open($z) === TRUE) {
						if( $zip->extractTo( PROCESSED_PATH.'zips/temp/' ) ) {
							$imgs_ex = array_filter( glob( PROCESSED_PATH.'zips/temp/*.jpg'), 'is_file');
							if(!empty($imgs_ex)) {
								foreach($imgs_ex as $img_ex) {
									$img_name = basename($img_ex);
									if(!empty($img_name)) {
										if( rename ( $img_ex,  OUTPUT_PATH.'/images/'.$img_name ) ) {
										
										}
									}
								}
							}
						
							$xmls_ex = array_filter(glob(PROCESSED_PATH.'zips/temp/*.[xX][mM][lL]'), 'is_file');
							if(!empty($xmls_ex)) {
								foreach($xmls_ex as $xml_ex) {
									$xml_name = basename($xml_ex);
									if(!empty($xml_name)) {
										if( rename ( $xml_ex,  INPUT_PATH.$xml_name ) ) {
										
										}
									}
								}
							}
						}
					
						$z_name = basename($z);
						rename ( $z,  PROCESSED_PATH.'zips/'.$z_name );
					 }
				}
				$zip->close();
		}
	}

	$x_ex = array_filter(glob(INPUT_PATH.'/*.[xX][mM][lL]'),'is_file');

	if( !empty($x_ex) ) {
	
		foreach($x_ex as $path) {
			@chmod($path, 0777);
			if(filesize($path) > FEEDSYNC_MAX_FILESIZE) {
				$xml_chunks = new XMl_CHUNKS($path);
				$xml_chunks->create_chunk();
			}
		}
	}
	
import_listings(true);
