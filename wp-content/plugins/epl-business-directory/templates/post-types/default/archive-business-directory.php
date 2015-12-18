<?php
/*
 * Archive Template for Custom Post Type : business_directory
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
								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								$title = sprintf( __( 'Property in %s', 'epl' ), $term->name );
							}
							else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() && function_exists( 'post_type_archive_title' ) ) { // Post Type Archive
								$title = post_type_archive_title( '', false );
							}
							else { // Default catchall just in case
								$title = __( 'Business Directory', 'epl' );
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
						if ( function_exists('epl_business_directory_archive')) {
							echo epl_business_directory_archive();
						} else {
							get_template_part( 'content', get_post_format() );
						}
						endwhile; // end of one post
					?>
			</div>
				
				<div class="loop-footer">
					<!-- Previous/Next page navigation -->
					<div class="loop-utility clearfix">
						<div class="alignleft"><?php previous_posts_link( __( '&laquo; Previous Page', 'epl' ) ); ?></div>
						<div class="alignright"><?php next_posts_link( __( 'Next Page &raquo;', 'epl' ) ); ?></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
get_sidebar();
get_footer(); 