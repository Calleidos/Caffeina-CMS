<?php
	header("Content-type: text/css");
?>

body{
	background:#ececec;
	font-family: sans-serif;
}
#bg-black{
	width:100%;
	z-index:-1;
	background:#000000;
	min-height:550px;
	position:absolute;
	top:515px;
	left:0px;
}
#main-content{
	margin:auto;
	width:960px;
	min-height:700px;
	background:#000000;
}
#header{
	width:960px;
	height:500px;
	background:url(/img/top-bg.jpg) center center no-repeat #ececec;
	padding-top:15px;
}
#logo{
	margin:auto;
	border:none;
	background:url(/img/logo.png) center center no-repeat transparent;
	width:558px;
	height:150px;
	display:block;
	margin-top:120px;
}
#menu{
	margin-top:-15px;
}
	.red:hover ul li{
		background-color:#d22027 !important;
	}
	.azzurro:hover ul li{
		background-color:#00adef !important;
	}
	.yellow:hover ul li{
		background-color:#fff200 !important;
	}
	
	.blue:hover ul li{
		background-color:#2a3e92 !important;
	}
	
	
#content{
	background:transparent;
}
	
#slider-container{
	width:930px;
	margin:15px;
	background:url(/img/slider-bg.png) center center no-repeat transparent;
	height:334px;
	padding-top: 5px;
	margin-bottom:0px;
	overflow:hidden;
}

#mycarousel li a img{
	max-height: 200px !important;
	max-width: 150px !important;
}

.reflect{
	margin: auto !important;
}

#mycarousel li a{
	display:inline-block;
	margin:auto;
	vertical-align: bottom;
}


#slider-shadow{
	width:930px;
	height:48px;
	margin:auto;
	background:url(/img/shadow-slider.png) center center no-repeat #FFFFFF;
}
#footer{
	width:100%;
	height:100px;
}
#footer-bar{
	width:825px;
	height:40px;
	background:url(/img/footer-bg.jpg) repeat-x center center transparent;
	margin:auto;
	margin-top:25px;
	line-height:40px;
	/* padding-right:105px; */
	font-size:13px;
}
.fb{background:url(/img/facebook.png) center center no-repeat transparent;}
.tw{background:url(/img/twitter.png) center center no-repeat transparent;}
.you{background:url(/img/youtube.png) center center no-repeat transparent;}
#footer-bar .fb, #footer-bar .tw, #footer-bar .you{
	float:left;
	margin-left:10px;
	width:25px;
	height:26px;
	margin-top:7px;
}
#footer-bar p{text-align:center;color:#FFFFFF;}
	
#credits{
	float:right;
	height:60px;
	line-height:60px;
	padding-right:15px;
}
#credits a{
	text-transform:uppercase;
	float:right;
	color:#FFFFFF !important;
	margin-left:15px;
	font-size:12px;
	text-decoration:underline;
}
.pp_gallery{
	display:none !important;
}
#logo-content{
	height:80px;
	width:298px;
	border:none;
	margin:10px 0 10px 15px;
	display:block;
	background:url(/img/logo-content.png) center center no-repeat transparent;
}
#page{
	width:898px !important;
	margin:auto;
	text-align:justify;
	height:330px;
	padding:15px;
	line-height:16px;
	magin-bottom:20px;
	border:2px solid #000000;
	background:#FFFFFF;
	border-radius:15px;
}
#page-content{
	width:868px;
	height:328px;
	background:#FFFFFF;
	margin:auto;
}
#page-content h2{
	font-weight:bold;
	text-size:18px;
	text-align:center;
	margin-top:10px;
	margin-bottom:20px;
}
#brands{
	text-align:center;
	margin-top:20px;
	margin-bottom:20px;
}
.imgbrand{
	vertical-align: middle;
}

/* CONTACT FORM CON VALIDATION */
#right-box-maps{
	width:280px;
	padding:10px;
	height:100%;
	float:right;
}
.error{color:red;}
#contact label.error{
	position:absolute;
	left:60px;
	width:300px;
	height:6px;
	font-size:11px;
	text-align:center;
	line-height:14px;
	background:url(/img/bubble.png) center center no-repeat transparent;
	padding-top:6px;
	padding-bottom:20px;
	margin-top:-27px;
}
#contact .NFCheck{
	margin-top:6px !important;
}
#contact .NFButtonLeft{
	margin-left:0px;
	left:69px;
}
#contact .NFButton{
	width:130px;
}
#contact .NFButtonRight{
	margin-left:0px;
	left:205px;
}
.label_for_form{
	float: right;
	margin-right: 470px;
	text-align: left;
	width: 150px;
}
#modulo_privacy{
	background-color: #F7F7F7;
    border: 1px solid #999999;
    font-size: 11px;
    height: 75px;
    overflow: auto;
    width: 563px;
}
/* popup email inviata */
#popup h1,#popup h2{
  color:orange;
  font-size:24px;
  margin-bottom:20px;
}

#hover{
  position:fixed;
  background:url(/img/overlaypopup.png) repeat center center transparent;
  width:100%;
  height:100%;
  opacity:.7;
  z-index:999;
  display:none;
}

#popup{
  position:fixed;
  width:600px;
  height:200px;
  background:#fff;
  left:50%;
  top:50%;
  border-radius:10px;
  padding:20px;
  margin-left:-310px; /* width/2 + padding-left */
  margin-top:-110px; /* height/2 + padding-top */
  z-index:9999;
  display:none;
}

#close{
  position:absolute;
  background:black;
  color:white;
  right:-10px;
  top:-10px;
  border-radius:50%;
  width:20px;
  height:20px;
  line-height:20px;
  text-align:center;
  font-size:8px;
  font-weight:bold;
  font-family:'Arial Black', Arial, sans-serif;
  cursor:pointer;
}
.fix-list img{
	max-height:150px;
	width:150px;
	max-wdth:150px;
}
#product-list a{
	display: inline-block;
    margin: auto;
    vertical-align: bottom;
}
#product-list li{
	float:left;
	margin-left:46px;
	margin-top:10px;
	height:220px;
	border:1px solid #cccccc;
	padding:5px;
}

.list-header{
	background:url(/img/bg-list-header.png) repeat-x 0 100% white;
	width:350px;
	float:left;
    border: 1px solid #C1C1C1;
    font-size: 13px;
    height: 25px;
    line-height: 25px;
    padding-left: 10px;
    padding-right: 10px;
}
.text-margin{
	width:350px !important;
	margin-top:20px;
	margin-left:10px;
	margin-right:10px;
	float:left;
}
.bold{
	font-weight:bold;
}