<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'Uploader.Uploader');
/**
 * Documents Controller
 *
 * @property Document $Document
 */
class DocumentsController extends AppController {
	
	public $helpers = array('TinyMce.TinyMce');
	
	public function admin_add($foreign_model, $foreign_id=null) {
		if ($this->request->is('post')) {
			$this->Document->create();
			$this->request->data['Document']['original_name']=$_FILES['data']['name']['Document']['fileName'];
			
			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('The Document has been saved'));
				$this->redirect(array('action' => 'admin_close', $this->Document->id));
			} else {
				$this->Session->setFlash(__('The Document could not be saved. Please, try again.'));
			}
		}
		if (!isset($foreign_id))
			$foreign_id=0;
		$this->set("foreign_model", $foreign_model);
		$this->set("foreign_id", $foreign_id);
		
	}
	
	public function admin_close($id) {
		$this->set("id", $id);
	}
	
	public function admin_deleteAjax() {
		$this->Document->id = $this->request->data['id'];
		$this->Document->delete();
		$this->autoRender=false;
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			throw new NotFoundException(__('Invalid Document'));
		}
		if ($this->Document->delete()) {
			$this->Session->setFlash(__('Document deleted'));
		}
		$this->Session->setFlash(__('Document was not deleted'));
		
		$this->autoRender=false;
	}

	
	function admin_addRow() {
		$this->set("element", $this->Document->read(null, $this->request->data['id']));
		$this->layout= "ajax";
	}
	
	function admin_addEditRow() {
		$this->set("element", $this->Document->read(null, $this->request->data['id']));
		$this->layout= "ajax";
	}
	
	function admin_saveAjax() {
		$document['Document']=$this->request->data;
		$this->Document->save($document);
		$this->set("element", $this->Document->read(null, $this->request->data['id']));
		$this->layout= "ajax";
		$this->render("admin_addRow");
	}
	
	
}
