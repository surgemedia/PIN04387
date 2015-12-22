=== FeedSync REAXML Pre-Processor ===
Contributors: mervb
Tags: importer, reaxml, real estate, property
Donate link: https://easypropertylistings.com.au/support-the-site/
Stable tag: 2.1
License: GPL 2.0
License URI: https://easypropertylistings.com.au/

Use FeedSync to merge multiple REAXML files into something you can use with your Real Estate website, property portal or custom application

== Description ==

FeedSync lets you quickly import REAXML files into your custom application or WordPress website project and display your clients real estate property listings quickly and easily.

This is the only REAXML Pre-Processor that you can install yourself and it will automatically add Geocode coordinates (Latitude/Long ) to your property, elements during processing.

What you get with FeedSync REAXML pre-processor:
* Quick to install
* Low server usage
* Work with all REAXML elements
* Automatic Geocoding during import
* Merge XML files into specific use import output files
* Save merged properties into: Current, Sold/Leased, Withdrawn/Offmarket
* All contents of the REAXML elements copied
* Simple GUI to review FeedSync status
* Easy to update the software
* Software support
* Set and forget
* Output a List of agents for import.
* Filter listings by office id, street, suburb, state, postcode, country.
* Output listings by current date.

== Installation ==
Uncompress your feedsync.zip and upload the feedsync directory into a directory on your server like public_html/XML/
		
Save the settings file and visit the feedsync directory (same as your $base_url settings) from your browser.

== Changelog ==

2.1, September 10, 2015
* New: Config file has a place to save your providers FTP account details.
* New: Added listing agents processing and export capability which will also extract the listing agent office id, extract first name, last name.
* New: Added listing export filters to enable you to export by office id, street name, suburb, postcode, country.
* New: Output listings by current date.
* New: Timezone for directory imported list.
* New: Process listing agents for upgraders.
* New: Tab to display unique listing agents present in FeedSync database.
* New: Database upgrade button to allow exporting with the new address and office features.
* New: Blank entries are no longer output.
* Tweak: Sold and leased listings are red and current are green.
* Tweak: Improved Geocoder fallback for lat long coordinates.

2.0.3, June 18, 2015
* Tweak: Correctly process Console and Rockend REST leased, withdrawn and offmarket listings as they only send limited info which removes the listing contents. We now just change the status of these listings retaining the listing information.
* Tweak: Removed ZIP_FORMAT setting. FeedSync now processes zip and non zip formats automatically.
* Tweak: Settings for GEOCODE are no longer case sensitive for ON or on.
* Tweak: Improvements to permissions for server compatibility.
* Tweak: FeedSync now checks for output/images folder and creates if necessary when using ZIP_FORMAT for Console/REST REAXML formats.
* New: Image preview tab appears when using zip providers, good to check image import from the FeedSync Listing/Images tab.
* New: Added animation image and text during processing.
* New: Added ability to enable error_log FEEDSYNC_DEBUG.
* New: Additional settings added to config.php but defaults apply if you don't update your config.php file.

2.0.2, May 22, 2015
* Tweak: We have configured the default output action to omit withdrawn and offmarket listings. If you want to output all status types you can use status=all to the output command.
* New: Added status=all command to output all available status types including withdrawn and offmarket listings.

2.0.1, May 19, 2015
* New: Added pagination to list of listings to reduce memory usage when displaying thousands of listings.

2.0, May 16, 2015
* New: Complete rebuild of FeedSync to use a database for better file processing.
* New: Added first date field to improve importing and retaining original list date.

1.3.1, March 22, 2015
* Fix: Corrected issue in processing files with all CAPS .XML

1.3, February 13, 2015
* New: Added ability to output single merged file.
* Tweak: Moved licence checker to Easy Property Listings.

1.2, December 12, 2014 
* Fix: Improved processing speed and can handle tens of thousands of records per hour. 

1.1.4, August 08, 2014 
* Fix: Added option to enable or disable REAXML Zip format 

1.1.3, July 27, 2014
* Fix: Version numbering corrected and old files removed 

1.1.2, July 27, 2014 
* Bug: Status for leased/sold was not updating correctly. 

1.1.1, June 27, 2014 
* New: Added support for Rockend REST REAXML format. 
* New: Ability to merge current listings when only a tag is changed to leased/sold. The REST REAXML format only sends a status change so we are now copying the last entry on the listing.

1.1 June 1, 2014 
* New: Zip Support to process REAXML files saved as .zip with included images 

1.0.2, March 27, 2014
* Changed download update link 

1.0.1, March 25, 2014 
* Added ability to have custom input and output directories so you can use your own output dir for security. 
* Added additional instructions to user settings.php file. Created template functions. 
* Added ability for end user to change header name from settings.php file. 
* Created index.php files if input/output/processed directory 

1.0.0, March 22, 2014 
* Complete re-write and folder re-structure based on users feedback where feed providers would purge feed directory. So now your input files are nested within the application preventing accidental deletion. 
* New directory Structure. 

0.3.3, March 25, 2014 
* Added Geocode options to user settings file. 
* Added Template functions for easier usage. 
* Added Licensing and Update Notification. 
* Added page and ability to check for updates.
* Added template functions. Re-structured for larger real estate portal needs.
* Help file updated 

0.3.2, March 24, 2014 
* Created function to handle all XML elements. 
* Added beta Software licensing. Re-named files.
* Added feedsync-templates.php functions 

0.3.2, March 19, 2014 
* Fixed bug with long file names not processing 

0.3.1, Feb 20, 2014 Created Help page. 
* Removed old files. 
* Added Readme File. Created Geocode test option. 

0.3, Feb 12, 2014 
* Wrapped application in Bootstrap GUI. 

0.2.1, October 9, 2013 
* Fixed a bug and added output page so the user can review the feedSync process. 
* Reset Content on this version. 

0.2, September 27, 2013 
* Renamed the source location from aggregated to > wc-processor, renamed mydesktop > imported. 
* Made changes to all feedsync.php files. Added notes to feedSync.php Created History.txt 

0.1 
* Initial Release
