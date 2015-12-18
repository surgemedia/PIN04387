<?php
require_once('../config.php');
require_once('functions.php');
global $feedsync_db;

$type = '';
$status = '';

$results = feedsync_list_listing_type( $type , $status );
$page = 'all';

echo display_export_data($results , $page);

