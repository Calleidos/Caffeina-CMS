<?php 
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
	);
	
	$element['title']=__("Modifica articolo");
	$this->set('element', $element );
	echo $this->element('/admin/edit/open');
			
	echo $this->Form->create('Post');?>
	
	
			<table border="0" width="100%" cellpadding="0" cellspacing="0" id="post-table" >
				
					
				<tr>
					<th class="table-header-check"></th>
					<th class="table-header-repeat"><span><?php echo __('Prodotto'); ?></span></th>
					<th class="table-header-repeat line-left" style="width:28px;"></th>
					<th class="table-header-repeat line-left"><span><?php echo __('Categorie'); ?></span></th>
				</tr>
		
		
		
				<tr>
					<td colspan="2" class="span_container">
					<?php
						if (isset($this->data['Post']['id']))
							echo $this->Form->input('id');
						if (isset($posttype))
							echo $this->Form->input("Post.posttype_id", array("value" => $posttype, 'type' => 'hidden'));
						echo $this->Form->input('code', array('class' => 'page-title ui-corner-all tabs_input'));
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
										<li><a href="#tab-details-<?php echo $language ?>"><?php echo __('Post Details'); ?></a></li>
										<li><a href="#tab-seo-<?php echo $language ?>"><?php echo __('SEO'); ?></a></li>
									</ul>
									<div id="tab-details-<?php echo $language ?>"><?php
										if (isset($this->request->data['PostVersion'][$id]["id"])) {
											echo $this->Form->input("PostVersion.$id.id");
										}
										echo $this->Form->input("PostVersion.$id.name", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("PostVersion.$id.slug", array("class" => "page-title ui-corner-all tabs_input", "disabled" => true));?>
										<button class="act btn_yellow" style="float: none;left: 260px;position: relative;top: -45px;" id="modify-slug-<?php echo $id ?>" onclick="modifySlug(<?php echo $id ?>); return false;"><?php echo _("Modify Slug"); ?></button>
										<?php 
										echo $this->Form->input("PostVersion.$id.active", array("options" => array(0 => __('Disabled'), 1=> __('Hidden'), 2=>__('Enabled') ), "class" => "styledselect"));
										echo $this->Form->input("PostVersion.$id.description", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("PostVersion.$id.price", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("PostVersion.$id.language_id", array("value" => $id, 'type' => 'hidden'));?>
									</div>
									<div id="tab-seo-<?php echo $language ?>"><?php
										echo $this->Form->input("PostVersion.$id.seo_title", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("PostVersion.$id.seo_keywords", array("class" => "page-title ui-corner-all tabs_input"));
										echo $this->Form->input("PostVersion.$id.seo_description", array("class" => "page-title ui-corner-all tabs_input"));?>
									</div>
								</div>
							</div><?php
						}?>
					</div>
					</td>
					<td colspan="2" style="vertical-align:top;width:130px;" class="cat-box">
					
						<?php
						if (!isset($selectedCategories))
							$selectedCategories=array();
						echo $this->Form->input('CategoryOrder.category_id', array('type' => 'select', 'multiple'=>"checkbox", 'div' =>"", 'label' => false, 'selected' => $selectedCategories));?>
					
						<a class="fancy-modal" href="/admin/categories/addAjax/<?php echo $posttype ?>">
							
							<button onclick="return false;" class="add-button act btn_green" style="height:25px;"><?php echo __("Add Category"); ?></button>
							
						</a>
					</td>
				</tr><?php 
					$images=count($this->requestAction(array('controller' => 'imagetypes', 'action' => 'admin_listImageTypes' ), array('pass' => array($posttype))))>0; 
					$docs=count($this->requestAction(array('controller' => 'documenttypes', 'action' => 'admin_listDocumentTypes' ), array('pass' => array($posttype))))>0; 
				if ($images || $docs) {?>
					<tr>
						<td colspan="4">
							<div class="tabs docs-editor">
								<ul>
									<?php if ($images) { ?><li><a href="#tab-images"><?php echo __('Foto prodotti'); ?></a></li><?php } ?>
									<?php if ($docs) { ?><li><a href="#tab-documents"><?php echo __('Documenti prodotti'); ?></a></li><?php } ?>
								</ul><?php 
								if ($images) {
									$details=array('type' => 'image', 'model' => 'Post', 'posttype' => $posttype);
									$this->set('details',$details);
									echo $this->element('/admin/file_list');
								}
								if ($docs) {
									$details=array('type' => 'document', 'model' => 'Post', 'posttype' => $posttype);
									$this->set('details',$details);
									echo $this->element('/admin/file_list');
								} ?>
							</div>
							<div class="clear">&nbsp;</div>
						</td>
					</tr>
				<?php } ?>
			</table>
		
		<span class="act input btn_green">
			<?php echo $this->Form->end(__('Salva'));?>
		</span><?php 
		
	echo $this->element('/admin/edit/close');