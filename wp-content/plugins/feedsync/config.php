<?php
/**
 * The base configurations of FeedSync.
 *
 * This file has the following configurations: MySQL settings, License, URL
 * processing settings, and ABSPATH.
 * 
 * You can get the MySQL settings from your web host.
 *
 * @package FeedSync
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for FeedSync */
define('DB_NAME', 'feedsync' );

/** MySQL database username */
define('DB_USER', 'root' );

/** MySQL database password */
define('DB_PASS', 'root' );

/** MySQL hostname */
define('DB_HOST', 'localhost' );

/** 
 * Keep a record of the FTP account you created for your provider.
 *
 * Recommended is for you to create an unique FTP account for the feed provider which will only give them access to 
 * the YOUR_URL.com.au/XML/feedsync/input folder. They don't need access to anything else on your server. This lets 
 * you move FeedSync later and all you have to do is edit the providers FTP Account Directory on your hosting.
 *
 * FTP Account:	your_site.com.au
 * User name: 	reaxml@your_site.com.au
 * Password:	SDEerf% (7 characters is recommended for older providers)
**/

/**
 * License keys for updates and support
 * Software License. Set these so you can register this website with your license so you can receive software support
 *
 * @since 1.0
 */
 
define('REC_LICENSED_URL', 'http://YOUR_WEBSITE_DOMAIN_NAME.COM.AU/' );
define('REC_LICENSE', 'YOUR_FEEDSYNC_LICENSE_KEY' );


/** 
 * Base URL of the location of FeedSync 
 *
 * Adjust to match the URL where FeedSync is installed.
 * Replace feedsync_xml_url with http://YOUR_WEBSITE/XML/
 * Edit This - The location url of where FeedSync exists.
 * Make sure you include a / at the end
 *
 * @since 1.0
 */
define('SITE_URL', 'http://YOUR_URL/XML/feedsync/');

/** Processing configuration **/

/**
 * Define the file size in order to process large XML files 
 * FEEDSYNC_MAX_FILESIZE will be broken into chunks to avoid time-outs
 * Default to 512000 bytes i.e 512 kb
 *
 * @since 2.0
 */
define('FEEDSYNC_MAX_FILESIZE',512000 );

/**
 * How many listings would each split xml file would contain. default to 50.
 *
 * @since 2.0
 */
define('FEEDSYNC_CHUNK_SIZE',50 );

/**
 * Processing XML container elements are not used
 * XML Property Details. Open a xml file and enter the user name and password from the <propertyList> element.
 *
 * @since 1.0
 */

define('XML_USERNAME','reaxml' );
define('XML_PASSWORD','reaxml' );

/**
 * GEO_ENABLED 'ON' or 'OFF'
 *
 * Set to 'on' to enable Lat/Long coordinates generation for each <address> block inside each REAXML elements. 
 * Warning! Google allows for 2,500 records per day per server. So if you have a huge number of records, 
 * first process the input files with geocoding OFF.
 */
define('GEO_ENABLED','OFF' );

/*
 * Pagination for browsing listings
 */
define('FEEDSYNC_PAGINATION',	1000 );

/*
 * Pagination for browsing listing images when providers use ZIP 
 */
define('FEEDSYNC_GALLERY_PAGINATION',	24 );

/* That's all, stop editing! Happy REAXML processing with FeedSync. */

/** Absolute path to the FeedSync directory. */
define('DS','/');
define('SITE_ROOT',dirname(__FILE__).DS );

/** 
 * Timezone Setting 
 *
 * @since 2.1
**/
define('FEEDSYNC_TIMEZONE',	'Australia/Victoria' );

/**
 * For developers: Adjust folder locations
 *
 * Define FeedSync folders if you want to adjust the default folders
 */
define('CORE_PATH',	SITE_ROOT.'core'.DS );
define('CORE_URL',	SITE_URL.'core'.DS );
define('VIEW_PATH',	CORE_PATH.'views'.DS );
define('ASSETS_PATH',	CORE_PATH.'assets'.DS );
define('ASSETS_URL',	CORE_URL.'assets'.DS );
define('CSS_URL',	ASSETS_URL.'css'.DS );
define('JS_URL',	ASSETS_URL.'js'.DS );
define('INPUT_URL',	SITE_URL.'input'.DS );
define('OUTPUT_URL',	SITE_URL.'output'.DS );
define('IMAGES_URL',	SITE_URL.'output/images'.DS );
define('PROCESSED_URL',	SITE_URL.'processed'.DS );
define('ZIP_URL',	PROCESSED_URL.'zips'.DS );
define('TEMP_URL',	ZIP_URL.'temp'.DS );
define('INPUT_PATH',	SITE_ROOT.'input'.DS );
define('OUTPUT_PATH',	SITE_ROOT.'output'.DS );
define('IMAGES_PATH',	OUTPUT_PATH.'images'.DS );
define('PROCESSED_PATH',SITE_ROOT.'processed'.DS );
define('ZIP_PATH',	PROCESSED_PATH.'zips'.DS );
define('TEMP_PATH',	ZIP_PATH.'temp'.DS );
define('LOG_PATH',	SITE_ROOT );
define('LOG_FILE',	'error.log' );
define('FEEDSYNC_DEBUG' , false );

