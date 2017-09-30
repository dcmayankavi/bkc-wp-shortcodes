=== Shortcodes ===
Contributors: dineshc
Donate link: https://www.paypal.me/dcmayankavi
Tags: wp-shortcodes, wordpress-shortcodes, option shortcode, meta shortcode.
Requires at least: 3
Tested up to: 4.8.2

Shortcodes plugin will helps to get option, post meta and other core data using shortcode.

== Description ==

Shortcodes providing WordPress core shortcode for get option, get post meta, get custom post meta and other WordPress data using shortcode.
Shortcodes:

1. [wp_get_option]
Ex. [wp_get_option option='blogname']

2. [wp_get_post_meta]
Ex. [wp_get_post_meta key='your-meta-field' single=true]

3. [wp_get_metadata]
Ex. [wp_get_metadata meta_type='comment' meta_key='your-meta-field' single=true]

4. [wp_get_the_thumbnail]
Ex. [wp_get_the_thumbnail]

5. Use of shortcode as parameter of another shortcode.
Ex. [wp_get_the_post_thumbnail post={{wp_get_the_ID}} size="medium" ]
"wp_get_the_ID" is a shortcode to get current post id which is is passed to post parameter of "wp_get_the_post_thumbnail" shortcode. To pass shortcode as parameter value you need to use {{shortcode}} syntax instead of [shortcode].
== Installation ==

1. Install either via the WordPress.org plugin directory, or by uploading the files to your server.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Once the plugin is activated you can use any wordpress core shortcode anywhere in your text.
4. Easy and useful. Enjoy!

== Changelog ==

= 1.0.0 =
* Initial release.

= 1.0.1 =
* Shortcodes generator array updated.

= 1.0.2 =
* Added support for shortcode as parameter of another shortcode.