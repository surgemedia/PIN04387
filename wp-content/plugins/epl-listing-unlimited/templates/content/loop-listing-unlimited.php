<?php
/*
 * EPL Suburb Profile Template : Archive Card
 */
?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('listing-unlimited-blog clearfix'); ?>>				
		<div id="epl-suburb-blog" class="suburb-blog-wrapper-container">		
			<div class="entry-header">
				<h3 class="entry-title clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>
		
			<div class="entry-content">
				<div class="suburb-box property-box property-box-left property-content">
					<?php the_excerpt(); ?>
				</div>
				
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="suburb-box suburb-box-right property-box property-box-right property-featured-image-wrapper">
						<a href="<?php the_permalink(); ?>">
							<?php //the_post_thumbnail( 'it-teaser-thumb', array( 'class' => 'teaser-left-thumb' ) ); ?>
							<?php the_post_thumbnail( 'medium' ); ?>
							<?php //the_post_thumbnail( array(600,600) ); ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>