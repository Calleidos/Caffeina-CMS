<?php 
	header("Content-type: text/css");
	$theme = "blue";
	$theme = $_GET['theme'];
	switch ($theme){
		case "red":
			$bg_color = "#ff0000";
			break;
		case "blue":
			$bg_color = "#0b63a8";
			break;
	}
	
?>
/*Defaults Styling*/

/*


body {font:12px/17px Arial, Helvetica, sans-serif; color:#333; background:#ccc; padding:40px 20px 20px 20px;}
fieldset {background:#f2f2e6; padding:10px; border:1px solid #fff; border-color:#fff #666661 #666661 #fff; margin-bottom:36px; width:600px;}
input, textarea, select {font:12px/12px Arial, Helvetica, sans-serif; padding:0;}
fieldset.action {background:#9da2a6; border-color:#e5e5e5 #797c80 #797c80 #e5e5e5; margin-top:-20px;}
legend {background:#bfbf30; color:#fff; font:17px/21px Calibri, Arial, Helvetica, sans-serif; padding:0 10px; margin:-26px 0 0 -11px; font-weight:bold; border:1px solid #fff; border-color:#e5e5c3 #505014 #505014 #e5e5c3;}
label {font-size:11px; font-weight:bold; color:#666;}
label.opt {font-weight:normal;}
dl {clear:both;}
dt {float:left; text-align:right; width:90px; line-height:25px; margin:0 10px 10px 0;}
dd {float:left; width:475px; line-height:25px; margin:0 0 10px 0;}
#footer {font-size:11px;}

#container {width:700px; margin:0 auto;}


*/


/*##########################################
Script: Niceforms 2.0
Theme: StandardBlue
Author: Lucian Slatineanu
URL: http://www.emblematiq.com/
##########################################*/

/*Text inputs*/
.NFText {border:none; vertical-align:middle; font:12px/15px Arial, Helvetica, sans-serif; background:none;}
.NFTextCenter {height:15px; background:url(/img/input.png) repeat-x 0 0; padding:3px 0; margin:0; float:left; line-height:15px;}
.NFTextLeft, .NFTextRight {width:7px; height:21px; vertical-align:middle; float:left;}
.NFTextLeft {background:url(/img/input-left.png) no-repeat 0 0;}
.NFTextRight {background:url(/img/input-right.png) no-repeat 0 0;}
/*Radio*/
.NFRadio {cursor:pointer; position:absolute; display:block; width:13px; height:13px; border:1px solid transparent; background:url(/img/radio.png) no-repeat 0 0; z-index:2;}
/*Checkbox*/
.NFCheck {cursor:pointer; position:absolute; width:12px; height:12px; border:1px solid transparent; background:url(/img/checkbox.png) no-repeat 0 0; z-index:2;}
/*Buttons*/
.NFButton {position:absolute;left:140px; margin-left:-65px; margin-top:0px; margin-bottom:15px; width:auto; height:26px; color:#fff; padding:0 2px; background:url(/img/formbutton.png) repeat-x 0 0; cursor:pointer; border:none; font:10px/26px Tahoma, Arial, Helvetica, sans-serif; font-weight:bold; text-transform:uppercase; letter-spacing:1px; vertical-align:middle;}
.NFButtonLeft, .NFButtonRight {margin-top:0px; margin-bottom:15px; width:6px; height:26px; vertical-align:middle;}
.NFButtonLeft {background:url(/img/button-left.png) no-repeat 0 0; position:absolute;left:50%;margin-left:-76px; }
.NFButtonRight {background:url(/img/button-right.png) no-repeat 0 0; position:absolute;left:50%;margin-left:60px; }
/*Textareas*/
.NFTextarea {border:none; background:none; font:12px/12px Arial, Helvetica, sans-serif; margin:0;}
.NFTextareaTop, .NFTextareaBottom {height:5px; clear:both; float:none; padding-right:10px;}
.NFTextareaTop {background:url(/img/textarea-tr.png) no-repeat 100% 0;}
.NFTextareaBottom {background:url(/img/textarea-br.png) no-repeat 100% 0; margin-bottom:5px;}
.NFTextareaTopLeft, .NFTextareaBottomLeft {width:5px; height:5px;}
.NFTextareaTopLeft {background:#f2f2e6 url(/img/textarea-tl.png) no-repeat 0 0;}
.NFTextareaBottomLeft {background:#f2f2e6 url(/img/textarea-bl.png) no-repeat 0 0;}
.NFTextareaLeft, .NFTextareaRight, .NFTextareaLeftH, .NFTextareaRightH {float:left; padding-bottom:5px;}
.NFTextareaLeft, .NFTextareaLeftH {width:5px;}
.NFTextareaLeft {background:url(/img/textarea-l-off.png) repeat-y 0 0;}
.NFTextareaLeftH {background:url(/img/textarea-l-over.png) repeat-y 0 0;}
.NFTextareaRight, .NFTextareaRightH {padding-right:5px; padding-bottom:0;}
.NFTextareaRight {background:url(/img/textarea-r-off.png) repeat-y 100% 0;}
.NFTextareaRightH {background:url(/img/textarea-r-over.png) repeat-y 100% 100%;}
/*Files*/
.NFFileButton {padding-bottom:0; vertical-align:bottom; cursor:pointer; background:url(/img/file.png) no-repeat 0 0; width:60px; height:21px;}
.NFFile {position:relative; margin-bottom:5px;}
.NFFile input.NFhidden {position:relative; filter:alpha(opacity=0); opacity:0; z-index:2; cursor:pointer; text-align:left;}
.NFFileNew {position:absolute; top:0px; left:0px; z-index:1;}
/*Selects*/
.NFSelect {height:21px; position:absolute; border:1px solid transparent;}
.NFSelectLeft {float:left; width:3px; height:21px; background:url(/img/select-left.png) no-repeat 0 0; vertical-align:middle;}
.NFSelectRight {height:21px; width:auto; background:url(/img/select-right.png) no-repeat 100% 0; cursor:pointer; font:12px/21px Arial, Helvetica, sans-serif; color:#fff; padding-left:3px; margin-left:3px;}
.NFSelectTarget {position:absolute; background:none; margin-left:-13px; margin-top:18px; z-index:3; left:0; top:0; padding-bottom:13px;}
.NFSelectOptions {position:relative; background:#585858; margin-left:16px; margin-top:0; list-style:none; padding:4px 0; color:#fff; font:11px/13px Arial, Helvetica, sans-serif; z-index:4; max-height:200px; overflow-y:auto; overflow-x:hidden; left:0; top:0;}
.NFSelectOptions li {padding-bottom:1px;}
.NFSelectOptions a {display:block; text-decoration:none; color:#fff; padding:2px 3px; background:none;}
.NFSelectOptions a.NFOptionActive {background:<?php echo "$bg_color"; ?>;}
.NFSelectOptions a:hover {background:<?php echo "$bg_color"; ?>;}
/*Multiple Selects*/
.NFMultiSelect {border:0; background:none; margin:0;}
.NFMultiSelectTop, .NFMultiSelectBottom {height:5px; clear:both; float:none; padding-right:10px;}
.NFMultiSelectTop {background:url(/img/textarea-tr.png) no-repeat 100% 0;}
.NFMultiSelectBottom {background:url(/img/textarea-br.png) no-repeat 100% 0; margin-bottom:5px;}
.NFMultiSelectTopLeft, .NFMultiSelectBottomLeft {width:5px; height:5px;}
.NFMultiSelectTopLeft {background:#f2f2e6 url(/img/textarea-tl.png) no-repeat 0 0;}
.NFMultiSelectBottomLeft {background:#f2f2e6 url(/img/textarea-bl.png) no-repeat 0 0;}
.NFMultiSelectLeft, .NFMultiSelectRight, .NFMultiSelectLeftH, .NFMultiSelectRightH {float:left; padding-bottom:5px;}
.NFMultiSelectLeft, .NFMultiSelectLeftH {width:5px;}
.NFMultiSelectLeft {background:url(/img/textarea-l-off.png) repeat-y 0 0;}
.NFMultiSelectLeftH {background:url(/img/textarea-l-over.png) repeat-y 0 0;}
.NFMultiSelectRight, .NFMultiSelectRightH {padding-right:5px; padding-bottom:0;}
.NFMultiSelectRight {background:url(/img/textarea-r-off.png) repeat-y 100% 0;}
.NFMultiSelectRightH {background:url(/img/textarea-r-over.png) repeat-y 100% 0;}

/*Focused*/
.NFfocused {border:1px dotted #666;}
/*Hovered*/
.NFh {background-position:0 100%;}
.NFhr {background-position:100% 100%;}
/*Hidden*/
.NFhidden {opacity:0; z-index:-1; position:relative;}
/*Safari*/
select, input, textarea, button {outline:none; resize:none;}