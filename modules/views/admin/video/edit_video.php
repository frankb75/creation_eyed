<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','admin_categorycss','cc_box')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Edit Video
	</div>
	<div style="padding:50px 20px 0 20px; overflow:hidden">
	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
	<div class="photo_head" style="width:87%;">
		Video
	</div>
	<div style="overflow:hidden;">
		<div style="float:left; width:50%;">
			<table>
				<tr>
					<td style="text-align:center;">
						<br />
						<img src="<?php echo base_url($thumb.''.$thumbnail); ?>" />
						<br />
						<span id="thumbs" style="font-size:16px; cursor:pointer;">Edit</span>	
						<form name="uploading" method="POST" enctype="multipart/form-data" autocomplete="off">
							<input id="u" type="file" name="upload" style="width:126px; opacity:0"/>
						</form>
						<script>
							document.querySelector('#u').addEventListener('change', function(e) {
								uploadFiles('<?php echo base_url('admin/video_thumb_reupload/'.$video_id.'?type='.$type.''); ?>',this.files,'uploading','<?php echo base_url('admin/edit_video/'.$video_id); ?>');
							}, false);

							var wed = document.getElementById("thumbs");
							wed.onclick = function(event) {
								document.uploading.upload.click(event);
							};
						</script>
					</td>
					<td style="text-align:center;">
						<br />
						<video id="vid" style="width:60%;" src="<?php echo base_url($location_vid.''.$video); ?>" controls></video>
						<br />
						<span id="vids" style="font-size:16px; cursor:pointer;">Edit</span>	
						<form name="uploading2" method="POST"enctype="multipart/form-data" autocomplete="off">
							<input id="u2" type="file" name="upload2" style="width:126px; opacity:0"/>
						</form>
						<script>
							document.querySelector('#u2').addEventListener('change', function(e) {
								uploadFiles('<?php echo base_url('admin/video_reupload/'.$video_id.'?type='.$type.''); ?>',this.files,'uploading2','<?php echo base_url('admin/edit_video/'.$video_id); ?>');
							}, false);

							var wed = document.getElementById("vids");
							wed.onclick = function(event) {
								document.uploading2.upload2.click(event);
							};
						</script>
					</td>
				</tr>
			</table>
		</div>
		<div style="float:left;">
			<form method="POST">
				<table style="width:100%;">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td><i>Note: this is for title and description only</i></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							Title:
						</td>
						<td style="vertical-align:top;">
							<input class="input_text" type="text" name="video_title" placeholder="Video Title" value="<?php echo isset($video_title) ? $video_title : ""; ?>" />
						</td>
					</tr>
					<tr>
						<td style="vertical-align:top;">
							Description:
						</td>
						<td>
							<textarea class="input_text" name="description" style="height:70px;"><?php echo isset($description) ? $description : ""; ?></textarea>
						</td>
					</tr>
				</table>
				<br />
				<div style="width:100%;text-align:right;">
					<input class="input_submit" type="submit" name="submit" value="Save" />
				</div>
			</form>
		</div>
	</div>
	</div>
	<br />
	<br />
	<div style="padding-left:25px;">
		<a href="<?php echo base_url('video/category?type='.$type.''); ?>" style="color:#727272;font-size:18px;">&laquo;Back</a>
	</div>
</div>
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
<?php get_footer("admin/footer"); ?>
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