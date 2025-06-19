<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style>

.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

</style>

<?php

	$query = $this->QModel->sfwa('clients_photos','clients_id',$clients_id);

	$count = $this->QModel->c($query);

?>

<div style="margin:0 auto; width:85%; overflow:hidden;">

	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">

		<span style="color:#646468;font-size:24px;">

			<?php echo $client_name; ?>

		</span>

	</div>

</div>

<div style="overflow:hidden; margin-top:30px;">

	<div style="margin:0 auto; width:85%; overflow:hidden; color:#646468; font-size:150%;">

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

	<div style="margin:0 auto; font-family:Helvetica; width:70%; overflow:hidden;">

		<div style="float:left; width:48%; overflow:hidden; background:#ffffff; height:400px;">

			<div style="overflow:hidden; padding:15px;">

				<div style="height:340px; overflow:hidden;">

					<a href="javascript:void(0);"><img id="image" src="<?php echo base_url("uploads/gallery/clients/".$clients_id."/original/".$original_image); ?>" style="display:block;" width="360" height="340"/></a>

				</div>

				<div style="overflow:hidden;">

					<div style="float:left; color:#000000; font-size:130%; font-weight:bold; padding-top:10px;">

						<?php echo $photos; ?>

					</div>

					<div style="float:right;"><!--Image here--></div>

				</div>

			</div>

		</div>

		<div style="float:right; width:35%; overflow:hidden;">

			<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:13px 0;">

				&nbsp;

			</div>

			<a href="javascript:void(0)" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold;" onclick="open_favorite()">

				<img src="<?php echo themes_url('images/icon_fullstar.png'); ?>" style="vertical-align:middle; margin-right:5px;"> My Favorites Photo

			</a>

			<?php if($this->session->userdata('myfavorites')): ?>

				<?php

					$q = $this->QModel->sfwa('myfavorites',array('email_address','photos_id'),array($this->session->userdata('myfavorites'),$clients_photos_id));

					if($this->QModel->c($q)):

				?>

				<a href="javascript:void(0)" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;" onclick="markAsFavorite(<?php echo $clients_id; ?>,<?php echo $clients_photos_id; ?>);">

					<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_fullstar.png'); ?>" style="vertical-align:middle; margin-right:5px;"> <span id="favMsg2">Remove to my Favorites</span>

				</a>

				<?php else: ?>

				<a href="javascript:void(0)" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;" onclick="markAsFavorite(<?php echo $clients_id; ?>,<?php echo $clients_photos_id; ?>);">

					<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_blackstar.png'); ?>" style="vertical-align:middle; margin-right:5px;"> <span id="favMsg2">Add to my Favorites</span>

				</a>

				<?php endif; ?>

			<?php else: ?>

			<a href="javascript:void(0)" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;" onclick="markAsFavorite(<?php echo $clients_id; ?>,<?php echo $clients_photos_id; ?>);">

				<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_blackstar.png'); ?>" style="vertical-align:middle; margin-right:5px;"> <span id="favMsg2">Add to my Favorites</span>

			</a>

			<?php endif; ?>

			<a id="viewBNW" href="javascript:void(0);" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;" onclick="blackAndWhite(1); return false;">

				<img src="<?php echo themes_url('images/icon_blackandwhite.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Black and White

			</a>

			<a href="<?php echo base_url('gallery/clients_gallery_image_purchase/'.$clients_id.'/'.$clients_photos_id); ?>" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;">

				<img src="<?php echo themes_url('images/icon_purchase.png'); ?>" style="vertical-align:middle; margin-right:5px;"> Purchase Image

			</a>

			<a href="<?php echo base_url('gallery/clients_gallery_view/'.$clients_id); ?>" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;">

				<img src="<?php echo themes_url('images/icon_return.png'); ?>" style="vertical-align:middle; margin-right:5px;"> Return to Images

			</a>

			<?php if($this->session->userdata('events'.$clients_id)): ?>

			<a href="<?php echo base_url('gallery/logout/'.$clients_id); ?>" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;">

				<img src="<?php echo themes_url('images/icon_logout.png'); ?>" style="vertical-align:middle; margin-right:5px;"> Logout

			</a>

			<?php endif; ?>

			<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:13px 0;">

				&nbsp;

			</div>

		</div>

	</div>

	<div style="margin:0 auto; font-family:Helvetica; width:70%; overflow:hidden; margin-top:30px;">

		<p style="color:#646468; font-size:130%;">These images are for web viewing purposes only. Your actual photos will be professionally printed from the original high quality images. All images are copyright of the photographer.</p>

	</div>

</div>

<?php get_footer("footer", array('client')); ?>

<div id="viewEvent" class="bak_light" <?php echo (isset($error) ? $error : '') ? 'style="display:block"' : ''; ?>>

	<div class="pass_pop">

		<div style="text-align:right;">

			<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="close_favorite()" style="cursor:pointer;"/>

		</div>

		<div style="font-size:12px;text-align:center;">To keep a list of your favorites please enter your email address below. You will be able to view your favorites from any computer.</div>

		<br />

		<div id="errorMsg<?php echo $clients_id; ?>"></div>

		<div id="favMsg" style="color:red; font-size:12px;"><?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?></div>

		<form id="form_light" method="POST">

			<table>

				<tr>

					<td><input class="input_text" type="text" name="email_address" placeholder="Enter your Email Address" /></td>

				</tr>

				<tr>

					<td><div style="font-size:12px; text-align:center;">For privacy concerns please see our privacy policy</div></td>

				</tr>

				<tr>

					<td>&nbsp;</td>

				</tr>

				<tr>

					<td style="text-align:right;">

						<input id="favSubmit" type="submit" name="submit" value="Submit"/>

						<img id="loading2" src="<?php echo themes_url('images/loading2.gif'); ?>" style="display:none;"/>

					</td>

				</tr>

			</table>

		</form>

	</div>

</div>

<script type="text/javascript">

	function blackAndWhite(val)

	{

		if(val == 1)

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','blackandwhite');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(2)');

			document.getElementById('viewBNW').innerHTML = '<img src="<?php echo themes_url('images/icon_Color.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Color';

		}

		else

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','Color');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(1)');

			document.getElementById('viewBNW').innerHTML = '<img src="<?php echo themes_url('images/icon_blackandwhite.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Black and White';

		}

	}

	

	function open_favorite()

	{

		<?php if($this->session->userdata('myfavorites')): ?>

			location.href = '<?php echo base_url('gallery/favorites/'.$clients_id); ?>';

		<?php else: ?>

			document.getElementById('viewEvent').style.display = "block";

			document.getElementById('favSubmit').removeAttribute('name');

			document.getElementById('favSubmit').setAttribute('name','submit');

			document.getElementById('form_light').removeAttribute('onsubmit');

			document.getElementById('form_light').setAttribute("onsubmit","return myfav(this,'<?php echo base_url('gallery/enteremailfavorites/'.$clients_id); ?>','submit');");

		<?php endif; ?>

	}

	

	function close_favorite()

	{

		document.getElementById('viewEvent').style.display = "none";

	}

	

	function markAsFavorite(val, val2)

	{

		<?php if($this->session->userdata('myfavorites')): ?>

			document.getElementById('star'+val2).src = '<?php echo themes_url('images/loading2.gif'); ?>';

			

			var xmlhttp;

			if (window.XMLHttpRequest)

			{

				xmlhttp=new XMLHttpRequest();

			}

			else

			{

				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

			}

			

			xmlhttp.onreadystatechange = function()

			{

				if (xmlhttp.readyState==4 && xmlhttp.status==200)

				{

					if(xmlhttp.responseText == "Successfully deleted.")

					{

						document.getElementById('star'+val2).src = '<?php echo themes_url('images/icon_blackstar.png'); ?>';

						document.getElementById('favMsg2').innerHTML = 'Add to my Favorites';

					}

					else

					{

						document.getElementById('star'+val2).src = '<?php echo themes_url('images/icon_fullstar.png'); ?>';

						document.getElementById('favMsg2').innerHTML = 'Remove to my Favorites';

					}

				}

			};

			

			xmlhttp.open("GET","<?php echo base_url('gallery/myfavorites'); ?>/"+val+"/"+val2,true);

			xmlhttp.send();

		<?php else: ?>

			document.getElementById('viewEvent').style.display = "block";

			document.getElementById('favSubmit').removeAttribute('name');

			document.getElementById('favSubmit').setAttribute('name','submit2');

			document.getElementById('form_light').removeAttribute('onsubmit');

			document.getElementById('form_light').setAttribute("onsubmit","return myfav(this,'<?php echo base_url('gallery/enteremailfavorites/'.$clients_id); ?>/"+val2+"','submit2');");

		<?php endif; ?>

	}

	

	function myfav(form, url,submit)

	{

		document.getElementById('favSubmit').style.display = "none";

		document.getElementById('loading2').style.display = "inline-block";

		

		var xmlhttp;

		if (window.XMLHttpRequest)

		{

			xmlhttp=new XMLHttpRequest();

		}

		else

		{

			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

		}

		

		xmlhttp.onreadystatechange = function()

		{

			if (xmlhttp.readyState==4 && xmlhttp.status==200)

			{

				if(xmlhttp.responseText == "Success2")

				{

					document.getElementById('favMsg').innerHTML = '<span style="color:green">Successfully submitted. Please wait...</span>';

					setTimeout(function(){

						history.go(0);

					},2500);

				}

				else if(xmlhttp.responseText == "Success")

				{

					document.getElementById('favMsg').innerHTML = '<span style="color:green">Successfully submitted. Please wait...</span>';

					setTimeout(function(){

						location.href = "<?php echo base_url('gallery/favorites/'.$clients_id); ?>";

					},2500);

				}

				else

				{

					document.getElementById('favMsg').innerHTML = xmlhttp.responseText;

					document.getElementById('favSubmit').style.display = "inline-block";

					document.getElementById('loading2').style.display = "none";

				}

			}

		};

		

		xmlhttp.open("POST",url,true);

		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlhttp.send('email_address='+form.email_address.value+'&'+submit+'=true');

		

		return false;

	}

</script>