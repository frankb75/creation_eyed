<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','admin_categorycss','ce_alert','cc_box','lightbox','adminClient')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="selected-menu" href="<?php echo base_url('admin/zareks'); ?>" style="margin-left:20px;">Photos</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/zareksDeliverySetup'); ?>">Delivery Setup</a>
	</div>
	<div style="padding:50px 20px 0 20px; overflow:hidden;">
	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; ?>
		<form method="POST" enctype="multipart/form-data">
			<div style="float:left;">
				<div class="photo_head">
					Upload Photo
				</div>
				<br />
				<input class="input_text" type="file" name="file[]" style="background:#fff;" multiple />
			</div>
			<div style="float:left; padding-left:10px;">
				<input class="input_submit" type="submit" name="upload_photo" value="Upload Photo" />
			</div>
		</form>
	</div>
	<div style="padding:10px 20px 0 20px; overflow:hidden;">
		<table style="width:73%;">
			<tr class="tbl_head">
				<td colspan="2">&nbsp;Photos</td>
			</tr>
			<?php
				$query = $this->QModel->sf('zareks_photos','CAST(photos_id AS DECIMAL(10,2)) ASC');
				if( ! $this->QModel->c($query)):
			?>
			<tr>
				<td><span style="font-size:14px;">No photo uploaded.</span></td>
			</tr>
			<?php else: ?>
			<tr>
				<td style="text-align:center;">
					<?php $i = 0; while($get = $this->QModel->g($query)): ?>
					<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off" style="display:none;">
						<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
					</form>
					<div style="float:left; margin-right:16px; margin-bottom:5px; overflow:hidden;">
						<img src="<?php echo themes_url('images/close_button_red.png'); ?>" onclick="alert_box('delete','this image','<?php echo base_url('admin/delete_gallery/'.$get['photos_id']); ?>')" style="float:left; margin-right:5px; cursor:pointer;" alt="Delete"/>
						<img id="gallery<?php echo $i; ?>" src="<?php echo themes_url('images/icon_edit_small.png'); ?>" style="float:left; cursor:pointer;" alt="Edit"/>
						<br />
						<div style="height:126px; width:126px; text-align:center; background:black; border:3px solid #a4a4a4; border-radius:5px; text-align:center; overflow:hidden;">
							<div style="height:126px; width:126px; display:table-cell; vertical-align:middle;">
								<a href="<?php echo base_url('uploads/gallery/zareks/original/'.$get['photos']); ?>" rel="lightbox[jnk]"><img src="<?php echo base_url($location_thumb.''.$get['thumbnail_image']); ?>" style="margin:0 auto;"/></a>
							</div>
						</div>
					</div>
					<?php //if($i == 4){ $i = -1; echo '<div style="clear:both">&nbsp;</div>'; } ?>
					<script>
						document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
							uploadFiles('<?php echo base_url('admin/gellery_reupload/'.$get['photos_id']); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('admin/zareks'); ?>');
						}, false);

						var wed<?php echo $i; ?> = document.getElementById("gallery<?php echo $i; ?>");
						wed<?php echo $i; ?>.onclick = function(event) {
							document.uploading<?php echo $i; ?>.upload.click(event);
						};
					</script>
					<?php $i++; endwhile; ?>
				</td>
			</tr>
			<?php endif; ?>
		</table>
	</div>
</div>
<?php get_footer("admin/footer",array("jquery","ce_alert","lightbox")); ?>
<div id="cc-panel">
<div style="overflow:hidden;">
	<div id="cc-title">
		<span id="change-title"></span>
		<div style="clear:right"></div>
	</div>
</div>
		<div id="error_msg" class="error_msg" style="display:none; position:absolute; width:250px"></div>
<br />
	<div id="change-main" style="padding:0 50px 0 50px;"></div>
	<div id="change-loader" style="padding:0 50px 0 50px;"></div>
</div>
<div id="cc"></div>
<script type="text/javascript">
function uploadFiles(url, files, itemName, refreshURL)
{
	var f = new FormData(document.forms.namedItem(itemName));
	for(var i = 0, file; file = files[i]; ++i) {
		f.append(file.name, file);
	}
	var xhrObj = new XMLHttpRequest();
	xhrObj.open("POST", url, true);
	xhrObj.onload = function(e)
	{
		if(xhrObj.readyState==4 && xhrObj.status==200)
		{
			document.getElementById("change-main").innerHTML = xhrObj.responseText;
			setTimeout(function(){
				document.getElementById("cc-panel").style.display = "none";
				document.getElementById("cc").style.display = "none";
				location.href = refreshURL;
			}, 3000);
		}
	};
	xhrObj.upload.onprogress = function(e) {
		if (e.lengthComputable) {
			var percentComplete = (e.loaded / e.total) * 100;
			document.getElementById("change-main").innerHTML = parseInt(percentComplete)+"% Uploading... Please wait";
			document.getElementById("cc-panel").style.display = "inline";
			document.getElementById("cc").style.display = "inline";
			document.getElementById('cc-panel').style.height = "100px";
			document.getElementById('change-title').innerHTML = "Uploading";
		}
	};
	xhrObj.send(f);
}
</script>