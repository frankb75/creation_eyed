<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','admin_categorycss','ce_alert','cc_box','lightbox')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Zarek's Home Pictures
	</div>
	<div style="padding:50px 20px 0 20px; overflow:hidden;">
	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST" enctype="multipart/form-data">
			<div style="float:left;">
				<div class="photo_head">
					Upload Photo
				</div>
				<br />
				Category:
				<select name="category" style="width:240px;padding:5px;">
					<option value="">-- Select Category --</option>
					<option <?php echo (isset($category) ? $category == "Events - Weddings" : "") ? "selected" : ""; ?>>Events - Weddings</option>
					<option <?php echo (isset($category) ? $category == "Events - Engagement" : "") ? "selected" : ""; ?>>Events - Engagement</option>
					<option <?php echo (isset($category) ? $category == "Events - Bar Mitzvahs" : "") ? "selected" : ""; ?>>Events - Bar Mitzvahs</option>
					<option <?php echo (isset($category) ? $category == "Events - Corporate" : "") ? "selected" : ""; ?>>Events - Corporate</option>
					<option <?php echo (isset($category) ? $category == "Portraits - Family" : "") ? "selected" : ""; ?>>Portraits - Family</option>
					<option <?php echo (isset($category) ? $category == "Portraits - Individual" : "") ? "selected" : ""; ?>>Portraits - Individual</option>
					<option <?php echo (isset($category) ? $category == "Portraits - Children" : "") ? "selected" : ""; ?>>Portraits - Children</option>
					<option <?php echo (isset($category) ? $category == "Portraits - Pregnancy/Boudoir" : "") ? "selected" : ""; ?>>Portraits - Pregnancy/Boudoir</option>
					<option <?php echo (isset($category) ? $category == "Headshots - Adult" : "") ? "selected" : ""; ?>>Headshots - Adult</option>
					<option <?php echo (isset($category) ? $category == "Headshots - Children" : "") ? "selected" : ""; ?>>Headshots - Children</option>
					<option <?php echo (isset($category) ? $category == "Headshots - Business" : "") ? "selected" : ""; ?>>Headshots - Business</option>
					<option <?php echo (isset($category) ? $category == "Digital Imaging - Retouching/Restoration" : "") ? "selected" : ""; ?>>Digital Imaging - Retouching/Restoration</option>
					<option <?php echo (isset($category) ? $category == "Digital Imaging - Image Manipulation" : "") ? "selected" : ""; ?>>Digital Imaging - Image Manipulation</option>
				</select>
			</div>
			<div style="float:left; padding-left:10px;">
				<input class="input_submit" type="submit" name="upload_photo" value="Upload Photo" />
			</div>
		</form>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<div style="width:25%;">
			<div class="tools">
				<div id="home" style="float:left;cursor:pointer;">Edit</div>
				<form name="uploading" method="POST" enctype="multipart/form-data" autocomplete="off">
					<input id="u" type="file" name="upload" style="width:200px; opacity:0"/>
				</form>
				<script>
					document.querySelector('#u').addEventListener('change', function(e) {
						uploadFiles('<?php echo base_url('admin/home_reupload/'.$photos_id.'?type='.$category); ?>',this.files,'uploading','<?php echo base_url('admin/edit_home_pics/'.$photos_id); ?>');
					}, false);
					
					var wed = document.getElementById("home");
					wed.onclick = function(event) {
						document.uploading.upload.click(event);
					};
				</script>
			</div>
			<br />
			<img src="<?php echo base_url('uploads/home/semi-original/'.$photos); ?>" />
		</div>
		<br />
		<a href="<?php echo base_url('admin/home_pics'); ?>"><div style="font-size:18px;color:#545454;"><< Back</div></a>
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

function reload(url)
{
	location.href = url;
}
</script>