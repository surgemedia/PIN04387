<?php
/*
 * Plugin Name: EPL - Business Directory
 * Plugin URL: https://easypropertylistings.com.au/extension/business-directory/
 * Description: Adds local business directory to Easy Property Listings
 * Version: 2.0.1
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'EPL_Business_Directory' ) ) :
	/*
	 * Main EPL_Business_Directory Class
	 *
	 * @since 1.0
	 */
	final class EPL_Business_Directory {
		
		/*
		 * @var EPL_Business_Directory The one true EPL_Business_Directory
		 * @since 1.0
		 */
		private static $instance;
	
		/*
		 * Main EPL_Business_Directory Instance
		 *
		 * Insures that only one instance of EPL_Business_Directory exists in memory at any one time.
		 * Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0
		 * @static
		 * @staticvar array $instance
		 * @uses EPL_Business_Directory::includes() Include the required files
		 * @see EPL_BD()
		 * @return The one true EPL_Business_Directory
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EPL_Business_Directory ) ) {
				self::$instance = new EPL_Business_Directory;
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
			if ( !defined('EPL_RUNNING') ) {
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

			if ( !defined('EPL_RUNNING') ) {
				echo '<div class="error"><p>';
				_e( 'Please activate <b>Easy Property Listings</b> to enable all functions of EPL - Business Directory', 'epl-bd' );
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
			if ( ! defined( 'EPL_BD_PRODUCT_NAME' ) ) {
				define( 'EPL_BD_PRODUCT_NAME', 'Business Directory' );
			}
			// Plugin Folder URL
			if ( ! defined( 'EPL_BD_URL' ) ) {
				define( 'EPL_BD_URL', plugin_dir_url( __FILE__ ) );
			}
			
			// Plugin Folder Path
			if ( ! defined( 'EPL_BD_PATH' ) ) {
				define( 'EPL_BD_PATH', plugin_dir_path( __FILE__ ) );
			}
			
			// Plugin Sub-Directory Paths
			if ( ! defined( 'EPL_BD_PATH_INCLUDES' ) ) {
				define( 'EPL_BD_PATH_INCLUDES', EPL_BD_PATH . 'includes/' );
			}
			
			// Plugin Sub-Directory Templates
			if ( ! defined( 'EPL_BD_PATH_TEMPLATES' ) ) {
				define( 'EPL_BD_PATH_TEMPLATES', EPL_BD_PATH . 'templates/' );
			}
			
			// Plugin Sub-Directory Templates/content
			if ( ! defined( 'EPL_BD_PATH_TEMPLATES_CONTENT' ) ) {
				define( 'EPL_BD_PATH_TEMPLATES_CONTENT', EPL_BD_PATH . 'templates/content/' );
			}
			
			if ( ! defined( 'EPL_BD_PATH_TEMPLATES_POST_TYPES_ITHEMES' ) ) {
				define( 'EPL_BD_PATH_TEMPLATES_POST_TYPES_ITHEMES', EPL_BD_PATH_TEMPLATES . 'post-types/ithemes/' );
			}
			
			if ( ! defined( 'EPL_PATH_TEMPLATES_POST_TYPES_DEFAULT' ) ) {
				define( 'EPL_PATH_TEMPLATES_POST_TYPES_DEFAULT', EPL_BD_PATH_TEMPLATES . 'post-types/default/' );
			}
		}
		/*
		 * Include required files
		 *
		 * @access private
		 * @since 1.0
		 * @return void
		 */
		private function includes() {
			require_once EPL_BD_PATH_INCLUDES . 'post-type-business-directory.php';
			require_once EPL_BD_PATH_INCLUDES . 'taxonomy-business-category.php';
			require_once EPL_BD_PATH_INCLUDES . 'widget-business-directory.php';
			require_once EPL_BD_PATH_INCLUDES . 'widget-business-category.php';
			
			if ( is_admin() ) {
			
				$eplbd_license = new EPL_License( __FILE__, EPL_BD_PRODUCT_NAME, '2.0.1', 'Merv Barrett' );
				
				require_once EPL_BD_PATH_INCLUDES . 'hooks.php';
				require_once EPL_BD_PATH_INCLUDES . 'meta-boxes.php';
				
			} else {
				require_once EPL_BD_PATH_TEMPLATES . 'template-functions.php';
				require_once( EPL_BD_PATH_TEMPLATES . 'post-types/themes.php' );
			}
		}
		/**
		* Add a flag that will allow to flush the rewrite rules when needed.
		*/
		function reset_permalinks() {
			if ( ! get_option( 'epl_bd_reset_permalinks' ) ) {
				add_option( 'epl_bd_reset_permalinks', true );
			}
		}
		
		/**
		* Flush rewrite rules if the previously added flag exists,
		* and then remove the flag.
		*/ 
		function reset_permalinks_maybe() {
			if ( get_option( 'epl_bd_reset_permalinks' ) ) {
				flush_rewrite_rules();
				delete_option( 'epl_bd_reset_permalinks' );
			}
		}
	}
endif; // End if class_exists check
/*
 * The main function responsible for returning the one true EPL_Business_Directory
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $epl = EPL_BD(); ?>
 *
 * @since 1.0
 * @return object The one true EPL_Business_Directory Instance
 */
function EPL_BD() {
	return EPL_Business_Directory::instance();
}
// Get EPL_BD Running
EPL_BD();