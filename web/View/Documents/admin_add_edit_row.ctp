<?php
	$element['Document']['posttype_id']=$element['Post']['posttype_id'];
	$this->set('element', $element['Document']);
	echo $this->element('/admin/documents/admin_edit_list');
?>