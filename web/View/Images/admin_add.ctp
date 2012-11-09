<?php 
	$this->append('script');?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#ImageOrder").val($("#image-list" , parent.document).children().children("tr.file-row").length+1);
			});
		</script><?php
	$this->end();?>

<div class="images">
<?php echo $this->Form->create('Image', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Image'); ?></legend><?php
		echo $this->Form->input('Image.name');
		echo $this->Form->input('Image.foreign_id', array('value'=>$foreign_id, 'type' =>"hidden"));
		echo $this->Form->input('Image.foreign_model', array('value'=>"Product", 'type' =>"hidden"));
		echo $this->Form->input('Image.tipologia', array('type'=>'select', 'options'=>Configure::read("tipologiaImmagine")));
		echo $this->Form->input('Image.fileName', array('type' => 'file'));
		echo $this->Form->input('Image.order', array('type' => 'hidden')); ?>
	</fieldset>
<?php echo $this->Form->end('Upload'); ?>
</div>
	