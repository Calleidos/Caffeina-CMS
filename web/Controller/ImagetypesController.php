<?php
App::uses('AppController', 'Controller');
/**
 * Imagetypes Controller
 *
 * @property Image $Image
 */
class ImagetypesController extends AppController {
	
	/**
	 * addAjax method
	 *
	 * @return void
	 */
	public function admin_addAjax() {
		if ($this->request->is('post')) {
			$this->Imagetype->create();
			if ($this->Imagetype->save($this->request->data)) {
				$this->set('id', $this->Imagetype->id);
				$this->set('name', $this->request->data['Imagetype']['name']);
				$this->render('admin_close');
			} else {
				$this->_flash(__('The category could not be saved. Please, try again.', true),'red');
			}
		}
		$this->layout = 'iframe';
		$this->render('admin_edit');
	}
	
	public function admin_listImageTypes($posttype) {
		$types=$this->Imagetype->ImagetypesPosttype->find('list', array('conditions' => array('posttype_id' => $posttype), 'fields' => array('id')));
		$types=$this->Imagetype->find('list', array('conditions' => array('id' => $types)));
		return $types;
	}
}