<tr id="document-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Document.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			if (isset($element['foreign_id'])) 
				echo $this->Form->input("Document.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
		?>
		<button onclick="cancelFileSave(<?php echo $element['id'] ?>, 'document'); return false;" class="cancel-file-save"><?php echo __("Cancel"); ?></button>
		<button onclick="saveFile(<?php echo $element['id'] ?>, 'document'); return false;" class="save-file"><?php echo __("Save file"); ?></button>
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.name", array("value" => $element['name'], 'label' => false)); ?>
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.tipologia", array("value" => $element['tipologia'], 'label' => false, 'type'=>'select', 'options'=>Configure::read("tipologiaDocumento"))); ?>
	</td>
	<td>
		&nbsp;
	</td>
	<td>
		<?php echo $this->Form->input("Document.{$element['id']}.description", array("value" => $element['description'], 'label' => false, "div" => array("id" => "Document{$element['id']}DescriptionTextArea" ))); ?>
	</td>
	<td>
		&nbsp;
	</td>
</tr>