<?php
	$this->append('script');?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			var data='<div class="checkbox"><input type="checkbox" id="ImagetypeImagetype<?php echo $id ?>" value="<?php echo $id ?>" checked="checked" name="data[Imagetype][Imagetype][]"><label for="ImagetypeImagetype<?php echo $id ?>"><?php echo $name ?></label></div>';
			$('#imagetype-select', parent.document).append(data);
			parent.$.fancybox.close();
		});
	</script><?php
$this->end();?>