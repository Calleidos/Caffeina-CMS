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
	?>


	<!--  start page-heading -->
	<div id="page-heading">
		<h1><?php echo __("Categoria"); ?> : <?php echo $category["Category"]["name"]; ?></h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><?php echo $this->Html->image("admin/shared/side_shadowleft.jpg", array("width" => 20, "height" => 300, "alt" => ""));?></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><?php echo $this->Html->image("admin/shared/side_shadowright.jpg", array("width" => 20, "height" => 300, "alt" => ""));?></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">		
		 
				<!--  start post-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="post-table">
				<h2><?php echo __('Prodotti');?></h2>
					
					<tr>
						<th class="table-header-check"><a id="toggle-all" ></a> </th>
						<th class="table-header-repeat line-left minwidth-1"><span><?php echo __('Titolo in Italiano'); ?></span></th>
						<th class="table-header-repeat line-left minwidth-1"><span><?php echo __('Codice'); ?></span></th>
						<th class="table-header-repeat line-left"><span><?php echo __('Ordine');?></span></th>
						<th class="table-header-repeat line-left" class="actions"><span><?php echo __('Actions');?></span></th>
					</tr><?php $temp = false;
					foreach ($posts as $post): ?>
					<tr <?php  if($temp == true){echo 'class="alternate-row"'; $temp = false;}else{$temp = true;} ?> >
						<td><input type="checkbox" /></td>
						<td><?php echo h($post['PostVersion'][$mainLanguage]['name']); ?>&nbsp;</td>
						<td><?php echo h($post['Post']['code']); ?></td>
						
						<td><?php /*echo h($post['Post']['order']); */?>
							<ul class="ordering"><?php 
								if ($post['Post']['order']>1) {?>
						    		<li><button class="act up_order" onclick="order('posts', <?php echo $category["Category"]["id"]; ?>, <?php echo $post['Post']['id'] ?>, -1); return false;" class=''><?php echo __('Sposta su');?></button></li><?php
						    	}
						    	if ($post['Post']['order']<$totalPosts) {?>
						    		<li><button class="act down_order" onclick="order('posts', <?php echo $category["Category"]["id"]; ?>, <?php echo $post['Post']['id'] ?>, +1); return false;" class=''><?php echo __('Sposta giu');?></button></li><?php
						    	}?>
					    	</ul>
						
						</td>
						<td class="options-width act">
							<span class="btn_yellow">
								<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?>
							</span>
							<span class="btn_red">
								<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
							</span>
						</td>
					</tr>
				<?php endforeach; ?>
				</tr>
				</table>
				<!--  end post-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
			<!--  start actions-box ............................................... -->
			<!-- <div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					<a href="" class="action-edit">Edit</a>
					<a href="" class="action-delete">Delete</a>
				</div>
				<div class="clear"></div>
			</div>-->
			<!-- end actions-box........... -->
			
			<!--  start paging..................................................... -->
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			
			</table>
			<!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>


<div class="clear">&nbsp;</div>