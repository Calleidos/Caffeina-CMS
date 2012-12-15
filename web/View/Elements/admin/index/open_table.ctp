<h2><?php echo $element['title']; ?></h2>
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="post-table">
	<tr>
		<th class="table-header-check"><a id="toggle-all" ></a> </th><?php 
		foreach ($element['headers'] as $header) {?>
			<th class="table-header-repeat line-left"><?php echo $header ?></th>
		<?php } ?>
	</tr>