<?php
	
	define( 'DOING_AJAX', true );

	require_once('../config.php');
	require_once('functions.php');
	
	if( isset($_REQUEST['action']) )
		$feedsync_hook->do_action('ajax_' . $_REQUEST['action']);
