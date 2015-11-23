<?php
/*
 * EPL-SP Template for single Location Profiles
 */
?>
 
<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-unlimited-single' ); ?>>
	
	<!-- title, meta, and date info -->				
	<div class="entry-header clearfix">
		<!-- Featured Image -->
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-image">
				<div class="epl-featured-image epl-cropped">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'large', array( 'class' => 'epl-featured-image' ) ); ?>
					</a>
				</div>
			</div>
		<?php endif; ?>
		<!-- END Featured Image -->
		
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
	</div>
	
	<!-- post content -->
	<div class="entry-content clearfix">

		<!-- Location Profile Tab -->
		<div class="tab-wrapper">
			<!-- Suburb profile Tab -->
			<div class="tab-section">
				<!--<h5 class="tab-title">Property Manager</h5>-->
				<div class="tab-content">
					<?php epl_lu_the_meta_list_items() ?>
				</div>
			</div>

			<!-- Gallery -->
			<?php // check if the post has a Post Thumbnail assigned to it.
				$attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ( $attachments ) { ?>
					<div class="tab-section">
						<div class="tab-content">
							<?php echo do_shortcode('[gallery columns="4" link="file"]'); ?>
						</div>
					</div>
				<?php } ?>
				
		</div>
	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer clearfix">
		<div class="entry-meta">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'epl-lu' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
		</div>
	</div>
</div>
<!-- end .post -->
