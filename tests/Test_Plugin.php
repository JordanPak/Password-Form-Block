<?php
/**
 * Test_Plugin
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

use Password_Form_Block\Plugin;

/**
 * Class Test_Plugin
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */
class Test_Plugin extends WP_UnitTestCase {

	/**
	 * Plugin instance
	 *
	 * @since 1.0.0
	 * @var   Plugin
	 */
	public $instance;

	/**
	 * Setup
	 *
	 * @since 1.0.0
	 */
	public function setUP() {
		parent::setUp();
		$this->instance = new Plugin();
		$this->instance->init();
	}

	/**
	 * Test __construct()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\Plugin::__construct()
	 */
	public function test_construct() {
		$this->assertEquals( 10, has_action( 'plugins_loaded', [ $this->instance, 'init' ] ) );
		$this->assertEquals( 5, has_action( 'password_form_block_activate', [ $this->instance, 'init' ] ) );
	}

	/**
	 * Test init()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\Plugin::init()
	 */
	public function test_init() {
		$reflection_plugin = new ReflectionObject( $this->instance );
		$blocks_property   = $reflection_plugin->getProperty( 'blocks' );

		$blocks_property->setAccessible( true );
		$blocks_class = $blocks_property->getValue( $this->instance );

		$this->assertEquals(
			'Password_Form_Block\Blocks',
			get_class( $blocks_class ),
			'Main plugin class props are not all instantiated correctly.'
		);
	}
}
