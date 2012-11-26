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
		Login
	</title>
	<?php
		$this->Html->script('jquery-1.8.1.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('jquery-ui-1.8.23.custom.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('jquery-ui-timepicker-addon', array('inline' => false, 'block'=>"scripts"));
		//$this->Html->css('smoothness/jquery-ui-1.8.23.custom', null, array('inline' => false));
		
		echo $this->Html->meta('icon');

		/*echo $this->Html->css('cake.generic');
		echo $this->Html->css('main');*/

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('scripts');
		echo $this->fetch('script');
		
	

echo $this->Html->script('js_admin/jquery-1.4.1.min');

 
 
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
		<script type='text/javascript'>
			jQuery.fn.center = function () {
			this.css("position","absolute");
			this.css("top", ( $(window).outerHeight() - this.outerHeight() ) / 2+$(window).scrollTop() + "px");
			this.css("left", ( $(window).outerWidth() - this.outerWidth() ) / 2+$(window).scrollLeft() + "px");
			return this;
		};
		
		</script> 
		<script type='text/javascript'>
			$(document).ready(function() {
				
				// $("#content").center();
					
				//window resize===========================================
				var h_cont=700;
				var h, new_h;
				setHeight();
				h=new_h;
				setSize();
				function setHeight(){
					new_h=$(window).height();
				}
				function setSize(){
					if (h>h_cont) {
						$('.main').stop().animate({paddingTop:~~((h-h_cont)/2)});
					} else {
						$('.main').stop().animate({paddingTop:0});
					}
				}
				setInterval(setNew,1);
				function setNew(){
					setHeight();
					if (h!=new_h) {
					h=new_h;
					setSize();
					}
				} 
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
<body id="login-bg"> 
	<!-- Start: page-top-outer -->
	<?php echo $this->Session->flash('auth'); ?>
	<div style="width:100%;height:100%;position:absolute;">
		<div id="login-holder" class="main">
			<!--  start loginbox ................................................................................. -->
			<div id="loginbox">
				<!--  start login-inner -->
				<div id="login-inner">
					<?php echo $this->Form->create('User', array('action' => 'login')); ?>
					<table border="0" cellpadding="0" cellspacing="0" class="login_table">
					<tr>
						<th>Username</th>
						<td><?php echo $this->Form->input("username", array("type" => "text", "value" => "Username", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'Username';}", "onfocus" => "if (this.value == 'Username') {this.value = '';}")); ?></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><?php echo $this->Form->input("password", array("type" => "password", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'password';}", "onfocus" => "if (this.value == 'password') {this.value = '';}", "value" => "password")); ?></td>
					</tr><?php /* ?>
					<tr>
						<th></th>
						<td valign="top"><?php echo $this->Form->input("login-check", array("type" => "checkbox", "class" => "checkbox-size"))?></td>
					</tr> */ ?>
					<tr>
						<th></th>
						<td><input type="submit" class="submit-login" />
					<?php echo $this->Form->end(); ?></td>
					</tr>
					</table>
				</div>
			 	<!--  end login-inner -->
				<div class="clear"></div>
				<?php /* ?><a href="" class="forgot-pwd">Forgot Password?</a> */ ?>
			</div>
			<!--  end loginbox -->
		 
			<!--  start forgotbox ................................................................................... -->
			<div id="forgotbox">
				<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
				<!--  start forgot-inner -->
				<div id="forgot-inner">
				<table border="0" cellpadding="0" cellspacing="0" class="login_table">
				<?php echo $this->Form->create('User', array('action' => 'login-psw'));?>
				<tr>
					<th>Email address:</th>
					<td>
						<?php echo $this->Form->input("email", array("type" => "text", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'Your Email';}", "onfocus" => "if (this.value == 'Your Email') {this.value = '';}", "value" => "Your Email")); ?>
						
					</td>
				</tr>
				<tr>
					<th> </th>
					<td>
						<?php echo $this->Form->end(); ?>
						<input type="button" class="submit-login"  />
					</td>
				</tr>
				</table>
				</div>
				<!--  end forgot-inner -->
				<div class="clear"></div>
				<a href="" class="back-login">Back to login</a>
			</div>
			<!--  end forgotbox -->
		</div>
	</div>

</body>
</html>
