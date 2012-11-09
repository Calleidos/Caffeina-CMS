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

<div class="products">
	<h2><?php echo __('Products');?></h2>
	<table cellpadding="0" cellspacing="0" class="index-list">
	<tr>
		<th><?php echo __("Titolo in Italiano"); ?></th>
		<th><?php echo $this->Paginator->sort('code');?></th>
		<th><?php echo __('Categories');?></th>
		<th><?php echo $this->Paginator->sort('order');?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr><?php 
	foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['ProductVersion'][$mainLanguage]['name']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['code']); ?></td>
		<td><?php 
			foreach ($product['Category'] as $cat) {
				echo $this->Html->link($cat['name'], array('controller' => 'categories', 'action' => 'view', $cat['id']))."<br />";
			}?>&nbsp;
		</td>
		<td><?php echo h($product['Product']['order']);?>
			<ul><?php 
				if ($product['Product']['order']>1) {?>
		    		<li><button onclick="order('products', <?php echo $product['Product']['id'] ?>, -1); return false;" class='order-up'>Move up</button></li><?php
		    	}
		    	if ($product['Product']['order']<$totalProducts) {?>
		    		<li><button onclick="order('products', <?php echo $product['Product']['id'] ?>, +1); return false;" class='order-down'>Move Down</button></li><?php
		    	}?>
	    	</ul>
		
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>