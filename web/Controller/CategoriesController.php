<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {

	public $helpers = array('TinyMce.TinyMce');
	
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
        $data = $this->Category->generateTreeList(null, null, null, '- ');
        debug($data); die;
    }

	public function view($permalink = null, $language=null) {
		$category=$this->Category->findBySlug($permalink);
		$this->Category->id = $category['Category']['id'];

		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		
		$products=array();
		
		foreach($category['Product'] as $product) {
			$products[]=$product['id'];
		}
		$this->set('category', $permalink);
		$this->set('products', $this->Category->Product->ProductVersion->find('all', array('conditions' => array('Language.iso' => $language, 'ProductVersion.product_id' => $products, 'ProductVersion.active' => 2), 'order' => array('Product.order'))));
		
	}
    
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id) {
		
		$this->Category->id = $id;

		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->set('category',  $this->Category->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add($model=null) {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$parentCategories = $this->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('parentCategories'));
		if (isset($model))
			$this->set("model", $model);
		$this->render('admin_edit');
	}

/**
 * addAjax method
 *
 * @return void
 */
	public function admin_addAjax($model=null) {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'admin_close', $this->Category->id));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$parentCategories = $this->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('parentCategories'));
		if (isset($model))
			$this->set("model", $model);
		$this->render('admin_edit');
	}
	
	public function admin_close($id) {
		$this->set("id", $id);
	}
	
	public function admin_createSelect($model=null) {
		$parentCategories = $this->Category->generateTreeList(array('foreign_model' => $model), null, null, "- ");
		$this->set(compact('parentCategories'));
		$this->layout= "ajax";
	}
	
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Category->read(null, $id);
		}
		$parentCategories = $this->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('parentCategories'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		/*if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}*/
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('Category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
