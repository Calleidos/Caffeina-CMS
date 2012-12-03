<?php 
	$mainLanguage=Configure::read('mainLanguage');
	$this->element("fancybox_links");
		$this->Html->css('datetimepicker', null, array('inline' => false));
		$this->Html->script("/js/functions.js", array('inline' => false));
		$this->append('script');?>
		<script type="text/javascript">		
			jQuery(document).ready(function($){
				orderIcons();
				createIcons();
								
			});
	
			
		</script><?php
	$this->end(); 
	$element['title']= __("Categoria")." : ". $category["Category"]["name"];
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['title']= __('Prodotti');
	$element['headers']=array(
		"<span>".__('Titolo in Italiano')."</span>",
		"<span>".__('Codice')."</span>",
		"<span>".__('Ordine')."</span>",
		"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');
	
	$element['temp'] = true;
	foreach ($posts as $post):
		$ordering="
		<ul class='ordering'>";
		if ($post['Post']['order']>1) {
	    		$ordering.="<li><button class='act up_order' onclick='order('posts', ".$category['Category']['id'].", ".$post['Post']['id'] .", -1); return false;' class=''>". __('Sposta su')."</button></li>";
	    	}
    	if ($post['Post']['order']<$totalPosts) {
    		$ordering.="<li><button class='act down_order' onclick='order('posts', ". $category['Category']['id'].", ". $post['Post']['id'].", +1); return false;' class=''>". __('Sposta giu')."</button></li>";
    	}
    	$ordering.="</ul>";
		$element['content']=array(
			h($post['PostVersion'][$mainLanguage]['name']),
			h($post['Post']['code']),
			$ordering,
			
		);
		$element['actions']="
				<span class='btn_yellow'>
					".$this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']))."
				</span>
				<span class='btn_red'>
					".$this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id']))."
				</span>";
		$element['temp']=!$element['temp'];
		$this->set('element', $element );
		echo $this->element('/admin/index/row'); 
	endforeach;

	echo $this->element('/admin/index/close_table');
	echo $this->element('/admin/index/bottom'); ?>