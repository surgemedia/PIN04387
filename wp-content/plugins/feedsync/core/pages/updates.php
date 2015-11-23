<?php
/*

Title: XML Feed Processor Geocode Test Page
Program Author URI: http://realestateconnected.com.au/
Description: Program created and written to process Australian REAXML feed for easy import into WordPress. 
The program will process the input files that are places in the XML directory from your feed provider and save the results into 
three XML output files in the /feedsync/outputs directory. These files contain the results of the input files.

Author: Merv Barrett
Author URI: http://realestateconnected.com.au/

Version: 2.0

Version History
	See history.txt
*/
	require_once('../../config.php');
	require_once('../functions.php');
	$page_now = 'Updates';
	global $feedsync_db;
	get_header($page_now);
?>

		

		
		<div class="page-header">
			<h1>FeedSync Changelog</h1>
			<p><?php echo '<strong>Installed:</strong> ' , $application_name , ' ' , $current_version ?></p>
		</div>
		<?php echo feedsync_settings_navigation($page_now) ?>

		<?php 
		$request = 'get_version';
		echo feedsync_license_validator( $request ); 
		?>

<?php echo get_footer(); ?>
