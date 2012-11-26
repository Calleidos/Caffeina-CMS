<?php
App::uses('Posttype', 'Model');

/**
 * Posttype Test Case
 *
 */
class PosttypeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.posttype', 'app.category', 'app.category_order', 'app.product', 'app.product_version', 'app.language', 'app.image', 'app.document');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Posttype = ClassRegistry::init('Posttype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Posttype);

		parent::tearDown();
	}

}
