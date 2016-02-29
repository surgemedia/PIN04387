<?php
/*
Title: XML Feed Processor Run Page
Program Author URI: http://realestateconnected.com.au/
Description: Program created and written to process Australian REAXML feed for easy import into WordPress. 
The program will process the input files and store them in a database on your server. The output is generated on the fly as requested by your import software.

Author: Merv Barrett
Author URI: http://realestateconnected.com.au/
Version: 2.1

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


/* Initialise FeedSync Do not edit this file*/

require_once('config.php'); 
require_once('core/functions.php'); 

$feedsync_hook->do_action('init');

if( !is_installed() ) {
	install();
} else {
	home();
}
