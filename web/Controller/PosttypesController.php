<?php
App::uses('AppController', 'Controller');
/**
 * Posttypes Controller
 *
 * @property Posttype $Posttype
 */
class PosttypesController extends AppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Posttype->recursive = 0;
		$this->set('posttypes', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Posttype->id = $id;
		if (!$this->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		$this->set('posttype', $this->Posttype->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Posttype->create();
			if ($this->Posttype->save($this->request->data)) {
				$this->Session->setFlash(__('The posttype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The posttype could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Posttype->id = $id;
		if (!$this->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Posttype->save($this->request->data)) {
				$this->Session->setFlash(__('The posttype has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The posttype could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Posttype->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Posttype->id = $id;
		if (!$this->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		if ($this->Posttype->delete()) {
			$this->Session->setFlash(__('Posttype deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Posttype was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
