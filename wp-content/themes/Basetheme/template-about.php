<?php
/**
 * Template Name: About Template
 */
?>
<?php while (have_posts()) : the_post(); ?>

<div class="row">
	<?php 
		$extraClass="big";
		$image=getFeaturedUrl(get_the_id());
		$preTitle=get_the_title();
		$title="pinnacle property qld";
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
</div>




<?php endwhile; ?>
