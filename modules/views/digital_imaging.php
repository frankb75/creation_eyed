<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",'cc_box'); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; margin-right:auto; width:85%; overflow:hidden;">
	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#d4d4d4;font-size:24px;"><?php echo ucwords(str_replace('_',' ', $this->segment->uri(0))); ?></span>
	</div>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:95%; overflow:hidden;">
	<table style="width:75%; margin:0 auto;">
		<tr>
			<td style="overflow:hidden;">
				<?php	
					$query =  $this->QModel->sf('digital_imaging_cover_photo');
					if( ! $this->QModel->c($query)):
				?>
					<td style="width:100%;color:#fff;font-size:18px;text-align:center;">
						No Records Found!
					</td>
				<?php else: ?>
					<?php $i = 0; while($get = $this->QModel->g($query)): ?>
						<div style="float:left; width:48%; padding-right:0.2px;">
							<div style="width:97%; padding:20px;">
								<?php if($this->session->userdata('admin')): ?>
									<span id="digital_imaging<?php echo $i; ?>" style="color:#fff; font-size:16px; cursor:pointer;">Edit</span>	
									<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
										<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
									</form>
									<script>
										document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
											uploadFiles('<?php echo base_url('admin/digital_imaging_cover_reupload/'.$get['photos_id'].'?type='.$get['category'].''); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('digital_imaging'); ?>');
										}, false);
										
										var wed<?php echo $i; ?> = document.getElementById("digital_imaging<?php echo $i; ?>");
										wed<?php echo $i; ?>.onclick = function(event) {
											document.uploading<?php echo $i; ?>.upload.click(event);
										};
									</script>
								<?php else: ?>
								<?php endif; ?>
								<?php if($get['category'] == 'Retouching Restoration - Before and after'): ?>
								<a href="<?php echo base_url('digital_imaging/category?type=retouching_restoration'); ?>">
								<img class="img_size" src="<?php echo base_url('uploads/digital_imaging/retouching/cover/'.$get['photos']) ?>" style="height:400px;" />
								<br />
								<img src="<?php echo themes_url('images/image_icon.png'); ?>"/> <span style="color:#878c94;font-family:Calibri;">Retouching/Restoration - Before and after </span>
								<?php elseif($get['category'] == 'Image Manipulation'): ?>
								<a href="<?php echo base_url('digital_imaging/category?type=image_manipulation'); ?>">
								<img class="img_size" src="<?php echo base_url('uploads/digital_imaging/image_manipulation/cover/'.$get['photos']) ?>" style="height:400px;" />
								<br />
								<img src="<?php echo themes_url('images/image_icon.png'); ?>"/> <span style="color:#878c94;font-family:Calibri;">Image Manipulation </span>
								<?php else: ?>
								<?php endif; ?>
								<br />
								</a>
							</div>
						</div>
					<?php $i++; endwhile; ?>
				<?php endif; ?>
			</td>
		</tr>
	</table>
</div>
<?php get_footer("footer"); ?>
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

function reload(url)
{
	location.href = url;
}
</script>