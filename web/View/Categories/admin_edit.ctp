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
				<div class="categories">
				<?php echo $this->Form->create('Category', array('class'=>'legend'));?>
					<fieldset>
						<legend><?php echo __('Modifica categoria:'); ?></legend>
					<?php
						$this->TinyMce->editor(
							array(
								'mode' => "textareas",
								'theme' => 'advanced',
								'theme_advanced_statusbar_location' => "bottom",
								'theme_advanced_toolbar_location' => "top",	
							)
						);
						if (isset($this->data['Category']['id']))
							echo $this->Form->input('id', array('class'=>'page-title ui-corner-all tabs_input'));
						if (isset($this->data['Category']['posttype_id']))
							echo $this->Form->input('posttype_id', array('type'=>'hidden'));
						echo $this->Form->input('parent_id', array('options'=>$parentCategories));
						echo $this->Form->input('name', array('class'=>'page-title ui-corner-all tabs_input'));
						echo $this->Form->input('description', array('class'=>'page-title ui-corner-all tabs_input'));
					?>
					</fieldset>
				<span class="act input btn_green">	
				<?php echo $this->Form->end(__('Submit'));?>
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
				
