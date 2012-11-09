<?php
	$this->append('script');?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$.ajax({
				async:true, 
				data:{id:'<?php echo $id ?>'},
				dataType:"html", 
				success:function (data) {
					alert(data);
					$('.category-box', parent.document).html(data);
					parent.createIcons();
					parent.fancyImages();
					parent.$.fancybox.close();
				}, 
				type:"post",
				url:"/admin/categories/createSelect"
			});
			
		});
	</script><?php
$this->end();?>