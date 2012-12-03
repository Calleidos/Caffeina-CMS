<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		$this->Html->script('jquery-1.8.1.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('jquery-ui-1.8.23.custom.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('jquery-ui-timepicker-addon', array('inline' => false, 'block'=>"scripts"));
		$this->Html->css('smoothness/jquery-ui-1.8.23.custom', null, array('inline' => false));
		
		echo $this->Html->meta('icon');

		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('scripts');
		echo $this->fetch('script');

 
 
echo $this->Html->script('js_admin/ui.core');
echo $this->Html->script('js_admin/custom_jquery');


echo $this->Html->css('css_admin/screen');

?>

<!--[if IE]>
<?php 
echo $this->Html->css('css_admin/pro_dropline_ie');
?>
<![endif]-->

<!--  checkbox styling script -->
<?php 
/*echo $this->Html->script('js_admin/ui.core');*/
		
		
		
		
echo $this->Html->script('js_admin/ui.checkbox');
echo $this->Html->script('js_admin/jquery.bind');
?>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<?php 
echo $this->Html->script('js_admin/jquery.selectbox-0.5');
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<?php
echo $this->Html->script('js_admin/jquery.selectbox-0.5_style_2');
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<?php 
echo $this->Html->script('js_admin/jquery.selectbox-0.5_style_3');
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<?php 
echo $this->Html->script('js_admin/jquery.filestyle');
?>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "../../img/admin/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

 
<!-- Tooltips -->
<?php 
echo $this->Html->script('js_admin/jquery.tooltip');
echo $this->Html->script('js_admin/jquery.dimensions');
?>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 


<!--  date picker script -->
<?php echo $this->Html->css('css_admin/datePicker');
echo $this->Html->script('js_admin/date');
echo $this->Html->script('js_admin/jquery.datePicker');
?>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>




<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<?php 
	echo $this->Html->script('js_admin/jquery.pngFix.pack');
?>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><?php echo $this->Html->image("admin/shared/logo.png", array("alt" => ""));?></a>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0" style="visibility:hidden">
		<tr>
		<td><input type="text" value="Search" onblur="if (this.value=='') { this.value='Search'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
		<td>
		<select class="styledselect">
			<option value=""> <?php echo __('Tutti'); ?></option>
			<option value=""> <?php echo __('Prodotti'); ?></option>
			<option value=""> <?php echo __('Categorie'); ?></option>
			<option value=""><?php echo __('Clienti'); ?></option>
			<option value=""><?php echo __('Notizie'); ?></option>
		</select> 
		</td>
		<td>
		<input type="image" src="/img/admin/shared/top_search_btn.gif"  />
		</td>
		</tr>
		</table>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><?php echo $this->Html->image("admin/shared/nav/nav_myaccount.gif", array("alt" => "", "height" => "14px", "width" => "93px"));?></div>
			<div class="nav-divider">&nbsp;</div>
			<?php echo $this->Html->link($this->Html->image("admin/shared/nav/nav_logout.gif", array("alt" => "", "height" => "14px", "width" => "64px")), array('controller' => 'users', 'action' => 'logout', 'prefix' => 'admin'), array('id' => 'logout', 'escape' => false))?>
			
			<div class="clear">&nbsp;</div>
		
			<!--  start account-content -->	
			<div class="account-content">
			<div class="account-drop-inner">
				<a href="" id="acc-settings"><?php echo __('Impostazioni'); ?></a>
				<?php /* ?>
				<div class="clear">&nbsp;</div>
								<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-details"><?php echo __('Dati personali'); ?></a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-project"><?php echo __('Dati progetto'); ?></a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-inbox"><?php echo __('Messaggi'); ?></a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-stats"><?php echo __('Statistiche'); ?></a>
				<?php //*/ ?> 
			</div>
			</div>
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		
		<?php /*?><ul class="select"><li><a href="#nogo"><b><?php echo $this->Html->link(__('Aggiungi prodotto'), array('controller' => 'posts', 'action' => 'add', 'prefix'=>'admin'), array('class' => ''));?></b><!--[if IE 7]><!--></a><!--<![endif]-->
		
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div><?php */ ?>
		                    
		<ul class="current"><li><a href="#nogo"><b><?php echo __('Prodotti');?></b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li class="sub_show"><?php echo $this->Html->link(__('Elenco prodotti'), array('controller' => 'posts', 'action' => 'index', 'prefix'=>'admin', 1), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Aggiungi prodotto'), array('controller' => 'posts', 'action' => 'add', 'prefix'=>'admin', 1), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Elenco categorie'), array('controller' => 'categories', 'action' => 'index', 'prefix'=>'admin', 1), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Aggiungi categoria'), array('controller' => 'categories', 'action' => 'add', 'prefix'=>'admin', 1), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Cestino'), array('controller' => 'posts', 'action' => 'trash', 'prefix'=>'admin',1), array('class' => ''));?></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo"><b><?php echo __('Utenti');?></b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><?php echo $this->Html->link(__('Elenco utenti'), array('controller' => 'users', 'action' => 'index', 'prefix'=>'admin'), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Aggiungi utente'), array('controller' => 'users', 'action' => 'add', 'prefix'=>'admin'), array('class' => ''));?></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo"><b><?php echo __('News');?></b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><?php echo $this->Html->link(__('Elenco notizie'), array('controller' => 'news', 'action' => 'index', 'prefix'=>'admin'), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Aggiungi notizia'), array('controller' => 'news', 'action' => 'add', 'prefix'=>'admin'), array('class' => ''));?></li>
				<li><?php echo $this->Html->link(__('Cestino'), array('controller' => 'posts', 'action' => 'trash', 'prefix'=>'admin',2), array('class' => ''));?></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">

<!-- start content -->
<div id="content">

			<div id="messages">
				<?php
				    if ($this->Session->check('Message.flash')) 
				    	echo $this->Session->flash(); // the standard messages
				    // multiple messages
				    if ($messages = $this->Session->read('Message.multiFlash')) {?>
				   
							<!--  start content-table-inner ...................................................................... START -->
							<div id="content-table-inner">
							
								<!--  start table-content  -->
								<div id="table-content" style="min-height:auto;"><?php 
				        foreach($messages as $k=>$v){
				        	echo $this->Session->flash('multiFlash.'.$k);
				        }?>
				        </div>
						</div>
					
				<div class="clear">&nbsp;</div><?php 
				    }
				?>
			</div>

			<?php echo $this->fetch('content'); ?>
			

</div>
<!--  end content -->
</div>
<!--  end content-outer........................................................END -->

 <div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Caffeina-CMS <?php echo __('Tutti i diritti riservati'); ?>.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
<div style="font-size:12px !important:; clear:both"><?php echo $this->element('sql_dump'); ?></div>

</body>
</html>
