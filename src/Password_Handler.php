<?php
/**
 * Post password handling
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

namespace Password_Form_Block;

// exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class for handling password form block, post content, etc.
 *
 * @since 1.0.0
 */
class Password_Handler {

	/**
	 * Hook everything in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'the_content', [ $this, 'set_content' ], 900 );
		$this->add_post_password_required_filter();
	}

	/**
	 * Add our post_password_required filter
	 *
	 * @since 1.0.0
	 */
	public function add_post_password_required_filter() {
		add_filter( 'post_password_required', [ $this, 'set_password_required' ], 10, 2 );
	}

	/**
	 * Remove our post_password_required filter
	 *
	 * @since 1.0.0
	 */
	public function remove_post_password_required_filter() {
		remove_filter( 'post_password_required', [ $this, 'set_password_required' ], 10, 2 );
	}

	/**
	 * Get whether or not the current post's password is required, without our
	 * filter.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function get_unfiltered_post_password_required() {
		$this->remove_post_password_required_filter();
		$required = post_password_required();
		$this->add_post_password_required_filter();

		return $required;
	}

	/**
	 * Remove post password requirement if the password is already required and
	 * the current post has the password form block
	 *
	 * @since 1.0.0
	 *
	 * @param  boolean $required  Whether the user needs to supply a password. True if password has not been
	 *                            provided or is incorrect, false if password has been supplied or is not required.
	 * @param  WP_Post $post      Post object.
	 * @return boolean
	 */
	public function set_password_required( $required, $post ) {

		return $required && has_block( 'password-form-block/password-form', $post )
			? false
			: $required;
	}

	/**
	 * Set post content up to and including the password form block, if
	 * applicable.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content  Post content.
	 * @return string           Post content.
	 */
	public function set_content( $content ) {

		// If the post doesn't require a password, already has it validated, or
		// doesn't have the password form block, move on.
		if ( ! has_block( 'password-form-block/password-form' ) || ! $this->get_unfiltered_post_password_required() ) {
			return $content;
		}

		$unprotected_content = '';

		foreach ( parse_blocks( get_the_content() ) as $block ) {

			$unprotected_content .= render_block( $block );

			if ( 'password-form-block/password-form' === $block['blockName'] ) {
				break;
			}
		}

		return $unprotected_content;
	}
}
