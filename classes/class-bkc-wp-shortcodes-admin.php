<?php
/**
 * BKC WP Shortcodes Admin
 *
 * @package BKC WP Shortcodes
 * @author Dinesh Chouhan
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'BKC_WP_Shortcodes_Admin' ) ) :

	/**
	 * Create class BKC_WP_Shortcodes_Admin
	 */
	class BKC_WP_Shortcodes_Admin {

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
				self::$instance = new BKC_WP_Shortcodes_Admin();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->init();
		}

		/**
		 * WP Core Shortcodes.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function init() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'admin_head', array( $this, 'admin_head' ) );
		}

		/**
		 * Add Admin Menu.
		 * 
		 * @return void.
		 */
		public function admin_menu() {
			add_dashboard_page( 
				__( 'BKC WP Shortcodes', 'bkc-wp-shortcodes' ),
				__( 'BKC WP Shortcodes', 'bkc-wp-shortcodes' ),
				'read', 
				'bkc-wp-shortcodes', 
				array( $this, 'admin_menu_markup' )
			);
		}

		/**
		 * Add Admin Menu.
		 * 
		 * @return void.
		 */
		public function admin_head() {

			$screen = get_current_screen();
			if ( 'dashboard_page_bkc-wp-shortcodes' == $screen->base ) {
				?>
				<style id="bkc-wp-shortcodes" type="text/css">
					.bkc-wp-shortcodes code {
						display: block;
						margin: 5px 0;
						line-height: 1.5;
						font-style: italic;
					}
				</style>
				<?php
			}
		}

		public function admin_menu_markup() {
			require_once BKC_WP_SHORTCODES_DIR . 'template/general.php';
		}

	}

	BKC_WP_Shortcodes_Admin::instance();
endif;
