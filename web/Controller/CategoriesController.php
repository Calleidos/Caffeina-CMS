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

        $this->set('totalCategories', $this->Category->find('count'));
        $this->set("categories" , $data);
    }
    
    public function admin_viewposts($id=null) {
    	$this->Category->id = $id;
    
    	if (!$this->Category->exists()) {
    		throw new NotFoundException(__('Invalid category'));
    	}
    	$category=$this->Category->read(null, $id);
    
    	$this->set('category', $category);
    	$ids=array();
    	
    	$categoryOrders=$this->Category->CategoryOrder->find('list', array('conditions' => array('category_id' => $id ), 'order' => array('order'), 'fields' => array('post_id', 'order')));
    	$posts=$this->Category->CategoryOrder->Post->find('all', array('conditions' => array('id' => array_keys($categoryOrders))));
    	$prod=array();
    	
    	foreach($posts as $post) {
    		$prod[$categoryOrders[$post['Post']['id']]]=$post;
    		$prod[$categoryOrders[$post['Post']['id']]]['Post']['order']=$categoryOrders[$post['Post']['id']];
    	}
    	
    	$posts=$prod;
    	
    	ksort($posts);
    	
    	pr($posts);
    	
    	foreach ($posts as $key=>$post) {
    		$pvs=array();
    		foreach ($post['PostVersion'] as $pv)
    			$pvs[$pv['language_id']]=$pv;
    		$posts[$key]['PostVersion']=$pvs;
    	}
    	
    	$this->set('posts', $posts);
    
    	$this->set('totalPosts', count($posts));
    
    
    }

	public function view($permalink = null, $language=null) {
		$category=$this->Category->findBySlug($permalink);
		$this->Category->id = $category['Category']['id'];

		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		
		$posts=array();
		
		foreach($category['Post'] as $post) {
			$posts[]=$post['id'];
		}
		$this->set('category', $permalink);
		$this->set('posts', $this->Category->Post->PostVersion->find('all', array('conditions' => array('Language.iso' => $language, 'PostVersion.post_id' => $posts, 'PostVersion.active' => 2), 'order' => array('Post.order'))));
		
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
				/*$this->Session->setFlash(__('The category has been saved'));*/

				$this->_flash(__('The category has been saved.', true),'green');
				
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The category could not be saved. Please, try again.'));*/
			$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
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
				/*$this->Session->setFlash(__('The category has been saved'));*/

				$this->_flash(__('The category has been saved.', true),'green');
				
				$this->redirect(array('action' => 'admin_close', $this->Category->id));
			} else {
				/*$this->Session->setFlash(__('The category could not be saved. Please, try again.'));*/
			$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
			}
		}
		$parentCategories = $this->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('parentCategories'));
		if (isset($model))
			$this->set("model", $model);
		$this->render('admin_edit');
		$this->layout = 'iframe';
	}
	
	public function admin_close($id) {
		$this->set("id", $id);
		$this->layout = 'iframe';
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
				/*$this->Session->setFlash(__('The category has been saved'));*/

				$this->_flash(__('The category has been saved.', true),'green');
				
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The category could not be saved. Please, try again.'));*/
				$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
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
			/*$this->Session->setFlash(__('Category deleted'));*/

			$this->_flash(__('Category deleted!', true),'green');
			
			$this->redirect(array('action' => 'index'));
		}
		/*$this->Session->setFlash(__('Category was not deleted'));*/
			$this->_flash(__('Category was not deleted.', true),'red');
		$this->redirect(array('action' => 'index'));
	}
	
	
	
	public function admin_order() {
		
		pr($this->data);
				
		$id = $this->data['id'];
		$order = $this->data['order'];
		$category = $this->data['category'];
		$post=$this->Category->CategoryOrder->find('first', array('conditions' => array('post_id'=>$id, 'category_id' => $category)));
		$changeId=$this->Category->CategoryOrder->find('first', array('conditions' => array('order'=>$post['CategoryOrder']['order']+$order, 'category_id' => $category)));
		$orderPost=$post['CategoryOrder']['order'];
		$orderChangeId=$changeId['CategoryOrder']['order'];
		$post['CategoryOrder']['order']=$orderChangeId;
		$changeId['CategoryOrder']['order']=$orderPost;
		$this->Category->CategoryOrder->save($post);
		$this->Category->CategoryOrder->save($changeId);
		$this->autoRender=false;
	}
	
	
}
