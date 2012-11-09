<?php
App::uses('PostsCategory', 'Model');

/**
 * PostsCategory Test Case
 *
 */
class PostsCategoryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.posts_category', 'app.post', 'app.category', 'app.tag', 'app.posts_tag');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostsCategory = ClassRegistry::init('PostsCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostsCategory);

		parent::tearDown();
	}

}
