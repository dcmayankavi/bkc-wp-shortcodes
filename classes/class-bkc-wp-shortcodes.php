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
			add_shortcode( 'wp_get_network_option',    array( $this, 'get_network_option' ) );
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
				'wp_get_attachment_link' => array(
					'post' => null,
					'leavename' => false,
				),
				'wp_get_users' => array(
					'args' => array(),
				),
				'wp_get_avatar' => array(
					'id_or_email' => '',
					'size'        => 96,
					'default'     => '',
					'alt'         => '',
					'args'        => null,
				),
				'wp_get_avatar_url' => array(
					'id_or_email' => '',
					'args'        => null,
				),
				'wp_get_blogaddress_by_id' => array(
					'blog_id' => 0,
				),
				'wp_get_blogaddress_by_name' => array(
					'blogname' => '',
				),
				'wp_get_blog_count' => array(
					'network_id' => null,
				),
				'wp_get_blog_id_from_url' => array(
					'domain' => '',
					'path ' => '/',
				),
				'wp_get_sites' => array(
					'args' => array(),
				),
				'wp_get_blog_option' => array(
					'id' => 0,
					'option' => '',
					'default' => false,
				),
				'wp_get_blog_permalink' => array(
					'blog_id' => 0,
					'post_id' => 0,
				),
				'wp_get_calendar' => array(
					'initial' => true,
					'echo' => true,
				),
				'wp_get_category_link' => array(
					'category' => 0,
				),
				'wp_get_cat_name' => array(
					'cat_id' => 0,
				),
				'wp_get_cat_ID' => array(
					'cat_name' => '',
				),
				'wp_get_comments_link' => array(
					'post_id' => 0,
				),
				'wp_get_comments_number' => array(
					'post_id' => 0,
				),
				'wp_get_comments_number_text' => array(
					'zero' => false,
					'one' => false,
					'more' => false,
				),
				'wp_get_comments_pagenum_link' => array(
					'pagenum' => 1,
					'max_page' => '',
				),
				'wp_get_comment_author' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_author_link' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_author_url' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_author_url_link' => array(
					'linktext' => '',
					'before' => '',
					'after' => '',
					'comment' => null,
				),
				'wp_get_comment_author_email' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_author_email_link' => array(
					'linktext' => '',
					'before' => '',
					'after' => '',
					'comment' => null,
				),
				'wp_get_comment_author_IP' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_excerpt' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_guid' => array(
					'comment_ID' => 0,
				),
				'wp_get_comment_date' => array(
					'd' => '',
					'comment_ID' => 0,
				),
				'wp_get_comment_id_fields' => array(
					'id' => 0,
				),
				'wp_get_comment_link' => array(
					'comment' => null,
					'args' => array(),
				),
				'wp_get_comment_pages_count' => array(
					'comments' => null,
					'per_page' => null,
					'threaded' => null,
				),
				'wp_get_comment_reply_link' => array(
					'args' => array(),
					'comment' => null,
					'post' => null,
				),
				'wp_get_comment_text' => array(
					'comment_ID' => 0,
					'args' => array(),
				),
				'wp_get_comment_time' => array(
					'd' => '',
					'gmt' => false,
					'translate' => false,
				),
				'wp_get_comment_type' => array(
					'comment_ID' => 0,
				),
				'wp_get_custom_logo' => array(
					'blog_id' => 0,
				),
				'wp_get_dashboard_url' => array(
					'user_id' => 0,
					'path' => '',
					'scheme' => 'admin',
				),
				'wp_get_date_from_gmt' => array(
					'string' => '',
					'format' => 'Y-m-d H:i:s',
				),
				'wp_get_day_link' => array(
					'year' => false,
					'month' => false,
					'day' => false,
				),
				'wp_get_default_comment_status' => array(
					'post_type' => 'post',
					'comment_type' => 'comment',
				),
				'wp_get_delete_post_link' => array(
					'id' => 0,
					'deprecated' => '',
					'force_delete' => false,
				),
				'wp_get_dirsize' => array(
					'directory' => '',
				),
				'wp_get_edit_bookmark_link' => array(
					'link' => 0,
				),
				'wp_get_edit_comment_link' => array(
					'comment_id' => 0,
				),
				'wp_get_edit_post_link' => array(
					'id' => 0,
					'context' => 'display',
				),
				'wp_get_edit_profile_url' => array(
					'user_id' => 0,
					'scheme' => 'admin'
				),
				'wp_get_edit_tag_link' => array(
					'tag_id' => 0, 
					'taxonomy' => 'post_tag'
				),
				'wp_get_edit_term_link' => array(
					'term_id' => 0, 
					'taxonomy' => '', 
					'object_type' => '',
				),
				'wp_get_edit_user_link' => array(
					'user_id' => null
				),
				'wp_get_embed_template' => array(),
				'wp_get_feed_link' => array(
					'feed' => ''
				),
				'wp_get_filesystem_method' => array(
					'args' => array(),
					'context' => '',
					'allow_relaxed_file_ownership' => false
				),
				'wp_get_file_description' => array(
					'file' => ''
				),
				'wp_get_footer' => array(
					'name' => null
				),
				'wp_get_front_page_template' => array(),
				'wp_get_gmt_from_date' => array(
					'string' => '', 
					'format' => 'Y-m-d H:i:s'
				),
				'wp_get_header' => array(
					'name' => null
				),
				'wp_get_header_image' => array(),
				'wp_get_header_image_tag' => array(
					'attr' => array()
				),
				'wp_get_header_textcolor' => array(),
				'wp_get_header_video_url' => array(),
				'wp_get_home_path' => array(),
				'wp_get_home_template' => array(),
				'wp_get_home_url' => array(
					'blog_id' => null,
					'path' => '',
					'scheme' => null
				),
				'wp_get_html_split_regex' => array(),
				'wp_get_http_origin' => array(),
				'wp_get_id_from_blogname' => array(
					'slug' => ''
				),
				'wp_get_images_from_uri' => array(
					'uri' => ''
				),
				'wp_get_default_feed' => array(),
				'wp_get_date_template' => array(),
				'wp_get_custom_header_markup' => array(),
				'wp_get_current_user_id' => array(),
				'wp_get_current_theme' => array(),
				'wp_get_current_network_id' => array(),
				'wp_get_current_blog_id' => array(),
				'wp_get_comment_ID' => array(),
				'wp_get_comment_author_rss' => array(),
				'wp_restore_current_blog' => array(),
				'wp_get_background_color' => array(),
				'wp_get_background_image' => array(),
				'wp_get_the_post_thumbnail' => array(
					'post' => null,
					'size' => 'post-thumbnail',
					'attr' => '',
				),
				'wp_get_image_send_to_editor' => array(
					'id' => 0,
					'caption' => '',
					'title' => '',
					'align' => '',
					'url' => '',
					'rel' => false,
					'size' => 'medium',
					'alt' => ''
				),
				'wp_get_image_tag' => array(
					'id' => 0,
					'alt' => '',
					'title' => '',
					'align' => '',
					'size' => 'medium'
				),
				'wp_get_index_template' => array(),
				'wp_get_lastcommentmodified' => array(
					'timezone' => 'server'
				),
				'wp_get_lastpostdate' => array(
					'timezone' => 'server',
					'post_type' => 'any'
				),
				'wp_get_lastpostmodified' => array(
					'timezone' => 'server',
					'post_type' => 'any'
				),
				'wp_get_last_updated' => array(
					'deprecated' => '',
					'start' => 0,
					'quantity' => 40
				),
				'wp_get_locale' => array(),
				'wp_get_locale_stylesheet_uri' => array(),
				'wp_get_main_network_id' => array(),
				'wp_get_media_item' => array(
					'attachment_id' => 0,
					'args' => null
				),
				'wp_get_media_items' => array(
					'post_id' => 0,
					'errors' => array()
				),
				'wp_get_month_link' => array(
					'year' => false,
					'month' => false
				),
				'wp_get_next_comments_link' => array(
					'label' => '',
					'max_page' => 0
				),
				'wp_get_next_posts_link' => array(
					'label' => null,
					'max_page' => 0
				),
				'wp_get_next_posts_page_link' => array(
					'max_page' => 0
				),
				'wp_get_next_post_link' => array(
					'format' => '%link &raquo;',
					'link' => '%title',
					'in_same_term' => false,
					'excluded_terms' => '',
					'taxonomy' => 'category'
				),
				'wp_get_num_queries' => array(),
				'wp_get_oembed_endpoint_url' => array(
					'permalink' => '',
					'format' => 'json'
				),
				'wp_get_pagenum_link' => array(
					'pagenum' => 1,
					'escape' => true
				),
				'wp_get_page_link' => array(
					'post' => false,
					'leavename' => false,
					'sample' => false
				),
				'wp_get_page_of_comment' => array(
					'comment_ID' => 0,
					'args' => array()
				),
				'wp_get_page_template' => array(),
				'wp_get_page_template_slug' => array(
					'post' => null,
				),
				'wp_get_page_uri' => array(
					'page' => 0,
				),
				'wp_get_parent_theme_file_path' => array(
					'file' => '',
				),
				'wp_get_parent_theme_file_uri' => array(
					'file' => '',
				),
				'wp_get_permalink' => array(
					'post' => 0,
					'leavename' => false,
				),
				'wp_get_plugin_page_hook' => array(
					'plugin_page' => '', 
					'parent_page' => ''
				),
				'wp_get_plugin_page_hookname' => array(
					'plugin_page' => '', 
					'parent_page' => ''
				),
				'wp_get_posts_by_author_sql' => array(
					'post_type' => '',
					'full' => true,
					'post_author' => null,
					'public_only' => false
				),
				'wp_get_posts_nav_link' => array(
					'args' => array()
				),
				'wp_get_post_comments_feed_link' => array(
					'post_id' => 0,
					'feed' => ''
				),
				'wp_get_post_embed_url' => array(
					'post_id' => null,
				),
				'wp_get_post_embed_html' => array(
					'width' => 0,
					'height' => 0,
					'post' => null
				),
				'wp_get_post_field' => array(
					'field' => '',
					'post' => null,
					'context' => 'display'
				),
				'wp_get_post_format' => array(
					'post' => null,
				),
				'wp_get_post_format_string' => array(
					'slug' => '',
				),
				'wp_get_post_mime_type' => array(
					'ID' => '',
				),
				'wp_get_post_status' => array(
					'ID' => '',
				),
				'wp_get_post_modified_time' => array(
					'd' => 'U',
					'gmt' => false,
					'post' => null,
					'translate' => false
				),
				'wp_get_post_permalink' => array(
					'id' => 0,
					'leavename' => false,
					'sample' => false
				),
				'wp_get_raw_theme_root' => array(
					'stylesheet_or_template' => '',
					'skip_cache' => false
				),
				'wp_get_random_header_image' => array(),
				'wp_get_queried_object_id' => array(),
				'wp_get_query_template' => array(
					'type' => '',
					'templates' => array()
				),
				'wp_get_private_posts_cap_sql' => array(
					'post_type' => '',
				),
				'wp_get_previous_post_link' => array(
					'format' => '&laquo; %link',
					'link' => '%title',
					'in_same_term' => false,
					'excluded_terms' => '',
					'taxonomy' => 'category'
				),
				'wp_get_previous_posts_page_link' => array(),
				'wp_get_previous_posts_link' => array(
					'label' => null
				),
				'wp_get_previous_comments_link' => array(
					'label' => ''
				),
				'wp_get_post_type_archive_template' => array(),
				'wp_get_post_type_archive_link' => array(
					'post_type' => '',
				),
				'wp_get_post_type_archive_feed_link' => array(
					'post_type' => '',
					'feed' => '',
				),
				'wp_get_post_type' => array(
					'post' => null,
				),
				'wp_get_post_thumbnail_id' => array(
					'post' => null,
				),
				'wp_get_post_time' => array(
					'd' => 'U',
					'gmt' => false,
					'post' => null,
					'translate' => false
				),
				'wp_get_rest_url' => array(
					'blog_id' => null,
					'path' => '/',
					'scheme' => 'rest'
				),
				'wp_get_sample_permalink_html' => array(
					'id' => 0,
					'new_title' => null,
					'new_slug' => null
				),
				'wp_get_search_comments_feed_link' => array(
					'search_query' => '',
					'feed' => '',
				),
				'wp_get_search_feed_link' => array(
					'search_query' => '',
					'feed' => '',
				),
				'wp_get_search_form' => array(
					'echo' => true
				),
				'wp_get_search_link' => array(
					'query' => ''
				),
				'wp_get_search_query' => array(
					'escaped' => true
				),
				'wp_get_search_template' => array(),
				'wp_get_sidebar' => array(
					'name' => null
				),
				'wp_get_single_template' => array(),
				'wp_get_site_icon_url' => array(
					'size' => 512,
					'url' => '',
					'blog_id' => 0
				),
				'wp_get_site_url' => array(
					'blog_id' => null,
					'path' => '',
					'scheme' => null
				),
				'wp_get_space_allowed' => array(),
				'wp_get_space_used' => array(),
				'wp_get_status_header_desc' => array(
					'code' => 0
				),
				'wp_get_stylesheet' => array(),
				'wp_get_stylesheet_directory' => array(),
				'wp_get_stylesheet_directory_uri' => array(),
				'wp_get_stylesheet_uri' => array(),
				'wp_get_submit_button' => array(
					'text' => '',
					'type' => 'primary large',
					'name' => 'submit',
					'wrap' => true,
					'other_attributes' => ''
				),
				'wp_get_tag_feed_link' => array(
					'tag_id' => 0,
					'feed' => ''
				),
				'wp_get_tag_link' => array(
					'tag' => 0
				),
				'wp_get_tag_regex' => array(
					'tag' => ''
				),
				'wp_get_tag_template' => array(),
				'wp_get_taxonomy_template' => array(),
				'wp_get_template' => array(),
				'wp_get_template_directory' => array(),
				'wp_get_template_directory_uri' => array(),
				'wp_get_template_part' => array(
					'slug' => '',
					'name' => null
				),
				'wp_get_temp_dir' => array(),
				'wp_get_term_feed_link' => array(
					'term_id' => 0,
					'taxonomy' => 'category',
					'feed' => ''
				),
				'wp_get_term_field' => array(
					'field' => '',
					'term' => '',
					'taxonomy' => '',
					'context' => 'display'
				),
				'wp_get_term_link' => array(
					'term' => '',
					'taxonomy' => '',
				),
				'wp_get_term_parents_list' => array(
					'term' => '',
					'taxonomy' => '',
					'args' => array()
				),
				'wp_get_theme_file_path' => array(
					'file' => '',
				),
				'wp_get_theme_file_uri' => array(
					'file' => '',
				),
				'wp_get_theme_mod' => array(
					'name' => '',
					'default' => false,
				),
				'wp_get_theme_root' => array(
					'stylesheet_or_template' => false,
				),
				'wp_get_theme_root_uri' => array(
					'stylesheet_or_template' => false,
					'theme_root' => false,
				),
				'wp_wp_get_attachment_link' => array(
					'id' => 0,
					'size' => 'thumbnail',
					'permalink' => false,
					'icon' => false,
					'text' => false,
					'attr' => ''
				),
				'wp_get_the_archive_description' => array(),
				'wp_get_the_archive_title' => array(),
				'wp_get_the_author' => array(
					'deprecated' => ''
				),
				'wp_get_the_author_link' => array(),
				'wp_get_the_author_posts' => array(),
				'wp_get_the_author_posts_link' => array(),
				'wp_get_the_category_by_ID' => array(
					'cat_ID' => 0
				),
				'wp_get_the_category_list' => array(
					'separator' => '',
					'parents' => '',
					'post_id' => false
				),
				'wp_get_the_category_rss' => array(
					'type' => null
				),
				'wp_get_the_comments_navigation' => array(
					'args' => array()
				),
				'wp_get_the_comments_pagination' => array(
					'args' => array()
				),
				'wp_get_the_content' => array(
					'more_link_text' => null,
					'strip_teaser' => false
				),
				'wp_get_the_content_feed' => array(
					'feed_type' => null,
				),
				'wp_get_the_date' => array(
					'd' => '',
					'post' => null,
				),
				'wp_get_the_excerpt' => array(
					'post' => null,
				),
				'wp_get_the_generator' => array(
					'type' => '',
				),
				'wp_get_the_guid' => array(
					'post' => 0,
				),
				'wp_get_the_ID' => array(),
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

			$unset_shortcodes = array( 'wp_get_option', 'wp_get_network_option', 'wp_get_post_meta', 'wp_get_metadata' );
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
	
						if ( function_exists( $function ) ) {
							if ( version_compare( PHP_VERSION, '5.6', '>=' ) ) {
								$func_args = [];
								foreach ( $args as $key => $value ) {
									if ( 0 === strpos( $value, '{{' ) ) {
										$value = get_shortcode_from_attr( $value );
									}
									array_push( $func_args , $value );
								}

								// ... operator introduced in PHP 5.6.
								return $function( ...$func_args );
							} else {
								$count = count( $args );
								if ( $count > 0 ) {
									$args_keys = array_keys( $args );
								}
								switch ( $count ) {
									case 0:
										return $function();
										break;

									case 1:
										return $function( $args[ $args_keys[0] ] );
										break;

									case 2:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ] );
										break;

									case 3:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ] );
										break;

									case 4:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ] );
										break;

									case 5:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ] );
										break;

									case 6:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ], $args[ $args_keys[5] ] );
										break;

									case 7:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ], $args[ $args_keys[5] ], $args[ $args_keys[6] ] );
										break;

									case 8:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ], $args[ $args_keys[5] ], $args[ $args_keys[6] ], $args[ $args_keys[7] ] );
										break;

									case 9:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ], $args[ $args_keys[5] ], $args[ $args_keys[6] ], $args[ $args_keys[7] ], $args[ $args_keys[8] ] );
										break;

									case 10:
										return $function( $args[ $args_keys[0] ], $args[ $args_keys[1] ], $args[ $args_keys[2] ], $args[ $args_keys[3] ], $args[ $args_keys[4] ], $args[ $args_keys[5] ], $args[ $args_keys[6] ], $args[ $args_keys[7] ], $args[ $args_keys[8] ], $args[ $args_keys[9] ] );
										break;

									default:
										return '';
										break;
								}
							}
						} else {
							return '';
						}
					});
				}
			}
		}

		/**
		 * Gets the shortcode from attribute.
		 *
		 * @since 1.0.2
		 * @param  string  $value  The value.
		 * @return string
		 */
		public function get_shortcode_from_attr( $value ) {
			$shortcode = str_replace( '}}', '', str_replace( '{{', '', $value ) );
			$shortcode = explode( ' ', $shortcode );
			$shortcode = $shortcode[0];
			if ( shortcode_exists( $shortcode ) ) {
				$actual_shortcode = str_replace( '}}', ']', str_replace( '{{', '[', $value ) );
				$value = do_shortcode( $actual_shortcode, true );
			}
			return $value;
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
		 * wp_get_network_option shortcode callback.
		 *
		 * @since 1.0.1
		 */
		public function get_network_option( $atts ) {

			$args = shortcode_atts( array(
				'network_id'  => 0,
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
