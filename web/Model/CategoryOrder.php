<?php
App::uses('AppModel', 'Model');
/**
 * CategoryOrder Model
 *
 * @property CategoryOrder $ParentCategoryOrder
 * @property CategoryOrder $ChildCategoryOrder
 * @property Post $Post
 */
class CategoryOrder extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Post' => array(
				'className' => 'Post',
				'foreignKey' => 'post_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		)
	);

}
