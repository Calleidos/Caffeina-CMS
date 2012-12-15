<?php
	$this->element("fancybox_links");
	$this->append('script');?>
		<script type="text/javascript">		
			jQuery(document).ready(function($){
								
				$(".fancy-modal").fancybox({
					type : 'iframe' 
				});
					
			});			
		</script><?php
	$this->end();	

	$element['title']=__("Modifica Posttype");
	$this->set('element', $element );
	echo $this->element('/admin/edit/open');
	echo $this->Form->create('Posttype');
	if (isset($this->request->data['Posttype']['id']))
		echo $this->Form->input('id');
	echo $this->Form->input('name');
	echo $this->Form->input('Imagetype', array('type' => 'select', 'multiple'=>"checkbox", 'div' => array('id'=>'imagetype-select')));?>
	<a class="fancy-modal" href="/admin/imagetypes/addAjax/">
		
		<button onclick="return false;" class="add-button act btn_green" style="height:25px;"><?php echo __("Add Imagetype"); ?></button>
		
	</a><?php
	echo $this->Form->input('Documenttype', array('type' => 'select', 'multiple'=>"checkbox"));?>

	<span class="act input btn_green">
		<?php echo $this->Form->end(__('Salva'));?>
	</span><?php 

	echo $this->element('/admin/edit/close');//*/
