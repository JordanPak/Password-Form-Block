<?php
/**
 * Test_Block
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

use Password_Form_Block\Block;

/**
 * Class Test_Block
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */
class Test_Block extends WP_UnitTestCase {

	/**
	 * Sample block instance
	 *
	 * @since 1.0.0
	 * @var   Blocks
	 */
	public $block;

	/**
	 * Setup
	 *
	 * @since 1.0.0
	 */
	public function setUP() {
		parent::setUp();
		$this->block = new Block( 'test' );
	}

	/**
	 * Test __construct()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\Block::__construct()
	 */
	public function test_construct() {
		$this->assertEquals( 10, has_action( 'init', [ $this->block, 'do_registration' ] ) );
	}

	/**
	 * Test do_registration()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\Block::do_registration()
	 */
	public function test_do_registration() {
		$this->block->do_registration();

		$registry = WP_Block_Type_Registry::get_instance();

		$this->assertTrue(
			$registry->is_registered( 'password-form-block/test' ),
			'Block is not in block type registry.'
		);
	}
}
