<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("home_css","cc_box")); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; margin-right:auto; width:80%; padding-left:80px; overflow:hidden;">
	<div style="font-family:Helvetica;color:#d4d4d4;font-size:24px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> Home</div>
	<?php
		$query =  $this->QModel->sf('home_photos');
		if( ! $this->QModel->c($query)):
	?>
		<div style="text-align:center; font-size:30px; color:#fff;">
			No Photo Uploaded.
		</div>
	<?php else: ?>
		<?php 
			$i = 0;
			while($get = $this->QModel->g($query)):
			$photos_id = $get['photos_id'];
			$photos = $get['photos'];
			$photos_created = $get['photos_created'];
		?>
		<?php if($this->session->userdata('admin')): ?>
			<div style="float:left;margin-bottom:15px; width:298px; margin-left:7px;">
			<div class="tools">
				<div id="home<?php echo $i; ?>" style="float:left;cursor:pointer;">Edit</div>
				<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
					<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
				</form>
				<script>
					document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
						uploadFiles('<?php echo base_url('admin/home_reupload/'.$photos_id); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url(); ?>');
					}, false);
					
					var wed<?php echo $i; ?> = document.getElementById("home<?php echo $i; ?>");
					wed<?php echo $i; ?>.onclick = function(event) {
						document.uploading<?php echo $i; ?>.upload.click(event);
					};
				</script>
			</div>
		<?php else: ?>
			<div style="float:left; margin-bottom:7px; width:32%; margin-left:7px;">
		<?php endif; ?>
		<div id="xd<?php echo $i; ?>" style="height:300px; width:100%; background:transparent; text-align:center; overflow:hidden;">
			<div id="xdx<?php echo $i; ?>" style="height:300px; display:table-cell; vertical-align:middle;">
				<img src="<?php echo base_url('uploads/home/semi-original/'.$get['photos']); ?>" style="margin:0 auto;"/>
			</div>
		</div>
		<script>
			var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
			document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
		</script>
	</div>
	<?php
		$i++;
		endwhile; 
	?>
	<?php endif; ?>
</div>
<br />
<br />
<div style="margin-left:auto; margin-right:auto; width:60%; padding-left:80px; overflow:hidden;">
	<div style="color:#d4d4d4;float:left;width:65%;padding:20px 10px 10px 10px;">
		WeddingWire Couples' Choice Awards&reg; recipients represent the top five percent of wedding professionals within the WeddingWire Network who demonstrate excellence in quality, service, responsiveness and professionalism. 
	</div>
	<div style="float:left;">
		<link href='//www.weddingwire.com/assets/global/widget.css' rel='stylesheet' type='text/css'>
		<div class='ww-bca-2015 ww-reset'>
			<a class="ww-bca-top" href="http://www.weddingwire.com" title="WeddingWire"><img alt="WeddingWire" src="//www.weddingwire.com/assets/badges/BCA-2015/BCA_2015-badge-top.png" /></a>
			<a class="ww-bca-bottom" href="http://www.weddingwire.com/reviews/photography-video-by-zarek-sherman-oaks/246b2b217cb8a3a8.html" title="Photography &amp; Video By Zarek Reviews, Best Wedding Photographers in Los Angeles - 2015 Couples&#39; Choice Award Winner"><img alt="Photography &amp; Video By Zarek Reviews, Best Wedding Photographers in Los Angeles - 2015 Couples&#39; Choice Award Winner" src="//www.weddingwire.com/assets/badges/BCA-2015/BCA_2015-badge-bottom.png" /></a>
			<div class='ww-clear'>
				&nbsp;
				<img alt="" height="1" src="//www.weddingwire.com/apis/v3/tracker?partner_key=163r5mm3&amp;target_id=246b2b217cb8a3a8&amp;type=bca_2015" width="1" />
			</div>
		</div>
	</div>
<?php get_footer("footer"); ?>
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