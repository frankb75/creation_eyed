<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("client_css")); ?>
<style>
.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }
.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }
*table, tr, td, th{ border:1px solid #ffffff; }
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
<div style="overflow:hidden; margin-top:20px;">
	<div style="font-family:Helvetica; margin:0 auto; width:85%; overflow:hidden; color:#ffffff; font-size:250%;">
		<div style="float:left;">
			My Cart
		</div>
	</div>
</div>
<div style="overflow:hidden; margin:15px 0;">
	<div style="font-family:Helvetica; margin:0 auto; width:85%; overflow:hidden; color:#ffffff; font-size:130%;">
		<div style="float:left; padding:2px 10px; margin-right:20px; background:#000000;">
			Shopping Cart
		</div>
		<div style="float:left; padding:2px 10px; margin-right:20px; background:#000000; color:#434343;">
			Place Holder
		</div>
		<div style="float:left; padding:2px 10px; background:#000000; color:#434343;">
			Receipt
		</div>
	</div>
</div>
<div style="overflow:hidden; margin-top:5px;">
	<div style="margin:0 auto; width:85%; overflow:hidden; color:#ffffff;">
		<table style="width:100%;font-family:Helvetica;">
			<tr style="background:#404040; font-size:130%;">
				<th style="width:27%; padding:8px 0; text-align:left; padding-left:30px;">Photo</th>
				<th style="width:18%; padding:8px 0 8px 30px; text-align:left;">Quantity</th>
				<th style="width:8%; padding:8px 0; text-align:left;">Price</th>
				<th style="width:28%; padding:8px 0; text-align:left;">Item Info</th>
				<th style="width:8%; padding:8px 0; text-align:left;">Total</th>
				<th style="width:11%;"></th>
			</tr>
			<tr>
				<td style="padding:15px 0;">
					<div style="width:100%; overflow:hidden; background:#ffffff; height:290px;">
						<div style="overflow:hidden; padding:15px;">
							<div class="clients_gallery" style="height:230px; overflow:hidden;">
								<a href="javascript:void(0);" onclick="alert('Image will pop up');"><img src="<?php echo themes_url('images/1.png'); ?>" style="display:block;"/></a>
							</div>
							<div style="overflow:hidden;">
								<div style="float:left; color:#000000; font-size:90%; font-weight:bold; margin-top:10px;">
									baby.jpg
								</div>
								<div style="float:right;"><!--Image here--></div>
							</div>
						</div>
					</div>
				</td>
				<td style="vertical-align:top; padding:15px 0; padding-left:30px;">
					<input type="text" name="quantity" style="width:80px;"/>
					<br />
					<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; padding:3px 0; text-align:center; width:87px;" type="submit" name="return" value="Update Qty"/>
					<br />
					<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; text-align:center; width:87px;" type="submit" name="return" value="More Size"/>
				</td>
				<td style="vertical-align:top; padding:15px 0;">$8.00</td>
				<td style="vertical-align:top; padding:15px 0;">Set for 2 Wallets</td>
				<td style="vertical-align:top; padding:15px 0;">$8.00</td>
				<td><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="return" value="X Remove"/></td>
			</tr>
			<tr style="background:#404040;">
				<td style="padding:15px 0;">
					<div style="width:100%; overflow:hidden; background:#ffffff; height:290px;">
						<div style="overflow:hidden; padding:15px;">
							<div class="clients_gallery" style="height:230px; overflow:hidden;">
								<a href="javascript:void(0);" onclick="alert('Image will pop up');"><img src="<?php echo themes_url('images/1.png'); ?>" style="display:block;"/></a>
							</div>
							<div style="overflow:hidden;">
								<div style="float:left; color:#000000; font-size:90%; font-weight:bold; margin-top:10px;">
									baby.jpg
								</div>
								<div style="float:right;"><!--Image here--></div>
							</div>
						</div>
					</div>
				</td>
				<td style="vertical-align:top; padding:15px 0; padding-left:30px;">
					<input type="text" name="quantity" style="width:80px;"/>
					<br />
					<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; padding:3px 0; text-align:center; width:87px;" type="submit" name="return" value="Update Qty"/>
					<br />
					<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; text-align:center; width:87px;" type="submit" name="return" value="More Size"/>
				</td>
				<td style="vertical-align:top; padding:15px 0;">$8.00</td>
				<td style="vertical-align:top; padding:15px 0;">Set for 2 Wallets</td>
				<td style="vertical-align:top; padding:15px 0;">$8.00</td>
				<td><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="return" value="X Remove"/></td>
			</tr>
		</table>
		<br />
		<div style="overflow:hidden;">
			<div style="float:left; width:40%; overflow:hidden;">
				<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:13px 0;">
					&nbsp;
				</div>
				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:110%;">
					Subtotal: <span style="color:green;">$0.00</span>
				</div>
				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:110%; margin-top:2px;">
					Tax: calculated during check out
				</div>
				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:110%; margin-top:2px;">
					Shipping Options:
					<table style="width:100%; font-size:80%; margin-top:15px;">
						<tr>
							<td>Pick up at Studio - FREE</td>
							<td style="text-align:right;">O</td>
						</tr>
						<tr>
							<td>Orders with image size over 11x14 - 24.75 - FREE</td>
							<td style="text-align:right;">O</td>
						</tr>
						<tr>
							<td>Orders up to $125 - 8.50</td>
							<td style="text-align:right;">O</td>
						</tr>
						<tr>
							<td>Orders up to $60 - 4.50</td>
							<td style="text-align:right;">O</td>
						</tr>
					</table>
					<div style="overflow:hidden; margin-top:30px;">
						<div style="float:left"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" value="Return to Images"/></div>
						<div style="float:right"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" value="Check Out" onclick="location.href = '<?php echo base_url('gallery/clients_gallery_view_checkout'); ?>'"/></div>
					</div>
				</div>
				<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:13px 0;">
					&nbsp;
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer("footer", array('client')); ?>
