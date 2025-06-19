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

		<a href="<?php echo base_url($this->segment->uri(0)); ?>">

			<span style="color:#646468;font-size:18px;">

				<?php echo ucwords($this->segment->uri(0)); ?>

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<a href="<?php echo base_url('gallery/zareks'); ?>">

			<span style="color:#646468; font-size:18px;">

				Zarek's

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<span style="color:#646468;font-size:24px;">

			<?php echo $photos; ?>

		</span>

	</div>

<?php echo isset($error) ? '<div style="padding:5px; color:red;">'.$error.'</div>' : ""; ?>

</div>

<div style="overflow:hidden; margin-top:20px;">

	<div style="margin:0 auto; font-family:Helvetica; width:85%; overflow:hidden;">

		<div style="float:left; width:41%;">

			<div style="width:100%; overflow:hidden; background:#ffffff; height:400px;">

				<div style="overflow:hidden; padding:15px;">

					<div style="height:340px; overflow:hidden;">

						<a href="javascript:void(0);"><img id="image" src="<?php echo base_url("uploads/gallery/zareks/{$zareks_id}/original/".$original_image); ?>" style="display:block;" width="375" height="340"/></a>

					</div>

					<div style="overflow:hidden;">

						<div style="float:left; color:#000000; font-size:130%; font-weight:bold; padding-top:10px;">

							<?php echo $photos; ?>

						</div>

						<div style="float:right;"><!--Image here--></div>

					</div>

				</div>

			</div>

			<div>

			<button id="viewBNW" style="margin-top:10px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer;" onclick="blackAndWhite(1)">View in Black and White</button>

			<p style="color:#646468; margin-top:8px;">NOTE: An image that is displayed only in B&W cannot be ordered as a color print.</p>

			</div>

		</div>

		<div class="payment_proccess" style="float:right; width:54%; overflow:hidden;">

			<form method="POST">

				<table style="width:100%;">

				<tr>

					<th style="width:22%;">Color Qty*</th>

					<th style="width:22%;">B&W Qty</th>

					<th style="width:22%;">Price</th>

					<th style="width:34%;">Size</th>

				</tr>

				<?php 

					$query = $this->QModel->sf('delivery_setup_zarek');

					while($get = $this->QModel->g($query)):

					$delivery_setup_id = $get['delivery_setup_id'];

					$sizes = $get['sizes'];

					$price = $get['price'];

					

					if($this->session->userdata('isCart'))

					{

						$query2 = $this->QModel->sfwa('cart',array('session_id','delivery_setup_id','color','zareks_photos_id'),array($this->session->userdata('isCart'),$delivery_setup_id,'Color',$zareks_photos_id));

						if($this->QModel->c($query2))

						{

							$get2 = $this->QModel->g($query2);

							$val = $get2['quantity'];

						}

						else

						{

							$val = "";

						}

						

						$query3 = $this->QModel->sfwa('cart',array('session_id','delivery_setup_id','color','zareks_photos_id'),array($this->session->userdata('isCart'),$delivery_setup_id,'B&W',$zareks_photos_id));

						if($this->QModel->c($query3))

						{

							$get3 = $this->QModel->g($query3);

							$val2 = $get3['quantity']; 

						}

						else

						{

							$val2 = "";

						}

					}

					else

					{

						$val = "";

						$val2 = "";

					}

				?>

				<tr>

					<?php

						if($this->input->post('color')[$delivery_setup_id]):

					?>

					<td style="text-align:center;"><input type="text" name="color[<?php echo $delivery_setup_id; ?>]" value="<?php echo $this->input->post('color')[$delivery_setup_id]; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php else: ?>

					<td style="text-align:center;"><input type="text" name="color[<?php echo $delivery_setup_id; ?>]" value="<?php echo $val; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php endif; ?>

					<?php

						if($this->input->post('bw')[$delivery_setup_id]):

					?>

					<td style="text-align:center;"><input type="text" name="bw[<?php echo $delivery_setup_id; ?>]" value="<?php echo $this->input->post('bw')[$delivery_setup_id]; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php else: ?>

					<td style="text-align:center;"><input type="text" name="bw[<?php echo $delivery_setup_id; ?>]" value="<?php echo $val2; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php endif; ?>

					<td style="text-align:center;"><span style="color:#646468; font-weight:bold;">$<?php echo $price; ?></span></td>

					<td style="text-align:center;"><span style="color:#646468; font-weight:bold;"><?php echo $sizes; ?></span></td>

				</tr>

				<?php endwhile; ?>

				<tr>

					<td style="text-align:right;" colspan="4">

						<input style="margin-top:10px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="return" value="Return to Shopping Cart"/><input style="margin-top:10px; margin-left:20px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="add" value="Add to Cart"/>

					</td>

				</tr>

				</table>

			</form>

		</div>

	</div>

</div>

<?php get_footer("footer"); ?>

<script type="text/javascript">

	function blackAndWhite(val)

	{

		if(val == 1)

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','blackandwhite');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(2)');

			document.getElementById('viewBNW').innerHTML = 'View in Color';

		}

		else

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','Color');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(1)');

			document.getElementById('viewBNW').innerHTML = 'View in Black and White';

		}

	}

</script>