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
	Default
================================================================================ */
html { background:url('<?php echo themes_url('images/bg_admin.png'); ?>') #e0e0e8 repeat-y; overflow-x:hidden; }
body { font-family:"Lato",sans-serif; background:url('<?php echo themes_url('images/bg_admin.png'); ?>') #e0e0e8 y-repeat; background-attachment:fixed; }
.wrap { float:center; width:100%; height:auto; }
.header { background:url('<?php echo themes_url('images/admin_header.png'); ?>') repeat-x; width:auto; height:60px; overflow:hidden; margin:0; }
.header_body {height:60px;}
.orange{ background:url('<?php echo themes_url('images/orange-line.png'); ?>') repeat-x; height:14px;}
.body { background:url('<?php echo themes_url('images/bg_admin.png'); ?>') #e0e0e8 repeat-y; overflow:hidden; }
.cont_body { background:url('<?php echo themes_url('images/bg_admin.png'); ?>') #e0e0e8 repeat-y; padding:0 0 10px 0; border:0; }
<?php if($this->session->userdata('admin')): ?>
.footer { background:#3a3d44;}
<?php else: ?>
.footer { }
<?php endif; ?>
.footer_body { margin-top:-10px; font-size:11px; height:auto; }
.container{
	position: relative;
	width:100%;
}
/*================================================================================
	Image Size
================================================================================ */
.img_size2{
	width:100%;
	height:auto;
	max-height: auto;
	max-width: auto;
}
/*================================================================================
	link
================================================================================ */
.categ{ color:#494949;}
a:hover{ text-decoration:none; }

/*================================================================================
	Custom Button
================================================================================ */
.input_text{ font-family:"Tahoma",Verdana,Times New Roman,sans-serif; width:300px; padding:5px; border:1px solid #c6c7cb; }
.input_text:focus { outline:0; }
.input_submit{
	background:url('<?php echo themes_url('images/btn_bg.png'); ?>');
	border:1px solid #63acff;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding:9px;
	width:104px;
}
.input_submit:active{
	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.input_submit:focus{
	outline:0;
}
.input_submit2{
	background:url('<?php echo themes_url('images/btn_bg2.png'); ?>');
	border:1px solid #a6a6a6;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding:9px;
	width:104px;
}
.input_submit2:active{
	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.input_submit2:focus{
	outline:0;
}
.areatext{
	font-family:"Tahoma",Verdana,Times New Roman,sans-serif;
	width:240px;
	height:73px;
	padding:5px;
}