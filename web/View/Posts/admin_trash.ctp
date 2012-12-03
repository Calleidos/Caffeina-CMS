<?php 
	$mainLanguage=Configure::read('mainLanguage');
	
	$element['title']= __("Cestino");
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['title']= __('Prodotti');
	$element['headers']=array(
			"<span>".__('Titolo in Italiano')."</span>",
			"<span>".__('Codice')."</span>",
			"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');
	
	$element['temp'] = true;
	foreach ($posts as $post):
		$element['content']=array(
			$this->Html->link(__(h($post['PostVersion'][$mainLanguage]['name'])), array('action' => 'edit', $post['Post']['id']), array('class' => 'cat_link')),
			h($post['Post']['code']),			
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
	echo $this->element('/admin/index/bottom');