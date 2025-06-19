<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array('testimonial_css')); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%;">
	<div style="margin-bottom:25px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo ucwords(str_replace('_',' ', $this->segment->uri(1))); ?></span>
	</div>
	<div style="text-align:center;">
		<img src="<?php echo themes_url('images/referral.jpg'); ?>" style="width:50%;height:auto;max-height: auto;max-width: auto;" />
	</div>
	<div style="color:#646468;font-size:16px;">
		<div style="color:#646468;font-size:20px;">Zarek's Links:</div>
		Here are some links to my associates and friends. 
		<br />
		<br />
		<?php 
			$query = $this->QModel->sf('referral');
			
			if( ! $this->QModel->c($query)):
		?>
			<div style="font-size:20px;">
				No Record Found!
			</div>
		<?php else: ?>
			<?php while($get = $this->QModel->g($query)): ?>
				<br />
				<div style="color:#000000;font-size:18px;"><?php echo $get['category']; ?></div>
				<br />
				<?php echo $get['content']; ?>
				<br />
				<br />
				<div style="border:1px dotted #5a5a5a;width:100%;"></div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer("footer"); ?>