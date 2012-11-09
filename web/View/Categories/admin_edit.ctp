<div class="categories">
<?php echo $this->Form->create('Category');?>
	<fieldset>
		<legend><?php echo __('Edit Category'); ?></legend>
	<?php
		$this->TinyMce->editor(
			array(
				'mode' => "textareas",
				'theme' => 'advanced',
				'theme_advanced_statusbar_location' => "bottom",
				'theme_advanced_toolbar_location' => "top",	
			)
		);
		if (isset($this->data['Category']['id']))
			echo $this->Form->input('id');
		if (isset($this->request->data['Category']['foreign_model']))
			$model=$this->request->data['Category']['foreign_model'];
		if (isset($model)) 
			echo $this->Form->input('foreign_model', array('type'=>'hidden', 'value'=>$model));
		echo $this->Form->input('parent_id', array('options'=>$parentCategories));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
