<?php
/**
 * Misc. helper functions
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

namespace Password_Form_Block;

/**
 * Break array into string of attributes
 *
 * @since 1.0.0
 *
 * @param  array  $attrs   Attributes (keys) and values.
 * @param  string $prefix  Prefix for data attributes (ex: "data-").
 * @return string          Inline string of data attributes.
 */
function get_attrs( $attrs, $prefix = '' ) {

	// Remove initially empty args.
	$attrs = array_filter( $attrs );

	foreach ( $attrs as $attr => $value ) {

		// data- attributes.
		if ( 'data' === $attr && is_array( $value ) ) {
			$attrs[ $attr ] = get_attrs( array_filter( $value ), 'data-' );
			continue;
		}

		// Array of classes.
		if ( 'class' === $attr && is_array( $value ) ) {
			$value = implode( ' ', array_filter( $value ) );
		}

		// Array of classes + all other cases.
		$attrs[ $attr ] = $prefix . $attr . '="' . esc_attr( $value ) . '"';
	}

	return implode( ' ', $attrs );
}

/**
 * Output HTML string off attributes
 *
 * @since 1.0.0
 *
 * @param  array  $attrs   Attributes and their values.
 * @param  string $prefix  A prefix for data attributes (ex: "data-").
 */
function do_attrs( $attrs, $prefix = '' ) {
	echo get_attrs( $attrs, $prefix ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Attribute building helper, but all items go to "class" arg
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_attrs_class() {
	return get_attrs( [ 'class' => func_get_args() ] );
}

/**
 * Output class attribute
 *
 * @since 1.0.0
 */
function do_attrs_class() {
	echo get_attrs( [ 'class' => func_get_args() ] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Get a plugin template
 *
 * @since 1.0.0
 *
 * @param string $name Template part name (excluding .php).
 * @param array  $args Template arguments (extracted to vars).
 */
function get_plugin_template( $name, $args = [] ) {

	// Maker vars for all the args.
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args ); // phpcs:ignore
	}

	// Set the path and ensure the template is there.
	$template = PASSWORD_FORM_BLOCK_DIR . "src/templates/{$name}.php";

	if ( ! file_exists( $template ) ) {
		return;
	}

	// Load the template part.
	include $template;
}

/**
 * Get a dynamic block template
 *
 * @since 1.0.0
 *
 * @param string $name Block template part name (excluding .php).
 * @param array  $args Template arguments (extracted to vars).
 */
function get_block_template( $name, $args = [] ) {
	ob_start();
	get_plugin_template( "block/$name", $args );
	return ob_get_clean();
}
