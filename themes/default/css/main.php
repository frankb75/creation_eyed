<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
@import url(http://fonts.googleapis.com/css?family=Lato);

@font-face {
font-family: 'Helvetica';
	src: url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.eot');
	src: url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.eot') format('embedded-opentype'),
	 url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.woff2') format('woff2'),
	 url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.woff') format('woff'),
	 url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.ttf') format('truetype'),
	 url('<?php echo themes_url('font/'); ?>helveticaneueltpro-ltcn.svg#HelveticaNeueLTPro47LightCondensed') format('svg');
}

/*================================================================================
	Image Size
================================================================================ */
.img_size{
	width:99%;
	height:auto;
	max-height: auto;
	max-width: auto;
}
.img_size2{
	width:97%;
	height:270px;
	max-height: auto;
	max-width: auto;
}
.img_size3{
	width:97%;
	height:300px;
	max-height: auto;
	max-width: auto;
}

/*================================================================================
	Default
================================================================================ */
html { overflow-x:hidden; }
body { font-family:"Lato",sans-serif; }
.wrap { float:center; width:100%; height:auto; }
.header { width:auto; overflow:hidden; margin:0; padding:50px 10px 20px 10px; }
.header_body { }
.body { overflow:hidden; }
.cont_body { padding:10px 0 10px 0; border:0; }
.footer { }
.footer_body { margin-top:0; font-size:11px; height:auto; }
.container{
	position: relative;
	width:100%;
}
.left-container{
	position: absolute;
	float:left; 
	width:86%; 
	height:auto;
}

/*================================================================================
	link
================================================================================ */
.categ{ color:#494949;}
a:hover{ text-decoration:none; }

/*================================================================================
	Custom Button
================================================================================ */
.input_text{ font-family:"Tahoma",Verdana,Times New Roman,sans-serif; width:300px; padding:5px; border:1px solid black; }
.input_text:focus { outline:0; box-shadow: 0 0 10px #5CB3FF; -webkit-box-shadow: 0 0 10px #5CB3FF; -moz-box-shadow: 0 0 10px #5CB3FF; }
input[type=submit]{ padding:5px; }
.areatext{
	font-family:"Tahoma",Verdana,Times New Roman,sans-serif;
	width:240px;
	height:73px;
	padding:5px;
}
.input_cart { font-family:"Tahoma",Verdana,Times New Roman,sans-serif; background:#39393d; color:#8f8a8a; border:1px solid #575757; border-radius:5px; }