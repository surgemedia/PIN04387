<?php
/**
 * Template Name: SubLanding Template
 */
?>
<div class="row">
	
	<?php 
		$extraClass="small";
		$image=getFeaturedUrl(get_the_id());
		$preTitle="";
		$title="For<b>Buyers</b>";
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

// check if the repeater field has rows of data
if( have_rows('card') ):
	$color="grey-dark";
 	// loop through the rows of data
    while ( have_rows('card') ) : the_row();

        // display a sub field value
        $title=get_sub_field('title');
        $image=get_sub_field('image');
				$linkto=get_sub_field('link_to');
				$linktext=get_sub_field('link_text');
				$content= get_sub_field('content');

				include(locate_template('templates/part-sublanding-card.php')); 
	
				if ("grey-dark"==$color) $color = 'brand-dark';
			      else $color = "grey-dark";
    endwhile;

else :

    // no rows found

endif;

?>

	</div>

