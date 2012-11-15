<tr class="file-row" id="document-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Document.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			if (isset($element['foreign_id'])) 
				echo $this->Form->input("Document.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.name", array("value" => $element['name'], "type"=>"hidden"));
			echo $this->Form->input("Document.{$element['id']}.tipologia", array("value" => $element['tipologia'], "type"=>"hidden"));
		?>
		<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteFile(<?php echo $element['id'] ?>, 'document');} return false;" class="act btn_red"><?php echo __("Delete file"); ?></button>
		<button onclick="editFile(<?php echo $element['id'] ?>, 'document'); return false;" class="act btn_yellow"><?php echo __("Edit file"); ?></button>
	</td>
	<td>
		<?php echo $element['name'] ?>
	</td>
	<td>
		<?php echo $element['tipologia'] ?>
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