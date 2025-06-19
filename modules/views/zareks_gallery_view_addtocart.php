<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style type="text/css">

	.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }

	*table, tr, td, th{ border:1px solid #ffffff; }

</style>

<?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?>

<div style="overflow:hidden;">

	<div style="font-family:Helvetica; margin:0 auto; width:85%; overflow:hidden; color:#646468;">

		<div style="float:left; font-size:24px;">

			My Cart

		</div>

	</div>

</div>

<div style="overflow:hidden; margin-top:5px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; color:#ffffff;">

		<div style="float:left; width:60%; margin-right:1%">

		<table style="width:100%;font-family:Helvetica;">

			<tr style="background:#404040; font-size:16px;">

				<th style="width:18%; padding:8px 0; text-align:left; padding-left:30px;">Photo</th>

				<th style="width:23%; padding:8px 0 8px 30px; text-align:left;">Quantity</th>

				<th style="width:25%; padding:8px 0; text-align:left;">Size</th>

				<th style="width:13%; padding:8px 0; text-align:left;">Price</th>

				<th style="width:8%; padding:8px 0; text-align:left;">Total</th>

				<th style="width:13%;"></th>

			</tr>

			<?php

				$total_price = 0;

				$query = $this->QModel->sfwa("cart","session_id",$this->session->userdata('isCart'));

				if( ! $this->QModel->c($query)):

			?>

			<tr>

				<td colspan="6" style="text-align:center;">No Records found!</td>

			</tr>

			<?php

				else:

				while($get = $this->QModel->g($query)):

				if($get['zareks_photos_id'])

				{

					// Get folder name.

					$query2 = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$get['zareks_photos_id']);

					$get2 = $this->QModel->g($query2);

					

					// Get delivery_setup

					$query3 = $this->QModel->sfwa('delivery_setup_zarek','delivery_setup_id',$get['delivery_setup_id']);

					$get3 = $this->QModel->g($query3);

					$total_price += $get3['price'] * $get['quantity'];

					$quantity_price = $get3['price'] * $get['quantity'];

				}

			if($get['zareks_photos_id']):

			?>

			<tr>

				<td style="padding:15px 0;">

					<div style="width:134px; overflow:hidden; background:#ffffff; height:170px;">

						<div style="overflow:hidden; padding:5px;">

							<div style="height:134px; width:124px; text-align:center; overflow:hidden;">

								<div style="height:134px; width:124px; display:table-cell; vertical-align:middle;">

								<?php if($get['color'] == "Color"): ?>

									<img src="<?php echo base_url('uploads/gallery/zareks/'.$get2['zareks_id'].'/semi-original/'.$get2['semi_original_image']); ?>" style="margin:0 auto; width:124px;"/>

								<?php else: ?>

									<img class="blackandwhite" src="<?php echo base_url('uploads/gallery/zareks/'.$get2['zareks_id'].'/semi-original/'.$get2['semi_original_image']); ?>" style="margin:0 auto; width:124px;"/>

								<?php endif; ?>

								</div>

							</div>

							<div style="overflow:hidden;">

								<div style="float:left; color:#000000; font-size:90%; font-weight:bold; margin-top:10px;">

									<?php echo $get2['photos']; ?>

								</div>

								<div style="float:right;"><!--Image here--></div>

							</div>

						</div>

					</div>

				</td>

				<td style="vertical-align:top; padding:15px 0; padding-left:30px;">

					<form action="<?php echo base_url('gallery/zareks_gallery_view_addtocart/'.$get['cart_id'].'?r='.$this->input->get('r')); ?>" method="POST">

						<input class="input_text" type="text" name="quantity" value="<?php echo $get['quantity']; ?>" style="width:75px;"/>

						<br />

						<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; padding:3px 0; text-align:center; width:87px;" type="submit" name="update" value="Update Qty"/>

						<br />

						<input style="margin-top:10px; font-size:90%; border-radius:5px; cursor:pointer; text-align:center; width:87px;" type="submit" name="return" value="More Size" onclick="location.href = '<?php echo base_url('gallery/zareks_gallery_image_purchase/'.$get2['zareks_id'].'/'.$get['zareks_photos_id'].'?r='.$this->input->get('r')); ?>'; return false;"/>

					</form>

					<?php if($get['zareks_photos_id']): ?>

						<form action="<?php echo base_url('gallery/zareks_gallery_view_addtocart/'.$get['cart_id'].'?r='.$this->input->get('r')); ?>" method="POST">

							<input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer; width:87px;" type="submit" name="remove" value="Remove"/>

						</form>

					<?php else: ?>

						<form action="<?php echo base_url('gallery/zareks_gallery_view_addtocart/'.$get['cart_id'].'?r='.$this->input->get('r')); ?>" method="POST">

							<input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer; width:87px;" type="submit" name="remove" value="Remove"/>

						</form>

					<?php endif; ?>

				</td>

				<td style="vertical-align:top; padding:15px 0;color:#646468;"><?php echo $get3['sizes']; ?></td>

				<td style="vertical-align:top; padding:15px 0;color:#646468;">$<?php echo $get3['price']; ?></td>

				<td style="vertical-align:top; padding:15px 0;color:#646468;">$<?php echo number_format($quantity_price,2); ?></td>

				<td style="vertical-align:center;">

					

				</td>

			</tr>

			<?php endif; ?>

			<?php endwhile; ?>

			<?php endif; ?>

		</table>

		</div>

		<?php if($this->QModel->c($query)): ?>

		<div style="overflow:hidden; float:left; width:370px;">

			<div style="float:left; width:370px; overflow:hidden;">

				<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:8px 0;">

					&nbsp;

				</div>

				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold">

					Subtotal: <span style="color:green;">$<?php echo number_format($total_price,2); ?></span>

				</div>

				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:14px; margin-top:2px;">

					Tax: calculated during check out

				</div>

				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:14px; margin-top:2px;">

					Shipping Options:

					<form method="POST">

						<table style="width:100%; font-size:14px; margin-top:15px;">

							<tr>

								<td><span style="color:#fdd337; font-size:18px;">Pick up at Studio - <span style="font-size:15px;">No Shipping Charges</span></span></td>

							</tr>

							<tr>

								<td><div style="margin-left:30px;">Check</div></td>

								<td style="text-align:right;"><input type="radio" name="delivery" value="Check upon pickup"/></td>

							</tr>

							<tr>

								<td><div style="margin-left:30px;">Cash</div></td>

								<td style="text-align:right;"><input type="radio" name="delivery" value="Cash upon pickup"/></td>

							</tr>

							<tr>

								<td><div style="margin-left:30px;">Credit Card</div></td>

								<td style="text-align:right;"><input type="radio" name="delivery" value="Credit Card"/></td>

							</tr>

							<tr>

								<td>&nbsp;</td>

							</tr>

							<tr>

								<td><span style="color:#fdd337; font-size:18px;">Ship Photos</span></td>

							</tr>

							<tr>

								<td><div style="margin-left:30px;">Mail the check</div></td>

								<td style="text-align:right;"><input type="radio" name="delivery" value="Mail the check"/></td>

							</tr>

							<tr>

								<td><div style="margin-left:30px;">Credit Card</div></td>

								<td style="text-align:right;"><input type="radio" name="delivery" value="Credit Card2"/></td>

							</tr>

						</table>

						<div style="overflow:hidden; margin-top:30px;">

							<?php

								if($this->input->get('r'))

									$return_url = base_url('gallery/zareks_gallery_view/'.$this->input->get('r'));

								else

									$return_url = base_url('gallery/zareks');

							?>

							<div style="float:left"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" value="Return to Images" onclick="location.href = '<?php echo $return_url; ?>'; return false;"/></div>

							<div style="float:right"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="checkout" value="Check Out"/></div>

						</div>

					</form>

				</div>

				<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:8px 0;">

					&nbsp;

				</div>

			</div>

		</div>

		<?php endif; ?>

	</div>

</div>

<?php get_footer("footer", array('client')); ?>