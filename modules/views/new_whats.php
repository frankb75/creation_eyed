<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array('testimonial_css')); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%;">
	<div style="margin-bottom:25px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo str_replace('_',' ', ucwords($this->segment->uri(1))); ?></span>
	</div>
	<div style="text-align:center;">
		<img src="<?php echo themes_url('images/whats_new.jpg'); ?>" style="width:55%;height:auto;max-height: auto;max-width: auto;" />
	</div>
	<div style="margin:0 auto; width:75%;">
		<div class="scroll_test">
			<div style="color:#646468;">
				<?php
					$query_wedding = $this->QModel->sf(
						'whats_new',
						'whats_new_id DESC'
					);
					
					if( ! $this->QModel->c($query_wedding)):
				?>
					<div style="width:100%;color:#646468;font-size:18px;text-align:center;">
						No Records Found!
					</div>
				<?php else: ?>
					<?php 
						$i = 0;
						while($get = $this->QModel->g($query_wedding)):
						$whats_new_id = $get['whats_new_id'];
						$title = $get['title'];
						$date = $get['date'];
						$message = $get['message'];
					?>
					<br />
					<b><?php echo $title; ?></b>
					<br />
					<?php echo date('F d, Y',strtotime($date)); ?>
					<br />
					~ <span style="color:#000;"><?php echo $message; ?></span>
					<br />
					<br />
					<div style="border:1px dashed #0a0a0c;"></div>
					<?php
						$i++;
						endwhile; 
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer("footer"); ?>