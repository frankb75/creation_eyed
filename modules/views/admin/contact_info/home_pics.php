<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','admin_categorycss','ce_alert','cc_box','lightbox')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Zarek's Home Pictures
	</div>
	<div style="padding:50px 20px 0 20px; overflow:hidden;">
	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; ?>
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
				<br />
				<br />
				<input class="input_text" type="file" name="file" style="background:#fff;"/>
			</div>
			<div style="float:left; padding-left:10px;">
				<input class="input_submit" type="submit" name="upload_photo" value="Upload Photo" />
			</div>
		</form>
	</div>
	<br />
	<div style="padding:50px 20px 0 20px; overflow:hidden">
		<table style="width:73%;">
			<tr class="tbl_head">
				<td colspan="2">&nbsp;Photos</td>
			</tr>
			<?php
				$query = $this->QModel->sf('home_photos');
				if( ! $this->QModel->c($query)):
			?>
			<tr>
				<td><span style="font-size:14px;">No photo uploaded.</span></td>
			</tr>
			<?php else: ?>
			<tr>
				<td style="text-align:center;">
					<?php $i = 0; while($get = $this->QModel->g($query)): ?>
					<div id="drop<?php echo $get['photos_id']; ?>" style="float:left; margin-right:16px; margin-bottom:5px;" ondrop="drop(event)" ondragover="allowDrop(event)">
						<img src="<?php echo themes_url('images/close_button_red.png'); ?>" onclick="alert_box('delete','this image','<?php echo base_url('admin/home_pics_delete/'.$get['photos_id']); ?>')" style="float:left; margin-right:5px; cursor:pointer;" alt="Delete"/>
						<a href="<?php echo base_url('admin/edit_home_pics/'.$get['photos_id']); ?>"><img  src="<?php echo themes_url('images/icon_edit_small.png'); ?>" style="float:left; cursor:pointer;" alt="Edit"/></a>
						<br />
						<div style="height:126px; width:126px; text-align:center; background:black; border:3px solid #a4a4a4; border-radius:5px; text-align:center; overflow:hidden;">
							<div style="height:126px; width:126px; display:table-cell; vertical-align:middle;">
								<a id="a|drag<?php echo $get['photos_id']; ?>" draggable="true" ondragstart="drag(event)"  href="<?php echo base_url($location_orig.''.$get['photos']); ?>" rel="lightbox[jnk]"><img id="drag<?php echo $get['photos_id']; ?>" src="<?php echo base_url($location_thumb.''.$get['photos']); ?>" style="margin:0 auto;"/></a>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
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
var current_id = "";
function allowDrop(event) {
	event.preventDefault();
}

function drag(event) {
	var a = event.target.id.split("|");
	var l = a.length;
	
	if(l == 2)
	{
		event.dataTransfer.setData("text", a[1]);
		current_id = a[1];
	}
	else
	{
		event.dataTransfer.setData("text", a[0]);
		current_id = a[0];
	}
}

function drop(event) {
	event.preventDefault();
	var img_target = document.getElementById(event.target.id).src;
	var img_dragged = document.getElementById(current_id).src;
	
	document.getElementById(current_id).removeAttribute("src");
	document.getElementById(current_id).setAttribute("src",img_target);
	
	document.getElementById(event.target.id).removeAttribute("src");
	document.getElementById(event.target.id).setAttribute("src",img_dragged);
	
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
			/*xmlhttp.responseText*/;
		}
	};

	xmlhttp.open("GET","<?php echo base_url('admin/dragAndDrop/'.$get['photos_id'].'?type=home&target_id='); ?>"+event.target.id+"&current_id="+current_id,true);
	xmlhttp.send();
}

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