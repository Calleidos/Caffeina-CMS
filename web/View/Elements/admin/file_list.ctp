<div id="tab-<?php echo Inflector::pluralize($details['type']); ?>">
	<table class="file-list" id="<?php echo $details['type']; ?>-list">
		<tbody>
			<tr>
				<th>&nbsp;</th>
                <th><strong><?php echo __('Name'); ?></strong></th>
				<th><strong><?php echo __('Type'); ?></strong></th>
				<th><strong><?php echo __('Order'); ?></strong></th>
                <th><strong><?php echo __('Details'); ?></strong></th>
                <th><strong><?php echo __('File Link'); ?></strong></th>
			</tr><?php 
			if (!empty($this->request->data[ucwords($details['type'])])) {
				foreach ($this->request->data[ucwords($details['type'])] as $key=>$file) {
					if (isset($this->request->data[$details['model']]['id']))
						$file['foreign_id']=$this->request->data[$details['model']]['id'];
					$this->set('element',$file);
					echo $this->element('/admin/'.Inflector::pluralize($details['type']).'/admin_list');
				}
			}?>
		</tbody>
	</table>
	<a class="fancy-modal" href="/admin/<?php echo Inflector::pluralize($details['type']); ?>/add/<?php echo $details['model'] ?>/<?php if (isset($this->request->data[$details['model']]['id'])) echo $this->request->data[$details['model']]['id'] ?>">
		<button class="act plus" onclick="return false;" class="add-button">
			<?php echo __("Aggiungi"); ?>&nbsp;<?php echo ucwords($details['type']); ?>
		</button>
	</a>
</div>