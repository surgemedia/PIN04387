<?php
/**
 * Template Name: Tips Template
 */
?>


<?php 
	$extraClass="small";
	$image=getFeaturedUrl(get_the_id());
	$preTitle="";
	$title="Buying<b>Tips</b>";
	$postTitle="";
	include(locate_template('templates/part-jumbotron.php')); ?>
	
	
<div class="tips-content">
		<div class="content">
			“I just want to say a belated thanks to the team at Pinnacle Properties and to recommend their service to anyone looking to sell their property! It was an absolute pleasure selling my house  with Von. She is always very prompt, positive and helpful.”

		</div>
			<div class="author">
				Martin Shane
			</div>
	</div>
<?php 
// WP_Query arguments
$args = array (
	'post_type'              => array( 'tips' )

);

// The Query
$the_query = new WP_Query( $args );?>
<?php if ( $the_query->have_posts() ) {
      
      while ( $the_query->have_posts() ) {
        $the_query->the_post();?>

<?php 
	// echo "string 1";
	debug(get_post());
	$color="grey-dark";
	$image=getFeaturedUrl(get_the_id());

	include(locate_template('templates/part-tips-card.php')); ?>



<?php 
  }
  
} else {
 echo "string";
}
/* Restore original Post Data */
wp_reset_postdata();
?>



