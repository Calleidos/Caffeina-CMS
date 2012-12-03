<?php
App::uses('AppController', 'Controller');
/**
 * Imagetypes Controller
 *
 * @property Image $Image
 */
class ImagetypesController extends AppController {
	
	
	
	public function admin_listImageTypes($posttype) {
		$types=$this->Imagetype->ImagetypesPosttype->find('list', array('conditions' => array('posttype_id' => $posttype), 'fields' => array('id')));
		$types=$this->Imagetype->find('list', array('conditions' => array('id' => $types)));
		return $types;
	}
}