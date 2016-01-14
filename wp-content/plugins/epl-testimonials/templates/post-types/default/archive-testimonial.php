<?php
/*
 * Archive Template for Testimonial Custom Post Type : testimonial
 */
get_header(); ?>
<section id="primary" class="site-content">
	<div id="content" role="main">
		<?php
		if ( have_posts() ) : ?>
			<div class="loop">
				<header class="archive-header loop-header">
					<h4 class="loop-title">
						<?php
							the_post();
							
							if ( is_tax() ) { // Tag Archive
								$title = sprintf( __( 'Archive for %s', 'epl-tm' ), builder_get_tax_term_title() );
							}
							else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() && function_exists( 'post_type_archive_title' ) ) { // Post Type Archive
								$title = post_type_archive_title( '', false );
							}
							else { // Default catchall just in case
								$title = __( 'Archive', 'epl-tm' );
							}
							
							if ( is_paged() )
								printf( '%s &ndash; Page %d', $title, get_query_var( 'paged' ) );
							else
								echo $title;
							
							rewind_posts();
						?>
					</h4>
				</header>
				
				<div class="loop-content">
					<?php
						while ( have_posts() ) : // The Loop
							the_post();
							if ( function_exists('epl_property_testimonial_archive')) {
								echo epl_property_testimonial_archive();
							} else {
								get_template_part( 'content', get_post_format() );
							}
							endwhile; // end of one post
						?>
				</div>
				
				<div class="loop-footer">
					<!-- Previous/Next page navigation -->
					<div class="loop-utility clearfix">
						<div class="alignleft"><?php previous_posts_link( __( '&laquo; Previous Page', 'epl-tm' ) ); ?></div>
						<div class="alignright"><?php next_posts_link( __( 'Next Page &raquo;', 'epl-tm' ) ); ?></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_sidebar();
get_footer();