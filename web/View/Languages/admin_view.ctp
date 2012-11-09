<div class="languages view">
<h2><?php  echo __('Language');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($language['Language']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($language['Language']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flag'); ?></dt>
		<dd>
			<?php echo h($language['Language']['flag']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Language'), array('action' => 'edit', $language['Language']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Language'), array('action' => 'delete', $language['Language']['id']), null, __('Are you sure you want to delete # %s?', $language['Language']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Versions'), array('controller' => 'product_versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Version'), array('controller' => 'product_versions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Product Versions');?></h3>
	<?php if (!empty($language['ProductVersion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Seo Title'); ?></th>
		<th><?php echo __('Seo Keywords'); ?></th>
		<th><?php echo __('Seo Description'); ?></th>
		<th><?php echo __('Language Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($language['ProductVersion'] as $productVersion): ?>
		<tr>
			<td><?php echo $productVersion['id'];?></td>
			<td><?php echo $productVersion['name'];?></td>
			<td><?php echo $productVersion['description'];?></td>
			<td><?php echo $productVersion['active'];?></td>
			<td><?php echo $productVersion['price'];?></td>
			<td><?php echo $productVersion['slug'];?></td>
			<td><?php echo $productVersion['seo_title'];?></td>
			<td><?php echo $productVersion['seo_keywords'];?></td>
			<td><?php echo $productVersion['seo_description'];?></td>
			<td><?php echo $productVersion['language_id'];?></td>
			<td><?php echo $productVersion['product_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'product_versions', 'action' => 'view', $productVersion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_versions', 'action' => 'edit', $productVersion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_versions', 'action' => 'delete', $productVersion['id']), null, __('Are you sure you want to delete # %s?', $productVersion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product Version'), array('controller' => 'product_versions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
