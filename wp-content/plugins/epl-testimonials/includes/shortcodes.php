<?php
/**
 * SHORTCODE :: epl_testimonial [epl_testimonials id=false limit=10]
 *
 * since	2.2
 * @package     EPL-TM
 * @subpackage  Shortcode
 * @copyright   Copyright (c) 2014, Merv Barrett
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only load on front
if( is_admin() ) {
	return; 
}

function epl_tm_shortcode_testimonials_callback( $atts ) {

	extract( shortcode_atts( array(
		'id'				=>	false,
		'limit'				=>	'10', // Number of maximum posts to show
	), $atts ) );
	
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=>	'testimonial',
		'posts_per_page'	=>	$limit,
		'paged' 		=>	$paged
	);
	
	global $post, $epl_settings;
	$unique_id = get_post_meta( $post->ID , 'property_unique_id', true);
	$tab_title = isset($epl_settings['epl_tm_group_title']) ? $epl_settings['epl_tm_group_title'] : __('Testimonial','epl');
	
	
	ob_start();
	
	$query_open = new WP_Query( $args );
	
	if ( $query_open->have_posts() ) { ?>
		<div class="loop epl-shortcode epl-tm-shortcode">
			<div class="loop-content epl-testimonial-archive <?php echo epl_template_class( $template ); ?>">
				<?php
					while ( $query_open->have_posts() ) : // The Loop
						$query_open->the_post();
						
							epl_property_testimonial_single( );
						
					endwhile; // end of one post

				?>
			</div>
			<div class="loop-footer">
					<?php do_action('epl_pagination',array('query'	=>	$query_open)); ?>
			</div>
		</div>
		<?php
	} else {
		echo '<h3>'.__('Nothing found, please check back later.', 'epl').'</h3>';
	}
	wp_reset_postdata();
	return ob_get_clean();

}
add_shortcode( 'epl_testimonials', 'epl_tm_shortcode_testimonials_callback' );

