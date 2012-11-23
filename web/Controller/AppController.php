<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	public function generateHabtmJoin ($modelName, $joinType = 'INNER') {
		// If the relation does not exist, return an empty array.
		if (!isset($this->hasAndBelongsToMany[$joinModel])) {
			return array();
		}
	 
		// Init joins, and get HABTM relation.
		$joins = array();
		$assoc = $this->hasAndBelongsToMany[$joinModel];
	 
		// Add the join table.
		$bind = "{$assoc['with']}.{$assoc['foreignKey']} = {$this->alias}.{$this->primaryKey}";
		$joins[] = array(
			'table' => $assoc['joinTable'],
			'alias' => $assoc['with'],
			'type' => $joinType,
			'foreignKey' => false,
			'conditions' => array($bind),
		);
	 
		// Add the next table.
		$bind = "{$joinModel}.{$this->{$joinModel}->primaryKey} = {$assoc['with']}.{$assoc['associationForeignKey']}";
		$joins[] = array(
			'table' => $this->{$joinModel}->table,
			'alias' => $joinModel,
			'type' => $joinType,
			'foreignKey' => false,
			'conditions' => array($bind),
		);
	 
		return $joins;
	}
	
	function beforeFilter() {
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			$this->layout = 'admin';
		}
		
		
	}
	function _flash($message,$type='message') {
		$messages = (array)$this->Session->read('Message.multiFlash');
		$messages[] = array(
				'message'=>$message,
				'layout'=>'default',
				'element'=>'message',
				'params'=>array('class'=>$type),
		);
		$this->Session->write('Message.multiFlash', $messages);
	}
}