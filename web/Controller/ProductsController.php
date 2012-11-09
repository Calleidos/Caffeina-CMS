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
		$this->paginate['contain']=array('Category', "ProductVersion");
		$products=$this->paginate();
		foreach ($products as $key=>$product) {
			$pvs=array();
			foreach ($product['ProductVersion'] as $pv)
				$pvs[$pv['language_id']]=$pv;
			$products[$key]['ProductVersion']=$pvs;
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
		$nestedCategories=$this->Product->Category->find('threaded', array('conditions'=> array('Category.foreign_model' => 'Product')));
		
		$categoryTree=$this->Product->Category->generateTreeList(array('Category.foreign_model' => 'Product'));
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
	
	public function admin_order() {
		$id = $this->data['id'];
		$order = $this->data['order'];
		$this->Product->recursive=0;
		$product=$this->Product->find('first', array('conditions' => array('Product.id'=>$id)));
		$changeId=$this->Product->find('first', array('conditions' => array('Product.order'=>$product['Product']['order']+$order)));
		$orderProduct=$product['Product']['order'];
		$orderChangeId=$changeId['Product']['order'];
		$product['Product']['order']=$orderChangeId;
		$changeId['Product']['order']=$orderProduct;
		$this->Product->save($product);
		$this->Product->save($changeId);
		$this->autoRender=false;
	}
	
	public function admin_reorder() {
		$this->Product->recursive=0;
		$products=$this->Product->find("all", array("order"=>array("Product.order")));
		$i=1;
		foreach($products as $key=>$product){
			$products[$key]['Product']['order']=$i;
			$i++; 
		}
		$this->Product->saveMany($products);
		$this->autoRender=false;
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
			if ($this->Product->saveAll($this->request->data)) {
				$id=$this->Product->id;
				foreach ($this->request->data['Image'] as $image) {
					$image['foreign_id']=$id;
					$this->Product->Image->save($image);
				}
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Product->Category->generateTreeList(null, null, null, "- ");
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
			if ($this->Product->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$product = $this->Product->find('first', array('conditions'=>array('Product.id' => $id)));
			$versions=array();
			foreach ($product['ProductVersion'] as $pv)
				$versions[$pv['language_id']]=$pv;
			$product['ProductVersion']=$versions;
			$this->request->data=$product;
		}
		$categories = $this->Product->Category->generateTreeList(null, null, null, "- ");
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
			$this->Session->setFlash(__('Product deleted'));
			$this->admin_reorder();
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

