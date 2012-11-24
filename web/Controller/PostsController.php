<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PostsController extends AppController {

	
	public $helpers = array('TinyMce.TinyMce', "View");
	
	
	
	public $paginate = array(
        'order' => array(
            'Post.order' => 'asc'
		),
		'conditions' => array(
			'Post.deleted' => 0
		)
    );
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

/**
 * admin index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Post->recursive=-1;
		$this->Post->Behaviors->attach('Containable');
		$this->paginate['contain']=array('CategoryOrder', "PostVersion");
		$categories=$this->Post->CategoryOrder->Category->find('list', array('fields'=> array('id', 'name')));
		$posts=$this->paginate();
		foreach ($posts as $key=>$post) {
			$pvs=array();
			foreach ($post['PostVersion'] as $pv)
				$pvs[$pv['language_id']]=$pv;
			$posts[$key]['PostVersion']=$pvs;
			foreach ($post['CategoryOrder'] as $catOrd)
				$posts[$key]['Category'][]=array('id' => $catOrd['category_id'], 'name' => $categories[$catOrd['category_id']] );
		}
		$this->set('posts', $posts);
		$this->set('totalPosts', $this->Post->find('count'));
	}
	
	public function admin_trash() {
		$this->Post->recursive=-1;
		$categories=$this->Post->CategoryOrder->Category->find('list', array('fields'=> array('id', 'name')));
		$posts=$this->Post->find('all', array('conditions' => array('deleted' => 1)));
		foreach ($posts as $key=>$post) {
			$pvs=array();
			foreach ($post['PostVersion'] as $pv)
				$pvs[$pv['language_id']]=$pv;
			$posts[$key]['PostVersion']=$pvs;
			foreach ($post['CategoryOrder'] as $catOrd)
				$posts[$key]['Category'][]=array('id' => $catOrd['category_id'], 'name' => $categories[$catOrd['category_id']] );
		}
		$this->set('posts', $posts);
		$this->set('totalPosts', $this->Post->find('count'));
		$this->render("admin_index");
	}
	
	
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}
	


/**
 * admin_index method
 *
 * @return void
 *//*
	public function admin_index() {
		$nestedCategories=$this->Post->CategoryOrder->Category->find('threaded', array('conditions'=> array('Category.foreign_model' => 'Post')));
		
		$categoryTree=$this->Post->CategoryOrder->Category->generateTreeList(array('Category.foreign_model' => 'Post'));
		//pr($categoryTree);
		//pr($nestedCategories);
		
		//$nestedCategories=$this->listNestedCategories();
		$this->set("nestedCategories", $nestedCategories);
		
		
		
		$posts=$this->Post->find("all");
		foreach ($posts as $post) {
			$ids[]=$post['Post']['id'];
		}
		
		$pvs=$this->Post->PostVersion->find("all", array("conditions" => array('post_id' => $ids)));
		$postVersions=array();
		foreach ($pvs as $key=>$pv) {
			$postVersions[$pv["PostVersion"]['post_id']][$pv["PostVersion"]['language_id']]=$pv;
		}
		$this->set("postVersions", $postVersions);
		/*
		$this->Post->recursive = 0;
		$posts=$this->paginate();
		foreach ($posts as $post) {
			$ids[]=$post['Post']['id'];
		}
		*//*
		$this->set("languages", $this->Post->PostVersion->Language->find("all", array('conditions'=>array('active' => 1))));
		
	}*/

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}
	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			foreach ($this->request->data["PostVersion"] as $id=>$pv) {
				if (trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['seo_title']))=='')
					$this->request->data["PostVersion"][$id]['seo_title']=trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['name']));
			}
			$categories=$this->request->data['CategoryOrder'];
			unset($this->request->data['CategoryOrder']);
			
			if ($this->Post->saveAll($this->request->data)) {
				$id=$this->Post->id;
				foreach ($this->request->data['Image'] as $image) {
					$image['foreign_id']=$id;
					$this->Post->Image->save($image);
				}
				$defC=array();
				foreach ($categories['category_id'] as $cat) {
					$defC[$cat]=array('CategoryOrder' => array(
							'post_id' 	=> $id,
							'category_id' 	=> $cat,
							'order'			=> count($this->Post->CategoryOrder->find('list', array('conditions' => array('category_id' => $cat))))+1
					));
				}
				if(!empty($defC))
					$this->Post->CategoryOrder->saveAll($defC);
				/*$this->Session->setFlash(__('The post has been saved'));*/

				$this->_flash(__('The post has been saved.', true),'green');
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The post could not be saved. Please, try again.'));*/

				$this->_flash(__('The post could not be saved. Please, try again.', true),'red');
				
			}
		}
		$categories = $this->Post->CategoryOrder->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('categories'));
		$languages=$this->Post->PostVersion->Language->find('list', array('order' => array('Language.order')));
		$this->set("languages", $languages);
		$this->set('order', $this->Post->find('count')+1);
		$this->render("admin_edit");
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			foreach ($this->request->data["PostVersion"] as $id=>$pv) {
				if (trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['seo_title']))=='')
					$this->request->data["PostVersion"][$id]['seo_title']=trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['name']));
			}
			$categories=$this->Post->CategoryOrder->find('all', array('conditions' => array('post_id' => $this->request->data['Post']['id']), 'fields' => array('id', 'category_id', 'post_id', 'order')));
			$originalCat=$this->Post->CategoryOrder->find('list', array('conditions' => array('post_id' => $this->request->data['Post']['id']), 'fields' => array('id')));
			$c=array();
			foreach ($categories as $cat)
				$c[$cat['CategoryOrder']['category_id']]=$cat;
			$categories=$this->request->data['CategoryOrder'];
			unset($this->request->data['CategoryOrder']);
			$defC=array();
			foreach ($categories['category_id'] as $cat) {
				if (!array_key_exists($cat, $c)) {
					$defC[$cat]=array('CategoryOrder' => array(
						'post_id' 	=> $this->request->data['Post']['id'],
						'category_id' 	=> $cat,
						'order'			=> count($this->Post->CategoryOrder->find('list', array('conditions' => array('category_id' => $cat))))+1
					));
				} else {
					$defC[$cat]=$c[$cat];
				}
			}
			
			if ($this->Post->saveAll($this->request->data)) {
				if(!empty($originalCat))
					$this->Post->CategoryOrder->deleteAll(array('CategoryOrder.id'=>$originalCat));
				if(!empty($defC))
					$this->Post->CategoryOrder->saveAll($defC);
				/*$this->Session->setFlash(__('The post has been saved'));*/
				$this->_flash(__('The post has been saved.', true),'green');
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The post could not be saved. Please, try again.'));*/
				$this->_flash(__('The post could not be saved. Please, try again.', true),'red');
			}
		} else {
			$post = $this->Post->find('first', array('conditions'=>array('Post.id' => $id)));
			$versions=array();
			foreach ($post['PostVersion'] as $pv)
				$versions[$pv['language_id']]=$pv;
			$post['PostVersion']=$versions;
			$this->request->data=$post;
		}
		$categories = $this->Post->CategoryOrder->Category->generateTreeList(null, null, null, "- ");
		$selected = array();
		foreach ($post['CategoryOrder'] as $catOrd) {
			$selected[]=$catOrd['category_id'];
		}
		$this->set('selectedCategories', $selected);
		$this->set(compact('categories'));
		$this->set("languages", $this->Post->PostVersion->Language->find('list', array('conditions' => array('Language.active'=>true), 'order' => array('Language.order')) ));
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
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$data=array('Post' => array('id'=>$id, 'deleted' => 1));
		if ($this->Post->save($data)) {
			/*$this->Session->setFlash(__('Post deleted'));*/
	
			$this->_flash(__('Post has been deleted.', true),'green');
				
			$this->admin_reorder($this->Post->CategoryOrder->find('list', array('conditions' => array('post_id' => $id), 'fields' => array('category_id'))));
			$this->redirect(array('action' => 'index'));
		}
		/*$this->Session->setFlash(__('Post was not deleted'));*/
	
		$this->_flash(__('Post was not deleted.', true),'red');
			
			
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_finalDelete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->Post->delete()) {
			/*$this->Session->setFlash(__('Post deleted'));*/

			$this->_flash(__('Post has been deleted.', true),'green');
			
			$this->admin_reorder($this->Post->CategoryOrder->find('list', array('conditions' => array('post_id' => $id), 'fields' => array('category_id'))));
			$this->redirect(array('action' => 'index'));
		}
		/*$this->Session->setFlash(__('Post was not deleted'));*/

			$this->_flash(__('Post was not deleted.', true),'red');
			
			
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_reorder($categories=null) {
		if ($categories<>null && !empty($categories) ) {
			foreach ($categories as $category) {
				$this->Category->CategoryOrder->recursive=0;
				$posts=$this->Category->CategoryOrder->find("all", array('conditions' => array('category_id' => $category, 'Product.deleted' => 0), "order"=>array("order")));
				$i=1;
				foreach($posts as $key=>$post){
					$posts[$key]['CategoryOrder']['order']=$i;
					$i++;
				}
				$this->Category->CategoryOrder->saveMany($posts);
				$this->autoRender=false;
			}
		}
	}
	
	
}

