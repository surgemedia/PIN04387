<?php
/**
 * TEMPLATE : Testimonial Single
 *
 * @since 1.0
 */
function epl_property_testimonial_single() {

	global $post, $epl_settings;

	$display	= isset( $epl_settings['epl_tm_single_image_display'])	? $epl_settings['epl_tm_single_image_display']	: 'on';
	$d_image	= isset( $epl_settings['epl_tm_single_image_size'])	? $epl_settings['epl_tm_single_image_size']	: 'thumbnail';
	$d_align	= isset( $epl_settings['epl_tm_single_image_align'])	? $epl_settings['epl_tm_single_image_align']	: 'alignright';
	
	
	$location	= taxonomy_exists( 'location' )	? strip_tags( get_the_term_list($post->ID, 'location', '', '', '' ) ) : '';
	$d_location	= $location && isset( $epl_settings['epl_tm_single_location'])	? $epl_settings['epl_tm_single_location']	: 'on';
	
	include( EPL_TM_PLUGIN_PATH_TEMPLATES . 'content/content-testimonial-single.php' );
}

/**
 * TEMPLATE - Testimonial Archive
 *
 * @since 1.0
 */
function epl_property_testimonial_archive() { 

	global $post, $epl_settings;

	$excerpt	= isset( $epl_settings['epl_tm_loop_display_excerpt'])	? $epl_settings['epl_tm_loop_display_excerpt']	: 'full';
	$display	= isset( $epl_settings['epl_tm_loop_image_display'])	? $epl_settings['epl_tm_loop_image_display']	: 'on';
	$d_image	= isset( $epl_settings['epl_tm_loop_image_size'])	? $epl_settings['epl_tm_loop_image_size']	: 'thumbnail';
	$d_align	= isset( $epl_settings['epl_tm_loop_image_align'])	? $epl_settings['epl_tm_loop_image_align']	: 'alignright';
	
	$location	= taxonomy_exists( 'location' )	? strip_tags( get_the_term_list($post->ID, 'location', '', '', '' ) ) : '';
	$d_location	= $location && isset( $epl_settings['epl_tm_loop_location'])	? $epl_settings['epl_tm_loop_location']	: 'on';

	include( EPL_TM_PLUGIN_PATH_TEMPLATES . 'content/content-testimonial-loop.php' );
}

/**
 * TEMPLATE - Testimonial Single
 *
 * @since 1.0
 */	
function epl_property_testimonial_widget($location = 0 ,$display = 0 , $d_align = 0 , $d_image = 'thumbnail') { 		
	include( EPL_TM_PLUGIN_PATH_TEMPLATES . 'content/content-testimonial-widget.php' );
}

/**
 * Add Testimonial to Listings
 * Add sub meta boxes to the post-edit page
 *
 * @since 2.0
 */
function epl_tm_single_action( ) {
	
	global $post, $epl_settings;
	$unique_id = get_post_meta( $post->ID , 'property_unique_id', true);
	
	if ( $unique_id == '' )
		return;
		
	$tab_title = isset($epl_settings['epl_tm_group_title']) ? $epl_settings['epl_tm_group_title'] : __('Testimonial','epl');
	$query = new WP_Query( array (
		'post_type'	=>	'testimonial',
		'meta_query'	=>	array(
				array(
				'key' => 'property_unique_id',
				'value' => $unique_id,
				'compare' => '=='
				)
			)
		)
	);
	
	if ( $query->have_posts() ) {
		echo '<div class="epl-tab-section">';
			echo '<h5 class="tab-title">'.$tab_title.'</h5>';
			echo '<div class="tab-content">';
				while ( $query->have_posts() ) {
					$query->the_post();
						epl_property_testimonial_single( );
				}
			echo '</div>';
		echo '</div>';
	}

	wp_reset_postdata();

}
add_action('epl_property_tab_section_after', 'epl_tm_single_action');


/*
 * Add testimonials to single staff dir page
 */
function epl_sd_single_staff_testimonial_callback() {

	global $epl_author, $epl_settings;
	
	if( isset($epl_settings['epl_sd_show_testimonials'])  && $epl_settings['epl_sd_show_testimonials'] == 'yes') {
		
		$quantity 	= isset($epl_settings['epl_sd_testimonials_count']) ? $epl_settings['epl_sd_testimonials_count'] : '4';
		$test_args = array(
			'post_type' 		=> 'testimonial',
			'author' 			=> $epl_author->author_id,
			'posts_per_page' 	=> $quantity
		);
		$test_query = new WP_Query($test_args);
		if ($test_query->have_posts() && function_exists('epl_property_testimonial_archive')) {
			?>
			<div class="epl-sd-testimonial directory-section-testimonial epl-clearfix">
			<div class="epl-sd-section-title epl-tab-title">&nbsp;</div>
			<?php
			while ($test_query->have_posts()) {
				$test_query->the_post();
				echo epl_property_testimonial_archive();
			}
			wp_reset_postdata();
			?>
			</div>
			<?php
		}
	}
	
}
add_action( 'epl_sd_single_extension' , 'epl_sd_single_staff_testimonial_callback' , 10);
