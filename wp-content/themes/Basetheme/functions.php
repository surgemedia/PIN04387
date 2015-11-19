<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
  'post-types/action-post-type-testimonials.php',                // Custom post type
  'post-types/action-post-type-people.php',                // Custom post type
  'lib/function-debug.php',                // debuggings fun
  'lib/function-get-featured-image-url.php',      // get feaured image url for aq resizer
  'lib/function-getslug.php',                     // get the current slug
  'lib/function-get_id_from_slug.php',            // get id from slug
  'lib/function_clean_youtube_link.php',            // just get the v=
  'lib/function-display-gravity-form.php',            // Easy ACF to Gravity form display func
  'lib/gravity_forms-v5.php',            // Adds Gravity form to ACF
  'lib/acf-option-page.php',            // theme Option Page
  'lib/wp-api-register-property.php',            // WP API post type addons
  'lib/aq_resizer.php',                // Image resizer


];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
