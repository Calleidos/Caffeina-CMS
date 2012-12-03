<tr id="image-<?php echo $element["id"] ?>">
	<td>
		<?php 
			echo $this->Form->input("Image.{$element['id']}.id", array("value" => $element['id'], "type"=>"hidden"));
			echo $this->Form->input("Image.{$element['id']}.posttype_id", array("type"=>"hidden"));
		?>
		<button onclick="cancelFileSave(<?php echo $element['id'] ?>, 'image'); return false;" class="act btn_red"><?php echo __("Cancel"); ?></button>
		<button onclick="saveFile(<?php echo $element['id'] ?>, 'image'); return false;" class="act btn_green"><?php echo __("Save file"); ?></button>
	</td>
	<td>
		<?php echo $this->Form->input("Image.{$element['id']}.name", array("value" => $element['name'], 'label' => false, "class" => "page-title ui-corner-all tabs_input")); ?>
	</td>
	<td>
		<?php echo $this->Form->input("Image.{$element['id']}.imagetype_id", array("selected" => $element['imagetype_id'], 'label' => false, 'type'=>'select', 'options'=>$this->requestAction(array('controller' => 'imagetypes', 'action' => 'admin_listImageTypes' ), array('pass' => array($element['posttype_id']))), "class" => "styledselect")); ?>
	</td>
	<td>
		&nbsp;
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