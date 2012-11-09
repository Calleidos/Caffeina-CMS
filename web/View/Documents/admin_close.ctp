<?php
	$this->append('script');?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$.ajax({
				async:true, 
				data:{id:'<?php echo $id ?>'},
				dataType:"html", 
				success:function (data) {
					$('#document-list > tbody:last', parent.document).append(data);
					parent.orderIcons();
					parent.createIcons();
					parent.fancyImages();
					parent.$.fancybox.close();
				}, 
				type:"post",
				url:"/admin/documents/addRow"
			});
			
		});
	</script><?php
$this->end();?>