<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 * @property Post $Post
 */
class Category extends AppModel {
	
	var $actsAs = array(
		'Tree',
		'Sluggable' => array(
			'title_field' => 'name'
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		'ChildCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CategoryOrder' => array(
				'className' => 'CategoryOrder',
				'foreignKey' => 'category_id',
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
	
	
	public function generateTreeListPostType ($posttype=null) {
		$categories=$this->children($this->getPostTypeParent($posttype), false, 'id');
		$ids=array();
		foreach ($categories as $cat)
			$ids[]=$cat['Category']['id'];
		return $this->generateTreeList(array('id' => $ids), null, null, "- ");
		
	}
	
	public function getPostTypeParent ($posttype = null) {
		$this->recursive=-1;
		$conditions=$this->find('first', array('conditions' => array('Category.parent_id' => NULL, 'Category.posttype_id' =>$posttype), 'fields'=> array('id')));
		return $conditions['Category']['id'];
	}
	


}
