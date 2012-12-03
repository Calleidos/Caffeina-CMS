<?php
App::uses('AppController', 'Controller');
/**
 * Documenttypes Controller
 *
 * @property Image $Image
 */
class DocumenttypesController extends AppController {
	
	public function admin_listDocumentTypes($posttype) {
		$types=$this->Documenttype->DocumenttypesPosttype->find('list', array('conditions' => array('posttype_id' => $posttype), 'fields' => array('id')));
		$types=$this->Documenttype->find('list', array('conditions' => array('id' => $types)));
		return $types;
	}
}