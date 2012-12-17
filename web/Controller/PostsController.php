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

	public function beforeRender(){
		parent::beforeRender();
	}
		
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
	public function admin_index($posttype=null) {
		$this->Post->Posttype->id = $posttype;
		if (!$this->Post->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		$this->Post->Posttype->recursive=-1;
		$this->set("posttype", $this->Post->Posttype->find('first', array('conditions' => array('id'=>$posttype))));
		$this->Post->recursive=-1;
		$this->Post->Behaviors->attach('Containable');
		$this->paginate['contain']=array('CategoryOrder', "PostVersion");
		$categories=$this->Post->CategoryOrder->Category->find('list', array('fields'=> array('id', 'name')));
		$this->paginate['conditions']["Post.posttype_id"] = $posttype;
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
	
	public function admin_trash($posttype=null) {
		$this->Post->Posttype->id = $posttype;
		if (!$this->Post->Posttype->exists()) {
			throw new NotFoundException(__('Invalid posttype'));
		}
		$this->Post->Posttype->recursive=-1;
		$this->set("posttype", $this->Post->Posttype->find('first', array('conditions' => array('id'=>$posttype))));
		$categories=$this->Post->CategoryOrder->Category->find('list', array('fields'=> array('id', 'name')));
		$posts=$this->Post->find('all', array('conditions' => array('deleted' => 1, 'posttype_id' => $posttype)));
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
		$post=$this->Post->read(null, $id);
		if (isset($post['Posttype']['name']) && !empty($post['Posttype']['name'])) {
			$this->render("/{$post['Posttype']['name']}/index");
		}
		$this->set('post',$post);
	}
	

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
	public function admin_add($posttype=null) {
		if ($this->request->is('post')) {
			pr($this->request->data);
			die;
			$this->Post->create();
			foreach ($this->request->data["PostVersion"] as $id=>$pv) {
				if (trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['seo_title']))=='')
					$this->request->data["PostVersion"][$id]['seo_title']=trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['name']));
			}
			$categories=$this->request->data['CategoryOrder'];
			unset($this->request->data['CategoryOrder']);
			
			if ($this->Post->saveAll($this->request->data)) {
				$id=$this->Post->id;
				if (isset($this->request->data['Image'])) {
					foreach ($this->request->data['Image'] as $image) {
						$image['foreign_id']=$id;
						$this->Post->Image->save($image);
					}
				}
				$defC=array();
				if (isset($categories) && !empty($categories))  {
					foreach ($categories['category_id'] as $cat) {
						$defC[$cat]=array('CategoryOrder' => array(
								'post_id' 	=> $id,
								'category_id' 	=> $cat,
								'order'			=> count($this->Post->CategoryOrder->find('list', array('conditions' => array('category_id' => $cat))))+1
						));
					}
				}
				if(!empty($defC))
					$this->Post->CategoryOrder->saveAll($defC);
					$this->_flash(__('The post has been saved.', true),'green');		
					$this->redirect(array('action' => 'index', $this->request->data['Post']['posttype_id']));
			} else {
				$this->_flash(__('The post could not be saved. Please, try again.', true),'red');
			}
		}
		$this->request->data['Post']['posttype_id']=$posttype;
		$categories = $this->Post->CategoryOrder->Category->generateTreeListPostType($posttype);
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
				$this->redirect(array('action' => 'index', $this->request->data['Post']['posttype_id']));
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
		
		$posttype=$post['Post']['posttype_id'];
		
		$this->set('posttype', $posttype);
		$categories = $this->Post->CategoryOrder->Category->generateTreeListPostType($posttype);
		$this->set(compact('categories'));
		
		$this->set('selectedCategories', $this->Post->selectedCategories($post['Post']['id']));
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
		$data=$this->Post->read(null, $id);
		$data['Post']['deleted']=1;
		if ($this->Post->save($data)) {
				
			$this->_flash(__('Post has been deleted.', true),'green');
				
			$this->admin_reorder($this->Post->CategoryOrder->find('list', array('conditions' => array('post_id' => $id), 'fields' => array('category_id'))));
			$this->redirect(array('action' => 'index', $data['Post']['posttype_id']));
		}
			
		$this->_flash(__('Post was not deleted.', true),'red');
			
			
		$this->redirect(array('action' => 'index', $data['Post']['posttype_id']));
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
		$data=$this->Post->read(null, $id);
		if ($this->Post->delete()) {
			$this->_flash(__('Post has been deleted.', true),'green');
			
			$this->admin_reorder($this->Post->CategoryOrder->find('list', array('conditions' => array('post_id' => $id), 'fields' => array('category_id'))));
			$this->redirect(array('action' => 'index', $data['Post']['posttype_id']));
		}

		$this->_flash(__('Post was not deleted.', true),'red');
					
		$this->redirect(array('action' => 'index', $data['Post']['posttype_id']));
	}
	
	public function admin_reorder($categories=null) {
		if ($categories<>null && !empty($categories) ) {
			foreach ($categories as $category) {
				$this->Post->CategoryOrder->recursive=0;
				$posts=$this->Post->CategoryOrder->find("all", array('conditions' => array('category_id' => $category, 'Post.deleted' => 0), "order"=>array("order")));
				$i=1;
				foreach($posts as $key=>$post){
					$posts[$key]['CategoryOrder']['order']=$i;
					$i++;
				}
				$this->Post->CategoryOrder->saveMany($posts);
				$this->autoRender=false;
			}
		}
	}
	
	
}

