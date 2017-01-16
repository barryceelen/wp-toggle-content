<?php
/**
 * Plugin functions for the admin area
 *
 * @package   Toggle_Text
 * @author    Barry Ceelen <b@rryceelen.com>
 * @link      https://github.com/barryceelen/wp-toggle-content
 * @copyright 2017 Barry Ceelen
 * @license   GPLv3+
 */

/**
 * Register tinyMCE plugin.
 *
 * @since 1.0.0
 * @param array $external_plugins An array of external TinyMCE plugins.
 * @return array Modified array of external TinyMCE plugins.
 */
function toggle_content_tinymce_plugin( $external_plugins ) {

	$external_plugins['togglecontent'] = plugins_url( '/js/editor_plugin.js', __FILE__ );
	return $external_plugins;
}

/**
 * Add inline script to admin footer.
 *
 * Used to provide variables for the editor plugin.
 *
 * @since 1.0.0
 */
function toggle_content_vars() {
	printf(
		'<script type="text/javascript">var toggleContentVars = {tooltip:"%s"}</script>',
		esc_js( apply_filters( 'toggle_content_tooltip', __( 'Expand/Collapse Selection', 'toggle-content' ) ) )
	);
}

/**
 * Add button to tinyMCE toolbar.
 *
 * @since 1.0.0
 *
 * @param array  $mce_buttons First-row list of tinyMCE buttons.
 * @param string $editor_id   Unique editor identifier, e.g. 'content'.
 * @return array Modified list of tinyMCE buttons.
 */
function toggle_content_tinymce_button( $mce_buttons, $editor_id ) {
	if ( 'content' === $editor_id && ! in_array( 'togglecontent', $mce_buttons, true ) ) {
		array_push( $mce_buttons, 'togglecontent' );
	}

	return $mce_buttons;
}

/**
 * Add editor style.
 *
 * @since 1.0.0
 *
 * @see add_editor_style()
 */
function toggle_content_editor_style() {
	add_editor_style( TOGGLE_TEXT_PLUGIN_URL . 'css/editor-style.css' );
}

/**
 * Enqueue admin styles.
 *
 * @since 1.0.0
 *
 * @see wp_enqueue_style()
 */
function toggle_content_enqueue_styles() {

	$current_screen = get_current_screen();

	if ( 'post' !== $current_screen->base ) {
		return;
	}

	wp_enqueue_style(
		'toggle-content',
		plugins_url( '/css/admin.css', __FILE__ ),
		array(),
		140120161619,
		'screen'
	);
}
