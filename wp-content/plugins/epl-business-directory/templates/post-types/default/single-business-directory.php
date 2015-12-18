<?php
/*
 * Single Template for Business Directory custom post type : business_directory
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
						if ( function_exists('epl_business_directory_single') ) {
							echo epl_business_directory_single();
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