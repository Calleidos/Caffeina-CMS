<?php
App::uses('AppController', 'Controller');
/**
 * ProductVersions Controller
 *
 * @property ProductVersion $ProductVersion
 */
class ProductVersionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProductVersion->recursive = 0;
		$this->set('productVersions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($slug=null, $language=null) {
		$pv=$this->ProductVersion->find('first', array('conditions'=> array('slug' => $slug, 'Language.iso' => $language)));
		$this->ProductVersion->id = $pv['ProductVersion']['id'];
		pr($pv);
		if (!$this->ProductVersion->exists() || !($pv['ProductVersion']['active'])) {
			throw new NotFoundException(__('Invalid product version'));
		}
		$this->set('productVersion', $pv);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductVersion->create();
			if ($this->ProductVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The product version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product version could not be saved. Please, try again.'));
			}
		}
		$languages = $this->ProductVersion->Language->find('list');
		$products = $this->ProductVersion->Product->find('list');
		$this->set(compact('languages', 'products'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ProductVersion->id = $id;
		if (!$this->ProductVersion->exists()) {
			throw new NotFoundException(__('Invalid product version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The product version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ProductVersion->read(null, $id);
		}
		$languages = $this->ProductVersion->Language->find('list');
		$products = $this->ProductVersion->Product->find('list');
		$this->set(compact('languages', 'products'));
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
		$this->ProductVersion->id = $id;
		if (!$this->ProductVersion->exists()) {
			throw new NotFoundException(__('Invalid product version'));
		}
		if ($this->ProductVersion->delete()) {
			$this->Session->setFlash(__('Product version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product version was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ProductVersion->recursive = 0;
		$this->set('productVersions', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ProductVersion->id = $id;
		if (!$this->ProductVersion->exists()) {
			throw new NotFoundException(__('Invalid product version'));
		}
		$this->set('productVersion', $this->ProductVersion->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ProductVersion->create();
			if ($this->ProductVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The product version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product version could not be saved. Please, try again.'));
			}
		}
		$languages = $this->ProductVersion->Language->find('list');
		$products = $this->ProductVersion->Product->find('list');
		$this->set(compact('languages', 'products'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->ProductVersion->id = $id;
		if (!$this->ProductVersion->exists()) {
			throw new NotFoundException(__('Invalid product version'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ProductVersion->save($this->request->data)) {
				$this->Session->setFlash(__('The product version has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product version could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ProductVersion->read(null, $id);
		}
		$languages = $this->ProductVersion->Language->find('list');
		$products = $this->ProductVersion->Product->find('list');
		$this->set(compact('languages', 'products'));
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
		$this->ProductVersion->id = $id;
		if (!$this->ProductVersion->exists()) {
			throw new NotFoundException(__('Invalid product version'));
		}
		if ($this->ProductVersion->delete()) {
			$this->Session->setFlash(__('Product version deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product version was not deleted'));
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
		$pv['ProductVersion']=$this->request->data;
		$this->ProductVersion->save($pv);
		$this->autoRender=false;
	}
}