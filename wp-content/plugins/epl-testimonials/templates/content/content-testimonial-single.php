<?php
/*
* Single Testimonial File
*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-testimonial-single' ); ?>>
	<div class="entry-summary">
		<blockquote>
		
			<?php if ( $d_location == 'on' ) { ?>
				<div class="entry-header">
					<h5 class="epl-testimonial-location"><?php echo $location; ?></h5>
				</div><!-- .entry-header -->
			<?php } ?>
			
			<?php if ( $display == 'on' ) {
				if ( has_post_thumbnail() ) { ?>
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $d_image , array('class' => $d_align)); ?>
						</a>
					</div>
					<?php
				}
			} ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<h3 class="epl-testimonial-title"><?php the_title(); ?></h3>
		</blockquote>
	</div>
</div>
