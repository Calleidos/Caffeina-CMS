<tr id="document-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Document.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.posttype_id", array("type"=>"hidden"));
		?>
		<button onclick="cancelFileSave(<?php echo $element['id'] ?>, 'document'); return false;" class="act btn_red"><?php echo __("Cancel"); ?></button>
		<button onclick="saveFile(<?php echo $element['id'] ?>, 'document'); return false;" class="act btn_green"><?php echo __("Save file"); ?></button>
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.name", array("value" => $element['name'], 'label' => false, "class" => "page-title ui-corner-all tabs_input")); ?>
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.documenttype_id", array("selected" => $element['documenttype_id'], 'label' => false, 'type'=>'select', 'options'=>$this->requestAction(array('controller' => 'documenttypes', 'action' => 'admin_listDocumentTypes' ), array('pass' => array($element['posttype_id']))), "class" => "styledselect")); ?>
	</td>
	<td>
		&nbsp;
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.description", array("value" => $element['description'], 'label' => false, "div" => array("id" => "Document{$element['id']}DescriptionTextArea" ), "class" => "page-title ui-corner-all tabs_input")); ?>
	</td>
	<td>
		&nbsp;
	</td>
</tr>