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
	
	
	public $components = array(
			'Session',
			'Auth' => array(
					'loginRedirect' => array('controller' => 'posts', 'action' => 'index', 1, 'prefix' => 'admin'),
					'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'prefix' => 'admin')
			)
	);
	
	function beforeFilter() {
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			$this->layout = 'admin';
		}
		if(isset($this->Auth)) {
		    if(isset($this->params['admin']) && $this->params['admin']) {
		      $this->Auth->allow('admin_login'); // allow backend login only
		    } else {
		      $this->Auth->allow(); // allow everything in frontend
		    }
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
	
	public function beforeRender() {
		$this->_configureErrorLayout();
	}
	
	public function _configureErrorLayout() {
		if ($this->name == 'CakeError') {
			if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
				if($this->Auth->User('id'))
					$this->layout="admin";
				else  
					$this->layout = false;
			} else {
				$this->layout = 'default';
			}
		}
	}
	
	
}