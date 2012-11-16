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
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

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
			
				<!--  start message-yellow -->
				<div id="message-yellow">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="yellow-left"><?php echo __('Hai un nuovo messaggio!'); ?><a href="#">Go to Inbox.</a></td>
					<td class="yellow-right"><a class="close-yellow"><?php echo $this->Html->image("admin/table/icon_close_yellow.gif", array("alt" => ""));?></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-yellow -->
				
				<!--  start message-red -->
				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><?php echo __('Errore'); ?><a href="#">Admin</a></td>
					<td class="red-right"><a class="close-red"><?php echo $this->Html->image("admin/table/icon_close_red.gif", array("alt" => ""));?></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-red -->
				
				<!--  start message-blue -->
				<div id="message-blue">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="blue-left"><?php echo __('Eventu blu'); ?><a href="">&nbsp;</a> </td>
					<td class="blue-right"><a class="close-blue"><?php echo $this->Html->image("admin/table/icon_close_blue.gif", array("alt" => ""));?></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-blue -->
			
				<!--  start message-green -->
				<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"><?php echo __('Prodotto aggiunto con successo.'); ?><a href="">&nbsp;</a></td>
					<td class="green-right"><a class="close-green"><?php echo $this->Html->image("admin/table/icon_close_green.gif", array("alt" => ""));?></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<h2><?php echo __('Prodotti');?></h2>
					
					<tr>
						<th class="table-header-check"><a id="toggle-all" ></a> </th>
						<th class="table-header-repeat line-left minwidth-1"><span><?php echo __('Titolo in Italiano'); ?></span></th>
						<th class="table-header-repeat line-left minwidth-1"><span><?php echo __('Codice'); ?></span></th>
						<th class="table-header-repeat line-left"><span><?php echo __('Ordine');?></span></th>
						<th class="table-header-repeat line-left" class="actions"><span><?php echo __('Actions');?></span></th>
					</tr><?php $temp = false;
					foreach ($products as $product): ?>
					<tr <?php  if($temp == true){echo 'class="alternate-row"'; $temp = false;}else{$temp = true;} ?> >
						<td><input type="checkbox" /></td>
						<td><?php echo h($product['ProductVersion'][$mainLanguage]['name']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['code']); ?></td>
						
						<td><?php /*echo h($product['Product']['order']); */?>
							<ul class="ordering"><?php 
								if ($product['Product']['order']>1) {?>
						    		<li><button class="act up_order" onclick="order('products', <?php echo $product['Product']['id'] ?>, -1); return false;" class=''><?php echo __('Sposta su');?></button></li><?php
						    	}
						    	if ($product['Product']['order']<$totalProducts) {?>
						    		<li><button class="act down_order" onclick="order('products', <?php echo $product['Product']['id'] ?>, +1); return false;" class=''><?php echo __('Sposta giu');?></button></li><?php
						    	}?>
					    	</ul>
						
						</td>
						<td class="options-width act">
							<span class="btn_yellow">
								<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['Product']['id'])); ?>
							</span>
							<span class="btn_red">
								<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
							</span>
						</td>
					</tr>
				<?php endforeach; ?>
				</tr>
				</table>
				<!--  end product-table................................... --> 
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

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>