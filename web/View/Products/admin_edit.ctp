<?php 
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
<div class="products">
<?php echo $this->Form->create('Product');?>
	
	<h1><?php echo __('Admin Edit Product'); ?></h1>
	<?php
		if (isset($this->data['Product']['id']))
			echo $this->Form->input('id');
		if (isset($order))
			echo $this->Form->input('order');
			
		echo $this->Form->input('code');?>
		<div class="category-box  ui-widget">
			<h3 class="ui-widget-header ui-corner-all"><?php echo __("Categories") ?></h3><?php
			echo $this->Form->input('Category', array('type' => 'select', 'multiple'=>"checkbox", 'div' =>"ui-widget ui-widget-content ui-corner-all", 'label' => false));?>
		
			<a class="fancy-modal" href="/admin/categories/addAjax/Product">
				<button onclick="return false;" class="add-button"><?php echo __("Add Category"); ?></button>
			</a>
		</div>
		<div class="tabs main-editor">
			<ul>
				<?php foreach ($languages as $id=>$language) { ?>
					<li><a href="#tabs-<?php echo $id ?>"><?php echo $language ?></a></li>
				<?php  } ?>
			</ul>
			<?php foreach ($languages as $id=>$language) { ?>
				<div id="tabs-<?php echo $id ?>">
					<div class="tabs">
						<ul>
							<li><a href="#tab-details-<?php echo $language ?>"><?php echo __('Product Details'); ?></a></li>
							<li><a href="#tab-seo-<?php echo $language ?>"><?php echo __('SEO'); ?></a></li>
						</ul>
						<div id="tab-details-<?php echo $language ?>"><?php
							if (isset($this->request->data['ProductVersion'][$id]["id"])) {
								echo $this->Form->input("ProductVersion.$id.id");
							}
							echo $this->Form->input("ProductVersion.$id.name", array("class" => "page-title"));
							echo $this->Form->input("ProductVersion.$id.slug", array("disabled" => true));?>
							<button id="modify-slug-<?php echo $id ?>" onclick="modifySlug(<?php echo $id ?>); return false;" class="edit-file"><?php echo _("Modify Slug"); ?></button><?php 
							echo $this->Form->input("ProductVersion.$id.active", array("options" => array(0 => __('Disabled'), 1=> __('Hidden'), 2=>__('Enabled') )));
							echo $this->Form->input("ProductVersion.$id.description");
							echo $this->Form->input("ProductVersion.$id.price");
							echo $this->Form->input("ProductVersion.$id.language_id", array("value" => $id, 'type' => 'hidden'));?>
						</div>
						<div id="tab-seo-<?php echo $language ?>"><?php
							echo $this->Form->input("ProductVersion.$id.seo_title");
							echo $this->Form->input("ProductVersion.$id.seo_keywords");
							echo $this->Form->input("ProductVersion.$id.seo_description");?>
						</div>
					</div>
				</div><?php
			}?>
		</div>
		<div class="tabs">
			<ul>
				<li><a href="#tab-images"><?php echo __('Product Photos'); ?></a></li>
				<li><a href="#tab-documents"><?php echo __('Product Documents'); ?></a></li>
			</ul><?php 
			
			$details=array('type' => 'image', 'model' => 'Product');
			$this->set('details',$details);
			echo $this->element('/admin/file_list');
			$details=array('type' => 'document', 'model' => 'Product');
			$this->set('details',$details);
			echo $this->element('/admin/file_list');?>
			
		</div>
		<?php
	echo $this->Form->end(__('Submit'));?>
</div>