<div class="posts">
	<h2><?php echo __('Posts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('name');?></th>
	</tr>
	<?php
	foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $this->Html->link($post['PostVersion']['name'], array('language' => 'it', 'controller' =>'postVersions', 'action' => 'view', 'categoria'=>$category,  'prodotto'=>$post['PostVersion']['slug'])); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>