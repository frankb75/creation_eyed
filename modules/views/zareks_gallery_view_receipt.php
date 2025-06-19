<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style type="text/css">

	.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

	.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }

	*table, tr, td, th{ border:1px solid #ffffff; }

</style>

<div style="margin:0 auto; width:85%; overflow:hidden;">

	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">

		<span style="color:#646468;font-size:24px;">

			Receipt

		</span>

	</div>

</div>

<div style="overflow:hidden; margin-top:5px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; color:#ffffff;">

		<table style="width:100%;font-family:Helvetica;">

			<tr style="background:#404040; font-size:16px;">

				<th style="padding:8px 0; text-align:left; padding-left:30px;">Items</th>

				<th style="padding:8px 0 8px 30px; text-align:left;">Description</th>

				<th style="padding:8px 0; text-align:left;">Size</th>

				<th style="padding:8px 0; text-align:left;">Quantity</th>

				<th style="padding:8px 0; text-align:left;">Unit Price</th>

				<th style="padding:8px 0; text-align:left;">Total</th>

			</tr>

			<?php

				$total_price = 0;

				$shipping_price = 0;

				$shipping_11x14 = 0;

				$query = $this->QModel->sfwa("cart","session_id",$this->session->userdata('isCart'));

				if( ! $this->QModel->c($query)):

			?>

			<tr>

				<td colspan="5" style="text-align:center;">No Records found!</td>

			</tr>

			<?php

				else:

				$qtax = $this->QModel->sf('tax');

				$gtax = $this->QModel->g($qtax);

				$tax = $gtax['tax'];

				

				$qship1 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',1);

				$qship2 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',2);

				$qship3 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',3);

				$gship1 = $this->QModel->g($qship1);

				$gship2 = $this->QModel->g($qship2);

				$gship3 = $this->QModel->g($qship3);

				$shipCost1 = $gship1['shipping_cost'];

				$shipCost2 = $gship2['shipping_cost'];

				$shipCost3 = $gship3['shipping_cost'];

				

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

					

					if($get3['sizes'] == "11x14")

						$shipping_11x14++;

				}

			if($get['zareks_photos_id']):

			?>

			<tr style="color:#000;">

				<td style="padding:15px 0;">

					<div style="width:134px; overflow:hidden; background:#ffffff; height:143px;">

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

									

								</div>

								<div style="float:right;"><!--Image here--></div>

							</div>

						</div>

					</div>

				</td>

				<td style="vertical-align:top; padding:15px 0; padding-left:30px;">

					<?php echo $get2['photos']; ?>

				</td>

				<td style="vertical-align:top; padding:15px 0;"><?php echo $get3['sizes']; ?></td>

				<td style="vertical-align:top; padding:15px 0;"><?php echo $get['quantity']; ?></td>

				<td style="vertical-align:top; padding:15px 0;">$<?php echo $get3['price']; ?></td>

				<td style="vertical-align:top; padding:15px 0;">$<?php echo number_format($quantity_price,2); ?></td>

				<td style="vertical-align:center;">

				</td>

			</tr>

			<?php endif; ?>

			<?php endwhile; ?>

			<tr style="color:#000">

				<td colspan="4" style="text-align:right;"><div style="margin-right:5px">Sub Total:</div></td>

				<td>$<?php echo number_format($total_price,2); ?></td>

			</tr>

			<tr style="color:#000">

				<td colspan="4" style="text-align:right;"><div style="margin-right:5px">Sales Tax:</div></td>

				<td>$<?php echo number_format($total_price * $tax,2); ?></td>

			</tr>

			<tr style="color:#000">

				<td colspan="4" style="text-align:right;"><div style="margin-right:5px">Total Shipping:</div></td>

				<td>

					<?php if($delivery_type == "Check upon pickup" OR $delivery_type == "Cash upon pickup" OR $delivery_type == "Credit Card"): ?>

						$0.00 <?php $shipping_cost = 0; ?>

					<?php else: ?>

						<?php if($shipping_11x14): ?>

							$<?php echo $shipCost1; ?> <?php $shipping_cost = $shipCost1; ?>

						<?php else: ?>

							<?php if($total_price > 60): ?>

								$<?php echo $shipCost2; ?> <?php $shipping_cost = $shipCost2; ?>

							<?php else: ?>

								$<?php echo $shipCost3; ?> <?php $shipping_cost = $shipCost3; ?>

							<?php endif; ?>

						<?php endif; ?>

					<?php endif; ?>

				</td>

			</tr>

			<tr style="color:#000">

				<td colspan="4" style="text-align:right;"><div style="margin-right:5px">Mode of Payment:</div></td>

				<td>

					<?php if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2"): ?>

						Credit Card

					<?php else: ?>

						<?php echo str_replace("upon pickup","",$delivery_type); ?>

					<?php endif; ?>

				</td>

			</tr>

			<tr style="color:#000">

				<td colspan="4" style="text-align:right;"><div style="margin-right:5px">Total:</div></td>

				<td>$<?php echo number_format($total_price + ($total_price * $tax) + $shipping_cost,2); ?></td>

			</tr>

			<?php endif; ?>

		</table>

		<br /><br />

		<form method="POST">

			<input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer; float:right;" type="submit" name="submit" value="Submit"/>

		</form>

		<br /><br /><br />

	</div>

</div>

<?php get_footer("footer"); ?>