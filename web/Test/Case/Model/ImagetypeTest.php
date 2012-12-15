<?php
App::uses('Imagetype', 'Model');

/**
 * Imagetype Test Case
 *
 */
class ImagetypeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.imagetype', 'app.image', 'app.post', 'app.posttype', 'app.category', 'app.category_order', 'app.post_version', 'app.language', 'app.document', 'app.posts_imagetype');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Imagetype = ClassRegistry::init('Imagetype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Imagetype);

		parent::tearDown();
	}

}
