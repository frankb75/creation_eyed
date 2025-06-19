<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css","nano2")); ?>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<style>

.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }

#main-right-nav { margin-top:150px; }

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

		<a href="<?php echo base_url('gallery/clients'); ?>">

			<span style="color:#646468;font-size:18px;">

				Clients

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<span style="color:#646468;font-size:24px;">

			<?php echo $client_name; ?>

		</span>

	</div>

<?php echo isset($error) ? '<div style="padding:5px; color:red;">'.$error.'</div>' : ""; ?>

</div>

<div style="overflow:hidden; margin-top:30px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; color:#646468; font-size:18px;">

		<div style="float:left;">

			<?php echo $client_name; ?>

		</div>

	</div>

</div>

<div style="overflow:hidden; margin-top:5px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; background:#404040; padding:8px 0; color:#ffffff;">

		<div style="float:left; margin-left:10px;">

			<img src="<?php echo themes_url('images/icon_calendar.png'); ?>" style="vertical-align:middle;"/> <span style="font-size:16px;"><?php echo date("F j, Y",strtotime($date_client)); ?></span> <span style="font-size:16px; margin-left:30px;">Expires: <?php echo date("F j, Y",strtotime($expiration_date)); ?></span>

		</div>

		<div style="clear:both;"></div>

	</div>

</div>

<div style="overflow:hidden; margin-top:20px;">

	<div style="margin:0 auto; font-family:Helvetica; width:85%; overflow:hidden;">

		<div style="float:left; width:41%;">

			<?php

				$query = $this->QModel->sfwa('selected_photos','unique_id',$unique_id);

				$count = $this->QModel->c($query);

				

				if($count == 1)

					$nano = "340px";

				else if($count == 2)

					$nano = "700px";

				else

					$nano = "712px";

			?>

			<div class="nano" style="height:<?php echo $nano; ?>;">

				<div class="nano-content" style="color:#646468; height:<?php echo $nano; ?>; overflow-y:scroll;">

					<?php

						$i = 0;

						while($get = $this->QModel->g($query)):

						$zareks_photos_id = $get['zareks_photos_id'];

						

						$q = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$zareks_photos_id);

						$g = $this->QModel->g($q);

						$original_image = $g['original_image'];

						$photos = $g['photos'];

						

						if( ! $i)

							$border = "green";

						else

							$border = "transparent";

					?>

					<div id="img<?php echo $i; ?>" style="cursor:pointer; width:300px; overflow:hidden; background:#ffffff; height:300px; border:5px solid <?php echo $border; ?>; margin:0 auto;" onclick="selectingImage(<?php echo $i; ?>)">

						<div style="overflow:hidden; padding:15px;">

							<div style="height:240px; overflow:hidden;">

								<img id="image<?php echo $zareks_photos_id; ?>" src="<?php echo base_url("uploads/gallery/zareks/".$zareks_id."/original/".$original_image); ?>" style="display:block;" width="100%" height="250"/>

							</div>

							<div style="overflow:hidden;">

								<div style="float:left; color:#000000; font-size:18px; font-weight:bold; padding-top:10px;">

									<?php echo $photos; ?>

								</div>

							</div>

						</div>

					</div>

					<div style="width:300px; margin:0 auto;">

						<button id="viewBNW<?php echo $zareks_photos_id; ?>" style="margin-top:5px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer; margin-bottom:15px;" onclick="blackAndWhite(1,<?php echo $zareks_photos_id; ?>)">View in Black and White</button>

					</div>

					<?php $i++; endwhile; ?>

				</div>

			</div>

			<div>

				<p style="color:#646468; margin-top:8px;">NOTE: An image that is displayed only in B&W cannot be ordered as a color print.</p>

			</div>

		</div>

		<form method="POST">

			<div class="payment_proccess" style="float:right; width:54%; overflow:hidden;">

				<?php

					$qright = $this->QModel->sfwa('selected_photos','unique_id',$unique_id);

					$ii = 0;

					while($gright = $this->QModel->g($qright)):

					$zareks_photos_id = $gright['zareks_photos_id'];

					

					if( ! $ii)

						$dis = "table";

					else

						$dis = "none";

				?>

				<table id="quantity<?php echo $ii; ?>" style="width:100%; display:<?php echo $dis; ?>">

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

						

						$query3 = $this->QModel->sfwa('cart',array('session_id','delivery_setup_id','color','zareks_photos_id'),array($this->session->userdata('isCart'),$delivery_setup_id,'BlacknWhite',$zareks_photos_id));

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

						if($this->input->post('color'.$ii)[$delivery_setup_id]):

					?>

					<td style="text-align:center;"><input type="text" name="color<?php echo $ii; ?>[<?php echo $delivery_setup_id; ?>]" value="<?php echo $this->input->post('color'.$ii)[$delivery_setup_id]; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php else: ?>

					<td style="text-align:center;"><input type="text" name="color<?php echo $ii; ?>[<?php echo $delivery_setup_id; ?>]" value="<?php echo $val; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php endif; ?>

					<?php

						if($this->input->post('bw'.$ii)[$delivery_setup_id]):

					?>

					<td style="text-align:center;"><input type="text" name="bw<?php echo $ii; ?>[<?php echo $delivery_setup_id; ?>]" value="<?php echo $this->input->post('bw'.$ii)[$delivery_setup_id]; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php else: ?>

					<td style="text-align:center;"><input type="text" name="bw<?php echo $ii; ?>[<?php echo $delivery_setup_id; ?>]" value="<?php echo $val2; ?>" style="width:60px; margin-top:5px; padding:3px;"/></td>

					<?php endif; ?>

					<td style="text-align:center;"><span style="color:#646468; font-weight:bold;">$<?php echo $price; ?></span></td>

					<td style="text-align:center;"><span style="color:#646468; font-weight:bold;"><?php echo $sizes; ?></span></td>

				</tr>

				<?php endwhile; ?>

				</table>

				<?php $ii++; endwhile; ?>

				<div style="text-align:right;">

					<input style="margin-top:10px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="return" value="Return to Images"/><input style="margin-top:10px; margin-left:20px; font-size:14px; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="add" value="Add to Cart"/>

				</div>

			</div>

		</div>

	</div>

</div>

<?php get_footer("footer", array('client','nano')); ?>

<script type="text/javascript">

	$(".nano").nanoScroller({

		alwaysVisible: true,

		scroll: "top"    

	});

	

	function blackAndWhite(val,id)

	{

		if(val == 1)

		{

			document.getElementById('image'+id).removeAttribute('class');

			document.getElementById('image'+id).setAttribute('class','blackandwhite');

			document.getElementById('viewBNW'+id).removeAttribute('onclick');

			document.getElementById('viewBNW'+id).setAttribute('onclick','blackAndWhite(2,'+id+')');

			document.getElementById('viewBNW'+id).innerHTML = 'View in Color';

		}

		else

		{

			document.getElementById('image'+id).removeAttribute('class');

			document.getElementById('image'+id).setAttribute('class','Color');

			document.getElementById('viewBNW'+id).removeAttribute('onclick');

			document.getElementById('viewBNW'+id).setAttribute('onclick','blackAndWhite(1,'+id+')');

			document.getElementById('viewBNW'+id).innerHTML = 'View in Black and White';

		}

	}

	

	function selectingImage(i)

	{

		var total = 0;

		while(total < <?php echo $i; ?>)

		{

			document.getElementById('img'+total).style.border = "5px solid transparent";

			document.getElementById('quantity'+total).style.display = "none";

			total++;

		}

		

		document.getElementById('img'+i).style.border = "5px solid green";

		document.getElementById('quantity'+i).style.display = "table";

	}

	

	document.getElementById('main-right-nav').style.marginTop = "120px";

</script>