<?php
	$this->append('script');?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$.ajax({
				async:true, 
				data:{posttypeId:'<?php echo $posttypeId ?>'},
				dataType:"html", 
				success:function (data) {
					var selected=$('.cat-box .checkbox', parent.document).children("input:checked");
					$('.cat-box', parent.document).html(data);
					$(selected).each(function() {
						$("#"+$(this, parent.document).attr("id"), parent.document ).attr("checked", "checked");
					});
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