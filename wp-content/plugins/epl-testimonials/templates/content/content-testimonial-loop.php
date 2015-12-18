<?php
/*
* Testimonial Archive File
*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-testimonial-loop' ); ?>>
	<div class="entry-summary">

		<blockquote>
		<?php if ( $d_location == 'on' ) { ?>
			<div class="entry-header">
				<h5><?php echo $location; ?></h5>
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
			
			<?php if ( $excerpt == 'excerpt' ) {	
				 the_excerpt();
			} else {
				if( function_exists('epl_the_content') ) { 
        		epl_the_content(); 
    		} else {
				the_content();
    		}
			} ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</blockquote>
	</div>
</div>
<!-- end .post -->
