<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header"); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<div style="float:left; margin-bottom:20px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#d4d4d4;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#d4d4d4;font-size:24px;"><?php echo ucwords($this->segment->uri(1)); ?></span>
	</div>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<?php 
		$x = 1;
		while($x<=9):
	?>
	<div style="float:left;width:32%;padding-bottom:10px;">
		<div style="background:#000;padding:5px;">
			<img class="img_size2" src="<?php echo themes_url("images/category/engagement.png"); ?>" />
			<br />
			<span style="color:#878c94;font-family:Calibri;font-size:14px;">Lorem Ipsum Dolor</span>
			<br />
			<span style="color:#878c94;font-family:Calibri;font-size:14px;">#12345</span>
			<br />
		</div>
	</div>
	<div style="float:left;padding:1.3px;"></div>
	<?php
		$x++;
		endwhile; 
	?>
</div>
<?php get_footer("footer"); ?>