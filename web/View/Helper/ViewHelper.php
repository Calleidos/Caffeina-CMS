<?php

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class ViewHelper extends AppHelper {
	
	var $helpers = array('Html');
	
	function stepIn($array, $pvs, $languages) {?>
		<li>
			<h4 class="h"><a href="#" style="display:block" class="trigger open"><?php  echo $array["Category"]['name'] ?></a></h4>
			<div class="outer" style="display: block;">
				<div class="inner">
					<div><?php 
						if (!empty($array['Product'])) {?>
							<table cellpadding="0" cellspacing="0">
								<tr>
									<th>&nbsp;</th>
									<th><?php echo __('name');?></th>
									<th><?php echo __('code');?></th>
									<th><?php echo __('order');?></th><?php 
									foreach ($languages as $language) {?>
										<th><?php echo $this->Html->image($language['Language']['flag']); ?>&nbsp;</th><?php
									}?>
								</tr><?php 
							foreach ($array['Product'] as $product) {?>
								<tr>
									<td>
										<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteArticle(<?php echo $product['id'] ?>, 'document');} return false;" class="cancel-file"><?php echo __("Delete"); ?></button>
										<?php echo $this->Html->link("", array("controller" => "products", "action" => "edit"))?><a href="/admin/products/edit/<?php echo $product['id'] ?>"><button onclick="" class="edit-file"><?php echo __("Edit") ?></button></a>
									</td>
									<td>
										<?php echo $pvs[$product['id']][2]['ProductVersion']['name'] ?></p>
									</td>
									<td>
										<?php echo $product['code'] ?></p>
									</td>
									<td>
										<?php echo $product['order'] ?></p>
									</td><?php
									foreach ($languages as $language) {?>
										<td><input class="ProductVersionLanguage" id="ProductVersion-<?php echo $pvs[$product['id']][$language['Language']['id']]['ProductVersion']['id']?>" type="checkbox" <?php if ($pvs[$product['id']][$language['Language']['id']]['ProductVersion']['active']) echo "checked='checked'"; ?> /></td><?php
									}?>
									
								</tr><?php
							}?>
							</table><?php
						}?>
					</div><?php
					if (!empty($array['children'])) {?>
						<ul><?php
	       				foreach ($array['children'] as $child)
							$this->stepIn($child, $pvs, $languages);?>
						</ul><?php
					}?>
				</div>
			</div>
		</li><?php
	}
	
}
