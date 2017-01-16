<?php
/**
 * Main plugin file
 *
 * @package   Toggle_Content
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPLv3+
 * @link      https://github.com/barryceelen/wp-toggle-content
 * @copyright 2017 Barry Ceelen
 *
 * Plugin Name:       Toggle Content
 * Plugin URI:        https://github.com/barryceelen/wp-toggle-content
 * Description:       Adds a button to the editor which makes content collapse.
 * Version:           1.0.0
 * Author:            Barry Ceelen
 * Author URI:        https://github.com/barryceelen
 * Text Domain:       toggle-content
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/barryceelen/wp-toggle-content
 *
 * Hat tip to Codelight for the very helpful article and example plugin:
 *
 * https://codelight.eu/creating-a-custom-blockquote-wrapper-format-with-nested-element-in-tinymce/
 * https://github.com/codelight-eu/tinymce-advanced-blockquote
 */

// Don't load directly.
defined( 'ABSPATH' ) or die();

define( 'TOGGLE_TEXT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TOGGLE_TEXT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

add_action( 'init', 'toggle_content_load_textdomain' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function toggle_content_load_textdomain() {

	if ( false !== strpos( __FILE__, basename( WPMU_PLUGIN_DIR ) ) ) {
		load_muplugin_textdomain( 'toggle-content', dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	} else {
		load_plugin_textdomain( 'toggle-content', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

if ( is_admin() ) {

	require_once( 'toggle-content-admin.php' );

	add_filter( 'mce_external_plugins', 'toggle_content_tinymce_plugin' );
	add_filter( 'mce_buttons', 'toggle_content_tinymce_button', 10, 2 );
	add_action( 'admin_init', 'toggle_content_editor_style' );
	add_action( 'admin_enqueue_scripts', 'toggle_content_enqueue_styles' );
	add_action( 'admin_print_scripts', 'toggle_content_vars' );

} else {

	require_once( 'toggle-content-public.php' );

	add_action( 'wp_enqueue_scripts', 'toggle_content_enqueue_scripts' );
}
