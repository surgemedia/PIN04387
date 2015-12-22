<?php
/*
* Testimonial Widget File
*/
?>
<div id="post-<?php the_ID(); ?>" class="epl-testimonial-widget epl-clearfix">
	<?php
		$suburb = '';
		if ($location == 'on') {
			if ( taxonomy_exists('location') ) {
				global $post;
				$suburb = get_the_term_list($post->ID, 'location', '', '', '' );
				$suburb = strip_tags( $suburb );
			}
		?>
			<div class="entry-header">
				<h5><?php echo $suburb; ?></h5>
			</div><!-- .entry-header -->
			<?php
		}
	?>
	
	<div class="entry-summary">
		<?php
		if ( $display == 'on' ) {
			if ( has_post_thumbnail() ) { ?>
				<div class="entry-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( $d_image , array('class' => $d_align)); ?>
					</a>
				</div>
				<?php
			}
		}
			the_excerpt();
		?>
		<div class="testimonial-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
	</div>
</div>
<!-- end .post -->
