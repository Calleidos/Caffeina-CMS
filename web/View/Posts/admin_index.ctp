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
	$element['title']= __('Elenco')." ".$posttype['Posttype']['name'];
	$this->set('element', $element );
	echo $this->element('/admin/index/top');
	$element['title']= $posttype['Posttype']['name'];
	$element['headers']=array(
		"<span>".__('Titolo in Italiano')."</span>",
		$this->Paginator->sort('code'),
		"<span>".__('Categories')."</span>",
		"<span>".__('Actions')."</span>",
	);
	$this->set('element', $element );
	echo $this->element('/admin/index/open_table');
	
	$element['temp'] = true;
	foreach ($posts as $post):
		$categories=array();
		foreach ($post['Category'] as $cat) {
			$categories[]= $this->Html->link($cat['name'], array('controller' => 'categories', 'action' => 'viewposts', $cat['id']), array('class' => 'cat_link'));
		}
		$categories=implode(",&nbsp;", $categories);
		$element['content']=array(
			$this->Html->link(__(h($post['PostVersion'][$mainLanguage]['name'])), array('action' => 'edit', $post['Post']['id']), array('class' => 'cat_link')),
			h($post['Post']['code']),
			$categories,
			
		);
		$element['actions']="
				<span class='btn_yellow'>
					".$this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id']))."
				</span>
				<span class='btn_red'>
					".$this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id']))."
				</span>";
		$element['temp']=!$element['temp'];
		$this->set('element', $element );
		echo $this->element('/admin/index/row'); 
	endforeach; 
	
	echo $this->element('/admin/index/close_table');
	$this->set('paginator', $this->Paginator );
	echo $this->element('/admin/index/paginate');
	echo $this->element('/admin/index/bottom'); ?>