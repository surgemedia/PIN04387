<?php
/**
 * Template Name: Renting Tips
 */
?>
<div class="row">
	
	<?php 
		$extraClass=get_field("jumbotron_size");
		$image=getFeaturedUrl(get_the_id());
		$preTitle=get_field("light");
		$title="<b>".get_field("bold")."</b>";
		$postTitle=("small"!==get_field("jumbotron_size")) ? get_field("light2") : "";
		include(locate_template('templates/part-jumbotron.php')); ?>
		
		<?php while (have_posts()) : the_post(); ?>
	<div class="tips-content text-center">
			<div class="content">
				<?php edit_post_link(); ?>
				
				<?php the_content(); ?>
	
			</div>
				
		</div>
		<?php endwhile; ?>
	<?php 
	// WP_Query arguments
	$args = array (
		'post_type'  	=> array( 'tips' ),
		'type_of_tip'         => 'renting',
	);
	
	// The Query
	$the_query = new WP_Query( $args );?>
	<?php if ( $the_query->have_posts() ) {
	    
	  $color="";    
	      while ( $the_query->have_posts() ) {
	        $the_query->the_post();?>
	
	<?php 
	
		
		$image=get_field('image');
		// debug($image);
		include(locate_template('templates/part-tips-card.php')); 
	
		if (""==$color) $color = 'grey-dark';
	      else $color = "";
		?>
	<?php 
	  }
	  
	} else {
	 //do nothing
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	?>
	</div>

