<?php
App::uses('AppModel', 'Model');
/**
 * Imagetype Model
 *
 * @property Image $Image
 * @property Posttype $Posttype
 */
class Imagetype extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'imagetype_id',
			'dependent' => false,
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array('Posttype');

}
