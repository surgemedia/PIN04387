<?php
/*
 * Plugin Name: EPL - Listing Unlimited
 * Plugin URL: http://easypropertylistings.com.au/extension/listing-unlimited/
 * Description: Add additional customisable info to your listings that are imported from a third party.
 * Version: 2.1
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
if ( ! class_exists( 'EPL_Listing_Unlimited' ) ) :
	/*
	 * Main EPL_Listing_Unlimited Class
	 *
	 * @since 1.0
	 */
	final class EPL_Listing_Unlimited {
		
		/*
		 * @var EPL_Listing_Unlimited The one true EPL_Listing_Unlimited
		 * @since 1.0
		 */
		private static $instance;
	
		/*
		 * Main EPL_Listing_Unlimited Instance
		 *
		 * Insures that only one instance of EPL_Listing_Unlimited exists in memory at any one time.
		 * Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0
		 * @static
		 * @staticvar array $instance
		 * @uses EPL_Listing_Unlimited::includes() Include the required files
		 * @see EPL()
		 * @return The one true EPL_Listing_Unlimited
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EPL_Listing_Unlimited ) ) {
				self::$instance = new EPL_Listing_Unlimited;
				self::$instance->hooks();
				if ( defined('EPL_RUNNING') ) {
					self::$instance->setup_constants();
					self::$instance->includes();
				}
			}
			return self::$instance;
		}
		
		/**
		 * Setup the default hooks and actions
		 *
		 * @since 1.0
		 *
		 * @return void
		 */
		private function hooks() {
			// activation
			add_action( 'admin_init', array( $this, 'activation' ) );
			register_activation_hook( __FILE__, array($this,'reset_permalinks') );
			add_action( 'init', array( $this, 'reset_permalinks_maybe' ) );

		}
		
		/**
		 * Activation function fires when the plugin is activated.
		 * @since 1.0
		 * @access public
		 *
		 * @return void
		 */
		public function activation() {
			if ( ! defined('EPL_RUNNING') ) {
				// is this plugin active?
				if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
			 		// unset activation notice
			 		unset( $_GET[ 'activate' ] );
			 		// display notice
			 		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
				}
			}
		}
		
		/**
		 * Admin notices
		 *
		 * @since 1.0
		*/
		public function admin_notices() {

			if ( ! defined('EPL_RUNNING') ) {
				echo '<div class="error"><p>';
				_e( 'Please activate <b>Easy Property Listings</b> to enable all functions of EPL - Listing Unlimited', 'epl-lu' );
				echo '</p></div>';
			}
		}
		
		/*
		 * Setup plugin constants
		 *
		 * @access private
		 * @since 1.0
		 * @return void
		 */
		private function setup_constants() {		
			// API URL
			if ( ! defined( 'EPL_TEMPLATES' ) ) {
				define( 'EPL_TEMPLATES', 'http://easypropertylistings.com.au' );
			}
			
			// Extension name on API server
			if ( ! defined( 'EPL_LU_PRODUCT_NAME' ) ) {
				define( 'EPL_LU_PRODUCT_NAME', 'Listing Unlimited' );
			}
			
			// Plugin File
			if ( ! defined( 'EPL_LU_PLUGIN_FILE' ) ) {
				define( 'EPL_LU_PLUGIN_FILE', __FILE__ );
			}
			
			// Plugin Folder URL
			if ( ! defined( 'EPL_LU_PLUGIN_URL' ) ) {
				define( 'EPL_LU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			
			// Plugin Folder URL
			if ( ! defined( 'EPL_LU_PLUGIN_IMG_URL' ) ) {
				define( 'EPL_LU_PLUGIN_IMG_URL', EPL_LU_PLUGIN_URL . 'img/' );
			}
			
			// Plugin Folder Path
			if ( ! defined( 'EPL_LU_PLUGIN_PATH' ) ) {
				define( 'EPL_LU_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'EPL_LU_PLUGIN_DIR' ) ) {
				define( 'EPL_LU_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			
			if ( ! defined( 'EPL_LU_PATH_INCLUDES' ) ) {
				define( 'EPL_LU_PATH_INCLUDES', EPL_LU_PLUGIN_PATH . 'includes/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES', EPL_LU_PLUGIN_PATH . 'templates/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES_CONTENT' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES_CONTENT', EPL_LU_PATH_TEMPLATES . 'content/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES_POST_TYPES' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES_POST_TYPES', EPL_LU_PATH_TEMPLATES . 'post-types/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_DEFAULT' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_DEFAULT', EPL_LU_PATH_TEMPLATES_POST_TYPES . 'default/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_ITHEMES' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_ITHEMES', EPL_LU_PATH_TEMPLATES_POST_TYPES . 'ithemes-builder/' );
			}
			
			if ( ! defined( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_GENESIS' ) ) {
				define( 'EPL_LU_PATH_TEMPLATES_POST_TYPES_GENESIS', EPL_LU_PATH_TEMPLATES_POST_TYPES . 'genesis/' );
			}
		}
		
		/**
		* Add a flag that will allow to flush the rewrite rules when needed.
		*/
		function reset_permalinks() {
			if ( ! get_option( 'epl_lu_reset_permalinks' ) ) {
				add_option( 'epl_lu_reset_permalinks', true );
			}
		}
		
		/**
		* Flush rewrite rules if the previously added flag exists,
		* and then remove the flag.
		*/ 
		function reset_permalinks_maybe() {
			if ( get_option( 'epl_lu_reset_permalinks' ) ) {
				flush_rewrite_rules();
				delete_option( 'epl_lu_reset_permalinks' );
			}
		}
		
		
		/*
		 * Include required files
		 *
		 * @access private
		 * @since 1.0
		 * @return void
		 */
		public function includes() {
			require_once( EPL_LU_PLUGIN_PATH . 'includes/functions.php' );
			require_once( EPL_LU_PLUGIN_PATH . 'includes/post-type-listing-unlimited.php' );
			require_once( EPL_LU_PLUGIN_PATH . 'includes/widget-listing-unlimited.php' );
			
			
			if ( is_admin() ) {
				$eplsp_license = new EPL_License( __FILE__, EPL_LU_PRODUCT_NAME, '2.1', 'Merv Barrett' );
				require_once( EPL_LU_PATH_INCLUDES . 'hooks.php' );
				require_once( EPL_LU_PATH_INCLUDES . 'meta-boxes-listing-unlimited.php' );
				
				
			} else {
				require_once( EPL_LU_PATH_TEMPLATES . 'template-functions.php' );
				require_once( EPL_LU_PATH_TEMPLATES . 'post-types/themes.php' );
				require_once( EPL_LU_PATH_INCLUDES . 'shortcodes-listing-unlimited.php' );
				require_once( EPL_LU_PATH_INCLUDES . 'shortcodes-listing-unlimited-private.php' );
			}
			
			include_once( EPL_LU_PLUGIN_PATH . 'includes/install.php' );
			
		}
	}
endif; // End if class_exists check
/*
 * The main function responsible for returning the one true EPL_Listing_Unlimited
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $epl = EPL(); ?>
 *
 * @since 1.0
 * @return object The one true EPL_Listing_Unlimited Instance
 */
function EPL_LU() {
	return EPL_Listing_Unlimited::instance();
}
// Get EPL Running
EPL_LU();
