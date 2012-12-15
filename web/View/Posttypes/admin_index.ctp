<?php
	$element['title']= __('Elenco Tipi di Post');
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['title']= __('Elenco Tipi di Post');
	$element['headers']=array(
		$this->Paginator->sort('name'),
		"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');

	$element['temp'] = true;
	foreach ($posttypes as $posttype):
	
		$element['content']=array(
				h($posttype['Posttype']['name']),
		);
		$element['actions']="
					<span class='btn_yellow'>
						".$this->Html->link(__('Edit'), array('action' => 'edit', $posttype['Posttype']['id']))."
					</span>
					<span class='btn_red'>
						".$this->Form->postLink(__('Delete'), array('action' => 'delete', $posttype['Posttype']['id']), null, __('Are you sure you want to delete # %s?', $posttype['Posttype']['id']))."
					</span>";
		$element['temp']=!$element['temp'];
		$this->set('element', $element );
		echo $this->element('/admin/index/row');
	endforeach;
	
	echo $this->element('/admin/index/close_table');
	
	$this->set('paginator', $this->Paginator );
	echo $this->element('/admin/index/paginate');
	echo $this->element('/admin/index/bottom'); ?>