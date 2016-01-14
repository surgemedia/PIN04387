<?php
/*
 * Single Template 
 */
 
get_header(); ?>

<div id="primary" class="site-content">
	<?php
	if ( have_posts() ) : ?>
		<div class="loop">
			<div class="loop-content">
				<?php
					while ( have_posts() ) : // The Loop
						the_post();
						if ( function_exists('epl_lu_listing_unlimited_single')) {
							echo epl_lu_listing_unlimited_single();
						}
						comments_template(); // include comments template
					endwhile; // end of one post
				?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php
get_sidebar();
get_footer();
