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
	

<div class="col-md-3 side">
	
</div>
<div class="col-md-3 pull-right side">
    <?php include(locate_template('templates/part-quick-links.php')); ?>
</div>
<div class="col-md-6 general-content">
	<?php
    the_content(); ?>
</div>





<?php endwhile; ?>
