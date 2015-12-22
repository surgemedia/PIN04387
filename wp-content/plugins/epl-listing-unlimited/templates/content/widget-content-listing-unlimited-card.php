<?php
/*
 * a Function for paged card display
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('epl-listing-unlimited-card epl-clearfix'); ?>>
	<div class="entry-header">
		<?php if ( $display == 'on' && has_post_thumbnail() ) : ?>
			<div class="epl-listing-unlimited-widget-image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $image , array('class' => $d_align . ' ' . $image )); ?>
				</a>
			</div>
		<?php endif; ?>	
		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		<?php if ( $d_excerpt == 'on' ) {
			the_excerpt(); 
		} ?>
	</div>
</div>
