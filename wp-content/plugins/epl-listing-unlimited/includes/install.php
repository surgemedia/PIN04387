<?php
/**
 * Install Function
 *
 * @package     EPL LU
 * @subpackage  Functions/Install
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function epl_lu_install() {
	// Clear the permalinks
	flush_rewrite_rules();
}
register_activation_hook( EPL_LU_PLUGIN_FILE , 'epl_lu_install' );
