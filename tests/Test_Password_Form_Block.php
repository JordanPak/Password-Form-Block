<?php
/**
 * Test_Password_Form_Block
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

use function Password_Form_Block\instance;

/**
 * Class Test_Password_Form_Block
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */
class Test_Password_Form_Block extends WP_UnitTestCase {

	/**
	 * Test instance()
	 *
	 * @since 1.0.0
	 *
	 * @covers Password_Form_Block\instance()
	 */
	public function test_singleton() {

		$this->assertEquals(
			'Password_Form_Block\Plugin',
			get_class( instance() ),
			'instance() is not returning main `Plugin` class.'
		);

		// instance() should return the same Plugin instance.
		$this->assertEquals(
			instance(),
			instance(),
			'instance() is not returning the same class instance after first call.'
		);
	}
}
