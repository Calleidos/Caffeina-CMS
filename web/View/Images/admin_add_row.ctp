<?php
	$element['Image']['posttype_id']=$element['Post']['posttype_id'];
	$this->set('element', $element['Image']);
	echo $this->element('/admin/images/admin_list');
?>