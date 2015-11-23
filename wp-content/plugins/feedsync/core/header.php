<!DOCTYPE html>
<html lang="en">
  <head>
	<title>FeedSync by Real Estate Connected</title>
	<?php 
		enqueue_css( array('bootstrap.min.css','jumbotron-narrow.css') );
		enqueue_css( array('feedsync.css','prettyPhoto.css') );
		enqueue_js( array('jquery.min.js','jquery.prettyPhoto.js','main.js') );
	?>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo SITE_URL ?>/core/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo SITE_URL ?>/core/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo SITE_URL ?>/core/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITE_URL ?>/core/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo SITE_URL ?>/core/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo SITE_URL ?>/core/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo SITE_URL ?>/core/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo SITE_URL ?>/core/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITE_URL ?>/core/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo SITE_URL ?>/core/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_URL ?>/core/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo SITE_URL ?>/core/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL ?>/core/images/favicon-16x16.png">
	<link rel="manifest" href="<?php echo SITE_URL ?>/core/images/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo SITE_URL ?>/core/images/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
  </head>

  <body>

   <div class="container">
   <div class="header">
		<div id="feedsync-navigation">
			<ul class="nav nav-pills pull-right">
				<li class="<?php echo $page_now == 'home' ? 'active':''; ?>">
					<a href="<?php echo SITE_URL ?>">Home</a>
				</li>
				<li class="<?php echo $page_now == 'process' ? 'active':''; ?>">
					<a href="<?php echo CORE_URL.'process.php' ?>">Process</a>
				</li>
				<li class="<?php echo $page_now == 'export' ? 'active':''; ?>">
					<a href="<?php echo CORE_URL.'export.php' ?>">Export</a>
				</li>
				<li class="<?php echo $page_now == 'listings' ? 'active':''; ?>">
					<a href="<?php echo CORE_URL.'listings.php' ?>">Listings</a>
				</li>
				<li class="<?php echo $page_now == 'help' ? 'active':''; ?>">
					<a href="<?php echo CORE_URL.'pages/help.php' ?>">Help</a>
				</li>
			</ul>
		</div>
		<h3 class="text-muted"><a title="FeedSync" href="https://easypropertylistings.com.au/extensions/feedsync/">FeedSync</a></h3>
	</div>
