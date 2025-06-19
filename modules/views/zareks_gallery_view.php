<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("client_css","lightbox")); ?>
<?php
	$query = $this->QModel->sfwa('zareks_photos','zareks_id',$zareks_id,'CAST(zareks_photos_id AS DECIMAL(10,2)) ASC');
	$count = $this->QModel->c($query);
?>
<div style="overflow:hidden; margin-top:5px; width:85%; margin:0 auto;">
	<div style="color:#646468; font-size:25px; margin-bottom:5px;">
		<?php echo $client_name; ?>
	</div>
	<div style="margin:0 auto; width:100%; overflow:hidden; background:url('<?php echo themes_url('images/bg_1.png'); ?>'); padding:8px 0; color:#ffffff; font-size:120%;">
		<div style="float:right; margin-right:10px;">
			<img src="<?php echo themes_url('images/icon_image.png'); ?>" style="vertical-align:middle;"/> <span style="font-size:16px;"><?php echo $count; ?> Images</span>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="overflow:hidden; margin-top:20px; margin-left:20px;">
		<div style="margin:0 auto; font-family:Helvetica; float:left; width:25%; overflow:hidden;">
			<div style="float:left; width:100%; overflow:hidden;">
				<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:7px 0;">
					&nbsp;
				</div>
				<div style="padding:15px 30px 23px 30px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold; cursor:pointer;" onclick="open_favorite()">
					<img src="<?php echo themes_url('images/icon_star.png'); ?>" style="vertical-align:middle; margin-right:5px;"/> My Favorites Photo
				</div>
				<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:7px 0;">
					&nbsp;
				</div>
			</div>
		</div>
		<form method="POST">
			<div style="float:right; width:73%; overflow:hidden;">
				<?php if(isset($error2) ? $error2 : "") { echo '<div style="color:red;">'.$error2.'</div>'; } ?>
				<div id="galleryView">
					<img src="<?php echo themes_url('images/loading2.gif'); ?>" style="vertical-align:middle;"/> Please wait while images are loading...
				</div>
			</div>
		</form>
	</div>
<br /><br />
<?php get_footer("footer", array('jquery','client','lightbox')); ?>
<div id="viewEvent" class="bak_light" <?php echo (isset($error) ? $error : '') ? 'style="display:block"' : ''; ?>>
	<div class="pass_pop">
		<div style="text-align:right;">
			<img src="<?php echo themes_url('images/close_button_red.png'); ?>" onclick="close_favorite()" style="cursor:pointer;"/>
		</div>
		<div style="font-size:12px;text-align:center;color:#d4d4d4;">To keep a list of your favorites please enter your email address below. You will be able to view your favorites from any computer.</div>
		<br />
		<div id="errorMsg<?php echo $zareks_id; ?>"></div>
		<div id="favMsg" style="color:red; font-size:12px;"><?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?></div>
		<form id="form_light" method="POST">
			<table>
				<tr>
					<td><input class="input_text" type="text" name="email_address" placeholder="Enter your Email Address" /></td>
				</tr>
				<tr>
					<td><div style="font-size:12px; text-align:center;color:#d4d4d4;">For privacy concerns please see our privacy policy</div></td>
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
	setTimeout(function(){
		openImages();
	},2000);
	function openImages()
	{		
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
				document.getElementById('galleryView').innerHTML = xmlhttp.responseText;
			}
		};
		
		xmlhttp.open("GET","<?php echo base_url('gallery/zareksImagesLoading/'.$zareks_id); ?>",true);
		xmlhttp.send();
	}
	
	function open_favorite()
	{
		<?php if($this->session->userdata('myfavorites')): ?>
			location.href = '<?php echo base_url('gallery/favorites?zareks='.$zareks_id); ?>';
		<?php else: ?>
			document.getElementById('viewEvent').style.display = "block";
			document.getElementById('favSubmit').removeAttribute('name');
			document.getElementById('favSubmit').setAttribute('name','submit');
			document.getElementById('form_light').removeAttribute('onsubmit');
			document.getElementById('form_light').setAttribute("onsubmit","return myfav(this,'<?php echo base_url('gallery/enteremailfavorites/'.$zareks_id); ?>','submit');");
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
						document.getElementById('star'+val2).src = '<?php echo themes_url('images/icon_disstar.png'); ?>';
					}
					else
					{
						document.getElementById('star'+val2).src = '<?php echo themes_url('images/icon_btnstar.png'); ?>';
					}
				}
			};
			
			xmlhttp.open("GET","<?php echo base_url('gallery/myfavorites'); ?>/"+val+"/"+val2+"/zareks",true);
			xmlhttp.send();
		<?php else: ?>
			document.getElementById('viewEvent').style.display = "block";
			document.getElementById('favSubmit').removeAttribute('name');
			document.getElementById('favSubmit').setAttribute('name','submit3');
			document.getElementById('form_light').removeAttribute('onsubmit');
			document.getElementById('form_light').setAttribute("onsubmit","return myfav(this,'<?php echo base_url('gallery/enteremailfavorites/'.$zareks_id); ?>/"+val2+"','submit3');");
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
						location.href = "<?php echo base_url('gallery/favorites/'.$zareks_id.'?zareks=1'); ?>";
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