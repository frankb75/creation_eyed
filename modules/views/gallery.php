<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("lightbox","cc_box")); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; margin-right:auto; width:85%; overflow:hidden;">
	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <a href="<?php echo base_url($this->segment->uri(1)); ?>"><span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(1)); ?></span></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo ucwords($this->segment->uri(2)); ?></span>
	</div>
</div>
<div id="contgallery" style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:80%; padding-left:50px; overflow:hidden;">
	<?php
		$query = $this->QModel->query("SELECT * FROM zareks_photos ORDER BY photos_id ASC");
		if( ! $this->QModel->c($query)):
	?>
		<div style="width:100%;color:#646468;font-size:18px;text-align:center;">
			No Records Found!
		</div>
	<?php else: ?>
		<?php 
			$i = 0;
			while($get = $this->QModel->g($query)):
			$photos_id = $get['photos_id'];
			$photos_created = $get['photos_created'];
		?>
		<div style="float:left;width:30%;padding-bottom:10px; margin-left:7px;">
			<?php if($this->session->userdata('admin')): ?>
				<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
					<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
				</form>
				<span id="gallery<?php echo $i; ?>" style="color:#000; font-size:15px; cursor:pointer;">Edit</span>	
				<script>
					document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
						uploadFiles('<?php echo base_url('admin/gellery_reupload/'.$photos_id); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('gallery/zareks'); ?>');
					}, false);

					var wed<?php echo $i; ?> = document.getElementById("gallery<?php echo $i; ?>");
					wed<?php echo $i; ?>.onclick = function(event) {
						document.uploading<?php echo $i; ?>.upload.click(event);
					};
				</script>
			<?php $i++; ?>
			<?php else: ?>
			<?php endif; ?>
			<a href="<?php echo base_url('gallery/zareks_gallery_view_image/'.$photos_id); ?>">
				<div id="xd<?php echo $i; ?>" style="height:300px; width:100%; background:#e2e2e2; text-align:center; overflow:hidden;">
					<div id="xdx<?php echo $i; ?>" style="height:300px; display:table-cell; vertical-align:middle;">
						<img src="<?php echo base_url('uploads/gallery/zareks/semi-original/'.$get['semi_original_image']); ?>" style="margin:0 auto;"/>
					</div>
				</div>
			</a>
			<script>
				var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
				document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
			</script>
			<br />
		</div>
		<?php
			$i++;
			endwhile; 
		?>
	<?php endif; ?>
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
<?php get_footer("footer",array("jquery","lightbox")); ?>
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