<?php while (have_posts()) : the_post(); ?>

<div class="row">
	<?php 
		$extraClass=get_field("jumbotron_size");
		$image=getFeaturedUrl(get_the_id());
		$preTitle=get_field("light");
		$title="<b>".get_field("bold")."</b>";
		$postTitle=("small"!==get_field("jumbotron_size")) ? get_field("light2") : "";
		include(locate_template('templates/part-jumbotron.php')); ?>
		
	
	<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
		<?php edit_post_link(); ?>
		<?php the_content(); ?>

	<!-- <div class="bg_grey visible-lg"> </div> -->
	</div>
	<div class="col-sm-6 col-md-3 col-md-pull-6 side">
		
	</div>
	<div class="col-sm-6 col-md-3 side">
	    <?php include(locate_template('templates/part-quick-links.php')); ?>
	</div>
</div>



<?php endwhile; ?>