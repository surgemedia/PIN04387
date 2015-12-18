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
	
	<?php while (have_posts()) : the_post(); ?>
<div class="tips-content">
		<div class="content">
			<?php the_content(); ?>
		
		</div>
			
	</div>
	<?php endwhile; ?>
<?php 
// WP_Query arguments
$args = array (
	'post_type'              => array( 'tips' )

);

// The Query
$the_query = new WP_Query( $args );?>
<?php if ( $the_query->have_posts() ) {
    
  $color="";    
      while ( $the_query->have_posts() ) {
        $the_query->the_post();?>

<?php 

	
	$image=wp_get_attachment_url( get_post_thumbnail_id($post->ID));
	// debug($image);
	include(locate_template('templates/part-tips-card.php')); 

	if (""==$color) $color = 'grey-dark';
      else $color = "";
	?>
<?php 
  }
  
} else {
 echo "string";
}
/* Restore original Post Data */
wp_reset_postdata();
?>



