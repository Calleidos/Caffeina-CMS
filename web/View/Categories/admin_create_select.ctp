<h3 class="ui-widget-header ui-corner-all"><?php echo __("Categories") ?></h3><?php
echo $this->Form->input('Category', array('type' => 'select', 'multiple'=>"checkbox", 'div' =>"ui-widget ui-widget-content ui-corner-all", 'label' => false, 'options' => $parentCategories));?>

<a class="fancy-modal" href="/admin/categories/addAjax">
	<button onclick="return false;" class="add-button"><?php echo __("Add Category"); ?></button>
</a>