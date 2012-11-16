<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'Uploader.Uploader');
/**
 * Images Controller
 *
 * @property Image $Image
 */
class ImagesController extends AppController {
	
	
	
	public function admin_add($foreign_model, $foreign_id=null) {
		if ($this->request->is('post')) {
			$this->Image->create();
			$this->request->data['Image']['original_name']=$_FILES['data']['name']['Image']['fileName'];
			
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The Image has been saved'));
				$this->redirect(array('action' => 'admin_close', $this->Image->id));
			} else {
				$this->Session->setFlash(__('The Image could not be saved. Please, try again.'));
			}
		}
		if (!isset($foreign_id))
			$foreign_id=0;
		$this->set("foreign_model", $foreign_model);
		$this->set("foreign_id", $foreign_id);
		$this->layout="iframe";
		
	}
	
	public function admin_close($id) {
		$this->set("id", $id);
	}
	
	public function admin_deleteAjax() {
		$this->Image->id = $this->request->data['id'];
		$this->Image->delete();
		$this->autoRender=false;
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid Image'));
		}
		if ($this->Image->delete()) {
			$this->Session->setFlash(__('Image deleted'));
		}
		$this->Session->setFlash(__('Image was not deleted'));
		
		$this->autoRender=false;
	}

	
	function admin_addRow() {
		$this->set("element", $this->Image->read(null, $this->request->data['id']));
		$this->layout= "ajax";
	}
	
	function admin_addEditRow() {
		$this->set("element", $this->Image->read(null, $this->request->data['id']));
		$this->layout= "ajax";
	}
	
	function admin_saveAjax() {
		$image['Image']=$this->request->data;
		$this->Image->save($image);
		$this->set("element", $this->Image->read(null, $this->request->data['id']));
		$this->layout= "ajax";
		$this->render("admin_addRow");
	}
	
	
}
