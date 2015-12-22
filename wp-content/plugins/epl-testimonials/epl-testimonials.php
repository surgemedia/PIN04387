<?php
/*
 * Plugin Name: EPL - Testimonial Management
 * Plugin URL: http://easypropertylistings.com.au/extension/testimonial-management/
 * Description: Adds Testimonials post type, widgets and shortcode to Easy Property Listings
 * Version: 2.1
 * Author: Merv Barrett
 * Author URI: http://www.realestateconnected.com.au
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'EPL_Testimonial_Manager' ) ) :
	/*
	 * Main EPL_Testimonial_Manager Class
	 *
	 * @since 1.0
	 */
	final class EPL_Testimonial_Manager {
		
		/*
		 * @var EPL_Testimonial_Manager The one true EPL_Testimonial_Manager
		 * @since 1.0
		 */
		private static $instance;
	
		/*
		 * Main EPL_Testimonial_Manager Instance
		 *
		 * Insures that only one instance of EPL_Testimonial_Manager exists in memory at any one time.
		 * Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0
		 * @static
		 * @staticvar array $instance
		 * @uses EPL_Testimonial_Manager::includes() Include the required files
		 * @see EPL_TM()
		 * @return The one true EPL_Testimonial_Manager
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EPL_Testimonial_Manager ) ) {
				self::$instance = new EPL_Testimonial_Manager;
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
				_e( 'Please activate <b>Easy Property Listings</b> to enable all functions of EPL - Testimonial Management', 'epl' );
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
			if ( ! defined( 'EPL_TM_PRODUCT_NAME' ) ) {
				define( 'EPL_TM_PRODUCT_NAME', 'Testimonial Manager' );
			}
			
			// Plugin File
			if ( ! defined( 'EPL_TM_PLUGIN_FILE' ) ) {
				define( 'EPL_TM_PLUGIN_FILE', __FILE__ );
			}
			
			// Plugin Folder URL
			if ( ! defined( 'EPL_TM_PLUGIN_URL' ) ) {
				define( 'EPL_TM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			
			// Plugin Folder Path
			if ( ! defined( 'EPL_TM_PLUGIN_PATH' ) ) {
				define( 'EPL_TM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			}
			
			// Plugin Sub-Directory Paths
			if ( ! defined( 'EPL_TM_PLUGIN_PATH_INCLUDES' ) ) {
				define( 'EPL_TM_PLUGIN_PATH_INCLUDES', EPL_TM_PLUGIN_PATH . 'includes/' );
			}
			
			// Plugin Sub-Directory Templates
			if ( ! defined( 'EPL_TM_PLUGIN_PATH_TEMPLATES' ) ) {
				define( 'EPL_TM_PLUGIN_PATH_TEMPLATES', EPL_TM_PLUGIN_PATH . 'templates/' );
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
			
			require_once EPL_TM_PLUGIN_PATH_INCLUDES . 'install.php';
			
			include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'post-type-testimonial.php' );
			include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'widget-testimonial.php' );
			include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'widget-testimonial-author.php' );
			
			if ( ! class_exists( 'EPL_Staff_Directory' ) ) {
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'tax-department.php' );
			}
			
			if ( is_admin() ) {
				$epltm_license = new EPL_License( __FILE__, EPL_TM_PRODUCT_NAME, '2.1', 'Merv Barrett' );
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'functions.php' );
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'hooks.php' );
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'meta-boxes.php' );
				
			} else {
				include_once( EPL_TM_PLUGIN_PATH_TEMPLATES . 'post-types/themes.php' );
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'template-functions.php' );
				include_once( EPL_TM_PLUGIN_PATH_INCLUDES . 'shortcodes.php' );
			}
		}
		
		/**
		* Add a flag that will allow to flush the rewrite rules when needed.
		*/
		function reset_permalinks() {
			if ( ! get_option( 'epl_tm_reset_permalinks' ) ) {
				add_option( 'epl_tm_reset_permalinks', true );
			}
		}
		
		/**
		* Flush rewrite rules if the previously added flag exists,
		* and then remove the flag.
		*/ 
		function reset_permalinks_maybe() {
			if ( get_option( 'epl_tm_reset_permalinks' ) ) {
				flush_rewrite_rules();
				delete_option( 'epl_tm_reset_permalinks' );
			}
		}
	}
endif; // End if class_exists check
/*
 * The main function responsible for returning the one true EPL_Testimonial_Manager
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $epl = EPL_TM(); ?>
 *
 * @since 1.0
 * @return object The one true EPL_Testimonial_Manager Instance
 */
function EPL_TMGR() {
	return EPL_Testimonial_Manager::instance();
}

// Get EPL_TM Running
EPL_TMGR();
