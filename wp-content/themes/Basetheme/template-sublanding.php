<?php
/**
 * Template Name: SubLanding Template
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
				$linkto = (get_sub_field('link_to')==="false") ? get_sub_field('link_to_external') : get_sub_field('link_to_internal') ;
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

