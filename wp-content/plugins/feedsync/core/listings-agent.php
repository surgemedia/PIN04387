<?php
require_once('../config.php');
require_once('functions.php');
global $feedsync_db;

$type = '';
$status = '';

$results = feedsync_list_listing_agent();
echo display_agents($results);

