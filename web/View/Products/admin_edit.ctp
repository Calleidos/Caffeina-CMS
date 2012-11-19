<?php 
pr($this->request->data);
//echo $this->Html->css('cake.generic');
 echo $this->Html->css('main');
		
 
 
 		$this->element("fancybox_links");
		$this->Html->css('datetimepicker', null, array('inline' => false));
		$this->Html->script("/js/functions.js", array('inline' => false));
		$this->append('script');?>
		<script type="text/javascript">		
			jQuery(document).ready(function($){
				$(function() {
					$( ".tabs" ).tabs();
				});

				$(".fancy-modal").fancybox({
					type : 'iframe' 
				});

				$( ".add-button" ).button({
		            icons: {
		                primary: "ui-icon-circle-plus"
		            }
		        });
		        
				orderIcons();
				createIcons();
				fancyImages();

				$(".page-title").change(function(){
					slug="#"+$(this).attr('id').replace("Name", "Slug");
					if ($(slug).val().trim()=="") {
						$(slug).val($(this).val());
					}
				});
					
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
	
	
	

	<!--  start page-heading -->
	<div id="page-heading">
		<h1><?php echo __('Elenco prodotti')?></h1>
	</div>
	<!-- end page-heading -->

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
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
<?php echo $this->Form->create('Product');?>
	
	
			<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table" >
				
					
				<tr>
					<th class="table-header-check"></th>
					<th class="table-header-repeat"><span><?php echo __('Prodotto'); ?></span></th>
					<th class="table-header-repeat line-left" style="width:28px;"></th>
					<th class="table-header-repeat line-left"><span><?php echo __('Categorie'); ?></span></th>
				</tr>
		
		
		
				<tr>
					<td colspan="2">
					<?php
						if (isset($this->data['Product']['id']))
							echo $this->Form->input('id');
						echo $this->Form->input('code');
					?>
					<br />
					<div class="tabs main-editor">
						<ul>
							<?php foreach ($languages as $id=>$language) { ?>
								<li><a href="#tabs-<?php echo $id ?>"><?php echo $language ?></a></li>
							<?php  } ?>
						</ul>
						<?php foreach ($languages as $id=>$language) { ?>
							<div id="tabs-<?php echo $id ?>" style="margin-top:20px;">
								<div class="tabs">
									<ul>
										<li><a href="#tab-details-<?php echo $language ?>"><?php echo __('Product Details'); ?></a></li>
										<li><a href="#tab-seo-<?php echo $language ?>"><?php echo __('SEO'); ?></a></li>
									</ul>
									<div id="tab-details-<?php echo $language ?>"><?php
										if (isset($this->request->data['ProductVersion'][$id]["id"])) {
											echo $this->Form->input("ProductVersion.$id.id");
										}
										echo $this->Form->input("ProductVersion.$id.name", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("ProductVersion.$id.slug", array("class" => "page-title ui-corner-all tabs_input", "disabled" => true));?>
										<button id="modify-slug-<?php echo $id ?>" onclick="modifySlug(<?php echo $id ?>); return false;" class="edit-file"><?php echo _("Modify Slug"); ?></button><?php 
										echo $this->Form->input("ProductVersion.$id.active", array("options" => array(0 => __('Disabled'), 1=> __('Hidden'), 2=>__('Enabled') ), "class" => "styledselect"));
										echo $this->Form->input("ProductVersion.$id.description", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("ProductVersion.$id.price", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("ProductVersion.$id.language_id", array("value" => $id, 'type' => 'hidden'));?>
									</div>
									<div id="tab-seo-<?php echo $language ?>"><?php
										echo $this->Form->input("ProductVersion.$id.seo_title", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("ProductVersion.$id.seo_keywords", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("ProductVersion.$id.seo_description", array("class" => "page-title ui-corner-all tabs_input"));?>
									</div>
								</div>
							</div><?php
						}?>
					</div>
					</td>
					<td colspan="2" style="vertical-align:top;width:130px;">
						<?php
						if (!isset($selectedCategories))
							$selectedCategories=array();
						echo $this->Form->input('CategoryOrder.category_id', array('type' => 'select', 'multiple'=>"checkbox", 'div' =>"", 'label' => false, 'selected' => $selectedCategories));?>
					
						<a class="fancy-modal" href="/admin/categories/addAjax/Product">
							
							<button onclick="return false;" class="add-button act btn_green" style="height:25px;"><?php echo __("Add Category"); ?></button>
							
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="tabs docs-editor">
							<ul>
								<li><a href="#tab-images"><?php echo __('Foto prodotti'); ?></a></li>
								<li><a href="#tab-documents"><?php echo __('Documenti prodotti'); ?></a></li>
							</ul><?php 
							
							$details=array('type' => 'image', 'model' => 'Product');
							$this->set('details',$details);
							echo $this->element('/admin/file_list');
							$details=array('type' => 'document', 'model' => 'Product');
							$this->set('details',$details);
							echo $this->element('/admin/file_list');?>
							
						</div>
						<div class="clear">&nbsp;</div>
					</td>
				</tr>
			</table>
					
			
		
		
		
		<span class="act input btn_green">
			<?php echo $this->Form->end(__('Salva'));?>
		</span>
</div></div></td>
<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>
