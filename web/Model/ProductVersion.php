<?php
App::uses('AppModel', 'Model');
/**
 * ProductVersion Model
 *
 * @property Language $Language
 * @property Product $Product
 */
class ProductVersion extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	var $actsAs = array(
		'Sluggable' => array(
			'title_field' => 'name',
			'slug_field' => 'slug',
			'slug_max_length' => 100
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
