<?php
	$element['title']= __('Utenti');
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['headers']=array(
		$this->Paginator->sort('id'),
		$this->Paginator->sort('username'),
		$this->Paginator->sort('created'),
		$this->Paginator->sort('modified'),
		"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');
	
	$element['temp'] = true;
	foreach ($users as $user):
		$element['content']=array(
			h($user['User']['id']),
			h($user['User']['username']),
			h($user['User']['created']),
			h($user['User']['modified']),
		);
		$element['actions']="
				<span class='btn_green'>
					".$this->Html->link(__('View'), array('action' => 'view', $user['User']['id']))."
				</span>
				<span class='btn_yellow'>
					".$this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']))."
				</span>
				<span class='btn_red'>
					".$this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id']))."
				</span>";
		$element['temp']=!$element['temp'];
		$this->set('element', $element );
		echo $this->element('/admin/index/row'); 
	endforeach; 
	
	echo $this->element('/admin/index/close_table');
	$this->set('paginator', $this->Paginator );
	echo $this->element('/admin/index/paginate');
	echo $this->element('/admin/index/bottom'); ?>