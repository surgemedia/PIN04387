<?php 
/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts() {
    
    wp_enqueue_script( 'youTube-VideoLoad', get_template_directory_uri() . '/assets/scripts/youTube-VideoLoad.js', array(jquery), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );