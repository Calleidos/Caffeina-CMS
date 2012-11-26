<?php
	if (!isset($selectedCategories))
		$selectedCategories=array();
	echo $this->Form->input('CategoryOrder.category_id', array('type' => 'select', 'multiple'=>"checkbox", 'div' =>"", 'label' => false, 'selected' => $selectedCategories, 'options' => $parentCategories));?>
	<a class="fancy-modal" href="/admin/categories/addAjax/<?php echo $posttype ?>">
		<button onclick="return false;" class="add-button act btn_green" style="height:25px;"><?php echo __("Add Category"); ?></button>
	</a>