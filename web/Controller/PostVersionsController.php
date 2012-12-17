<?php
App::uses('AppController', 'Controller');
/**
 * PostVersions Controller
 *
 * @property PostVersion $PostVersion
 */
class PostVersionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PostVersion->recursive = 0;
		$this->set('postVersions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($slug=null, $language=null) {
		$pv=$this->PostVersion->find('first', array('conditions'=> array('slug' => $slug, 'Language.iso' => $language)));
		pr($pv);
		$this->PostVersion->id = $pv['PostVersion']['id'];
		pr($pv);
		pr($this->PostVersion->id);
		if (!$this->PostVersion->exists() || !($pv['PostVersion']['active'])) {
			throw new NotFoundException(__('Invalid post version'));
		}
		$this->set('postVersion', $pv);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PostVersion->create();
			if ($this->PostVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The post version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post version could not be saved. Please, try again.'));
			}
		}
		$languages = $this->PostVersion->Language->find('list');
		$posts = $this->PostVersion->Post->find('list');
		$this->set(compact('languages', 'posts'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PostVersion->id = $id;
		if (!$this->PostVersion->exists()) {
			throw new NotFoundException(__('Invalid post version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PostVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The post version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PostVersion->read(null, $id);
		}
		$languages = $this->PostVersion->Language->find('list');
		$posts = $this->PostVersion->Post->find('list');
		$this->set(compact('languages', 'posts'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PostVersion->id = $id;
		if (!$this->PostVersion->exists()) {
			throw new NotFoundException(__('Invalid post version'));
		}
		if ($this->PostVersion->delete()) {
			$this->Session->setFlash(__('Post version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Post version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->PostVersion->recursive = 0;
		$this->set('postVersions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->PostVersion->id = $id;
		if (!$this->PostVersion->exists()) {
			throw new NotFoundException(__('Invalid post version'));
		}
		$this->set('postVersion', $this->PostVersion->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->PostVersion->create();
			if ($this->PostVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The post version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post version could not be saved. Please, try again.'));
			}
		}
		$languages = $this->PostVersion->Language->find('list');
		$posts = $this->PostVersion->Post->find('list');
		$this->set(compact('languages', 'posts'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->PostVersion->id = $id;
		if (!$this->PostVersion->exists()) {
			throw new NotFoundException(__('Invalid post version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PostVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The post version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PostVersion->read(null, $id);
		}
		$languages = $this->PostVersion->Language->find('list');
		$posts = $this->PostVersion->Post->find('list');
		$this->set(compact('languages', 'posts'));
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
		$this->PostVersion->id = $id;
		if (!$this->PostVersion->exists()) {
			throw new NotFoundException(__('Invalid post version'));
		}
		if ($this->PostVersion->delete()) {
			$this->Session->setFlash(__('Post version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Post version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_ajaxActivate method
 *
 * @param string $id
 * @return void
 */
	public function admin_ajaxActivate() {
		if($this->request->data['active']=='false')
			$this->request->data['active']=0;
		else
			$this->request->data['active']=1;
		$pv['PostVersion']=$this->request->data;
		$this->PostVersion->save($pv);
		$this->autoRender=false;
	}
}