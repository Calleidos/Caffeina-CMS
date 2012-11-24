<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><?php echo $this->Html->image("admin/shared/side_shadowleft.jpg", array("width" => 20, "height" => 300, "alt" => ""));?></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><?php echo $this->Html->image("admin/shared/side_shadowright.jpg", array("width" => 20, "height" => 300, "alt" => ""));?></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				<?php 
					$this->append('script');?>
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$("#DocumentOrder").val($("#document-list" , parent.document).children().children("tr.file-row").length+1);
							});
						</script><?php
					$this->end();
				 	$this->TinyMce->editor(
						array(
							'mode' => "textareas",
							'theme' => 'advanced',
							'theme_advanced_statusbar_location' => "bottom",
							'theme_advanced_toolbar_location' => "top",
						)
					);?>
				
				<div class="documents" style="margin-top:30px;">
				<?php echo $this->Form->create('Document', array('type' => 'file', 'class'=>'legend')); ?>
					<fieldset>
						<legend><?php echo __('Aggiungi documento'); ?></legend><?php
						echo $this->Form->input('Document.name', array('class'=>'page-title ui-corner-all tabs_input'));
						echo $this->Form->input('Document.foreign_id', array('value'=>$foreign_id, 'type' =>"hidden"));
						echo $this->Form->input('Document.foreign_model', array('value'=>"Post", 'type' =>"hidden"));
						echo $this->Form->input('Document.tipologia', array('type'=>'select', 'options'=>Configure::read("tipologiaDocumento"), 'class' => 'styledselect'));
						?>
						<table cellspacing="0" cellpadding="0" style="width:100%">
						<tr>
						<td class="fileupload">
						
						<?php echo $this->Form->input('Document.fileName', array('type' => 'file', 'class'=>'file_1 page-title ui-corner-all tabs_input')); ?>
						</td>
						<td>
						<div class="bubble-left"></div>
						<div class="bubble-inner">DOC, PDF, TXT 5MB max</div>
						<div class="bubble-right"></div>
						</td>
						</tr>
						</table>
						<?php
							echo $this->Form->input('Document.description', array('class'=>'page-title ui-corner-all tabs_input'));
							echo $this->Form->input('Document.order', array('type' => 'hidden'));
						?>
					</fieldset>
				<span class="act input btn_green">
					<?php echo $this->Form->end('Upload'); ?>
				</span>
				</div>
				
				
		
				
			</div>
		</div>
	</td>
	<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
</table>
<div class="clear">&nbsp;</div>
