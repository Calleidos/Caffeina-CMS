<?php
App::uses('ProductVersion', 'Model');

/**
 * ProductVersion Test Case
 *
 */
class ProductVersionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product_version', 'app.language', 'app.product');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductVersion = ClassRegistry::init('ProductVersion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductVersion);

		parent::tearDown();
	}

}
