<?php
/**
 * Shortcodes
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
		 * WordPress Shortcodes
		 *
		 * @since 1.0.0
		 * @var $shortcodes
		 */
		private static $shortcodes;

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

			if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
				add_action( 'admin_notices', array( $this, 'php_version_notice' ) );
				return;
			}

			add_shortcode( 'wp_get_option',    array( $this, 'get_option' ) );
			add_shortcode( 'wp_get_post_meta', array( $this, 'get_post_meta' ) );
			add_shortcode( 'wp_get_metadata',  array( $this, 'get_metadata' ) );

			self::$shortcodes = apply_filters( 'bkc_wp_shortcodes', array(
				'wp_admin_url' => array(
					'path' => '',
					'scheme ' => 'admin',
				),
				'wp_get_admin_url' => array(
					'blog_id' => null,
					'path' => '',
					'scheme ' => 'admin',
				),
				'wp_get_bloginfo' => array(
					'show' => '',
					'filter' => 'raw',
				),
				'wp_switch_to_blog' => array(
					'new_blog' => 0,
					'deprecated' => null,
				),
				'wp_category_description' => array(
					'category' => 0,
				),
				'wp_get_attached_file' => array(
					'attachment_id' => 0,
					'unfiltered' => false,
				),
				'wp_get_attached_media' => array(
					'type' => null,
					'post' => 0,
				),
				'wp_wp_get_attachment_image' => array(
					'attachment_id' => null,
					'size' => 'thumbnail',
					'icon' => false,
					'attr' => '',
				),
				'wp_get_the_author_meta' => array(
					'field' => '',
					'user_id' => false,
				),
				'wp_get_author_posts_url' => array(
					'author_id' => 0,
					'author_nicename' => '',
				),
				'wp_restore_current_blog' => array(),
				'wp_get_background_color' => array(),
				'wp_get_background_image' => array(),
				'wp_get_the_post_thumbnail' => array(
					'post' => null,
					'size' => 'post-thumbnail',
					'attr' => '',
				),
			));

			$this->init_shortcodes();
		}

		/**
		 * Admin Notice
		 * 
		 * @since 1.0.0
		 * @return void
		 */
		public function php_version_notice() {
			echo '<div class="error"><p>' . __( 'Shortcodes plugin requires PHP 5.6 to function properly. Please upgrade PHP or deactivate Plugin Name.', 'bkc-wp-shortcodes' ) . '</p></div>';
		}

		/**
		 * Initalize WP Shortcodes
		 * 
		 * @since 1.0.0
		 * @return void
		 */
		public function init_shortcodes(){

			$unset_shortcodes = array( 'wp_get_option', 'wp_get_post_meta', 'wp_get_metadata' );
			foreach ( $unset_shortcodes as $key ) {
				if( isset( self::$shortcodes[$key] ) ) {
					unset( self::$shortcodes[$key] );
				}
			}
			
			if ( ! empty( self::$shortcodes ) ) {
				foreach ( self::$shortcodes as $shortcode => $attributes ) {
					add_shortcode( $shortcode,  function( $atts ) use ( $shortcode, $attributes ) {

						$function = preg_replace( '/wp_/', '', $shortcode, 1 );
						$args = shortcode_atts( $attributes, $atts );

						if ( version_compare( PHP_VERSION, '5.6', '>=' ) ) {
							$func_args = [];
							foreach ( $args as $key => $value ) {
								array_push( $func_args , $value );
							}

							// ... operator introduced in PHP 5.6.
							if ( function_exists( $function ) ) {
								return $function( ...$func_args );
							} else {
								return '';
							}
						}
					});
				}
			}
		}

		/**
		 * wp_get_option shortcode callback.
		 *
		 * @since 1.0.0
		 */
		public function get_option( $atts ) {

			$args = shortcode_atts( array(
				'option'  => '',
				'default' => false,
				'subkey'  => '',
			), $atts );

			if ( ! empty( $args['option'] ) ) {
				$value = get_option( $args['option'], $args['default'] );
				if ( ! empty( $args['subkey'] ) ) {
					return isset( $value[ $args['subkey'] ] ) ? $value[ $args['subkey'] ] : '';
				}
				return $value;
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
				'subkey'  => '',
			), $atts );

			if ( ! empty( $args['post_id'] ) && ! empty( $args['key'] ) ) {
				$post_id = ( 'current' == $args['post_id'] ) ? get_the_id() : $args['post_id'];
				$value = get_post_meta( $post_id, $args['key'], $args['single'] );
				if ( ! empty( $args['subkey'] ) ) {
					return isset( $value[ $args['subkey'] ] ) ? $value[ $args['subkey'] ] : '';
				}
				return $value;
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
				'subkey'    => '',
			), $atts );

			if ( ! empty( $args['meta_type'] ) && ! empty( $args['meta_type'] ) ) {
				$object_id = ( 'current' == $args['object_id'] ) ? get_the_id() : $args['object_id'];
				$value = get_metadata( $args['meta_type'], $object_id, $args['meta_key'], $args['single'] );
				if ( ! empty( $args['subkey'] ) ) {
					return isset( $value[ $args['subkey'] ] ) ? $value[ $args['subkey'] ] : '';
				}
				return $value;
			}
		}
	}

	BKC_WP_Shortcodes::instance();
endif;
