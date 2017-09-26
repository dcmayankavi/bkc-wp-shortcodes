<?php
/**
 * Plugin Name: Shortcodes
 * Description: This Plugin provides multiple wordpress core shortcodes.
 * Version: 1.0.0
 * Author: Dinesh Chouhan
 * Author URI: http://dineshchouhan.com
 * Text Domain: bkc-wp-shortcodes
 *
 * @package BKC WP Shortcodes
 * @author Dinesh Chouhan
 */

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

require_once 'classes/class-bkc-wp-shortcodes-loader.php';
