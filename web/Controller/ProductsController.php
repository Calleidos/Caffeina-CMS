<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {

	
	public $helpers = array('TinyMce.TinyMce', "View");
	
	
	
	public $paginate = array(
        'order' => array(
            'Product.order' => 'asc'
		),
    );
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

/**
 * admin index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive=-1;
		$this->Product->Behaviors->attach('Containable');
		$this->paginate['contain']=array('CategoryOrder', "ProductVersion");
		$categories=$this->Product->CategoryOrder->Category->find('list', array('fields'=> array('id', 'name')));
		$products=$this->paginate();
		foreach ($products as $key=>$product) {
			$pvs=array();
			foreach ($product['ProductVersion'] as $pv)
				$pvs[$pv['language_id']]=$pv;
			$products[$key]['ProductVersion']=$pvs;
			foreach ($product['CategoryOrder'] as $catOrd)
				$products[$key]['Category'][]=array('id' => $catOrd['category_id'], 'name' => $categories[$catOrd['category_id']] );
		}
		$this->set('products', $products);
		$this->set('totalProducts', $this->Product->find('count'));
	}
	
	
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}
	


/**
 * admin_index method
 *
 * @return void
 *//*
	public function admin_index() {
		$nestedCategories=$this->Product->CategoryOrder->Category->find('threaded', array('conditions'=> array('Category.foreign_model' => 'Product')));
		
		$categoryTree=$this->Product->CategoryOrder->Category->generateTreeList(array('Category.foreign_model' => 'Product'));
		//pr($categoryTree);
		//pr($nestedCategories);
		
		//$nestedCategories=$this->listNestedCategories();
		$this->set("nestedCategories", $nestedCategories);
		
		
		
		$products=$this->Product->find("all");
		foreach ($products as $product) {
			$ids[]=$product['Product']['id'];
		}
		
		$pvs=$this->Product->ProductVersion->find("all", array("conditions" => array('product_id' => $ids)));
		$productVersions=array();
		foreach ($pvs as $key=>$pv) {
			$productVersions[$pv["ProductVersion"]['product_id']][$pv["ProductVersion"]['language_id']]=$pv;
		}
		$this->set("productVersions", $productVersions);
		/*
		$this->Product->recursive = 0;
		$products=$this->paginate();
		foreach ($products as $product) {
			$ids[]=$product['Product']['id'];
		}
		*//*
		$this->set("languages", $this->Product->ProductVersion->Language->find("all", array('conditions'=>array('active' => 1))));
		
	}*/

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}
	

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			foreach ($this->request->data["ProductVersion"] as $id=>$pv) {
				if (trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['seo_title']))=='')
					$this->request->data["ProductVersion"][$id]['seo_title']=trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['name']));
			}
			$categories=$this->request->data['CategoryOrder'];
			unset($this->request->data['CategoryOrder']);
			
			if ($this->Product->saveAll($this->request->data)) {
				$id=$this->Product->id;
				foreach ($this->request->data['Image'] as $image) {
					$image['foreign_id']=$id;
					$this->Product->Image->save($image);
				}
				$defC=array();
				foreach ($categories['category_id'] as $cat) {
					$defC[$cat]=array('CategoryOrder' => array(
							'product_id' 	=> $id,
							'category_id' 	=> $cat,
							'order'			=> count($this->Product->CategoryOrder->find('list', array('conditions' => array('category_id' => $cat))))+1
					));
				}
				if(!empty($defC))
					$this->Product->CategoryOrder->saveAll($defC);
				/*$this->Session->setFlash(__('The product has been saved'));*/

				$this->_flash(__('The product has been saved.', true),'green');
				
				
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The product could not be saved. Please, try again.'));*/

				$this->_flash(__('The product could not be saved. Please, try again.', true),'red');
				
			}
		}
		$categories = $this->Product->CategoryOrder->Category->generateTreeList(null, null, null, "- ");
		$this->set(compact('categories'));
		$languages=$this->Product->ProductVersion->Language->find('list', array('order' => array('Language.order')));
		$this->set("languages", $languages);
		$this->set('order', $this->Product->find('count')+1);
		$this->render("admin_edit");
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			foreach ($this->request->data["ProductVersion"] as $id=>$pv) {
				if (trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['seo_title']))=='')
					$this->request->data["ProductVersion"][$id]['seo_title']=trim(preg_replace("/[^a-zA-Z0-9\s]/", "_", $pv['name']));
			}
			$categories=$this->Product->CategoryOrder->find('all', array('conditions' => array('product_id' => $this->request->data['Product']['id']), 'fields' => array('id', 'category_id', 'product_id', 'order')));
			$originalCat=$this->Product->CategoryOrder->find('list', array('conditions' => array('product_id' => $this->request->data['Product']['id']), 'fields' => array('id')));
			$c=array();
			foreach ($categories as $cat)
				$c[$cat['CategoryOrder']['category_id']]=$cat;
			$categories=$this->request->data['CategoryOrder'];
			unset($this->request->data['CategoryOrder']);
			$defC=array();
			foreach ($categories['category_id'] as $cat) {
				if (!array_key_exists($cat, $c)) {
					$defC[$cat]=array('CategoryOrder' => array(
						'product_id' 	=> $this->request->data['Product']['id'],
						'category_id' 	=> $cat,
						'order'			=> count($this->Product->CategoryOrder->find('list', array('conditions' => array('category_id' => $cat))))+1
					));
				} else {
					$defC[$cat]=$c[$cat];
				}
			}
			
			if ($this->Product->saveAll($this->request->data)) {
				if(!empty($originalCat))
					$this->Product->CategoryOrder->deleteAll(array('CategoryOrder.id'=>$originalCat));
				if(!empty($defC))
					$this->Product->CategoryOrder->saveAll($defC);
				/*$this->Session->setFlash(__('The product has been saved'));*/
				$this->_flash(__('The product has been saved.', true),'green');
				$this->redirect(array('action' => 'index'));
			} else {
				/*$this->Session->setFlash(__('The product could not be saved. Please, try again.'));*/
				$this->_flash(__('The product could not be saved. Please, try again.', true),'red');
			}
		} else {
			$product = $this->Product->find('first', array('conditions'=>array('Product.id' => $id)));
			$versions=array();
			foreach ($product['ProductVersion'] as $pv)
				$versions[$pv['language_id']]=$pv;
			$product['ProductVersion']=$versions;
			$this->request->data=$product;
		}
		$categories = $this->Product->CategoryOrder->Category->generateTreeList(null, null, null, "- ");
		$selected = array();
		foreach ($product['CategoryOrder'] as $catOrd) {
			$selected[]=$catOrd['category_id'];
		}
		$this->set('selectedCategories', $selected);
		$this->set(compact('categories'));
		$this->set("languages", $this->Product->ProductVersion->Language->find('list', array('conditions' => array('Language.active'=>true), 'order' => array('Language.order')) ));
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->Product->delete()) {
			/*$this->Session->setFlash(__('Product deleted'));*/

			$this->_flash(__('Product has been deleted.', true),'green');
			
			$this->admin_reorder($this->Product->CategoryOrder->find('list', array('conditions' => array('product_id' => $id), 'fields' => array('category_id'))));
			$this->redirect(array('action' => 'index'));
		}
		/*$this->Session->setFlash(__('Product was not deleted'));*/

			$this->_flash(__('Product was not deleted.', true),'red');
			
			
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_reorder($categories=null) {
		if ($categories<>null && !empty($categories) ) {
			foreach ($categories as $category) {
				$this->Category->CategoryOrder->recursive=0;
				$products=$this->Category->CategoryOrder->find("all", array('conditions' => array('category_id' => $category), "order"=>array("order")));
				$i=1;
				foreach($products as $key=>$product){
					$products[$key]['CategoryOrder']['order']=$i;
					$i++;
				}
				$this->Category->CategoryOrder->saveMany($products);
				$this->autoRender=false;
			}
		}
	}
	
	
}

