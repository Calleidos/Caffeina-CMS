<?php 
	$this->append('script');?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#DocumentOrder").val($("#document-list" , parent.document).children().children("tr.file-row").length+1);
			});
		</script><?php
	$this->end();
 	$this->TinyMce->editor(
		array(
			'mode' => "textareas",
			'theme' => 'advanced',
			'theme_advanced_statusbar_location' => "bottom",
			'theme_advanced_toolbar_location' => "top",
		)
	);?>

<div class="documents">
<?php echo $this->Form->create('Document', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Document'); ?></legend><?php
		echo $this->Form->input('Document.name');
		echo $this->Form->input('Document.foreign_id', array('value'=>$foreign_id, 'type' =>"hidden"));
		echo $this->Form->input('Document.foreign_model', array('value'=>"Product", 'type' =>"hidden"));
		echo $this->Form->input('Document.tipologia', array('type'=>'select', 'options'=>Configure::read("tipologiaDocumento")));
		echo $this->Form->input('Document.fileName', array('type' => 'file'));
		echo $this->Form->input('Document.description');
		echo $this->Form->input('Document.order', array('type' => 'hidden')); ?>
	</fieldset>
<?php echo $this->Form->end('Upload'); ?>
</div>
	