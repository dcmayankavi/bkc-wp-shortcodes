<?php
/**
 * BKC WP Shortcodes Loader Class
 *
 * @package BKC WP Shortcodes
 * @author Dinesh Chouhan
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'BKC_WP_Shortcodes_Loader' ) ) :

	/**
	 * Create class BKC_WP_Shortcodes_Loader
	 */
	class BKC_WP_Shortcodes_Loader {

		/**
		 * Declare a static variable instance.
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * WordPress Customizer Object
		 *
		 * @since 1.0.0
		 * @var $wp_customize
		 */
		private $wp_customize;

		/**
		 * Initiate class
		 *
		 * @since 1.0.0
		 * @return object
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new BKC_WP_Shortcodes_Loader();
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			define( 'BKC_WP_SHORTCODES_VER', '1.0.0' );
			define( 'BKC_WP_SHORTCODES_FILE', trailingslashit( dirname( dirname( __FILE__ ) ) ) . 'bkc-wp-shortcodes.php' );
			define( 'BKC_WP_SHORTCODES_DIR', plugin_dir_path( BKC_WP_SHORTCODES_FILE ) );
			define( 'BKC_WP_SHORTCODES_URL', plugins_url( '/', BKC_WP_SHORTCODES_FILE ) );
		}

		/**
		 * Include files required to plugin
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function includes() {
			if ( is_admin() ) {
				require_once BKC_WP_SHORTCODES_DIR . 'classes/class-bkc-wp-shortcodes-admin.php';
			}
			require_once BKC_WP_SHORTCODES_DIR . 'classes/class-bkc-wp-shortcodes.php';
			
		}
	}

	BKC_WP_Shortcodes_Loader::instance();
endif;
