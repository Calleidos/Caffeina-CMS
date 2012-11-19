<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property ProductVersion $ProductVersion
 */
class Product extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ProductVersion' => array(
			'className' => 'ProductVersion',
			'foreignKey' => 'product_id',
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
			'conditions' => 'Image.foreign_model="Product"',
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
			'conditions' => 'Document.foreign_model="Product"',
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
				'foreignKey' => 'product_id',
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

}
