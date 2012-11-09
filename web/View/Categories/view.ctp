<div class="products">
	<h2><?php echo __('Products');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('name');?></th>
	</tr>
	<?php
	foreach ($products as $product): ?>
	<tr>
		<td><?php echo $this->Html->link($product['ProductVersion']['name'], array('language' => 'it', 'controller' =>'productVersions', 'action' => 'view', 'categoria'=>$category,  'prodotto'=>$product['ProductVersion']['slug'])); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>