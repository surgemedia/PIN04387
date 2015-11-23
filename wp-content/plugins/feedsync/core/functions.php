<?php
	
	$current_version = '2.1';
	$application_name = 'FeedSync REAXML Processor';
	$partial_update_providers = array(
		'console',
		'Rockend'
	);

	require_once('class-hook.php'); 


	/* acts as backup if one of te constants definition is missing in config.php */
	
	function define_constants() {
		
		if( !defined('FEEDSYNC_MAX_FILESIZE') )
			define('FEEDSYNC_MAX_FILESIZE',512000 );
			
		if( !defined('FEEDSYNC_CHUNK_SIZE') )
			define('FEEDSYNC_CHUNK_SIZE',50 );
			
		if( !defined('GEO_ENABLED') )	
			define('GEO_ENABLED','OFF' );
			
		if( !defined('FEEDSYNC_PAGINATION') )
			define('FEEDSYNC_PAGINATION',	1000 );
			
		if( !defined('FEEDSYNC_GALLERY_PAGINATION') )
			define('FEEDSYNC_GALLERY_PAGINATION',	24 );
			
		if( !defined('CORE_PATH') )	
			define('CORE_PATH',	SITE_ROOT.'core'.DS );
			
		if( !defined('CORE_URL') )	
			define('CORE_URL',	SITE_URL.'core'.DS );
			
		if( !defined('VIEW_PATH') )		
			define('VIEW_PATH',	CORE_PATH.'views'.DS );
			
		if( !defined('ASSETS_PATH') )	
			define('ASSETS_PATH',	CORE_PATH.'assets'.DS );
			
		if( !defined('ASSETS_URL') )	
			define('ASSETS_URL',	CORE_URL.'assets'.DS );
			
		if( !defined('CSS_URL') )	
			define('CSS_URL',	ASSETS_URL.'css'.DS );
			
		if( !defined('JS_URL') )	
			define('JS_URL',	ASSETS_URL.'js'.DS );
			
		if( !defined('INPUT_URL') )	
			define('INPUT_URL',	SITE_URL.'input'.DS );
			
		if( !defined('OUTPUT_URL') )		
			define('OUTPUT_URL',	SITE_URL.'output'.DS );
			
		if( !defined('IMAGES_URL') )	
			define('IMAGES_URL',	SITE_URL.'output/images'.DS );
			
		if( !defined('PROCESSED_URL') )	
			define('PROCESSED_URL',	SITE_URL.'processed'.DS );
			
		if( !defined('ZIP_URL') )		
			define('ZIP_URL',	PROCESSED_URL.'zips'.DS );
			
		if( !defined('TEMP_URL') )		
			define('TEMP_URL',	ZIP_URL.'temp'.DS );
			
		if( !defined('INPUT_PATH') )		
			define('INPUT_PATH',	SITE_ROOT.'input'.DS );
			
		if( !defined('OUTPUT_PATH') )	
			define('OUTPUT_PATH',	SITE_ROOT.'output'.DS );
			
		if( !defined('IMAGES_PATH') )		
			define('IMAGES_PATH',	OUTPUT_PATH.'images'.DS );
			
		if( !defined('PROCESSED_PATH') )		
			define('PROCESSED_PATH',SITE_ROOT.'processed'.DS );
			
		if( !defined('ZIP_PATH') )		
			define('ZIP_PATH',	PROCESSED_PATH.'zips'.DS );
			
		if( !defined('TEMP_PATH') )		
			define('TEMP_PATH',	ZIP_PATH.'temp'.DS );
			
		if( !defined('LOG_PATH') )		
			define('LOG_PATH',	SITE_ROOT );
			
		if( !defined('LOG_FILE') )	
			define('LOG_FILE',	'error.log' );
			
		if( !defined('FEEDSYNC_DEBUG') )		
			define('FEEDSYNC_DEBUG' , false );

		if( !defined('FEEDSYNC_TIMEZONE') )		
			define('FEEDSYNC_TIMEZONE',	'Australia/Victoria' );

	}
	
	$feedsync_hook->add_action('init','define_constants',1);
	
	function setup_environment() {
		
			ini_set("log_errors" , "1");
			ini_set("error_log" , LOG_PATH.LOG_FILE);
	
			if ( defined('FEEDSYNC_DEBUG') && (FEEDSYNC_DEBUG == true || FEEDSYNC_DEBUG == TRUE || FEEDSYNC_DEBUG == 1 ) ) {
				ini_set("display_errors" , "1");
			} else {
				ini_set("display_errors" , "0");
			}

			date_default_timezone_set(FEEDSYNC_TIMEZONE);

	}
	$feedsync_hook->add_action('init','setup_environment',5);
	

	function init_db_connection() {
		global $feedsync_db;

		require_once CORE_PATH."ez_sql_core.php";

		require_once CORE_PATH."ez_sql_mysqli.php";

		if( !defined('DB_USER')  || !defined('DB_PASS')  || !defined('DB_NAME')  || !defined('DB_HOST')  ) {
			
			$feedsync_errors[111] = 'database credentials not defined';
			return false;
		
		} else {
			$feedsync_db = new ezSQL_mysqli(DB_USER,DB_PASS,DB_NAME,DB_HOST);
			$listing_table = $feedsync_db->get_results('show tables like "feedsync" ');
			$users_table = $feedsync_db->get_results('show tables like "feedsync_users" ');
			
			if( is_null($listing_table) || empty($listing_table) ||  is_null($users_table) || empty($users_table)  ) {
				create_table();
			} 
			
			$sql = "SELECT *
					FROM INFORMATION_SCHEMA.COLUMNS
					WHERE table_name = 'feedsync'
					AND table_schema = '".DB_NAME."'
					AND column_name = 'street'";

			$col_exists = $feedsync_db->get_results($sql);
			if( is_null($col_exists) ) {
				upgrade_tables();
			}

			
			
		}
		
		$feedsync_db->show_errors = false;
	}
	
	/*
	** Initialize database connection
	*/
	$feedsync_hook->add_action('init_db','init_db_connection');
	$feedsync_hook->do_action('init_db');
	/*
	** installer form
	*/
	$feedsync_hook->add_action('feedsync_form_installer','feedsync_form_installer');

	function feedsync_form_installer() {

		$file = CORE_PATH.'config.php';
		$current  = file_get_contents($file);
		$current .= "/* db credentials */\n";
		$current .= "DEFINE('DB_USER', '{$_POST['user_name']}' );\n";
		$current .= "DEFINE('DB_PASS', '{$_POST['user_pass']}' );\n";
		$current .= "DEFINE('DB_NAME', '{$_POST['db_name']}' );\n";
		$current .= "DEFINE('DB_HOST', '{$_POST['host_name']}' );\n";
		file_put_contents($file, $current);
		init_db_connection();
		
	}
	
	/*
	** exporter form
	*/
	$feedsync_hook->add_action('feedsync_form_exporter','feedsync_form_exporter');

	function feedsync_form_exporter() {
	
		
		global $feedsync_db;
		$query = "SELECT * FROM feedsync WHERE 1 = 1 ";
		
		
		$types 		= array('rental','residential','commercial','land','rural','business','commercialLand','holidayRental');
		$type 		= trim($_POST['listingtype']);
		
		$statuses 		= array('leased','sold','withdrawn','current','offmarket');
		$status 		= trim($_POST['listingstatus']);
		
		if( in_array($type,$types) ) {
			$query .= " AND type = '{$type}' ";
		}
		
		if( isset($_GET['recent']) ) {
			$query .= " AND STR_TO_DATE(mod_date,'%Y-%m-%d') = CURDATE() ";
		}
		
		if( in_array($status,$statuses) ) {
			$query .= " AND status = '{$status}' ";
		} elseif($status == 'all' ) {
			// do nothing
		}else {
			$query .= " AND status NOT IN ('withdrawn','offmarket') ";
		}
		
		$results = $feedsync_db->get_results($query);
		export_data($results);
		
	}
	
	/*
	** agents exporter form
	*/
	$feedsync_hook->add_action('feedsync_form_export_agents','feedsync_form_export_agents');

	function feedsync_form_export_agents() {
	
		
		global $feedsync_db;
		$query = "SELECT * FROM feedsync_users WHERE 1 = 1 ";
		
		$results = $feedsync_db->get_results($query);
		export_data($results);
		
	}
	
	$feedsync_hook->add_action('feedsync_form_do_output','feedsync_form_do_output');
	function feedsync_form_do_output() {
		
		global $feedsync_db;
		$type 		= isset($_GET['type']) ? trim($_GET['type']) : '';
		
		
		if($type == 'agents') {
			$query 		= "SELECT * FROM feedsync_users WHERE 1 = 1 ";
		} else {
			$query 		= "SELECT * FROM feedsync WHERE 1 = 1 AND address != '' ";
			$types 		= array('rental','residential','commercial','land','rural','business','commercialLand','holidayRental');
			$filters 	= array('suburb','street','state','postcode','country');
			
			foreach($filters as $filter) {
				if( isset($_GET[$filter]) ){
					$query .= " AND {$filter} = '{$feedsync_db->escape($_GET[$filter])}' ";
				}
			}
		
		
			$statuses 		= array('leased','sold','withdrawn','current','offmarket');
			$status 		= isset($_GET['status']) ? trim($_GET['status']) : '';
		
			if( in_array($type,$types) ) {
				$query .= " AND type = '{$type}' ";
			}
			
			$agent_id 	= isset($_GET['agent_id']) ? $feedsync_db->escape(trim($_GET['agent_id'])): '';
			if( $agent_id != '' ) {
				$query .= " AND agent_id = '{$agent_id}' ";
			}
			
			$date 	= isset($_GET['date']) ? $feedsync_db->escape(trim($_GET['date'])) : '';
			if( $date != '' ) {
				if($date = 'today') {
					$date = date ( 'Y-m-d' );
				}
				$query .= " AND DATE(`mod_date`) = '{$date}' ";
			}
			
			if( in_array($status,$statuses) ) {
				$query .= " AND status = '{$status}' ";
			}  elseif($status == 'all' ) {
				// do nothing
			} else {
				$query .= " AND status NOT IN ('withdrawn','offmarket') ";
			}
		}
		$results = $feedsync_db->get_results($query);
		header("Content-type: text/xml"); 
		ob_start();
		echo '<?xml version="1.0" standalone="no"?>
<!DOCTYPE propertyList SYSTEM "http://reaxml.realestate.com.au/propertyList.dtd">
<propertyList>'."\n";
		
		if ( $results != '' ) {
			foreach($results as $listing) {
				echo $listing->xml."\n";
			}
		}
		echo '</propertyList>';
		$xml =  ob_get_clean();
		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = FALSE;
		$dom->loadXML($xml);
		$dom->formatOutput = TRUE;
		echo $dom->saveXml();
		exit;
	}
	
	/*
	** handle form submission
	*/
	if( isset($_REQUEST['action']) ) {
		$feedsync_hook->do_action('feedsync_form_'.$_REQUEST['action']);
	}
	
	
	function is_installed() {
	
		global $feedsync_db,$feedsync_errors;
		
		if( !defined('DB_USER')  || !defined('DB_PASS')  || !defined('DB_NAME')  || !defined('DB_HOST')  ) {
			
			$feedsync_errors[] = 'database credentials not defined';
			return false;
		
		}
		
		$tables = $feedsync_db->get_results('show tables'); 

		if( $feedsync_db->last_error != ''  ) {
		
			$feedsync_errors[] = 'connection cannot be established, please check database details and try again !';
			return false;
		}
			
		return true;

	}
	
	function print_exit($data) {
		echo "<pre>";
		print_r($data);
		die;
	}

	function install() {
		require_once CORE_PATH."class-installer.php";
		$install =	new Feedsync_Installer();
		echo $install->print_view();
	}
	
	function enqueue_css($css = array() ) {
	
		if( !empty ($css) ) {
			foreach($css as $file) {
				echo '<link rel="stylesheet" href="'.CSS_URL.$file.'" />';
			}
		}
	}	
	
	function enqueue_js($js = array() ) {
	
		if( !empty ($js) ) {
			foreach($js as $file) {
				echo '<script type="text/javascript" src="'.JS_URL.$file.'" ></script>';
			}
		}
	}
	
	function get_error_html($error='') {
		return '
			<div class="alert alert-danger" role="alert">
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <span class="sr-only">Error:</span>
			  '.$error.'
			</div>
		';
	}
	
	function get_success_html($msg='') {
		return '
			<div class="alert alert-success" role="alert">
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <span class="sr-only">Error:</span>
			  '.$msg.'
			</div>
		';
	}
	
	function test_connection() {
		error_reporting(0);
		global $feedsync_db;
		parse_str($_POST['formData'],$_POST);
		$errors = '';
		$required = array(
			'user_name'	=>	'Username is required',
			'user_pass'	=>	'Password is required',
			'db_name'	=>	'Database is required',
			'host_name'	=>	'Hostname is required'
		);
		
		foreach($required as $key	=>	$error) {
			if( !array_key_exists($key,$required) || $_POST[$key] == '' ) {
				$errors .= get_error_html($error);
			}
		}
		
		if($errors != '') {
			 die( json_encode( array( 'status'	=>	'fail', 'message'	=>	$errors) ) );
		}
		
		require_once CORE_PATH."ez_sql_core.php";
		require_once CORE_PATH."ez_sql_mysqli.php";
		
		$feedsync_db = new ezSQL_mysqli($_POST['user_name'],$_POST['user_pass'],$_POST['db_name'],$_POST['host_name']);
		$feedsync_db->show_errors 	= false;
		$tables = $feedsync_db->get_results('show tables');

		if( $feedsync_db->last_error != ''  ) {
			$con_error = 'connection cannot be established, please check database details and try again !';
			die( json_encode( array( 'status'	=>	'fail', 'message'	=>	get_error_html($con_error)) ) );
		} else {
		
			die( json_encode( array( 'status'	=>	'success', 'message'	=>	get_success_html('Connection successful')) ) );
		}
	}
	
	$feedsync_hook->add_action('ajax_test_connection','test_connection');
	
	function create_table() {
		global $feedsync_db;
		$sql = 'CREATE TABLE IF NOT EXISTS `feedsync` (
				  `id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `unique_id` varchar(120) NOT NULL,
				  `agent_id` varchar(128) NOT NULL,
				  `mod_date` varchar(28) NOT NULL,
				  `type` varchar(28) NOT NULL,
				  `status` varchar(28) NOT NULL,
				  `xml` longtext NOT NULL,
				  `firstdate` varchar(28) NOT NULL,
				  `geocode` varchar(50) NOT NULL,
				  `street` varchar(256) NOT NULL,
				  `suburb` varchar(256) NOT NULL,
				  `state` varchar(256) NOT NULL,
				  `postcode` varchar(256) NOT NULL,
				  `country` varchar(256) NOT NULL,
				  `address` varchar(512) NOT NULL,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `unique_id` (`unique_id`)
				) ; ';
				
		$feedsync_db->query($sql);
		
		$sql = '
				CREATE TABLE IF NOT EXISTS `feedsync_users` (
				   `id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `office_id` varchar(128) NOT NULL,
				  `name` varchar(128) NOT NULL,
				  `telephone` varchar(128) NOT NULL,
				  `email` varchar(128) NOT NULL,
				   `xml` text NOT NULL,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `name` (`name`)
				) ;

		';
		$feedsync_db->query($sql);
		
	}
	
	
	function upgrade_tables() {
		global $feedsync_db;
		/** add columns in case of upgrade to this version **/
 		$sql = "
 			ALTER TABLE `feedsync` 
 				ADD `agent_id` varchar(256) NOT NULL,
 				ADD `street` varchar(256) NOT NULL,
 				ADD `suburb` varchar(256) NOT NULL,
 				ADD `state` varchar(256) NOT NULL,
 				ADD `postcode` varchar(256) NOT NULL,
 				ADD `country` varchar(256) NOT NULL;
 		";
 		$feedsync_db->query($sql);

	}
	
	
	function get_header($page_now='') {
		include_once(CORE_PATH.'header.php');
	}
	
	function get_footer() {
		include_once(CORE_PATH.'footer.php');
	}
	
	function home() {
		include_once(CORE_PATH.'home.php');
	}
	
	// Jumbotron Processor Button
	function feedsync_description_jumbotron() { ?>
			<img src="<?php echo CORE_URL.'images/feedsync-icon.png' ?>" width="128" height="128" />
			<h1>FeedSync</h1>
				<p class="lead">If you have XML files below waiting to be processed you can manually process them to test your FeedSync settings. Once you successfully process your xml files manually, you can set a timed schedule on your server via a simple <a href="<?php echo CORE_URL.'pages/help.php' ?>#cron">cron</a> command that will process your xml files regularly.</p>
				<p><a class="btn btn-primary btn-lg" href="core/process.php" role="button">Process Feed</a></p> <?php
	}
	
	function get_input_xml() {
		$xmls = glob( INPUT_PATH.'*.{[xX][mM][lL],[zZ][iI][pP]}', GLOB_BRACE);
		return $xmls;
	}
	
	function get_output_xml() {
		$xmls = glob( OUTPUT_PATH.'*.[xX][mM][lL]' );
		return $xmls;
	}
	
	function get_processed_xml() {
		$xmls = glob( PROCESSED_PATH.'*.[xX][mM][lL]' );
		return $xmls;
	}
	
	function feedsync_format_date( $date ) {
		// supress any timezone related notice/warning;
		error_reporting(0);
		$date_example = '2014-07-22-16:45:56';
		 
		$tempdate = explode('-',$date);
		$date = $tempdate[0].'-'.$tempdate[1].'-'.$tempdate[2].' '.$tempdate[3];
		return  date("Y-m-d H:i:s",strtotime($date));
	}
	
	function get_listings_sub_header($page_now='') {
		include_once(CORE_PATH.'listings-sub-header.php');
	}
	
	function feedsync_list_listing_type( $type = '', $status = '' ) {

		global $feedsync_db;
		$query = "SELECT * FROM feedsync WHERE 1 = 1 AND address != '' ";
		
		$types 		= array('rental','residential','commercial','land','rural','business','commercialLand','holidayRental');
		$statuses 	= array('leased','sold','withdrawn','current','offmarket');
		
		if( in_array($type,$types) ) {
			$query .= " AND type = '{$type}' ";
		}
		
		if( in_array($status,$statuses) ) {
			$query .= " AND status = '{$status}' ";
		}  elseif($status == 'all' ) {
			// do nothing
		} else {
			$query .= " AND status NOT IN ('withdrawn','offmarket') ";
		}
		
		return $feedsync_db->get_results($query);

	}
	
	function feedsync_list_listing_agent( ) {

		global $feedsync_db;
		$query = "SELECT * FROM feedsync_users WHERE 1 = 1 ";
		
		return $feedsync_db->get_results($query);

	}
	
	function display_export_data($results , $page = 'all') {
		ob_start();
		get_header('listings');
		get_listings_sub_header( $page );
			
		if( !empty($results) ) {
		
			// how many records should be displayed on a page?
		    $records_per_page = defined('FEEDSYNC_PAGINATION') ? FEEDSYNC_PAGINATION : 1000;

		    // include the pagination class
		    require 'pagination.php';

		    // instantiate the pagination object
		    $pagination = new Zebra_Pagination();

		    // set position of the next/previous page links
		    $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');

		    // the number of total records is the number of records in the array
		    $pagination->records(count($results));

		    // records per page
		    $pagination->records_per_page($records_per_page);

		    // here's the magick: we need to display *only* the records for the current page
		    $results = array_slice(
		        $results,                                             //  from the original array we extract
		        (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
		        $records_per_page                                       //  this many records
		    );
		    
    		//$table = '<div class="row"> <div class="col-lg-12"> '.$pagination->render(true).' </div> </div>';
			$table = "
			<div class='listings-list-panel panel panel-default'>
				<!--<div class='panel-heading'><span style='text-transform: capitalize;'>$page</span> Listings</div>-->
					 <table data-toggle='table' class='table table-hover'>
						<thead>
							<tr>
								<th class='id'>#</th>
								<th class='address'>Address</th>
								<th class='type'>Type</th>
								<th class='status'>Status</th>
								<th class='first-date'>First Date</th>
								<th class='mod-date'>Mod Date</th>
								<th class='unique-id'>Unique Id</th>
								<th class='geocode'>Coordinates</th>
							</tr>
						</thead>";

			$sno = 1;
			foreach($results as $result) { 
				$table .=' 
				<tr>
					<td class="id">'.$result->id.'</td>
					<td class="address">'.$result->address.'</td>
					<td class="type '.$result->type.'">'.$result->type.'</td>
					<td class="status '.$result->status.'">'.$result->status.'</td>
					<td class="first-date">'.$result->firstdate.'</td>
					<td class="mod-date">'.$result->mod_date.'</td>
					<td class="unique-id">'.$result->unique_id.'</td>
					<td class="geocode">'.$result->geocode.'</td>
				</tr>';
				
				$sno++;
			}
			
			$table .= '</table></div>';
			$table .= '<div class="row"> <div class="col-lg-12"> '.$pagination->render(true).' </div> </div>';
		
			echo $table;
			get_footer();
			return ob_get_clean();

		}
		
	}
	
		function display_agents($results) {
		ob_start();
		get_header('listings');
		get_listings_sub_header( 'agents' );
			
		if( !empty($results) ) {
		
			// how many records should be displayed on a page?
		    $records_per_page = defined('FEEDSYNC_PAGINATION') ? FEEDSYNC_PAGINATION : 1000;

		    // include the pagination class
		    require 'pagination.php';

		    // instantiate the pagination object
		    $pagination = new Zebra_Pagination();

		    // set position of the next/previous page links
		    $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');

		    // the number of total records is the number of records in the array
		    $pagination->records(count($results));

		    // records per page
		    $pagination->records_per_page($records_per_page);

		    // here's the magick: we need to display *only* the records for the current page
		    $results = array_slice(
		        $results,                                             //  from the original array we extract
		        (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
		        $records_per_page                                       //  this many records
		    );
		    
    		//$table = '<div class="row"> <div class="col-lg-12"> '.$pagination->render(true).' </div> </div>';
			$table = "
			<div class='listings-list-panel panel panel-default'>
				<!--<div class='panel-heading'><span style='text-transform: capitalize;'>Agents</span> Listings</div>-->
					 <table data-toggle='table' class='table table-hover'>
						<thead>
							<tr>
								<th class='id'>#</th>
								<th class='agent_id'>Agent ID</th>
								<th class='name'>Name</th>
								<th class='email'>Email</th>
								<th class='telephone'>Telephone</th>
							</tr>
						</thead>";

			$sno = 1;
			foreach($results as $result) { 
				$table .=' 
				<tr>
					<td class="id">'.$result->id.'</td>
					<td class="agent_id">'.$result->office_id.'</td>
					<td class="name '.$result->name.'">'.$result->name.'</td>
					<td class="email '.$result->email.'">'.$result->email.'</td>
					<td class="telephone">'.$result->telephone.'</td>
				</tr>';
				
				$sno++;
			}
			
			$table .= '</table></div>';
			$table .= '<div class="row"> <div class="col-lg-12"> '.$pagination->render(true).' </div> </div>';
		
			echo $table;
			get_footer();
			return ob_get_clean();

		}
		
	}
	function export_data($results) {
	
		if( !empty($results) ) {
		
			header("Content-Type: application/force-download; name=\"export.xml");
			header("Content-type: text/xml"); 
			header("Content-Transfer-Encoding: binary");
			header("Content-Disposition: attachment; filename=\"export.xml");
			header("Expires: 0");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma: no-cache");
			ob_start();
			echo '<?xml version="1.0" standalone="no"?>
<!DOCTYPE propertyList SYSTEM "http://reaxml.realestate.com.au/propertyList.dtd">
<propertyList>'."\n";

				foreach($results as $listing) {
					echo $listing->xml."\n";
				}
			echo '</propertyList>';
			$xml =  ob_get_clean();
			$dom = new DOMDocument;
			$dom->preserveWhiteSpace = FALSE;
			$dom->loadXML($xml);
			$dom->formatOutput = TRUE;
			echo $dom->saveXml();
			exit;

		}
	}
	
	function human_filesize($bytes, $decimals = 2) {
	  $sz = 'BKMGTP';
	  $factor = floor((strlen($bytes) - 1) / 3);
	  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}
	
	function sanitize_user_name( $title) {
		$title = strip_tags($title);
		// Preserve escaped octets.
		$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
		// Remove percent signs that are not part of an octet.
		$title = str_replace('%', '', $title);
		// Restore octets.
		$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

		$title = strtolower($title);
		$title = preg_replace('/&.+?;/', '', $title); // kill entities
		$title = str_replace('.', '-', $title);

		// Convert nbsp, ndash and mdash to hyphens
		$title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );

		// Strip these characters entirely
		$title = str_replace( array(
			// iexcl and iquest
			'%c2%a1', '%c2%bf',
			// angle quotes
			'%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
			// curly quotes
			'%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
			'%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
			// copy, reg, deg, hellip and trade
			'%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
			// acute accents
			'%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
			// grave accent, macron, caron
			'%cc%80', '%cc%84', '%cc%8c',
		), '', $title );

		// Convert times to x
		$title = str_replace( '%c3%97', 'x', $title );

		$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
		$title = preg_replace('/\s+/', '-', $title);
		$title = preg_replace('|-+|', '-', $title);
		$title = trim($title, '-');

		return $title;
	}
	
	function import_listings($cron_mode = false) {
		global $feedsync_db , $partial_update_providers;
		//print_exit($feedsync_db);
		// Xml loader
		$x_ex = array_filter(glob(INPUT_PATH.'/*.[xX][mM][lL]'),'is_file');
		
		if( !empty($x_ex) ) {
			$total_files = count($x_ex);

			foreach($x_ex as $path) {
		
				/** configuration **/
				$xmlFile = new DOMDocument('1.0');
				
				$xmlFile->formatOutput = true;
				$xmlFile->preserveWhiteSpace = false;
				$xmlFile->recover = TRUE;
				$xmlFile->load($path);
				$xpath = new DOMXPath($xmlFile);
				/** configuration - end **/

					/** processing listing agent **/
					$listing_agents = $xmlFile->getElementsByTagName("listingAgent");
					
					if(!empty($listing_agents)) {
						foreach($listing_agents as $listing_agent) {
							
							/** init values **/
							$data_agent = array();
							$data_agent['agent_id'] = '';
							$data_agent['office_id']= '';;
							$data_agent['name']= '';
							$data_agent['telephone']= '';
							$data_agent['email']= '';
					
							$data_agent['agent_id'] = $listing_agent->getAttribute('id');
							$data_agent['agent_id'] = $data_agent['agent_id'] == '' ? 1 : $data_agent['agent_id'];
							$listing_agent->setAttribute('id',$data_agent['agent_id']);
							
							if($listing_agent->parentNode->getElementsByTagName('agentID')->length != 0) {
								$data_agent['office_id'] = $listing_agent->parentNode->getElementsByTagName('agentID')->item(0)->nodeValue;
								if($listing_agent->getElementsByTagName('office_id')->length == 0) {
									$create_office_id 		= $xmlFile->createElement('office_id', $data_agent['office_id']);
									$listing_agent->appendChild($create_office_id);
								}
						
							}
							
							if($listing_agent->getElementsByTagName('name')->length != 0) {
								$data_agent['name'] = $listing_agent->getElementsByTagName('name')->item(0)->nodeValue;
								$agent_full_name    = explode(' ',$data_agent['name']);
								
								if($listing_agent->getElementsByTagName('agentFirstName')->length == 0) {
									$agent_first		= $agent_full_name[0];
									$create_fname 		= $xmlFile->createElement('agentFirstName',  htmlentities($agent_first) );
									$listing_agent->appendChild($create_fname);
								}
								if($listing_agent->getElementsByTagName('agentLastName')->length == 0) {
									$agent_last			= isset($agent_full_name[1]) ? $agent_full_name[1] : '';
									$create_lname 		= $xmlFile->createElement('agentLastName', htmlentities($agent_last) );
									$listing_agent->appendChild($create_lname);
								}
								if($listing_agent->getElementsByTagName('agentUserName')->length == 0) {
									$create_uname		= $xmlFile->createElement('agentUserName',sanitize_user_name($data_agent['name']));
									$listing_agent->appendChild($create_uname);
								}
								
						 	}
						 	
						 	if($listing_agent->getElementsByTagName('email')->length != 0) {
								$data_agent['email'] = $listing_agent->getElementsByTagName('email')->item(0)->nodeValue;
						 	}
						 	
						 	if($listing_agent->getElementsByTagName('telephone')->length != 0) {
						 		foreach($listing_agent->getElementsByTagName('telephone') as $agent_tel) {
									$data_agent['telephone'][] =  $agent_tel->nodeValue;
								}
								$data_agent['telephone'] = implode(',',$data_agent['telephone']);
						 	}
						 	
						 	$data_agent['xml']	= $xmlFile->saveXML( $listing_agent);
						 	$data_agent			=	array_map(array($feedsync_db,'escape'), $data_agent);
						 	
						 	
							/** check if listing agent exists already **/
							$agent_exists = $feedsync_db->get_row("SELECT * FROM feedsync_users where name = '{$data_agent['name']}' ");
							
							if( empty($agent_exists) ) {
								/** insert new data **/
								$query = "INSERT INTO 
										feedsync_users (office_id,name,telephone,email,xml) 
										VALUES (
											'{$data_agent['office_id']}',
											'{$data_agent['name']}',
											'{$data_agent['telephone']}',
											'{$data_agent['email']}',
											'{$data_agent['xml']}'
										)";
									
								//print_exit($query);
								$feedsync_db->query($query);
								//print_exit($feedsync_db);
							}
						 	
						}
					}
					
					/** Processing listing agent - end **/

					/** geocoding - start **/
					$addresses = $xmlFile->getElementsByTagName("address");
					foreach($addresses as $address) {
				
						/** add feedsyncGeocode node if not already there **/
						if($address->parentNode->getElementsByTagName('feedsyncGeocode')->length == 0) {
						
							if($address->parentNode->getElementsByTagName('Geocode')->length != 0) {
							
								$geocodenode 		= $address->parentNode->getElementsByTagName('Geocode');
								
								if($geocodenode->item(0)->getElementsByTagName('Latitude')->length == 0) {
									$coord 				= $geocodenode->item(0)->nodeValue;
							 	} else {
									$lat 				= $geocodenode->item(0)->getElementsByTagName('Latitude')->item(0)->nodeValue;	
									$long 				= $geocodenode->item(0)->getElementsByTagName('Longitude')->item(0)->nodeValue;
									$coord 				= $lat.','.$long;
							 	}
							 	
								$element 			= $xmlFile->createElement('feedsyncGeocode', $coord);
								$address->parentNode->appendChild($element);
								$xmlFile->save($path);
								
							} else {
								
								if ( GEO_ENABLED == 'ON' || GEO_ENABLED == 'on' ) {
								
									$streetNumber 	= $address->getElementsByTagName('streetNumber')->item(0)->nodeValue;
									$street 		= $address->getElementsByTagName('street')->item(0)->nodeValue;
									$suburb 		= $address->getElementsByTagName('suburb')->item(0)->nodeValue;
									$state 			= $address->getElementsByTagName('state')->item(0)->nodeValue;
									$postCode 		= $address->getElementsByTagName('postcode')->item(0)->nodeValue;
									$addr 			= $streetNumber. ",".$street.",".$suburb.",".$state.",".$postCode;
									$addr_readable 	= $addr;
									$addr 			= str_replace(" ", "+", $addr);
									$coord			= '';
									$addr = explode(',',$addr);

									/** try to get lat & long from google **/
									while(array_shift($addr) != NULL) {

										$query_address  = implode(',',$addr);
										$geocode 		= file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$query_address&sensor=false");
										$output 		= json_decode($geocode);
									
										/** if address is validated & google returned response **/
										if( !empty($output->results) && $output->status == 'OK' ) {
					
											$lat 			= $output->results[0]->geometry->location->lat;
											$long 			= $output->results[0]->geometry->location->lng;
											$coord 			= $lat.','.$long;
											$element 		= $xmlFile->createElement('feedsyncGeocode', $coord);
											$address->parentNode->appendChild($element);
											$xmlFile->save($path);
											break;
										}
									}
								
								}
							}
						}
					}
					/** geocoding - end **/
					
					/** process images - start **/
					
					$imgs 			= $xpath->query('//img[@file]');
					
					if(!empty($imgs)) {
						foreach ($imgs as $k=>$img) {
							$img_name = trim($img->getAttribute('file'));
							if(!empty($img_name)) {
								$img_name = basename($img_name);
								$img_path = OUTPUT_URL.'images/'.$img_name;
								$imgs->item($k)->setAttribute('url', $img_path);
					
							}
							
						}
					}
					/** process images - end **/
		
				/** fetch property list **/
				$items = $xmlFile->documentElement;
				if( !empty($items) ) {
					foreach($items->childNodes as $item) { 
			
						if( isset($item->tagName) && !is_null($item->tagName) ) {
					
							$db_data['type'] 			= $item->tagName;
							$db_data['unique_id'] 		= $item->getElementsByTagName('uniqueID')->item(0)->nodeValue;
							$db_data['agent_id'] 		= $item->getElementsByTagName('agentID')->item(0)->nodeValue;
							$mod_date 					= $item->getAttribute('modTime');
							$db_data['mod_date'] 		= feedsync_format_date( $mod_date );
							$db_data['status'] 			= $item->getAttribute('status');
							$db_data['xml']				= $xmlFile->saveXML( $item);
							$db_data['xml'] 			= $db_data['xml'];
							
							if($item->getElementsByTagName("address")->length != 0) {
							
								$address			= $item->getElementsByTagName("address");
								$streetNumber 		= $address->item(0)->getElementsByTagName('streetNumber')->item(0)->nodeValue;
								$street 			= $address->item(0)->getElementsByTagName('street')->item(0)->nodeValue;
								$suburb 			= $address->item(0)->getElementsByTagName('suburb')->item(0)->nodeValue;
								$state 				= $address->item(0)->getElementsByTagName('state')->item(0)->nodeValue;
								$postCode 			= $address->item(0)->getElementsByTagName('postcode')->item(0)->nodeValue;
								$country 			= $address->item(0)->getElementsByTagName('country')->item(0)->nodeValue;
								
								$db_data['street'] 		= $street;
								$db_data['suburb'] 		= $suburb;
								$db_data['state'] 		= $state;
								$db_data['postcode'] 	= $postCode;
								$db_data['country'] 	= $country;
								$db_data['address'] 	= $streetNumber. ",".$street.",".$suburb.",".$state.",".$postCode;

							
							} else {
								$db_data['street'] = '';
								$db_data['suburb'] = '';
								$db_data['state'] = '';
								$db_data['postcode'] = '';
								$db_data['country'] = '';
								$db_data['address'] = '';
							}
							
							if($item->getElementsByTagName('feedsyncGeocode')->length != 0)
								$db_data['geocode'] 		= $item->getElementsByTagName('feedsyncGeocode')->item(0)->nodeValue;
							else {
								/** if already geocoded set this to NULL to avoid further processing **/
								if ( GEO_ENABLED == 'ON' || GEO_ENABLED == 'on' ) {
									$db_data['geocode'] 		= 'NULL';
								} else {
									$db_data['geocode'] 		= '';
								}
								
							}
							
					
							/** check if listing exists already **/
							$exists = $feedsync_db->get_row("SELECT * FROM feedsync where unique_id = '{$db_data['unique_id']}' ");
							
							if( !empty($exists) ) {
								
								/** update if we have updated data **/
								if(  strtotime($exists->mod_date) < strtotime($db_data['mod_date']) ) {

									/** add firstDate node to xml if its already not there **/
									
									if ($item->getElementsByTagName("firstDate")->length == 0) {
									
										$firstDateValue 			= $xmlFile->createElement('firstDate', $exists->firstdate);
										$item->appendChild($firstDateValue);
										$db_data['xml']				= $xmlFile->saveXML( $item);
									}
									
									/** dont update whole xml if address is missing **/
									if ($item->getElementsByTagName("address")->length == 0) {
									
										$existing_xml = new DOMDocument;
										$existing_xml->preserveWhiteSpace = FALSE;
										$existing_xml->loadXML($exists->xml);
										$existing_xml->formatOutput = TRUE;
										$existing_listing = $existing_xml->getElementsByTagName($item->tagName);
										$existing_listing->item(0)->setAttribute('modTime', $db_data['mod_date']);
										$existing_listing->item(0)->setAttribute('status', $db_data['status']);
										$db_data['xml'] = $existing_xml->saveXML($existing_listing->item(0));
										
										if($existing_listing->item(0)->getElementsByTagName("address")->length != 0) {
							
											$address			= $existing_listing->item(0)->getElementsByTagName("address");
											$streetNumber 		= $address->item(0)->getElementsByTagName('streetNumber')->item(0)->nodeValue;
											$street 			= $address->item(0)->getElementsByTagName('street')->item(0)->nodeValue;
											$suburb 			= $address->item(0)->getElementsByTagName('suburb')->item(0)->nodeValue;
											$state 				= $address->item(0)->getElementsByTagName('state')->item(0)->nodeValue;
											$postCode 			= $address->item(0)->getElementsByTagName('postcode')->item(0)->nodeValue;
											$country 			= $address->item(0)->getElementsByTagName('country')->item(0)->nodeValue;
											$db_data['address'] = $streetNumber. ",".$street.",".$suburb.",".$state.",".$postCode;

							
										} else {
											$db_data['address'] = '';
										}
							
										if($existing_listing->item(0)->getElementsByTagName('feedsyncGeocode')->length != 0)
											$db_data['geocode'] 		= $existing_listing->item(0)->getElementsByTagName('feedsyncGeocode')->item(0)->nodeValue;
										else
											$db_data['geocode'] 		= '';
											
									}

									$db_data	=	array_map(array($feedsync_db,'escape'), $db_data);
									
									$query = "UPDATE feedsync SET 
												type 			= '{$db_data['type']}',
												mod_date 		= '{$db_data['mod_date']}',
												status 			= '{$db_data['status']}',
												xml 			= '{$db_data['xml']}',
												geocode 		= '{$db_data['geocode']}',
												address 		= '{$db_data['address']}',
												street 			= '{$db_data['street']}',
												suburb 			= '{$db_data['suburb']}',
												postcode 		= '{$db_data['postcode']}',
												country 		= '{$db_data['country']}'
												WHERE unique_id = '{$db_data['unique_id']}'
											";
									
									$feedsync_db->query($query);
									//print_exit($feedsync_db);
									
								}
						
							} else {
								
								/** insert firstDate node **/
								$firstDate 		= $xmlFile->createElement('firstDate', $db_data['mod_date']);
								$item->appendChild($firstDate);
								$db_data['xml']	= $xmlFile->saveXML( $item);
								$db_data		=	array_map(array($feedsync_db,'escape'), $db_data);
								
								/** insert new data **/
								$query = "INSERT INTO 
										feedsync (type, agent_id,unique_id, mod_date, status,xml,firstdate,street,suburb,state,postcode,country,geocode,address) 
										VALUES (
											'{$db_data['type']}',
											'{$db_data['agent_id']}',
											'{$db_data['unique_id']}',
											'{$db_data['mod_date']}',
											'{$db_data['status']}',
											'{$db_data['xml']}',
											'{$db_data['mod_date']}',
											'{$db_data['street']}',
											'{$db_data['suburb']}',
											'{$db_data['state']}',
											'{$db_data['postcode']}',
											'{$db_data['country']}',
											'{$db_data['geocode']}',
											'{$db_data['address']}'
										)";
										
								//print_exit($query);
								$feedsync_db->query($query);
								//print_exit($feedsync_db);
							}
					
					
					
						}
					}
				}
				try {
					if( rename($path,PROCESSED_PATH.basename($path) ) ) {
						if(!$cron_mode) { 
							die( 
								json_encode(
									array(
										'status'	=>	'success',
										'message'	=>	basename($path).'  processed .'.$total_files.' files left <br> <strong>Currently processing your files, do not navigate away from this page </strong>',
										'buffer'	=>	'processing'
									)
								) 
							);
						}
					}
				} catch(Exception $e) {
					if(!$cron_mode) {
						echo $e->getMessage(); die;
					}
				}
				
			}
		} else {
			if(!$cron_mode) {
				die( json_encode(array('status'	=>	'success', 'message'	=>	'all files have been processed', 'buffer'	=>	'complete')) );
			}
		}
	}
	
	$feedsync_hook->add_action('ajax_import_listings','import_listings');
	
	// Navigation Settings
	function feedsync_settings_navigation( $page ) { 
	?>
		<div id="feedsync-settings-navigation">
			<ul class="nav nav-pills">
		
				<li<?php if ( $page == "Updates") 
					echo " class=\"active\""; ?>>
				<a href="<?php echo CORE_URL;?>pages/updates.php">Updates</a>
			
				<li<?php if ( $page == "License") 
						echo " class=\"active\""; ?>>
				<a href="<?php echo CORE_URL;?>pages/license.php">Status</a>
			
				<li<?php if ( $page == "Activate") 
					echo " class=\"active\""; ?>>
				<a href="<?php echo CORE_URL;?>/pages/activate.php">Activate</a>
			
			</ul>
		</div>
	<?php
	}
	
	function feedsync_license_validator( $edd_request = 'get_version ') {
		global $current_version;

		$license = file_get_contents("https://easypropertylistings.com.au/?edd_action=$edd_request&item_name=FeedSync&license=".REC_LICENSE."&url=".REC_LICENSED_URL);
		$output = json_decode($license);
		$result = (array) json_decode($license);
	
		// Activate License  'activate_license'
		if ( $edd_request == 'activate_license' ) {
	
			if ( $result['license'] == 'valid' ) { ?>
			
				<div class="alert alert-success">
					<strong>Excellent your license is activated for this domain!</strong> You have activated <?php echo $result['site_count'] ?> site and have <?php echo $result['activations_left'] ?> activations left for a total of <?php echo $result['license_limit'] ?> licenses.
					Your License is valid till <?php echo date('F j, Y, g:i a',strtotime($result['expires'])) ?>
				</div>
			
			<?php
			}
			else { ?>
			<div class="alert alert-danger">
				</strong>License Invalid or Missing</strong> Try checking your settings and try again.
			</div>
			<?php
			}
		} // END Activate
	
		// Check License  'activate_license'
		elseif ( $edd_request == 'check_license' ) {

	
	
			if ( $result['license'] == 'valid' ) { ?>
			
				<div class="alert alert-success">
					<strong>Excellent your license is activated for this website!</strong> You have activated <?php echo $result['site_count'] ?> site and have <?php echo $result['activations_left'] ?> activations left for a total of <?php echo $result['license_limit'] ?> licenses.
					Your License is valid till <?php echo date('F j, Y, g:i a',strtotime($result['expires'])) ?>
				</div>
			
			<?php
			}
			else{ ?>
			<div class="alert alert-danger">
				</strong>License Invalid or Missing</strong> Try checking your settings and try again.
			</div>
			<?php
			}
		} // END Check
	
		// Check Updates
		else {
			if ( $result['license_check'] == 'invalid' ){ 		
				echo feedsync_license( $result['license_check'] );
			} 
			elseif ( $result['new_version'] > $current_version && $result['license_check'] != 'invalid' ) {	?>
				<div class="alert alert-info">
					<strong>New Version Available!</strong> <?php echo $result['name'] , ' v', $result['new_version'] ?>, <a href="https://easypropertylistings.com.au/your-account/">Download it here</a>
				</div>
			
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Changelog</h3>
				  </div>
				  <div class="panel-body">
					<?php 
						
						
						$data = unserialize($result['sections']);
						

						echo $data['changelog'];

						?>
				  </div>
				</div> 
			
			
			<?php
			} 
			elseif ( $current_version >= $result['new_version'] ) { ?>
				<div class="alert alert-success">
					<strong>You're Up To Date!</strong> You are running the latest version of FeedSync. 
				</div>
			<?php
			}
			else {

		
			} // END Check Updates
		}
	}
	
	// Site Without Valid License
	function feedsync_license( $check ) {
	
		if ( $check == 'invalid' ) { ?>
			<div class="alert alert-warning">
				<p><strong>Bummer your application is not licensed or the key is invalid.</strong> Please enter a valid license key into the settings file. With a valid license you can download updates quickly and easily.</p>
			</div>
		<?php
		} 
		elseif ( $check == 'invalid' ) { ?>
			<div class="alert alert-warning">
				<p><strong>Bummer your application is not licensed or the key is invalid.</strong> Please enter a valid license key into the settings file. With a valid license you can download updates quickly and easily.</p>
			</div>
		<?php
		}
	
	}
	
	function process_missing_coordinates() {
		global $feedsync_db;
		$alllistings = $feedsync_db->get_results("select * from feedsync where geocode = '' AND address != '' LIMIT 1");
		
		if( !empty( $alllistings ) ) {
			foreach($alllistings as $listing) {
				//print_exit($listing);
				$xmlFile = new DOMDocument;
				$xmlFile->preserveWhiteSpace = FALSE;
				$xmlFile->loadXML($listing->xml);
				$xmlFile->formatOutput = TRUE;
				$newxml = $listing->xml;
				$coord	= '';
				/** geocoding - start **/
				if($xmlFile->getElementsByTagName("address")->length != 0) {
					$addresses = $xmlFile->getElementsByTagName("address");
					foreach($addresses as $address) {
			
						$streetNumber 	= $address->getElementsByTagName('streetNumber')->item(0)->nodeValue;
						$street 		= $address->getElementsByTagName('street')->item(0)->nodeValue;
						$suburb 		= $address->getElementsByTagName('suburb')->item(0)->nodeValue;
						$state 			= $address->getElementsByTagName('state')->item(0)->nodeValue;
						$postCode 		= $address->getElementsByTagName('postcode')->item(0)->nodeValue;

						$addr = $streetNumber. ",".$street.",".$suburb.",".$state.",".$postCode;
						$addr_readable = $addr;


						/** add feedsyncGeocode node if not already there **/
						if($address->parentNode->getElementsByTagName('feedsyncGeocode')->length == 0) {
					
							/** if listing already have geocode tag, then grap lat long from it & add it in feedsyncGeocode **/
							if($address->parentNode->getElementsByTagName('Geocode')->length != 0) {
						
								$geocodenode 		= $address->parentNode->getElementsByTagName('Geocode');
							
								if($geocodenode->item(0)->getElementsByTagName('Latitude')->length == 0) {
									$coord 				= $geocodenode->item(0)->nodeValue;
							 	} else {
									$lat 				= $geocodenode->item(0)->getElementsByTagName('Latitude')->item(0)->nodeValue;	
									$long 				= $geocodenode->item(0)->getElementsByTagName('Longitude')->item(0)->nodeValue;
									$coord 				= $lat.','.$long;
							 	}
							
								$element 			= $xmlFile->createElement('feedsyncGeocode', $coord);
								$address->parentNode->appendChild($element);
								$newxml = $xmlFile->saveXML($xmlFile->documentElement);
							
							} else {
							
								/** try to get lat & long from google **/
								$addr = str_replace(" ", "+", $addr);
								$addr = explode(',',$addr);
								$coord			= '';
								
								while(array_shift($addr) != NULL) {

									$query_address  = implode(',',$addr);
									$geocode 		= file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$query_address&sensor=false");
									$output 		= json_decode($geocode);
									
									/** if address is validated & google returned response **/
									if( !empty($output->results) && $output->status == 'OK' ) {
					
										$lat 			= $output->results[0]->geometry->location->lat;
										$long 			= $output->results[0]->geometry->location->lng;
										$coord 			= $lat.','.$long;
										break;
									}
								}
								
								$element 		= $xmlFile->createElement('feedsyncGeocode', $coord);
								$address->parentNode->appendChild($element);
								$newxml = $xmlFile->saveXML($xmlFile->documentElement);

							}
						}  else {
							$coord 				= $address->parentNode->getElementsByTagName('feedsyncGeocode')->item(0)->nodeValue;
						}
					}
					
					if($coord == '') {
						$coord 			= 'NULL';
					}
					
					/** geocoding - end **/
					$db_data   = array(
						'xml'		=>	$newxml,
						'geocode'	=>  $coord
					);
				
					$db_data	=	array_map(array($feedsync_db,'escape'), $db_data);
					$query = "UPDATE feedsync SET 
								xml 			= '{$db_data['xml']}',
								geocode 		= '{$db_data['geocode']}'
								WHERE id 		= '{$listing->id}'
							";
					$feedsync_db->query($query);
					die( 
						json_encode(
							array(
								'status'	=>	'success',
								'message'	=>	'<strong>Geocode Status</strong> <br>
													Address : <em>'.$addr_readable.'</em> <br>
													Geocode : <em>'.$coord.'</em> <br>',
								'buffer'	=>	'processing'
							)
						) 
					);

				} else {
			
					die( 
						json_encode(
							array(
								'status'	=>	'success',
								'message'	=>	'No Address node found : skipping',
								'buffer'	=>	'processing'
							)
						) 
					);
				}
			} 
		} else {
		
			die( 
				json_encode(
					array(
						'status'	=>	'success',
						'message'	=>	'Geocode Processing Completed!',
						'buffer'	=>	'complete'
					)
				) 
			);
		}
		
	}
	
	$feedsync_hook->add_action('ajax_process_missing_coordinates','process_missing_coordinates');
	
	function check_folders_existance() {
		
		$paths = array(INPUT_PATH,OUTPUT_PATH,IMAGES_PATH,PROCESSED_PATH,ZIP_PATH,TEMP_PATH,LOG_PATH);

		foreach($paths as $path) {
			
			if (!file_exists($path) ) {
				@mkdir($path, 0755, true);
				
			} else {
				@chmod($path, 0755);
				
			}
		}
	}
	
	$feedsync_hook->add_action('init','check_folders_existance');
	
	function process_missing_listing_agents() {
		global $feedsync_db;
		$alllistings = $feedsync_db->get_results("select * from feedsync");
	
		if( !empty( $alllistings ) ) {

			foreach($alllistings as $listing) {

				$xmlFile = new DOMDocument;
				$xmlFile->preserveWhiteSpace = FALSE;
				$xmlFile->loadXML($listing->xml);
				$xmlFile->formatOutput = TRUE;
				$newxml = $listing->xml;

				/** missing listing agent processing - start **/
				if($xmlFile->getElementsByTagName("listingAgent")->length != 0) {
				
					foreach($xmlFile->getElementsByTagName("listingAgent") as $listing_agent) {
						
						/** init values **/
						$data_agent = array();
						$data_agent['agent_id'] = '';
						$data_agent['office_id']= '';;
						$data_agent['name']= '';
						$data_agent['telephone']= '';
						$data_agent['email']= '';
					
						$data_agent['agent_id'] = $listing_agent->getAttribute('id');
						$data_agent['agent_id'] = $data_agent['agent_id'] == '' ? 1 : $data_agent['agent_id'];
						$listing_agent->setAttribute('id',$data_agent['agent_id']);
					
						if($listing_agent->parentNode->getElementsByTagName('agentID')->length != 0) {
							$data_agent['office_id'] = $listing_agent->parentNode->getElementsByTagName('agentID')->item(0)->nodeValue;
							if($listing_agent->getElementsByTagName('office_id')->length == 0) {
								$create_office_id 		= $xmlFile->createElement('office_id', $data_agent['office_id']);
								$listing_agent->appendChild($create_office_id);
							}
							
						}
					
						if($listing_agent->getElementsByTagName('name')->length != 0) {
							$data_agent['name'] = $listing_agent->getElementsByTagName('name')->item(0)->nodeValue;
							$agent_full_name    = explode(' ',$data_agent['name']);
							
							if($listing_agent->getElementsByTagName('agentFirstName')->length == 0) {
								$agent_first		= $agent_full_name[0];
								$create_fname 		= $xmlFile->createElement('agentFirstName',  htmlentities($agent_first) );
								$listing_agent->appendChild($create_fname);
							}
							if($listing_agent->getElementsByTagName('agentLastName')->length == 0) {
								$agent_last			= isset($agent_full_name[1]) ? $agent_full_name[1] : '';
								$create_lname 		= $xmlFile->createElement('agentLastName', htmlentities($agent_last) );
								$listing_agent->appendChild($create_lname);
							}
							if($listing_agent->getElementsByTagName('agentUserName')->length == 0) {
								$create_uname		= $xmlFile->createElement('agentUserName',sanitize_user_name($data_agent['name']));
								$listing_agent->appendChild($create_uname);
							}
							
					 	}
					 	
					 	if($listing_agent->getElementsByTagName('email')->length != 0) {
							$data_agent['email'] = $listing_agent->getElementsByTagName('email')->item(0)->nodeValue;
					 	}
					 	
					 	if($listing_agent->getElementsByTagName('telephone')->length != 0) {
					 		foreach($listing_agent->getElementsByTagName('telephone') as $agent_tel) {
								$data_agent['telephone'][] =  $agent_tel->nodeValue;
							}
							$data_agent['telephone'] = implode(',',$data_agent['telephone']);
					 	}
					 	
					 	$data_agent['xml']	= $xmlFile->saveXML( $listing_agent);
					 	$data_agent			=	array_map(array($feedsync_db,'escape'), $data_agent);
					 	
						/** check if listing agent exists already **/
						$agent_exists = $feedsync_db->get_row("SELECT * FROM feedsync_users where name = '{$data_agent['name']}' ");
			
						if( empty($agent_exists) ) {
							
							$query = "INSERT INTO 
									feedsync_users (office_id,name,telephone,email,xml) 
									VALUES (
										'{$data_agent['office_id']}',
										'{$data_agent['name']}',
										'{$data_agent['telephone']}',
										'{$data_agent['email']}',
										'{$data_agent['xml']}'
									)";
							
							$feedsync_db->query($query);
						}

					}
				}
			}
		}
		die( 
			json_encode(
				array(
					'status'	=>	'success',
					'message'	=>	'Listing Agents Update Completed!',
					'buffer'	=>	'processed'
				)
			) 
		);
	}

	$feedsync_hook->add_action('ajax_process_missing_listing_agents','process_missing_listing_agents');

	/** for version 2.1 to fil data in new cols street, suburb, state, country, postcode **/
	function upgrade_table_data() {
		global $feedsync_db;
		$alllistings = $feedsync_db->get_results("
			select * from feedsync 
			WHERE 1 = 1
			AND agent_id = ''
			AND street = '' 
			AND suburb = '' 
			AND state = '' 
			AND postcode = '' 
			AND country = ''
			AND address != ''
			LIMIT 1"
		);
		
		if( !empty( $alllistings ) ) {
			foreach($alllistings as $listing) {
				//print_exit($listing);
				$xmlFile = new DOMDocument;
				$xmlFile->preserveWhiteSpace = FALSE;
				$xmlFile->loadXML($listing->xml);
				$xmlFile->formatOutput = TRUE;
				$newxml = $listing->xml;
				$coord	= '';
				/** geocoding - start **/
				if($xmlFile->getElementsByTagName("address")->length != 0) {
					$addresses = $xmlFile->getElementsByTagName("address");
					foreach($addresses as $address) {
			
						$db_data['agent_id'] 		= $address->parentNode->getElementsByTagName('agentID')->item(0)->nodeValue;
						$db_data['street'] 			= $address->getElementsByTagName('street')->item(0)->nodeValue;
						$db_data['suburb'] 			= $address->getElementsByTagName('suburb')->item(0)->nodeValue;
						$db_data['state']  			= $address->getElementsByTagName('state')->item(0)->nodeValue;
						$db_data['postcode'] 		= $address->getElementsByTagName('postcode')->item(0)->nodeValue;
						$db_data['country'] 		= $address->getElementsByTagName('country')->item(0)->nodeValue;
						
						$streetNumber 	= $address->getElementsByTagName('streetNumber')->item(0)->nodeValue;
						$addr_readable = 
							$streetNumber. ",".$db_data['street'] .",".$db_data['suburb'] .",".$db_data['state'] .",".$db_data['postcode'] ;
					}
					
					$db_data	=	array_map(array($feedsync_db,'escape'), $db_data);
					$query = "UPDATE feedsync SET 
								agent_id 			= '{$db_data['agent_id']}',
								street 			= '{$db_data['street']}',
								suburb 			= '{$db_data['suburb']}',
								state 			= '{$db_data['state']}',
								postcode 		= '{$db_data['postcode']}',
								country 		= '{$db_data['country']}'
								WHERE id 		= '{$listing->id}'
							";
					$feedsync_db->query($query);
					die( 
						json_encode(
							array(
								'status'	=>	'success',
								'message'	=>	'<strong>Upgrading FeedSync Database</strong><br>This may take a while depending on how many listings are in your database and the speed of your server.<br>
													Address : <em>'.$addr_readable.'</em> Updated !<br>',
								'buffer'	=>	'processing'
							)
						) 
					);

				} else {
			
					die( 
						json_encode(
							array(
								'status'	=>	'success',
								'message'	=>	'No Address node found : skipping',
								'buffer'	=>	'processing'
							)
						) 
					);
				}
			} 
		} else {
		
			die( 
				json_encode(
					array(
						'status'	=>	'success',
						'message'	=>	'Upgrade Process Complete!',
						'buffer'	=>	'complete'
					)
				) 
			);
		}
		
	}
	
	$feedsync_hook->add_action('ajax_upgrade_table_data','upgrade_table_data');


function all_agents_name() {
	global $feedsync_db , $partial_update_providers;
			$alllistings = $feedsync_db->get_results("select * from feedsync");

	if( !empty( $alllistings ) ) {
		$data_agent = array();
		foreach($alllistings as $listing) {

			$xmlFile = new DOMDocument;
			$xmlFile->preserveWhiteSpace = FALSE;
			$xmlFile->loadXML($listing->xml);
			$xmlFile->formatOutput = TRUE;
			$newxml = $listing->xml;

			/** missing listing agent processing - start **/
			if($xmlFile->getElementsByTagName("listingAgent")->length != 0) {
			
				foreach($xmlFile->getElementsByTagName("listingAgent") as $listing_agent) {

					if($listing_agent->getElementsByTagName('name')->length != 0) {
						$data_agent[] = $listing_agent->getElementsByTagName('name')->item(0)->nodeValue;
						
				 	}
			 	}
		 	}
	 	}
 	}
	print_exit( array_unique($data_agent) );		 	
}
// $feedsync_hook->add_action('init','all_agents_name',5);