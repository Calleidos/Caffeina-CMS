<div class="languages form">
<?php echo $this->Form->create('Language');?>
	<fieldset>
		<legend><?php echo __('Admin Add Language'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('flag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Languages'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Product Versions'), array('controller' => 'product_versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Version'), array('controller' => 'product_versions', 'action' => 'add')); ?> </li>
	</ul>
</div>
