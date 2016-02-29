<?php
/*
 * TEMPLATE - Listing Unlimited Template Functions
 */
// WIDGET
function epl_lu_listing_unlimited_list( $display = 0 , $image = 'admin-list-thumb', $d_align = 'none' , $d_excerpt = 0) { 

	include( EPL_LU_PATH_TEMPLATES . 'content/widget-content-listing-unlimited-list.php' );
}
function epl_lu_listing_unlimited_card( $display = 0 , $image = 'thumbnail', $d_align = 'none' , $d_excerpt = 0 ) {
	include( EPL_LU_PATH_TEMPLATES . 'content/widget-content-listing-unlimited-card.php' );
}

// TEMPLATE - Suburb Profile Single
function epl_lu_listing_unlimited_single() {
	//include( EPL_LU_PATH_TEMPLATES . 'listing-unlimited-meta.php' );
	
	epl_lu_get_the_meta();
	include( EPL_LU_PATH_TEMPLATES . 'content/content-listing-unlimited-single.php' );
}

function epl_lu_listing_unlimited_loop() {
	include( EPL_LU_PATH_TEMPLATES . 'content/loop-listing-unlimited.php' );
}

/**
 * Add Listing Unlimited to Listings
 */
function epl_lu_single_action( ) {
	
	global $post, $epl_settings;
	$unique_id = get_post_meta( $post->ID , 'property_unique_id', true);
	$tab_title = isset($epl_settings['epl_lu_group_title']) ? __($epl_settings['epl_lu_group_title'],'epl-lu') : __('Extra Info','epl-lu');
	$query = new WP_Query( array (
		'post_type'	=>	'listing_unlimited',
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
					//epl_lu_get_the_meta();
				
					epl_lu_the_meta_list_items();
				}
			echo '</div>';
		echo '</div>';
	}

	wp_reset_postdata();

}
add_action('epl_property_tab_section_after', 'epl_lu_single_action');

function epl_social_share($atts) {
    global $post;
    $defaults = array(
        'count' => 'hide',
        'theme' => 'plain',
        'listings' => array('property', 'rental'),
        'icons' => array('fb', 'twitter', 'google'),
        'iconwidth' => '',
        'iconpadding' => '',
        'padding' => '',
        'background' => '',
        'borderwidth' => '',
        'borderradius' => '10',
        'bordercolor' => ''
    );

    $atts = shortcode_atts($defaults, $atts, 'epl_social_share');

    extract($atts);
    if (!is_array($listings)) {
        $listings = explode(",", $listings);
    }
    if (!is_array($icons)) {
        $icons = explode(",", $icons);
    }
    get_epl_scl_style($iconwidth, $iconpadding, $padding, $background, $borderwidth, $borderradius, $bordercolor);
    
    $eplsharebuttons = '';
    if (in_array('fb',$icons)) :
        
        // facebook icon
        $eplsharebuttons .=
            '<a target="_blank" href="http://www.facebook.com/sharer.php?u=' . get_permalink($post->ID) . '" >
                <img src="' .EPL_LU_PLUGIN_IMG_URL . 'social/' . $theme . '/facebook.png" title="Facebook" class="epl_scl_icon" alt="Share on Facebook" />
            </a>';
    endif;
    
    // twitter icon
    if (in_array('twitter',$icons)):
    
        $twitter_text = urlencode(html_entity_decode($post->post_title, ENT_COMPAT, 'UTF-8'));
        $eplsharebuttons .=
            '<a target="_blank" class="epl_scl_twitter_share" href="http://twitter.com/share?url=' . get_permalink($post->ID) . '&amp;text=' . $twitter_text . '" >
                <img src="' . EPL_LU_PLUGIN_IMG_URL . 'social/' . $theme . '/twitter.png" title="Twitter" class="epl_scl_icon" alt="Tweet about this on Twitter" />
            </a>';
    endif;
    
    // google icon
    if (in_array('google',$icons)):

        $eplsharebuttons .= 
        '<a target="_blank" class="epl_scl_google_share" href="https://plus.google.com/share?url=' .  get_permalink($post->ID)  . '" >
            <img src="' . EPL_LU_PLUGIN_IMG_URL. 'social/' . $theme . '/google.png" title="Google+" class="epl_scl_icon" alt="Share on Google+" />
         </a>';
    
    endif;
    
    return '<div class="epl_scl">' . $eplsharebuttons . '</div>';
}

add_shortcode('epl_social_share', 'epl_social_share');

function get_epl_scl_style($iconwidth, $iconpadding, $padding, $background, $borderwidth, $borderradius, $bordercolor) {

    $htmlepl_sclStyle = '<style type="text/css">';

    $htmlepl_sclStyle .= '	.epl_scl {
											' . ($padding != '' ? 'padding: ' . $padding . 'px;' : NULL) . '
											' . ($borderwidth != '' ? 'border: ' . $borderwidth . 'px solid ' . $bordercolor . ';' : NULL) . '
											' . ($background != '' ? 'background-color: ' . $background . ';' : NULL) . '
											' . ($borderradius != '' ? '-moz-border-radius: ' . $borderradius . 'px; -webkit-border-radius: ' . $borderradius . 'px; -khtml-border-radius: ' . $borderradius . 'px;  border-radius: ' . $borderradius . 'px; -o-border-radius: ' . $borderradius . 'px;' : NULL) . '
										}
										img.epl_scl_icon		
										{ 	
											width: ' . $iconwidth . 'px !important;
											padding: ' . $iconpadding . 'px;
											border:  0;
											box-shadow: none !important;
											display: inline !important;
											vertical-align: middle;
										}
										.epl_scl, .epl_scl a		
										{
											text-decoration:none;
											' . ($background == '' ? 'background: none;' : NULL) . '
										}</style>';
    echo $htmlepl_sclStyle;
}
