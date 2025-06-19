<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','cc_box')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Headshots
	</div>
	<div style="padding:20px 20px 0 20px; overflow:hidden">
		<table style="width:100%;">
			<tr>
				<?php	
					$query =  $this->QModel->sf('headshots_cover_photo');
					if( ! $this->QModel->c($query)):
				?>
					<td style="width:100%;color:#fff;font-size:18px;text-align:center;">
						No Records Found!
					</td>
				<?php else: ?>
					<?php 
						$i = 0;
						while($get = $this->QModel->g($query)):
						$photos_id = $get['photos_id'];
						$photos = $get['photos'];
						$category = $get['category'];
						$photos_created = $get['photos_created'];
					?>
					<td>
						<span id="headshots<?php echo $i; ?>" style="color:#000; font-size:16px; cursor:pointer;">Edit</span>	
						<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
							<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
						</form>
						<script>
							document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
								uploadFiles('<?php echo base_url('admin/headshots_cover_reupload/'.$photos_id.'?type='.$category.''); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('admin/headshots'); ?>');
							}, false);
							
							var wed<?php echo $i; ?> = document.getElementById("headshots<?php echo $i; ?>");
							wed<?php echo $i; ?>.onclick = function(event) {
								document.uploading<?php echo $i; ?>.upload.click(event);
							};
						</script>
						<?php if($category == 'Adult'): ?>
							<div class="img_categ" onclick="location.href='<?php echo base_url('admin/category?type=adult'); ?>'">
							<img class="img_size2" onclick="location.href='<?php echo base_url('admin/category?type=adult'); ?>'" src="<?php echo base_url('uploads/headshots/adult/cover/'.$get['photos']) ?>" style="height:228px;" />
						<?php elseif($category == 'Children'): ?>
							<div class="img_categ" onclick="location.href='<?php echo base_url('admin/category?type=children2'); ?>'">
							<img class="img_size2" onclick="location.href='<?php echo base_url('admin/category?type=children2'); ?>'" src="<?php echo base_url('uploads/headshots/child/cover/'.$get['photos']) ?>" style="height:228px;" />
						<?php elseif($category == 'Business'): ?>
							<div class="img_categ" onclick="location.href='<?php echo base_url('admin/category?type=business'); ?>'">
							<img class="img_size2" onclick="location.href='<?php echo base_url('admin/category?type=business'); ?>'" src="<?php echo base_url('uploads/headshots/business/cover/'.$get['photos']) ?>" style="height:228px;" />
						<?php else: ?>
						<?php endif; ?>
							<div style="overflow:hidden;padding:10px 0 10px 0;">
								<div style="float:left;font-size:16.66px;color:#5b5b5b;"><?php echo $category; ?></div>
								<div style="float:right;">
									<img src="<?php echo themes_url('images/events-arrow-icon.png'); ?>" />
								</div>
							</div>
						</div>
					</td>
					<?php
						$i++;
						endwhile;
					?>
				<?php endif; ?>
			</tr>
		</table>
	</div>
</div>
<?php get_footer("admin/footer"); ?>
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