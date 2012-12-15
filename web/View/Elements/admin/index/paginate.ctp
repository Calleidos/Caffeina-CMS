<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
	<tr>
		<td>
			<?php echo $paginator->prev('' . __(''), array(), null, array('class' => 'prev disabled page-left'));?>
			<div id="page-info"><?php
				echo $paginator->counter(array(
					'format' => __('Page <strong>{:page}</strong> of {:pages}')
				));?>
			
			</div>
			<?php echo $paginator->next(__('') . '', array(), null, array('class' => 'next disabled page-right')); ?>
		</td>
	</tr>
</table>