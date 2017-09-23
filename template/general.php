<?php
/**
 * View General
 *
 * @package BKC WP Shortcodes
 * @author Dinesh Chouhan
 */

?>
<div class="wrap ast-clear bkc-wp-shortcodes">
	<h1><?php esc_html_e( 'BKC WP Shortcodes', 'bkc-wp-shortcodes' ) ?></h1>
	<div id="dashboard-widgets-wrap">
		<div id="dashboard-widgets" class="metabox-holder">
			<div id="postbox-container-1" class="postbox-container">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<div id="dashboard_right_now" class="postbox ">
						<h2 class="hndle ui-sortable-handle"><span>[wp_get_option]</span></h2>
						<div class="inside">
							<div class="main">
								<div>
									<?php esc_html_e( 'Shortcode to get site options.', 'bkc-wp-shortcodes' ) ?>
								</div>
								<br />
								<strong><?php esc_html_e( 'Usage: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_option option='' default=false]</code>
								<strong><?php esc_html_e( 'Example: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_option option='blogname']</code>
							</div>
						</div>
					</div>
				</div>
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<div id="dashboard_right_now" class="postbox ">
						<h2 class="hndle ui-sortable-handle"><span>[wp_get_metadata]</span></h2>
						<div class="inside">
							<div class="main">
								<div>
									<?php esc_html_e( 'Shortcode to get post meta values.', 'bkc-wp-shortcodes' ) ?>
								</div>
								<br />
								<strong><?php esc_html_e( 'Usage: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_metadata meta_type ='' object_id='' meta_key='' single=false]</code>
								<strong><?php esc_html_e( 'Example: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_metadata meta_type='comment' meta_key='your-meta-field' single=true]</code>
								<?php esc_html_e('This will return current post meta.', 'bkc-wp-shortcodes' ); ?>
								<code>[wp_get_metadata meta_type='comment' object_id='121' meta_key='your-meta-field' single=true]</code>
								<?php esc_html_e('This will return specific post id 121 post meta.', 'bkc-wp-shortcodes' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="postbox-container-2" class="postbox-container">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<div id="dashboard_right_now" class="postbox ">
						<h2 class="hndle ui-sortable-handle"><span>[wp_get_post_meta]</span></h2>
						<div class="inside">
							<div class="main">
								<div>
									<?php esc_html_e( 'Shortcode to get post meta values.', 'bkc-wp-shortcodes' ) ?>
								</div>
								<br />
								<strong><?php esc_html_e( 'Usage: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_post_meta post_id='' key='' single=false]</code>
								<strong><?php esc_html_e( 'Example: ', 'bkc-wp-shortcodes' ) ?></strong>
								<code>[wp_get_post_meta key='your-meta-field' single=true]</code>
								<?php esc_html_e('This will return current post meta.', 'bkc-wp-shortcodes' ); ?>
								<code>[wp_get_post_meta post_id='121' key='your-meta-field' single=true]</code>
								<?php esc_html_e('This will return specific post id 121 post meta.', 'bkc-wp-shortcodes' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
