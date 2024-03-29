<?php
/**
 * Editor blocks handler
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
 * Block registration and asset handling
 *
 * @since 1.0.0
 */
class Blocks {

	/**
	 * Block editor CSS/JS asset handle
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const EDITOR_ASSET_HANDLE = 'password-form-block-editor';

	/**
	 * Block front end + editor CSS handle
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	const ASSET_HANDLE = 'password-form-block-blocks';

	/**
	 * Spin everything up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'do_asset_registration' ] );

		new Password_Form();
	}

	/**
	 * Register assets for blocks/editor to use
	 *
	 * @since 1.0.0
	 */
	public function do_asset_registration() {
		$build_dir    = PASSWORD_FORM_BLOCK_DIR . 'build';
		$build_url    = PASSWORD_FORM_BLOCK_URL . 'build';
		$blocks_asset = require "$build_dir/blocks.asset.php";

		// Editor script.
		wp_register_script(
			self::EDITOR_ASSET_HANDLE,
			"$build_url/blocks.js",
			$blocks_asset['dependencies'],
			$blocks_asset['version'],
			true
		);
	}
}
