<?php
	$element['title']=__("Aggiungi Imagetype");
	$this->set('element', $element );
	echo $this->element('/admin/edit/open');
	echo $this->Form->create('Imagetype');
	if (isset($this->request->data['Imagetype']['id']))
		echo $this->Form->input('id');
	echo $this->Form->input('name');
	echo $this->Form->input('description');?>
	
	<span class="act input btn_green">
		<?php echo $this->Form->end(__('Salva'));?>
	</span><?php 

	echo $this->element('/admin/edit/close');
