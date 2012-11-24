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
						if (!empty($array['Post'])) {?>
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
							foreach ($array['Post'] as $post) {?>
								<tr>
									<td>
										<button onclick="if(confirm('<?php echo __("Are you sure you want to delete this file?")?>')) {deleteArticle(<?php echo $post['id'] ?>, 'document');} return false;" class="cancel-file"><?php echo __("Delete"); ?></button>
										<?php echo $this->Html->link("", array("controller" => "posts", "action" => "edit"))?><a href="/admin/posts/edit/<?php echo $post['id'] ?>"><button onclick="" class="edit-file"><?php echo __("Edit") ?></button></a>
									</td>
									<td>
										<?php echo $pvs[$post['id']][2]['PostVersion']['name'] ?></p>
									</td>
									<td>
										<?php echo $post['code'] ?></p>
									</td>
									<td>
										<?php echo $post['order'] ?></p>
									</td><?php
									foreach ($languages as $language) {?>
										<td><input class="PostVersionLanguage" id="PostVersion-<?php echo $pvs[$post['id']][$language['Language']['id']]['PostVersion']['id']?>" type="checkbox" <?php if ($pvs[$post['id']][$language['Language']['id']]['PostVersion']['active']) echo "checked='checked'"; ?> /></td><?php
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
