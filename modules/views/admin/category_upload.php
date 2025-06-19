<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("admin/header",array('admin_bodycss','admin_categorycss','ce_alert','cc_box','lightbox','uploadifive')); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>

<script src="<?php echo themes_url('js/jquery.uploadifive.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>

<link rel="stylesheet" type="text/css" href="<?php echo themes_url('css/uploadify.css'); ?>">

	<div style="background:#c6c7cb;font-size:30px; overflow:hidden; padding:12px 0 14px 15px;">

		<?php if( $categ == "Weddings" OR $categ == "Engagement" OR $categ == "Bar Mitzvahs" OR $categ == "Corporate" ): ?>

			Events - <?php echo $categ; ?>

		<?php elseif( $categ == "Family" OR $categ == "Individual" OR $categ == "Children" OR $categ == "Pregnancy/Boudoir" ): ?>

			Portraits - <?php echo $categ; ?>

		<?php elseif( $categ == "Adult" OR $categ == "Child" OR $categ == "Business" ): ?>

			Headshots - <?php echo $categ; ?>

		<?php elseif( $categ == "Retouching Restoration - Before and after" OR $categ == "Image Manipulation" ): ?>

			Digital Imaging - <?php echo $categ; ?>

		<?php else: ?>

		<?php endif; ?>

	</div>

	<div style="padding:50px 20px 0 20px; overflow:hidden;">

	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>

		<div style="float:left;">

			<div class="photo_head">

				Upload Photo

			</div>

			<br />

			<form>

				<div id="queue"></div>

				<input id="file_upload" name="file_upload" type="file" multiple="true">

			</form>

			<div id="note_box" style="display:none"><i>Note: Please refresh after upload is completed. To view the uploaded images.</i></div>

		</div>

	</div>

	<br />

	<div id="images_box" style="padding:50px 20px 0 20px; overflow:hidden;margin-top:5px;">

		<table style="width:73%;">

			<tr class="tbl_head">

				<td colspan="2">&nbsp;Photos</td>

			</tr>

			<?php

				$query = $this->QModel->sfwa(

					$table_name,

					array('category'),

					array($categ),'CAST(photos_id AS DECIMAL(10,2)) ASC'

				);

				if( ! $this->QModel->c($query)):

			?>

			<tr>

				<td><span style="font-size:14px;">No photo uploaded.</span></td>

			</tr>

			<?php else: ?>

			<tr>

				<td style="text-align:center;">

					<form method="POST">

						<div style="text-align:left; margin:5px 0 0 0">

							<input type="submit" name="delete_selected" value="Delete Selected File(s)"/>&nbsp;&nbsp;|&nbsp;&nbsp;<input type="checkbox" onclick="toggle(this);" />Select All<br/><br/>

						</div>

						<?php $i = 0; while($get = $this->QModel->g($query)): ?>

							<div id="drop<?php echo $get['photos_id']; ?>" style="float:left; margin-right:16px; margin-bottom:5px; text-align:left;" ondrop="drop(event,<?php echo $get['photos_id']; ?>)" ondragover="allowDrop(event)">

								<input type="checkbox" name="deleteImg[]" value="<?php echo $get['photos_id']; ?>"/>

								<br />

								<div style="height:126px; width:126px; text-align:center; background:black; border:3px solid #a4a4a4; border-radius:5px; text-align:center; overflow:hidden;">

									<div style="height:126px; width:126px; display:table-cell; vertical-align:middle;">

										<a id="a|drag<?php echo $get['photos_id']; ?>|getMsg<?php echo $get['photos_id']; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url($location_orig.''.$get['photos']); ?>" rel="lightbox[jnk]"><img id="drag<?php echo $get['photos_id']; ?>|getMsg<?php echo $get['photos_id']; ?>" src="<?php echo base_url($location_thumb.''.$get['photos']); ?>" style="margin:0 auto;"/></a>

									</div>

								</div>

								<div id="getMsg<?php echo $get['photos_id']; ?>" style="font-size:12px;"><?php echo $get['photos']; ?></div>

							</div>

						<?php $i++; endwhile; ?>

					</form>

				</td>

			</tr>

			<?php endif; ?>

		</table>

		<br />

		<a href="<?php echo base_url($link); ?>" style="color:#727272;font-size:18px;">&laquo;Back</a>

	</div>

</div>

<?php get_footer("admin/footer",array("ce_alert","lightbox")); ?>

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

var current_idText = "";

function allowDrop(event) {

	event.preventDefault();

}



function drag(event) {

	var a = event.target.id.split("|");

	var l = a.length;

	

	if(l == 2)

	{

		event.dataTransfer.setData("text", a[0]);

		current_id = a[0] +"|"+a[1];

		current_idText = a[1];

	}

	else /* Firefox */

	{

		event.dataTransfer.setData("text", a[0]);

		current_id = a[1] +"|"+a[2];

		current_idText = a[2];

	}

}



function drop(event) {

	event.preventDefault();

	var a = event.target.id.split("|");

	var l = a.length;

	

	var z = a[0];

	var x = a[1];

	

	var img_target = document.getElementById(event.target.id).src;

	var img_targetText = document.getElementById(x).innerHTML;

	var img_dragged = document.getElementById(current_id).src;

	var img_draggedText = document.getElementById(current_idText).innerHTML;



	document.getElementById(current_id).removeAttribute("src");

	document.getElementById(current_id).setAttribute("src",img_target);

	

	document.getElementById(event.target.id).removeAttribute("src");

	document.getElementById(event.target.id).setAttribute("src",img_dragged);

	

	document.getElementById(x).innerHTML = img_draggedText;

	document.getElementById(current_idText).innerHTML = img_targetText;

	

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



<?php $timestamp = time();?>

$(function() {

	$('#file_upload').uploadifive({

		'formData'     : {

			'timestamp' : '<?php echo $timestamp;?>',

			'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',

			'upload'     : 'YES'

		},

		'uploadScript' : '<?php echo base_url('admin/category?type='.$type); ?>',

		'fileSizeLimit' : '20MB',

		'cancelImg' : '<?php echo themes_url("images/uploadify-cancel.png"); ?>',

		'auto'		: true,

		'onUploadComplete' : function(file) {

            document.getElementById('note_box').style.display = "block";

			document.getElementById('images_box').style.display = "none";

        },

		'removeCompleted' : true

	});

});

</script>