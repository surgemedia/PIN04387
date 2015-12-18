<?php
/**
 * Template Name: Career Template
 */
?>
<?php while (have_posts()) : the_post(); ?>

<?php 
	$extraClass="small";
	$image=getFeaturedUrl(get_the_id());
	$preTitle="";
	$title=get_the_title();
	$postTitle="";
	include(locate_template('templates/part-jumbotron.php')); ?>
	

<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
	<?php
    the_content(); ?>
</div>
<div class="col-sm-6 col-md-3 col-md-pull-6 side">
	
</div>
<div class="col-sm-6 col-md-3 side">
    <?php include(locate_template('templates/part-quick-links.php')); ?>
</div>





<?php endwhile; ?>
