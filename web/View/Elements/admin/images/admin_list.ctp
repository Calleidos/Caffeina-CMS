<tr class="file-row" id="image-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Image.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			if (isset($element['foreign_id'])) 
				echo $this->Form->input("Image.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.foreign_model", array("value" => $element['foreign_model'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.name", array("value" => $element['name'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.tipologia", array("value" => $element['tipologia'], "type"=>"hidden"));
		?>
		<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteFile(<?php echo $element['id'] ?>, 'image');} return false;" class="cancel-file"><?php echo __("Delete file"); ?></button>
		<button onclick="editFile(<?php echo $element['id'] ?>, 'image'); return false;" class="edit-file"><?php echo __("Edit file"); ?></button>
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
		<?php echo $element['width'] ?>x<?php echo $element['height'] ?>
	</td>
	<td>
		<a rel="fancy-images" href="<?php echo $element['uploadPath'] ?>">
			<img src="<?php echo $element['path_scaled'] ?>" alt="<?php echo $element['name'] ?>" title="<?php echo $element['name'] ?>" />
		</a>
	</td>
</tr>