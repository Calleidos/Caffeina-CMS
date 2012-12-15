<tr <?php  if($element['temp']){echo 'class="alternate-row"';} ?> >
	<td><input type="checkbox" /></td><?php 
	
	foreach ($element['content'] as $content) {?>
		<td><?php echo $content ?>&nbsp;</td><?php
	} ?>
	<?php if (isset($element['actions'])) {?>
		<td class="options-width act"><?php echo $element['actions'] ?></td><?php 
	} ?>
</tr>