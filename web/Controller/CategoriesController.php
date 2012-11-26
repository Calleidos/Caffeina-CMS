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
	public function admin_index($posttype=null) {
		$this->Category->Posttype->id = $posttype;
		if (!$this->Category->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		$this->Category->Posttype->recursive=-1;
		$this->set("posttype", $this->Category->Posttype->find('first', array('conditions' => array('id'=>$posttype))));
		
        $data = $this->Category->generateTreeListPostType($posttype);

        $this->set('totalCategories', count($data));
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
    	$posts=$this->Category->CategoryOrder->Post->find('all', array('conditions' => array('Post.id' => array_keys($categoryOrders), 'Post.deleted' => 0)));
    	$prod=array();
    	
    	foreach($posts as $post) {
    		$prod[$categoryOrders[$post['Post']['id']]]=$post;
    		$prod[$categoryOrders[$post['Post']['id']]]['Post']['order']=$categoryOrders[$post['Post']['id']];
    	}
    	
    	$posts=$prod;
    	
    	ksort($posts);
    	
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
	public function admin_add($posttype=null) {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->_flash(__('The category has been saved.', true),'green');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
			}
		}
		
		if (isset($this->request->data['Category']['posttype_id']))
			$posttype=$this->request->data['Category']['posttype_id'];
		
		$parentCategories=$this->Category->generateTreeListPostType($posttype);
		$parentCategories=array($this->Category->getPostTypeParent($posttype) => __("Nessun Genitore"))+$parentCategories;
		$this->set(compact('parentCategories'));
		
		$this->render('admin_edit');
	}

/**
 * addAjax method
 *
 * @return void
 */
	public function admin_addAjax($posttype=null) {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->request->data['Category']['posttype_id']=$posttype;
			if ($this->Category->save($this->request->data)) {
				$this->redirect(array('action' => 'admin_close', $this->request->data['Category']['posttype_id']));
			} else {
				$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
			}
		}
		$parentCategories=$this->Category->generateTreeListPostType($posttype);
		$parentCategories=array($this->Category->getPostTypeParent($posttype) => __("Nessun Genitore"))+$parentCategories;
		$this->set(compact('parentCategories'));
		$this->layout = 'iframe';
		$this->render('admin_edit');
	}
	
	public function admin_close( $posttypeId) {
		$this->set("posttypeId", $posttypeId);
		$this->layout = 'iframe';
	}
	
	public function admin_createSelect() {
		$posttype=$this->data['posttypeId'];
		$parentCategories=$this->Category->generateTreeListPostType($posttype);
		$this->set(compact('parentCategories'));
		$this->set("posttype", $posttype);
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
				$this->_flash(__('The category has been saved.', true),'green');
				$this->redirect(array('action' => 'index', $this->request->data['Category']['posttype_id']));
			} else {
				$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
			}
		} else {
			$this->request->data = $this->Category->read(null, $id);
		}
		$posttype=$this->request->data['Category']['posttype_id'];
		$parentCategories=$this->Category->generateTreeListPostType($posttype);
		$parentCategories=array($this->Category->getPostTypeParent($posttype) => __("Nessun Genitore"))+$parentCategories;
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
		
		$this->Category->recursive=-1;
		$category=$this->Category->read(null, $id);
		
		if ($this->Category->delete()) {
			/*$this->Session->setFlash(__('Category deleted'));*/

			$this->_flash(__('Category deleted!', true),'green');
			
			$this->redirect(array('action' => 'index', $category['Category']['posttype_id']));
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
