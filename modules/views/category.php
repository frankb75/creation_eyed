<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array('cc_box','lightbox')); ?>
<style>
	#largeImage { position:absolute;padding:.5em ;background: #e3e3e3; border: 1px solid #BFBFBF; width:500px;}
</style>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<div style="float:left; margin-bottom:20px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <a href="<?php echo base_url($this->segment->uri(0)); ?>"><span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo $categ; ?></span>
	</div>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:80%; overflow:hidden; padding-left:90px;">
	<?php $query = $this->QModel->query("SELECT * FROM events_photos WHERE category='".$categ."' ORDER BY photos_id ASC"); ?>
	<?php if($type == "weddings"): ?>
		<?php
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
				$photos = $get['photos'];
				$category = $get['category'];
				$photos_created = $get['photos_created'];
			?>
			<div style="float:left; margin-bottom:7px; width:32%; margin-left:7px;">
				<?php if($this->session->userdata('admin')): ?>
					<span id="wedding<?php echo $i; ?>" style="color:#646468; font-size:16px; cursor:pointer;">Edit</span>	
					<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
						<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
					</form>
					<script>
						document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
							uploadFiles('<?php echo base_url('admin/reupload/'.$photos_id.'?type=weddings'); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('events/category?type=weddings'); ?>');
						}, false);

						var wed<?php echo $i; ?> = document.getElementById("wedding<?php echo $i; ?>");
						wed<?php echo $i; ?>.onclick = function(event) {
							document.uploading<?php echo $i; ?>.upload.click(event);
						};
					</script>
				<?php else: ?>
				<?php endif; ?>
				<div id="drop<?php echo $photos_id; ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
					<a id="a|drag<?php echo $photos_id; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/events/weddings/original/'.$photos); ?>" rel="lightbox[jnk]">
						<div id="xd<?php echo $i; ?>" style="height:270px; width:100%; background:#ececec; text-align:center; overflow:hidden;">
							<div id="xdx<?php echo $i; ?>" style="height:270px; width:100%; display:table-cell; vertical-align:middle; text-align:center;">
								<img id="drag<?php echo $get['photos_id']; ?>" src="<?php echo base_url("uploads/events/weddings/semi-original/".$photos); ?>" style="margin:0 auto;"/>
							</div>
						</div>
					</a>
				</div>
				<script>
					var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
					a<?php echo $i; ?> += 27;
					document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
				</script>
			</div>
			<?php
				$i++;
				endwhile; 
			?>
		<?php endif; ?>
	<?php elseif($type == "engagement"): ?>
		<?php
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
				$photos = $get['photos'];
				$category = $get['category'];
				$photos_created = $get['photos_created'];
			?>
			<div style="float:left; margin-bottom:7px; width:32%; margin-left:7px;">
				<?php if($this->session->userdata('admin')): ?>
					<span id="engagement<?php echo $i; ?>" style="color:#646468; font-size:16px; cursor:pointer;">Edit</span>	
					<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
						<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
					</form>
					<script>
						document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
							uploadFiles('<?php echo base_url('admin/reupload/'.$photos_id.'?type=engagement'); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('events/category?type=engagement'); ?>');
						}, false);

						var wed<?php echo $i; ?> = document.getElementById("engagement<?php echo $i; ?>");
						wed<?php echo $i; ?>.onclick = function(event) {
							document.uploading<?php echo $i; ?>.upload.click(event);
						};
					</script>
				<?php else: ?>
				<?php endif; ?>
				<div id="drop<?php echo $photos_id; ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
					<a id="a|drag<?php echo $photos_id; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/events/engagement/original/'.$photos); ?>" rel="lightbox[engagement]">
						<div id="xd<?php echo $i; ?>" style="height:270px; width:100%; background:#ececec; text-align:center; overflow:hidden;">
							<div id="xdx<?php echo $i; ?>" style="height:270px; width:100%; display:table-cell; vertical-align:middle; text-align:center;">
								<img id="drag<?php echo $get['photos_id']; ?>" src="<?php echo base_url("uploads/events/engagement/semi-original/".$photos); ?>" style="margin:0 auto;"/>
							</div>
						</div>
					</a>
				</div>
				<script>
					var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
					a<?php echo $i; ?> += 27;
					document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
				</script>
			</div>
			<?php
				$i++;
				endwhile; 
			?>
		<?php endif; ?>
	<?php elseif($type == "bar_mitzvahs"): ?>
		<?php
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
				$photos = $get['photos'];
				$category = $get['category'];
				$photos_created = $get['photos_created'];
			?>
			<div style="float:left; margin-bottom:7px; width:32%; margin-left:7px;">
				<?php if($this->session->userdata('admin')): ?>
					<span id="bar_mitzvahs<?php echo $i; ?>" style="color:#646468; font-size:16px; cursor:pointer;">Edit</span>	
					<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
						<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
					</form>
					<script>
						document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
							uploadFiles('<?php echo base_url('admin/reupload/'.$photos_id.'?type=bar_mitzvahs'); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('events/category?type=bar_mitzvahs'); ?>');
						}, false);

						var wed<?php echo $i; ?> = document.getElementById("bar_mitzvahs<?php echo $i; ?>");
						wed<?php echo $i; ?>.onclick = function(event) {
							document.uploading<?php echo $i; ?>.upload.click(event);
						};
					</script>
				<?php else: ?>
				<?php endif; ?>
				<div id="drop<?php echo $photos_id; ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
					<a id="a|drag<?php echo $photos_id; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/events/bar_mitzvahs/original/'.$photos); ?>" rel="lightbox[bar_mitzvahs]">
						<div id="xd<?php echo $i; ?>" style="height:270px; width:100%; background:#ececec; text-align:center; overflow:hidden;">
							<div id="xdx<?php echo $i; ?>" style="height:270px; width:100%; display:table-cell; vertical-align:middle; text-align:center;">
								<img id="drag<?php echo $get['photos_id']; ?>" src="<?php echo base_url("uploads/events/bar_mitzvahs/semi-original/".$photos); ?>" style="margin:0 auto;"/>
							</div>
						</div>
					</a>
				</div>
				<script>
					var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
					a<?php echo $i; ?> += 27;
					document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
				</script>
			</div>
			<?php
				$i++;
				endwhile; 
			?>
		<?php endif; ?>
	<?php elseif($type == "corporate"): ?>
		<?php
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
				$photos = $get['photos'];
				$category = $get['category'];
				$photos_created = $get['photos_created'];
			?>
			<div style="float:left; margin-bottom:7px; width:32%; margin-left:7px;">
				<?php if($this->session->userdata('admin')): ?>
					<span id="corporate<?php echo $i; ?>" style="color:#646468; font-size:16px; cursor:pointer;">Edit</span>	
					<form name="uploading<?php echo $i; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
						<input id="u<?php echo $i; ?>" type="file" name="upload" style="width:200px; opacity:0"/>
					</form>
					<script>
						document.querySelector('#u<?php echo $i; ?>').addEventListener('change', function(e) {
							uploadFiles('<?php echo base_url('admin/reupload/'.$photos_id.'?type=corporate'); ?>',this.files,'uploading<?php echo $i; ?>','<?php echo base_url('events/category?type=corporate'); ?>');
						}, false);
						
						var wed<?php echo $i; ?> = document.getElementById("corporate<?php echo $i; ?>");
						wed<?php echo $i; ?>.onclick = function(event) {
							document.uploading<?php echo $i; ?>.upload.click(event);
						};
					</script>
				<?php else: ?>
				<?php endif; ?>
				<div id="drop<?php echo $photos_id; ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
					<a id="a|drag<?php echo $photos_id; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/events/corporate/original/'.$photos); ?>" rel="lightbox[corporate]">
						<div id="xd<?php echo $i; ?>" style="height:270px; width:100%; background:#ececec; text-align:center; overflow:hidden;">
							<div id="xdx<?php echo $i; ?>" style="height:270px; width:100%; display:table-cell; vertical-align:middle; text-align:center;">
								<img id="drag<?php echo $photos_id; ?>" src="<?php echo base_url("uploads/events/corporate/semi-original/".$photos); ?>" style="margin:0 auto;"/>
							</div>
						</div>
					</a>
				</div>
				<script>
					var a<?php echo $i; ?> = document.getElementById("xd<?php echo $i; ?>").clientHeight;
					a<?php echo $i; ?> += 27;
					document.getElementById("xdx<?php echo $i; ?>").style.width = a<?php echo $i; ?>+"px";
				</script>
			</div>
			<?php
				$i++;
				endwhile; 
			?>
		<?php endif; ?>
	<?php else: ?>
		<?php redirect('404'); ?>
	<?php endif; ?>
	<div style="clear:both"></div>
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
/*  Drag and Drop */
<?php if($this->session->userdata('admin')): ?>
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

	xmlhttp.open("GET","<?php echo base_url('admin/dragAndDrop/'.$photos_id.'?type='.$type.'&target_id='); ?>"+event.target.id+"&current_id="+current_id,true);
	xmlhttp.send();
}
<?php else: ?>
<?php endif; ?>

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