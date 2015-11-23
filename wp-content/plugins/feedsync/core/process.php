<?php
/*

Title: XML Feed Processor
Program Author URI: http://realestateconnected.com.au/
Description: Program created and written to process Australian REAXML feed for easy import into WordPress. 
The program will process the input files that are places in the XML directory from your feed provider and save the results into 
three XML output files in the /feedsync/outputs directory. These files contain the results of the input files.

Author: Merv Barrett
Author URI: http://realestateconnected.com.au/

/*
	Copyright 2014	 Merv Barrett	 (email : merv@realestateconnected.com.au)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

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
					if( $zip->extractTo( TEMP_PATH ) ) {
						$imgs_ex = array_filter( glob( TEMP_PATH.'*.jpg'), 'is_file');
						if(!empty($imgs_ex)) {
							foreach($imgs_ex as $img_ex) {
								$img_name = basename($img_ex);
								if(!empty($img_name)) {
								
									if (!file_exists(IMAGES_PATH)) {
										@mkdir(IMAGES_PATH, 0777, true);
									}
									
									if( rename ( $img_ex,  IMAGES_PATH.$img_name ) ) {
										
									}
								}
							}
						}
						
						$xmls_ex = array_filter(glob(TEMP_PATH.'*.[xX][mM][lL]'), 'is_file');
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
					rename ( $z,  ZIP_PATH.$z_name );
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

get_header('process'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<input type="button" id="import_listings" value="Process" class="btn btn-primary">
		<input type="button" class="btn btn-info pull-right" value="Process Missing Coordinates" id="process_missing_coordinates">
		<input type="button" class="btn btn-info pull-right" value="Process Listing Agents" id="process_missing_listing_agents">
		<input type="button" class="btn btn-info pull-right" value="Database Upgrade" id="upgrade_table_data">
		
	</div>
	<div class="alert alert-success">
		Click on process to start processing files.
	</div>
</div>

<?php echo get_footer(); ?>

