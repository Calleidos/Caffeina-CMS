<tr class="file-row" id="document-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Document.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.posttype_id", array("value" => $element['posttype_id'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.name", array("value" => $element['name'], "type"=>"hidden"));
		?>
		<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteFile(<?php echo $element['id'] ?>, 'document');} return false;" class="act btn_red"><?php echo __("Delete file"); ?></button>
		<button onclick="editFile(<?php echo $element['id'] ?>, 'document'); return false;" class="act btn_yellow"><?php echo __("Edit file"); ?></button>
	</td>
	<td>
		<?php echo $element['name'] ?>
	</td>
	<td><?php
		$types=$this->requestAction(array('controller' => 'documenttypes', 'action' => 'admin_listDocumentTypes' ), array('pass' => array($element['posttype_id'])));
		echo $types[$element['documenttype_id']] ?>
	</td>
	<td class="order-icons">
		<?php echo $element['order'] ?>
	</td>
	<td>
		<?php echo $element['description'] ?>
	</td>
	<td>
		<button onClick="window.open('<?php echo $element['uploadPath'] ?>'); return false;" class="act btn_grey"><?php echo __("View Document"); ?></button>
	</td>
</tr>