<?php
/**
 * BKC WP Shortcodes
 *
 * @package BKC WP Shortcodes
 * @author Dinesh Chouhan
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'BKC_WP_Shortcodes' ) ) :

	/**
	 * Create class BKC_WP_Shortcodes
	 */
	class BKC_WP_Shortcodes {

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
				self::$instance = new BKC_WP_Shortcodes();
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

			add_shortcode( 'wp_get_option',    array( $this, 'get_option' ) );
			add_shortcode( 'wp_get_post_meta', array( $this, 'get_post_meta' ) );
			add_shortcode( 'wp_get_metadata',  array( $this, 'get_metadata' ) );
		}

		/**
		 * wp_get_option shortcode callback.
		 *
		 * @since 1.0.0
		 */
		public function get_option( $atts ) {

			$args = shortcode_atts( array(
				'option' => '',
				'default' => false,
			), $atts );

			if ( ! empty( $args['option'] ) ) {
				return get_option( $args['option'], $args['default'] );
			}
		}

		/**
		 * wp_get_option shortcode callback.
		 *
		 * @since 1.0.0
		 */
		public function get_post_meta( $atts ) {

			$args = shortcode_atts( array(
				'post_id' => 'current',
				'key'     => '',
				'single'  => false,
			), $atts );

			if ( ! empty( $args['post_id'] ) && ! empty( $args['key'] ) ) {
				$post_id = ( 'current' == $args['post_id'] ) ? get_the_id() : $args['post_id'];
				return get_post_meta( $post_id, $args['key'], $args['single'] );
			}
		}

		/**
		 * wp_get_option shortcode callback.
		 *
		 * @since 1.0.0
		 */
		public function get_metadata( $atts ) {

			$args = shortcode_atts( array(
				'meta_type' => '',
				'object_id' => 'current',
				'meta_key'  => '',
				'single'    => false,
			), $atts );

			if ( ! empty( $args['meta_type'] ) && ! empty( $args['meta_type'] ) ) {
				$object_id = ( 'current' == $args['object_id'] ) ? get_the_id() : $args['object_id'];
				return get_metadata( $args['meta_type'], $object_id, $args['meta_key'], $args['single'] );
			}
		}
	}

	BKC_WP_Shortcodes::instance();
endif;
