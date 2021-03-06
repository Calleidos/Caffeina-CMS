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
		<li><?php echo $this->Html->link(__('List Post Versions'), array('controller' => 'post_versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post Version'), array('controller' => 'post_versions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Post Versions');?></h3>
	<?php if (!empty($language['PostVersion'])):?>
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
		<th><?php echo __('Post Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($language['PostVersion'] as $postVersion): ?>
		<tr>
			<td><?php echo $postVersion['id'];?></td>
			<td><?php echo $postVersion['name'];?></td>
			<td><?php echo $postVersion['description'];?></td>
			<td><?php echo $postVersion['active'];?></td>
			<td><?php echo $postVersion['price'];?></td>
			<td><?php echo $postVersion['slug'];?></td>
			<td><?php echo $postVersion['seo_title'];?></td>
			<td><?php echo $postVersion['seo_keywords'];?></td>
			<td><?php echo $postVersion['seo_description'];?></td>
			<td><?php echo $postVersion['language_id'];?></td>
			<td><?php echo $postVersion['post_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'post_versions', 'action' => 'view', $postVersion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'post_versions', 'action' => 'edit', $postVersion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'post_versions', 'action' => 'delete', $postVersion['id']), null, __('Are you sure you want to delete # %s?', $postVersion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post Version'), array('controller' => 'post_versions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
