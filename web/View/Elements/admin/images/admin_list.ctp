<tr class="file-row" id="image-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Image.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.posttype_id", array("value" => $element['posttype_id'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.name", array("value" => $element['name'], "type"=>"hidden"));
		?>
		<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteFile(<?php echo $element['id'] ?>, 'image');} return false;" class="act btn_red"><?php echo __("Delete file"); ?></button>
		<button onclick="editFile(<?php echo $element['id'] ?>, 'image'); return false;" class="act btn_yellow"><?php echo __("Edit file"); ?></button>
	</td>
	<td>
		<?php echo $element['name'] ?>
	</td>
	<td>
		<?php
		$types=$this->requestAction(array('controller' => 'imagetypes', 'action' => 'admin_listImageTypes' ), array('pass' => array($element['posttype_id'])));
		echo $types[$element['imagetype_id']] ?>
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