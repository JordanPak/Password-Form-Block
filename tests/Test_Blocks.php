<?php
/**
 * Test_Blocks
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

use Password_Form_Block\Blocks;

/**
 * Class Test_Blocks
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */
class Test_Blocks extends WP_UnitTestCase {

	/**
	 * Blocks instance
	 *
	 * @since 1.0.0
	 * @var   Blocks
	 */
	public $instance;

	/**
	 * Setup
	 *
	 * @since 1.0.0
	 */
	public function setUP() {
		parent::setUp();
		$this->instance = new Blocks();
	}

	/**
	 * Test __construct()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\Blocks::__construct()
	 */
	public function test_construct() {

		// Check hooks.
		$this->assertEquals( 10, has_action( 'init', [ $this->instance, 'do_asset_registration' ] ) );
		$this->assertEquals( 10, has_action( 'enqueue_block_editor_assets', [ $this->instance, 'enqueue_editor_assets' ] ) );

		// Make sure "Password Form" block is registered.
		$registry = WP_Block_Type_Registry::get_instance();

		$this->assertTrue(
			$registry->is_registered( 'password-form-block/password-form' ),
			'"password-form-block/password-form" block is not registered.'
		);
	}

	/**
	 * Test do_asset_registration()
	 *
	 * @since 1.0.0
	 *
	 * @todo FIX THIS UP
	 *
	 * @covers Password_Form_Block\Blocks::do_asset_registration()
	 */
	// public function test_do_asset_registration() {
	// 	/*
	// 	 * Check script registration and test some versions/deps.
	// 	 */
	// 	$scripts = wp_scripts();

	// 	// Editor JS.
	// 	$editor_script = $scripts->registered['ajax-posts-block-editor'];

	// 	$this->assertEquals(
	// 		'ajax-posts-block-editor',
	// 		$editor_script->handle,
	// 		"Plugin's block editor JS is not registered."
	// 	);

	// 	$this->assertContains(
	// 		'wp-url',
	// 		$editor_script->deps,
	// 		"Plugin's block editor JS does not have all the correct dependencies."
	// 	);

	// 	$this->assertNotEmpty(
	// 		$editor_script->ver,
	// 		"Plugin's block editor JS does not have a version."
	// 	);

	// 	// Editor + front end JS.
	// 	$public_script = $scripts->registered['ajax-posts-block-blocks'];

	// 	$this->assertEquals(
	// 		'ajax-posts-block-blocks',
	// 		$public_script->handle,
	// 		"Plugin's editor + front end JS is not registered."
	// 	);

	// 	$this->assertContains(
	// 		'wp-api-fetch',
	// 		$public_script->deps,
	// 		"Plugin's editor + front end JS does not have all the correct dependencies."
	// 	);

	// 	$this->assertNotEmpty(
	// 		$public_script->ver,
	// 		"Plugin's editor + front end JS does not have a version."
	// 	);

	// 	// Validate inclusion of post type(s) in localized variable.
	// 	$localized_public_json = trim( str_replace( 'var apbHelper = ', '', $public_script->extra['data'] ), ';' );
	// 	$localized_public_json = json_decode( $localized_public_json );

	// 	$this->assertObjectHasAttribute(
	// 		'post',
	// 		$localized_public_json->types,
	// 		"Plugin's editor + front end JS helper object is not complete."
	// 	);

	// 	/*
	// 	 * Check style registration and test some versions/deps.
	// 	 */
	// 	$styles = wp_styles();

	// 	// Editor CSS.
	// 	$editor_style = $styles->registered['ajax-posts-block-editor'];

	// 	$this->assertEquals(
	// 		'ajax-posts-block-editor',
	// 		$editor_style->handle,
	// 		"Plugin's block editor CSS is not registered."
	// 	);

	// 	$this->assertEmpty(
	// 		$editor_style->deps,
	// 		"Plugin's block editor CSS has unexpected dependencies."
	// 	);

	// 	$this->assertNotEmpty(
	// 		$editor_style->ver,
	// 		"Plugin's block editor CSS does not have a version."
	// 	);

	// 	// Editor + front end CSS.
	// 	$public_style = $styles->registered['ajax-posts-block-blocks'];

	// 	$this->assertEquals(
	// 		'ajax-posts-block-blocks',
	// 		$public_style->handle,
	// 		"Plugin's editor + front end CSS is not registered."
	// 	);

	// 	$this->assertEmpty(
	// 		$public_style->deps,
	// 		"Plugin's editor + front end CSS has unexpected dependencies."
	// 	);

	// 	$this->assertNotEmpty(
	// 		$public_style->ver,
	// 		"Plugin's editor + front end CSS does not have a version."
	// 	);
	// }

	/**
	 * Test enqueue_editor_assets()
	 *
	 * @since 1.0.0
	 *
	 * @todo FIX THIS UP
	 *
	 * @covers Password_Form_Block\Blocks::enqueue_editor_assets()
	 */
	// public function test_enqueue_editor_assets() {
	// 	do_action( 'enqueue_block_editor_assets' );

	// 	$this->assertTrue(
	// 		wp_script_is( 'ajax-posts-block-editor', 'enqueued' ),
	// 		"Plugin's block editor JS is not enqueued."
	// 	);

	// 	$this->assertTrue(
	// 		wp_style_is( 'ajax-posts-block-editor', 'enqueued' ),
	// 		"Plugin's block editor CSS is not enqueued."
	// 	);
	// }
}
