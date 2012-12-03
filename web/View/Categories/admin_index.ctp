<?php 
	$mainLanguage=Configure::read('mainLanguage');
	
	$element['title']= __('Elenco Categorie');
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['title']= $posttype['Posttype']['name'];
	$element['headers']=array(
		"<span>".__('Titolo in Italiano')."</span>",
		"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');
	
	$element['temp'] = true;
	foreach ($categories as $key=>$category):
	
		$element['content']=array(
			$this->Html->link($category, array('controller' => 'categories'	, 'action' => 'edit', $key)),
				
		);
		$element['actions']="
			<span class='btn_yellow'>
				".$this->Html->link(__('Edit'), array('controller' => 'categories'	, 'action' => 'edit', $key))."
			</span>
			<span class='btn_red'>
				".$this->Form->postLink(__('Delete'), array('controller' => 'categories', 'action' => 'delete', $key), null, __('Are you sure you want to delete # %s?', $category['id']))."
			</span>";
		$element['temp']=!$element['temp'];
		$this->set('element', $element );
		echo $this->element('/admin/index/row');
	endforeach;
	
	echo $this->element('/admin/index/close_table');
	echo $this->element('/admin/index/bottom'); ?>