<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style>

.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }

</style>

<div style="text-align:right">

	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>

</div>

<div style="margin:0 auto; width:85%; overflow:hidden;">

	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">

		<a href="<?php echo base_url(); ?>">

			<img src="<?php echo themes_url('images/home_icon.png'); ?>" />

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<a href="<?php echo base_url($this->segment->uri(1)); ?>">

			<span style="color:#d4d4d4;font-size:18px;">

				<?php echo ucwords($this->segment->uri(1)); ?>

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<a href="<?php echo base_url('gallery/clients'); ?>">

			<span style="color:#d4d4d4;font-size:18px;">

				Clients

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<span style="color:#d4d4d4;font-size:24px;">

			Clients Gallery Name

		</span>

	</div>

</div>

<div style="overflow:hidden; margin-top:30px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; color:#ffffff; font-size:150%;">

		<div style="float:left;">

			Lorem ipsum dolor sit amet

		</div>

	</div>

</div>

<div style="overflow:hidden; margin-top:5px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; background:#404040; padding:8px 0; color:#ffffff; font-size:120%;">

		<div style="float:left; margin-left:10px;">

			October 17, 2014

		</div>

		<div style="float:left; margin-left:30px;">

			Expires: December 9, 2014

		</div>

	</div>

</div>

<div style="overflow:hidden; margin-top:20px;">

	<div style="margin:0 auto; font-family:Helvetica; width:85%; overflow:hidden;">

		<div style="float:left; width:41%;">

			<div style="width:100%; overflow:hidden; background:#ffffff; height:400px;">

				<div style="overflow:hidden; padding:15px;">

					<div class="clients_gallery" style="height:340px; overflow:hidden;">

						<a href="javascript:void(0);" onclick="alert('Image will pop up');"><img src="<?php echo themes_url('images/1.png'); ?>" style="display:block;"/></a>

					</div>

					<div style="overflow:hidden;">

						<div style="float:left; color:#000000; font-size:130%; font-weight:bold; padding-top:10px;">

							baby.jpg

						</div>

						<div style="float:right;"><!--Image here--></div>

					</div>

				</div>

			</div>

			<div>

			<button style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;">View in B&W </button>

			<p style="color:#ffffff; margin-top:8px;">NOTE:x An image that is displayed only in B&W cannot be ordered as a color print.</p>

			</div>

		</div>

		<div class="payment_proccess" style="float:right; width:54%; overflow:hidden;">

			<table style="width:100%;">

			<tr>

				<th style="width:22%;">Color Qty*</th>

				<th style="width:22%;">B&W Qty</th>

				<th style="width:22%;">Price</th>

				<th style="width:34%;">Size/Retouching</th>

			</tr>

			<tr>

				<td style="text-align:center;"><input type="text" style="width:60px; margin-top:5px; padding:3px;"/></td>

				<td style="text-align:center;"><input type="text" style="width:60px; margin-top:5px; padding:3px;"/></td>

				<td style="text-align:center;"><span style="color:#c2c2c2; font-weight:bold;">$0</span></td>

				<td style="text-align:center;"><span style="color:#c2c2c2; font-weight:bold;">Set of 2 Wallets</span></td>

			</tr>

			<tr>

				<td style="text-align:right;" colspan="4"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="return" value="Return to Images"/><input style="margin-top:10px; margin-left:20px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="add" value="Add to Cart" onclick="location.href = '<?php echo base_url('gallery/clients_gallery_view_addtochart'); ?>'"/></td>

			</tr>

			</table>

		</div>

	</div>

</div>

<?php get_footer("footer", array('client')); ?>

