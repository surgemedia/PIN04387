<?php
/**
 * Template Name: About Template
 */
?>
<?php while (have_posts()) : the_post(); ?>

<?php 
	$extraClass="big";
	$image=getFeaturedUrl(get_the_id());
	$preTitle=get_the_title();
	$title="pinnacle property qld";
	$postTitle="";
	include(locate_template('templates/part-jumbotron.php')); ?>
	







<?php endwhile; ?>
