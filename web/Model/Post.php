<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property PostVersion $PostVersion
 */
class Post extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Posttype' => array(
				'className' => 'Posttype',
				'foreignKey' => 'posttype_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		),
	);
	
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PostVersion' => array(
			'className' => 'PostVersion',
			'foreignKey' => 'post_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'foreign_id',
			'dependent' => true,
			'conditions' => 'Image.foreign_model="Post"',
			'fields' => '',
			'order' => 'Image.order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Document' => array(
			'className' => 'Document',
			'foreignKey' => 'foreign_id',
			'dependent' => true,
			'conditions' => 'Document.foreign_model="Post"',
			'fields' => '',
			'order' => 'Document.order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CategoryOrder' => array(
				'className' => 'CategoryOrder',
				'foreignKey' => 'post_id',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		)
	);
	
	public function selectedCategories($id=null) {
		$post = $this->find('first', array('conditions'=>array('Post.id' => $id)));
		$selected = array();
		foreach ($post['CategoryOrder'] as $catOrd) {
			$selected[]=$catOrd['category_id'];
		}
		return $selected;
	}
	

}
