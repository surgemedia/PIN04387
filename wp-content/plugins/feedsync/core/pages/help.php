<?php
/*
Title: XML Feed Processor Help Page
Program Author URI: http://realestateconnected.com.au/
Description: Program created and written to process Australian REAXML feed for easy import into WordPress. 
The program will process the input files that are places in the XML directory from your feed provider and save the results into 
three XML output files in the /feedsync/outputs directory. These files contain the results of the input files.

Author: Merv Barrett
Author URI: http://realestateconnected.com.au/

Version: 2.0

*/
	require_once('../../config.php');
	require_once('../functions.php');

	global $feedsync_db;
	get_header('help');
?>

	<div class="page-header">
		<h1>FeedSync Help</h1>
	</div>

	<h3 style="margin-top:2em;">Check for Updates and License Status</h3>
	
	<a href="updates.php" style="margin: 2em 0;" type="button" class="btn btn-sm btn-warning">Check For Updates</a>
	
	<a href="license.php" style="margin: 2em 0;" type="button" class="btn btn-sm btn-warning">Check License Status</a>
	
	<a href="activate.php" style="margin: 2em 0;" type="button" class="btn btn-sm btn-warning">Activate Your License</a>
	
	<h3 style="margin-top:1em;">Documentation</h3>
	
	<ul>
		<li><a href="https://easypropertylistings.com.au/section/feedsync/">FeedSync Documentation</a></li>
		<li><a href="https://easypropertylistings.com.au/docs/how-to-upgrade-to-feedsync-2-0/">How to Upgrade to FeedSync 2.0</a></li>
		<li><a href="https://easypropertylistings.com.au/docs/update-image-urls-using-phpmyadmin-for-old-mydesktop-cdn/">How to Upgrade old MyDesktop image URLs</a></li>
		<li><a href="https://easypropertylistings.com.au/docs/how-to-import-reaxml-files-into-your-wordpress-real-estate-website/">How to Import REAXML files into Your WordPress Real Estate Website</a></li>
	</ul>
	
	<h3 style="margin-top:1em;">How to install FeedSync</h3>
	
	<p>Your first step is to determine where you want to install FeedSync on your server. Download the application from <a href="https://easypropertylistings.com.au/your-account/">your account</a> at <a href="https://easypropertylistings.com.au/">Easy Property Listings.</a></p>
	
	<p>Uncompress feedsync.zip on your computer and FTP the feedsync directory into the XML/ directory on your server</p>
	
	<ul>
		<li>cPanel: Recommended folder: <strong>public_html/XML/</strong></li>
		<li>Plesk/Parallels: Recommended folder: <strong>httpdocs/XML/</strong></li>
	</ul>
	
	
	<h3 style="margin-top:2em;">Create a database for FeedSync to store listing data</h3>
	
	<p>FeedSync uses a SQL database to store listing data in. Login to your hosting and create a MySQL database.</p>
	
	<h4>cPanel Database</h4>
	<ul>
		<li>Click the <strong>MySQL Database Wizard</strong> under the Databases heading.</li>
		<li>Next to <strong>New Database</strong> enter a name for your database and click <strong>Next Step</strong>.</li>
		<li>Next to <strong>Username</strong> enter a username.</li>
		<li>Enter a password next to Password, enter it again for Password (Again) and then click Create User</li>
		<li>On the next page, you'll assign privileges for the user to the database. Check the box next to All Privileges and then click Next Step.</li>
	</ul>
	
	<h4>Plesk/Parallels Database</h4>
	<ul>
		<li>Login to your hosting and click the <strong>Websites</strong> tab.</li>
		<li>Click the <strong>Databases</strong> under the <strong>Websites & Domains</strong> heading.</li>
		<li>Press <strong>Add New Database</strong> enter <strong>feedsync</strong> for Database name.</li>
		<li>Make a note of the <strong>Database server</strong>.</li>
		<li>Under the <strong>Users</strong> heading enter <strong>feedsync</strong> in the <strong>Database user name</strong> field.</li>
		
		<li>Enter a strong secure password in the <strong>New password</strong> field, enter it again for <strong>Confirm password</strong> field (Again) and then click <strong>Ok</strong>.</li>
	</ul>
	
	<p>Congratulations, you have just successfully created a database for FeedSync!</p>
	
	<p>Make a note of your database name, password and database username.</p>
	
	<h3 style="margin-top:2em;">Performing the The Initial FeedSync Setup</h3>
	
	<p>There is only one file that you need to edit in order for your FeedSync to work which is the config.php file located in the feedsync directory.</p>
	
	<p>Open up your FTP program and navigate to the folder where you installed FeedSync and open the config.php file in a text editor. Edit the following details highlighted in bold below:</p>
	
	<h4>Base settings</h4>
	
	<ul>
		<li>define('SITE_URL', '<strong>http://YOUR_WEBSITE_DOMAIN_NAME.COM.AU/XML/feedsync/</strong>');</li>
		<li>define('DB_NAME', '<strong>DATABASE_NAME</strong>' );</li>
		<li>define('DB_USER', '<strong>DATABASE_USER_NAME</strong>' );</li>
		<li>define('DB_PASS', '<strong>DATABASE_PASSWORD</strong>' );</li>
		<li>define('DB_HOST', '<strong>localhost</strong>' ); // Plesk/Parallels: replace <strong>localhost</strong> with your Database server details.</li>
		<li>define( 'EPL_LICENSE_URL' , '<strong>YOUR_URL</strong>');</li>
		<li>define( 'EPL_LICENSE_KEY' , '<strong>YOUR_KEY</strong>');</li>
	</ul>
	
	<h4>To generate latitude and longitude coordinates or not</h4>
	
	<p>Some providers supply latitude and longitude coordinates for listings and some do not. Once you receive files from your provider open one of the XML files and look for a &#60;Geocode&#62; node which contains the Lat and Long values. If &#60;Geocode&#62; is not present set the following option to ON. Default is OFF.</p>
	
	<ul>
		<li>define( 'FS_GEOCODE' , '<strong>OFF</strong>'); // ON or OFF</li>
	</ul>
	
	<p>Save the config file and visit your feedsync directory from your browser and you should see FeedSync in all its glory :)</p>
	
	<h2 style="margin-top:2em;">Test Geocode Credit Status</h2>
	
	<p>FeedSync uses the <a href="https://developers.google.com/maps/documentation/geocoding/">Google Geocoding API</a> to convert the property addresses in your XML file during import into lat/long coordinates so your website can display the address with a map. <em>NOTE: Google has usage limits of 2,500 requests per day and you can check the status with the button below.</em></p>
	
	<a href="tool-geocode-staus.php" style="margin: 2em 0;" type="button" class="btn btn-sm btn-warning">Check Geocode Status</a>

	<h3 style="margin-top:2em;">Create a unique FTP account for your REAXML provider</h3>
	
	<p>We recommend that you to create an unique FTP account for the feed provider which will only give them access to the <strong>feedsync/input</strong> folder. <em>They don't need access to anything else on your server.</em> This lets you move FeedSync later and all you have to do is edit the providers FTP Account Directory on your hosting.</p>
	
	<p>Log into your hosting account and press the FTP Accounts button. Create a unique FTP Account using a unique username and strong secure password.</p>

	<p><strong>Important:</strong> In the <strong>Directory</strong> field specify the FeedSync input folder. With cPanel its usually:</p>

	<ul>
		<li>cPanel: Recommended: <strong>public_html/XML/feedsync/input</strong></li>
		<li>Plesk/Parallels: Recommended: <strong>httpdocs/XML/feedsync/input</strong></li>
	</ul>
	
	<p>Supply your REAXML feed provider with their unique FTP details:</p>
	
	<ul>
		<li><strong>FTP Account:</strong> ftp.myawesomewebsite.com.au</li>
		<li><strong>User name:</strong> reaxml@myawesomewebsite.com.au</li>
		<li><strong>Password:</strong> Secure password e.g. rn7vHgU <em>Note: Some providers have difficulty with long passwords.</em></li>
		<li><strong>Folder:</strong> Leave this blank as you have only given them access to the feedsync/input folder.</li>
	</ul>
	
	<p>Once your provider has configured their end they will start delivering REAXML files to the input folder. When files are in the feedsync/input folder they will be listed on the FeedSync home page as ready for processing.</p>
	
	<h3 style="margin-top:2em;">Processing for the first time</h3>
	
	<p>Once you have received REAXML files you can perform the import process manually to check that everything is working correctly with your configuration.</p>
	
	<h3 style="margin-top:2em;">Upgrading From FeedSync 2.0+</h3>
	
	<p>Upgrading FeedSync to 2.1 from 2.0+ is a simple process. Download the latest version of FeedSync from <a href="https://easypropertylistings.com.au/your-account/">your account</a>. Unzip the file to your computer and all you need to do is replace the /core folder and its contents in your installation of FeedSync on your server.</p>
	
	<p>Once you have upgraded the core files you need to perform a one time <strong>Database Upgrade</strong> from the <a href="../process.php">Process page</a> which will allow you to filter listings by office id and address values. Once the database is upgraded you can update your agent database with the <strong>Process Listing Agents</strong> button.</p>
	
	<p>Instructions to upgrade from FeedSync 1.3 or lower <a href="https://easypropertylistings.com.au/docs/how-to-upgrade-to-feedsync-2-0/">can be found here.</a></p>
	
	<h3 id="cron" style="margin-top:2em;">How To Setup Your Cron Job</h3>
	
	<p>Once your feed is working correctly and you have successfully processed your initial feed manually you can create a cron job on your server to process the files automatically.</p>
	
	<p>Login to your server cPanel account (usually just add /cpanel to the end of your domain name. Once you have logged in look for the <strong>Cron Jobs</strong> button. On the Cron Jobs page under the Add New Cron Job under common settings select Once every 30 minutes and insert the following into the Command box and press Add New Cron Job.</p>

	<?php
	$feedsync_path = getcwd();
	chdir('../');
	$feedsync_path = getcwd();
	
	if ( $feedsync_path ) { ?> 
	
	<h5>Option 1 is the most reliable for servers.</h5>
	
	<h6>Cron Option 1</h6>
	<div class="alert alert-success">wget -q -O /dev/null "<?php echo SITE_URL; ?>core/cron.php"</div>

	<h6>Cron Option 2</h6>
	<div class="alert alert-success">/usr/bin/php -q <?php echo $feedsync_path; ?>/cron.php</div>
	
	<h6>Cron Option 3</h6>
	<div class="alert alert-success">GET <?php echo SITE_URL; ?>core/cron.php</div>
	
	<?php } else { ?>
	
	<h6>Cron Option 1</h6>
	<p><strong>/usr/bin/php -q /home/YOUR_ACCOUNT/public_html/XML/feedsync/core/cron.php</strong></p>
	
	<h6>Cron Option 2</h6>
	<p><strong>GET http://YOUR_URL.COM.AU/XML/feedsync/core/cron.php</strong></p>
	
	<?php } ?>
	
	<p>Now your FeedSync will check for new files and run will process them at your scheduled cron times.</p>
	
	<h3 style="margin-top:2em;">Exporting Listings for Import</h3>
	
	<p>FeedSync has an export tab for exporting xml files manually.</p>

	<p>You can also use the dynamic action to and you can also directly access the export via a URL for importing into your website. Using Easy Property Listings for with WP All Import Pro allows you to import REAXML listing data into your WordPress website.</p>
	
	<div class="alert alert-success"><?php echo SITE_URL; ?>?action=do_output&type=residential</div>
	
	<p>Note: This will only output listings that are current, leased, sold. If you want to include withdrawn and off market listing you can use &status=all</p>
	
	<p>You can specify the file output using the following variables based on the REAXML specifications.</p>
	
	<ol>
		<li>&#63;action=do_output : this is required</li>
		<li>&#38;type=all or a singular value of ( all, residential, rental, land, rural, commercial, business, commercial_land)</li>
		<li>&#38;status=current or a singular value of (current, sold, leased, withdrawn, offmarket, all)</li>
	</ol>
	
	<h3 style="margin-top:2em;">Additional Listing Export Commands</h3>

	<p>You can also output your listings by address fields and agent/office id.</p>
	
	<div class="alert alert-success"><?php echo SITE_URL; ?>?action=do_output&#38;type=residential&#38;agent_id=123456</div>
		
	<p>You can output listings by additional options indicated below.</p>
	
	<ol>
		<li>&#63;action=do_output : this is required</li>
		<li>&#38;agent_id=123456 : output listings by office id.</li>
		<li>&#38;date=today : output listings by the current date.</li>
		<li>&#38;street=Smith Street : output listings by street name.</li>
		<li>&#38;suburb=Sydney : output listings by suburb.</li>
		<li>&#38;state=WA : output listings by state.</li>
		<li>&#38;postcode=6000 output listings by postcode.</li>
		<li>&#38;country= output listings by country.</li>
	</ol>
	
	<h3 style="margin-top:2em;">Exporting Agents</h3>

	<p>You can export all agents present in your database for import.</p>
	
	<div class="alert alert-success"><?php echo SITE_URL; ?>?action=do_output&#38;type=agents</div>
		

<?php echo get_footer(); ?>
