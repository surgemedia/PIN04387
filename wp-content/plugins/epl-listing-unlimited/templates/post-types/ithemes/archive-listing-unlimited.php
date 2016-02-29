<?php
function render_content() {
	if ( have_posts() ) : ?>
		<div class="loop">
			<div class="loop-header">
				<h4 class="loop-title">
					<?php
						the_post();
						
						if ( is_tax() ) { // Tag Archive
							$title = sprintf( __( 'Archive for %s', 'epl-lu' ), builder_get_tax_term_title() );
						}
						else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() && function_exists( 'post_type_archive_title' ) ) { // Post Type Archive
							$title = post_type_archive_title( '', false );
						}
						else { // Default catchall just in case
							$title = __( 'Archive', 'epl-lu' );
						}
						
						if ( is_paged() )
							printf( '%s &ndash; Page %d', $title, get_query_var( 'paged' ) );
						else
							echo $title;
						
						rewind_posts();
					?>
				</h4>
			</div>
			
			<div class="loop-content">
				<?php
					while ( have_posts() ) : // The Loop
						the_post();
						if ( function_exists('epl_lu_listing_unlimited_loop') ) {
							echo epl_lu_listing_unlimited_loop();
						} else { 
							get_template_part( 'content', get_post_format() );
						}
					endwhile; // end of one post
				?>
			</div>
			
			<div class="loop-footer">
				<!-- Previous/Next page navigation -->
				<div class="loop-utility clearfix">
					<div class="alignleft"><?php previous_posts_link( __( '&laquo; Previous Page', 'epl-lu' ) ); ?></div>
					<div class="alignright"><?php next_posts_link( __( 'Next Page &raquo;', 'epl-lu' ) ); ?></div>
				</div>
			</div>
		</div>
		<?php
	else : // do not delete
		do_action( 'builder_template_show_not_found' );
	endif; // do not delete
}
add_action( 'builder_layout_engine_render_content', 'render_content' );
do_action( 'builder_layout_engine_render', basename( __FILE__ ) );
