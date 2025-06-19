<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
.menu{
	background:transparent;
	float:left;
	width:270px;
	height:700px;
}
.content_size{
	float:left;
	width:100%;
}
.nav{
	height:60px;
	background:#1a1c20;
	overflow:hidden;
	border-bottom:1px solid #16181c;
}
.nav:hover{
	background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;
}
.nav_cont{
	color:#e0e0e8;
	font-family:Helvetica;
	font-size:24px;
	padding:20px 0 20px 0;
	cursor:pointer;
}
.nav_cont_select{
	background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;
	color:#e0e0e8;
	font-family:Helvetica;
	font-size:24px;
	padding:20px 0 20px 0;
	cursor:pointer;
}
.nav_below{ font-size:18px; padding-left:30px; display:none; }
.nav_below:hover{
	background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;
	cursor:pointer;
}
.tbl_head { background:url('<?php echo themes_url('images/icon_tbl_head.png'); ?>'); height:37px; font-size:18px; }
.tbl_body { height:37px; font-size:13px; }
.tbl_body2 { height:37px; font-size:13px; background:#c1c1c1; }

.img_categ{
	background:#c1c1c1;
	padding:10px;
	width:232px;
	height:278px;
	cursor:pointer;
}