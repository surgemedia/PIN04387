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
  'lib/function-debug.php',                // Custom functions
  'lib/function-get-featured-image-url.php',      // Custom functions
  'lib/function-get-tax-names.php',               // Custom functions
  'lib/function-getslug.php',                     // Custom functions
  'lib/function-get_id_from_slug.php',            // Custom functions
  'lib/function_clean_youtube_link.php',            // Custom functions
  'lib/function-display-gravity-form.php',            // Custom functions
  'lib/function-display-gravity-form.php',            // Custom functions
  'lib/gravity_forms-v5.php',            // Custom functions
  

  'lib/aq_resizer.php',                // Custom functions


];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
