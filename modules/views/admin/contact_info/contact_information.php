<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Contact Information
	</div>
	<div style="padding:20px 20px 0 20px; overflow:hidden">
		<table style="width:100%;">
			<tr>
				<td>
					<div class="img_categ" onclick="location.href='<?php echo base_url('admin/testimonials'); ?>'">
						<img class="img_size2" src="<?php echo themes_url('images/category/testi.png') ?>" />
						<div style="overflow:hidden;padding:10px 0 10px 0;">
							<div style="float:left;font-size:16.66px;color:#5b5b5b;">Testimonials</div>
							<div style="float:right;">
								<img src="<?php echo themes_url('images/events-arrow-icon.png'); ?>" />
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="img_categ" onclick="location.href='<?php echo base_url('admin/home_pics'); ?>'">
						<img class="img_size2" src="<?php echo themes_url('images/category/home_pics.png') ?>" />
						<div style="overflow:hidden;padding:10px 0 10px 0;">
							<div style="float:left;font-size:16.66px;color:#5b5b5b;">Home Pictures</div>
							<div style="float:right;">
								<img src="<?php echo themes_url('images/events-arrow-icon.png'); ?>" />
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="img_categ" onclick="location.href='<?php echo base_url('admin/whats_new'); ?>'">
						<img class="img_size2" src="<?php echo themes_url('images/category/document.png') ?>" />
						<div style="overflow:hidden;padding:10px 0 10px 0;">
							<div style="float:left;font-size:16.66px;color:#5b5b5b;">What's New</div>
							<div style="float:right;">
								<img src="<?php echo themes_url('images/events-arrow-icon.png'); ?>" />
							</div>
						</div>
					</div>
				</td>
				<td>
					<div class="img_categ" onclick="location.href='<?php echo base_url('admin/referral'); ?>'">
						<img class="img_size2" src="<?php echo themes_url('images/category/referral.png') ?>" />
						<div style="overflow:hidden;padding:10px 0 10px 0;">
							<div style="float:left;font-size:16.66px;color:#5b5b5b;">Referrals</div>
							<div style="float:right;">
								<img src="<?php echo themes_url('images/events-arrow-icon.png'); ?>" />
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php get_footer("admin/footer"); ?>