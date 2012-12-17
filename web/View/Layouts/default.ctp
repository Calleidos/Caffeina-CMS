<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title><?php 
		
		 
		$this->Html->css('destijl/reset', null, array('inline' => false));
		$this->Html->css('destijl/jMenu.jquery', null, array('inline' => false));
		$this->Html->css('destijl/jquery.jscrollpane', null, array('inline' => false));
		$this->Html->css('destijl/jcarousel', null, array('inline' => false));
		$this->Html->css('destijl/prettyPhoto', null, array('inline' => false));
		
		
		$this->Html->script('jquery-1.8.1.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('jquery-ui-1.8.23.custom.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/jMenu.jquery', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/jquery.mousewheel', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/jquery.jscrollpane', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/jquery.jcarousel.min', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/reflection', array('inline' => false, 'block'=>"scripts"));
		$this->Html->script('destijl/jquery.prettyPhoto', array('inline' => false, 'block'=>"scripts"));
		
		echo $this->fetch('css');
		echo $this->fetch('scripts');
		
		?>
		
		<link href="/css/destijl/destijl.php" rel="stylesheet" type="text/css" />
		
		<!-- INIZIO JQUERY MENU -->
			
			
			<script type="text/javascript">
				$(document).ready(function(){
					// more complex jMenu plugin called 
					$("#jMenu").jMenu({
						ulWidth : 100,
						effects : { 
							effectSpeedOpen : 300,
							effectTypeOpen : 'fade',
							effectTypeClose : 'fade'
						},
						animatedText : true,
						paddingLeft : 5,
						absoluteTop : -105
					}); 
				}); 
			</script> 
			
		<!-- FINE JQUERY MENU -->

		<!-- JSCROLLPANE -->
			
			<script type="text/javascript">
				$(function(){
					$('.scroll-pane').jScrollPane({
						showArrows: true,
						autoReinitialise: true,
						verticalArrowPositions: 'os'
					});
				});
			</script>

			<script type="text/javascript">
				$(document).ready(function(){
				
					$(".red").mouseover(function() {
						 $(".shadow-color").stop().animate({ backgroundColor:'#d22027'},500);
						 $(this).stop().animate({ backgroundColor:'#d22027'},500);
					}).mouseout(function() {
						$(".shadow-color").stop().animate({ backgroundColor:'#FFFFFF'},500);
						$(this).stop().animate({ backgroundColor:'#000000'},500);
					}); 
					
					$(".azzurro").mouseover(function() {
						 $(".shadow-color").stop().animate({ backgroundColor:'#00adef'},500);
						 $(this).stop().animate({ backgroundColor:'#00adef'},500);
					}).mouseout(function() {
						$(".shadow-color").stop().animate({ backgroundColor:'#FFFFFF'},500);
						$(this).stop().animate({ backgroundColor:'#000000'},500);
					});   
					
					$(".yellow").mouseover(function() {
						 $(".shadow-color").stop().animate({ backgroundColor:'#fff200'},500);
						 $(this).stop().animate({ backgroundColor:'#fff200'},500);
					}).mouseout(function() {
						$(".shadow-color").stop().animate({ backgroundColor:'#FFFFFF'},500);
						$(this).stop().animate({ backgroundColor:'#000000'},500);
					});   
					
					$(".blue").mouseover(function() {
						 $(".shadow-color").stop().animate({ backgroundColor:'#2a3e92'},500);
						 $(this).stop().animate({ backgroundColor:'#2a3e92'},500);
					}).mouseout(function() {
						$(".shadow-color").stop().animate({ backgroundColor:'#FFFFFF'},500);
						$(this).stop().animate({ backgroundColor:'#000000'},500);
					});       
				});
			</script>
			
			
			<!-- JCAROUSEL INIZIO -->
			
				<script type="text/javascript">

					jQuery(document).ready(function() {
						jQuery('#mycarousel').jcarousel();
					});

				</script>
				
			<!-- JCAROUSEL FINE -->
			
			
			<!-- REFLECTION IMAGE -->
			
				<script type="text/javascript">
					jQuery(function($) {
						$("img.reflect").reflect({
							
							height : 50,
							opacity: 0.5
							
						});
					});
				</script>
			
			<!-- REFLECTION IMAGE -->
			
			
			<!-- PRETTY PHOTO -->
		
				<script type="text/javascript" charset="utf-8">
					$(document).ready(function(){
						$("area[rel^='prettyPhoto']").prettyPhoto();
						
						$(".cont a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false});
						
						$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false});
						
					});
				</script>
		
		
			<!-- PRETTY PHOTO -->

			<?php /* if($title == "De Stijl"){ ?>
				<style>
				
					#mycarousel li a img{
						max-height: 260px !important;
						max-width: 640px !important;
					}
					.jcarousel-skin-tango .jcarousel-item {
						width: 640px !important;
					}
					.reflect{
						width: 640px !important;
					}
				</style><?php
			} //*/?>
	</head>
	<body>
		<div id="bg-black">&nbsp;</div>
		<div id="main-content">
			<div id="header">
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="content">
				<?php echo $this->element('menu'); ?>
				<div id="slider-container">
					
					<ul id="mycarousel" class="jcarousel-skin-tango gallery clearfix">
						<li><a href="img/sliders/home/01.jpg" rel="prettyPhoto[gallery1]"><img src="img/sliders/home/01.jpg" alt="" class="reflect" /></a></li>
						<li><a href="img/sliders/home/02.jpg" rel="prettyPhoto[gallery1]"><img src="img/sliders/home/02.jpg" alt="" class="reflect" /></a></li>
					</ul>
					
				</div>	
				<div id="slider-shadow" class="shadow-color"></div>
				
				<div id="footer">
					<div id="footer-bar">
						<p><a href="index.php" style="font-weight:bold;color:#FFFFFF">DE STIJL</a> | Viale della Pace, 167 | 36100 - Vicenza - (VI) | Tel./Fax. 0445 500536 | P.IVA e C.F. 03762620247 </p>
					</div>
					<div id="credits">
						<a href="http://www.calleidos.it">credits</a>
						<?php /* <a href="#area riservata">area riservata</a> //*/?>
						<a href="#privacy">privacy</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>