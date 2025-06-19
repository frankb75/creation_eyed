<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("client_css")); ?>
<style>
	.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }
	#largeImage { position:absolute;padding:.5em ;background: #e3e3e3; border: 1px solid #BFBFBF; width:300px;}
</style>
<?php
	$query = $this->QModel->sfwa('myfavorites','email_address',$this->session->userdata('myfavorites'),'CAST(myfavorites_id AS DECIMAL(10,2)) ASC');
	$count = $this->QModel->c($query);
	
	if($this->input->get('zareks'))
	{
		$clients_id = $this->input->get('zareks');
		$q = $this->QModel->sfwa('zareks','zareks_id',$clients_id);
		$g = $this->QModel->g($q);
		$client_name = $g['client_name'];
	}
	else
	{
		$q = $this->QModel->sfwa('clients','clients_id',$clients_id);
		$g = $this->QModel->g($q);
		$client_name = $g['client_name'];
	}
?>
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
		<?php if($this->input->get('zareks')): ?>
			<a href="<?php echo base_url('gallery/zareks'); ?>">
				<span style="color:#646468;font-size:18px;">
					Zareks
				</span>
			</a>
		<?php else: ?>
			<a href="<?php echo base_url('gallery/clients'); ?>">
				<span style="color:#646468;font-size:18px;">
					Clients
				</span>
			</a>
		<?php endif; ?>
		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />
		<?php if($this->input->get('zareks')): ?>
			<a href="<?php echo base_url('gallery/zareks_gallery_view/'.$clients_id); ?>">
				<span style="color:#646468;font-size:18px;">
					<?php echo $client_name; ?>
				</span>
			</a>
		<?php else: ?>
			<a href="<?php echo base_url('gallery/clients_gallery_view/'.$clients_id); ?>">
				<span style="color:#646468;font-size:18px;">
					<?php echo $client_name; ?>
				</span>
			</a>
		<?php endif; ?>
		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />
		<span style="color:#646468;font-size:24px;">
			My Favorites
		</span>
	</div>
</div>
<div style="overflow:hidden; margin-top:5px; width:85%; margin:0 auto;">
	<div style="color:#646468; font-size:25px; margin-bottom:5px;">
		My Favorites
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
				<?php if($this->input->get('zareks')): ?>
					<div style="padding:15px 30px 23px 30px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold; cursor:pointer;" onclick="location.href='<?php echo base_url('gallery/zareks_gallery_view/'.$clients_id); ?>'">
				<?php else: ?>
					<div style="padding:15px 30px 23px 30px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold; cursor:pointer;" onclick="location.href='<?php echo base_url('gallery/clients_gallery_view/'.$clients_id); ?>'">
				<?php endif; ?>
					<img src="<?php echo themes_url('images/icon_return.png'); ?>" style="vertical-align:middle; margin-right:5px;"/> Return to Image
				</div>
				<?php if($this->session->userdata('events'.$clients_id)): ?>
				<div style="cursor:pointer; padding:15px 30px 23px 30px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold; border-top:1px solid #121212;" onclick="location.href='<?php echo base_url('gallery/logout/'.$clients_id); ?>'">
					<img src="<?php echo themes_url('images/icon_logout.png'); ?>" style="vertical-align:middle; margin-right:5px;"/> Logout
				</div>
				<?php endif; ?>
				<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:7px 0;">
					&nbsp;
				</div>
			</div>
		</div>
		<div style="float:right; width:73%; overflow:hidden;">
			<?php if($count): ?>
			<?php
				while($get = $this->QModel->g($query)):
				if($get['locate'] == "Zareks")
				{
					$query2 = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$get['photos_id']);
					$get2 = $this->QModel->g($query2);
					$clients_id_origin = $get2['zareks_id'];
					$clients_photos_id = $get2['zareks_photos_id'];
					$photos = $get2['semi_original_image'];
					$clients_photos_created = $get2['clients_photos_created'];
					
					$loc = "zareks";
				}
				else
				{
					$query2 = $this->QModel->sfwa('clients_photos','clients_photos_id',$get['photos_id']);
					$get2 = $this->QModel->g($query2);
					$clients_id_origin = $get2['clients_id'];
					$clients_photos_id = $get2['clients_photos_id'];
					$photos = $get2['semi_original_image'];
					$clients_photos_created = $get2['clients_photos_created'];
					
					$loc = "clients";
				}
			if($this->QModel->c($query2)):
			?>
				<div style="overflow:hidden; background:#ffffff; height:290px; width:31.5%; float:left; overflow:hidden; margin-left:9px; margin-bottom:9px;">
					<div style="text-align:center; width:auto; height:224px; overflow:hidden; margin:10px 10px 5px 10px; background:#000;">
						<a class="items" href="javascript:void(0)" data="<?php echo base_url("uploads/gallery/{$loc}/".$clients_id_origin."/original/".$get2['original_image']); ?>" style="cursor:default;">
							<table style="height:224px; margin:0 auto;">
							<tr>
								<td style="vertical-align:middle"><img src="<?php echo base_url("uploads/gallery/{$loc}/".$clients_id_origin."/semi-original/".$photos); ?>"/></td>
							</tr>
							</table>
						</a>
					</div>
					<div style="margin-left:10px; font-size:12px;"><?php echo $get2['photos']; ?></div>
					<div style="height:44px; overflow:hidden;">
						<a href="<?php echo base_url('gallery/'.$loc.'_gallery_view_image/'.$clients_id_origin.'/'.$clients_photos_id); ?>" style="margin-top:2px; display:inline-block; color:#000000; font-size:13px; font-weight:bold; margin-left:10px;">
							<img src="<?php echo themes_url('images/icon_cart.png'); ?>" style="vertical-align:middle;"/> Add Cart
						</a>
						<?php if($this->session->userdata('myfavorites')): ?>
						<?php
							$q = $this->QModel->sfwa('myfavorites',array('email_address','photos_id','locate'),array($this->session->userdata('myfavorites'),$clients_photos_id,'Clients'));
							if($this->QModel->c($q)):
						?>
							<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_btnstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $clients_id_origin; ?>,<?php echo $clients_photos_id; ?>,'<?php echo $loc; ?>');"/>
						<?php else: ?>
							<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_disstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $clients_id_origin; ?>,<?php echo $clients_photos_id; ?>,'<?php echo $loc; ?>');"/>
						<?php endif; ?>
						<?php else: ?>
							<img id="star<?php echo $clients_photos_id; ?>" src="<?php echo themes_url('images/icon_disstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $clients_id_origin; ?>,<?php echo $clients_photos_id; ?>,'<?php echo $loc; ?>');"/>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php endwhile; ?>
			<?php else: ?>
				<span style="color:#646468;">No result found!</span>
			<?php endif; ?>
		</div>
	</div>
<br /><br />
<?php get_footer("footer", array('jquery','client')); ?>
<div id="viewEvent" class="bak_light" <?php echo (isset($error) ? $error : '') ? 'style="display:block"' : ''; ?>>
	<div class="pass_pop">
		<div style="text-align:right;">
			<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="close_favorite()" style="cursor:pointer;"/>
		</div>
		<div style="font-size:12px;text-align:center;">To keep a list of your favorites please enter your email address below. You will be able to view your favorites from any computer.</div>
		<br />
		<div id="errorMsg<?php echo $clients_id; ?>"></div>
		<?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?>
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
					<td style="text-align:right;"><input id="favSubmit" type="submit" name="submit" value="Submit"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	var offsetX = 20;
	var offsetY = 10;

	$('.items').hover(function(e) {
		var href = $(this).attr('data');
		$('<img id="largeImage" src="' + href + '" alt="big image" />')
		.css('top', e.pageY + offsetY)
		.css('left', e.pageX + offsetX)
		.appendTo('body');
	}, function() {
		$('#largeImage').remove();
	});

	$('a').mousemove(function(e) {
		$("#largeImage").css('top', e.pageY + offsetY).css('left', e.pageX + offsetX);
	});
	
	function close_favorite()
	{
		document.getElementById('viewEvent').style.display = "none";
	}
	
	function markAsFavorite(val, val2, val3)
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
			
			xmlhttp.open("GET","<?php echo base_url('gallery/myfavorites'); ?>/"+val+"/"+val2+"/"+val3,true);
			xmlhttp.send();
		<?php else: ?>
			document.getElementById('viewEvent').style.display = "block";
			document.getElementById('favSubmit').removeAttribute('name');
			document.getElementById('favSubmit').setAttribute('name','submit2');
			document.getElementById('form_light').removeAttribute('action');
			document.getElementById('form_light').setAttribute('action','<?php echo base_url('gallery/clients_gallery_view/'.$clients_id); ?>/'+val2);
		<?php endif; ?>
	}
</script>