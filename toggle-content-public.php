<?php
/**
 * Plugin functions for the public area
 *
 * @package   Toggle_Text
 * @author    Barry Ceelen <b@rryceelen.com>
 * @link      https://github.com/barryceelen/wp-toggle-content
 * @copyright 2017 Barry Ceelen
 * @license   GPLv3+
 */

/**
 * Enqueue public scripts.
 *
 * @since 1.0.0
 *
 * @see wp_enqueue_script()
 */
function toggle_content_enqueue_scripts() {

	wp_enqueue_script(
		'toggle-content',
		plugins_url( '/js/public.js', __FILE__ ),
		array( 'jquery' ),
		140120161619,
		true
	);

	wp_localize_script(
		'toggle-content',
		'toggleContentVars',
		array(
			'labelExpand'     => esc_js( apply_filters( 'toggle_content_label_expand', __( 'Read More', 'toggle-content' ) ) ),
			'className'       => apply_filters( 'toggle_content_element_class', 'toggle-content' ),
			'classNameToggle' => apply_filters( 'toggle_content_toggle_class', 'toggle-content-toggle' ),
			'tooltip'         => esc_js( apply_filters( 'toggle_content_tooltip', __( 'Expand/Collapse Selection', 'toggle-content' ) ) ),
		)
	);
}
