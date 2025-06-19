<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("client_css")); ?>
<style type="text/css">
	.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }
	.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }
	*table, tr, td, th{ border:1px solid #ffffff; }
</style>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="overflow:hidden; margin-top:20px;">
	<div style="font-family:Helvetica; margin:0 auto; width:85%; overflow:hidden; color:#646468;">
		<div style="float:left; font-size:24px;">
			Thank you for placing the order. Please check your email.
		</div>
	</div>
</div>
<?php get_footer("footer", array('client')); ?>