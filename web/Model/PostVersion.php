<?php
App::uses('AppModel', 'Model');
/**
 * PostVersion Model
 *
 * @property Language $Language
 * @property Post $Post
 */
class PostVersion extends AppModel {
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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
