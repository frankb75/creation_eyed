<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("admin/header",array('admin_bodycss','adminClient','datepicker','ce_alert','cc_box','lightbox','uploadifive')); ?>

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

	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">

		<a class="unselected-menu" href="<?php echo base_url('admin/create_event'); ?>" style="margin-left:20px;">Create Event</a>

		<a class="selected-menu" href="<?php echo base_url('admin/client_event'); ?>">Events</a>

		<a class="unselected-menu" href="<?php echo base_url('admin/clients'); ?>">Print Prices</a>

	</div>

	<div style="padding:20px; overflow:hidden;">

		<div style="padding:0 20px 0 40px;">

			<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>

			<form method="POST" enctype="multipart/form-data">

				<div style="overflow:hidden;">

					<img src="<?php echo base_url('uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$thumbnail_image); ?>" style="float:left; margin-right:10px;"/>

					<input type="file" name="file" style="float:left;"/>

				</div>

				<table style="font-size:14px; float:left; width:50%">

				<tr>

					<td>Event Name:</td>

					<td><input class="input_text" type="text" name="event_name" value="<?php echo isset($event_name) ? $event_name : ""; ?>"/></td>

				</tr>

				<tr>

					<td>Date Event:</td>

					<td><input id="de" class="input_text" type="text" name="date_event" value="<?php echo isset($date_event) ? date("m/d/Y",strtotime($date_event)) : ""; ?>"/></td>

				</tr>

				<tr>

					<td>Expiration Date:</td>

					<td><input id="ed" class="input_text" type="text" name="expiration_date" value="<?php echo isset($expiration_date) ? date("m/d/Y",strtotime($expiration_date)) : ""; ?>"/></td>

				</tr>

				<tr>

					<td colspan="2" style="font-size:18px;"><b>Discount Section</b></td>

				</tr>

				<tr>

					<td>Discount:</td>

					<td><input class="input_text" type="text" name="discount" value="<?php echo isset($discount) ? $discount : ""; ?>" style="width:50px;"/> %</td>

				</tr>

				<tr>

					<td>From:</td>

					<td><input id="fr" class="input_text" type="text" name="from" value="<?php echo isset($from) ? $from : ""; ?>"/></td>

				</tr>

				<tr>

					<td>To:</td>

					<td><input id="to" class="input_text" type="text" name="to" value="<?php echo isset($to) ? $to : ""; ?>"/></td>

				</tr>

				</table>

				<table style="font-size:14px; float:left">

				<tr>

					<td>Password:</td>

					<td>

						<input id="password" class="input_text" type="password" name="password" value="<?php echo isset($password) ? $password : ""; ?>"/>

						<br />

						<input type="checkbox" value="1" name="reveal" id="reveal" onchange="reveal_pass(this); "> Show Password

					</td>

				</tr>

				<tr>

					<td>Event Post:</td>

					<td>

						<select name="event_post" style="padding:5px;">

							<option value="">-- Choose Post --</option>

							<?php if( isset($event_post) ? $event_post == "Yes" : ""): ?>

							<option selected>Yes</option>	

							<option>No</option>

							<?php elseif( isset($event_post) ? $event_post == "No" : ""): ?>

							<option>Yes</option>	

							<option selected>No</option>

							<?php else: ?>

							<option>Yes</option>	

							<option>No</option>

							<?php endif; ?>

						</select>

					</td>

				</tr>

				<tr>

					<td colspan="2" style="text-align:right"><input class="input_submit" type="submit" name="save" value="Save"/></td>

				</tr>

				</table>

				<div style="clear:both;"></div>

			</form>

		</div>

		<div style="background:url('<?php echo themes_url('images/icon-slice-orange.png'); ?>'); height:4px; margin-top:20px;"></div>

		<div style="padding:10px 125px 0 40px;">

			<form>

				<div id="queue"></div>

				<input id="file_upload" class="input_submit" name="file_upload" type="file" multiple="true">

			</form>

			<div id="note_box" style="display:none"><i>Note: Please refresh after upload is completed. To view the uploaded images.</i></div>

			<div id="images_box" style="margin-top:5px;">

				<table width="100%">

				<tr class="tbl_head">

					<td colspan="2">&nbsp;Photos</td>

				</tr>

				<?php

					$query = $this->QModel->sfwa('clients_photos','clients_id',$clients_id,'CAST(photos AS DECIMAL(10,2)) ASC');

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

							<?php $i = 1; $ii = 0; $iii = 0; while($get = $this->QModel->g($query)): ?>

							<?php if($i == 6): $i = 1; ?>

							<div id="drop<?php echo $get['clients_photos_id']; ?>" style="float:left; margin-bottom:5px; text-align:left;" ondrop="drop(event)" ondragover="allowDrop(event)">

								<input type="checkbox" name="deleteImg[]" value="<?php echo $get['clients_photos_id']; ?>"/>

								<br />

								<div style="height:126px; width:126px; text-align:center; background:black; border:3px solid #a4a4a4; border-radius:5px; text-align:center; overflow:hidden;">

									<div style="height:126px; width:126px; display:table-cell; vertical-align:middle;">

										<a id="a|drag<?php echo $get['clients_photos_id']; ?>|getMsg<?php echo $get['clients_photos_id']; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/gallery/clients/original/'.$get['photos']); ?>" rel="lightbox[jnk]"><img id="drag<?php echo $get['clients_photos_id']; ?>|getMsg<?php echo $get['clients_photos_id']; ?>" src="<?php echo base_url('uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$get['thumbnail_image']); ?>" style="margin:0 auto;"/></a>

									</div>

								</div>

								<div id="getMsg<?php echo $get['clients_photos_id']; ?>" style="font-size:12px;"><?php echo $get['photos']; ?></div>

							</div>

							<?php else: $i++; ?>

							<div id="drop<?php echo $get['clients_photos_id']; ?>" style="float:left; margin-right:16px; margin-bottom:5px; text-align:left;" ondrop="drop(event)" ondragover="allowDrop(event)">

								<input type="checkbox" name="deleteImg[]" value="<?php echo $get['clients_photos_id']; ?>"/>

								<br />

								<div style="height:126px; width:126px; text-align:center; background:black; border:3px solid #a4a4a4; border-radius:5px; text-align:center; overflow:hidden;">

									<div style="height:126px; width:126px; display:table-cell; vertical-align:middle;">

										<a id="a|drag<?php echo $get['clients_photos_id']; ?>|getMsg<?php echo $get['clients_photos_id']; ?>" draggable="true" ondragstart="drag(event)" href="<?php echo base_url('uploads/gallery/clients/original/'.$get['photos']); ?>" rel="lightbox[jnk]"><img id="drag<?php echo $get['clients_photos_id']; ?>|getMsg<?php echo $get['clients_photos_id']; ?>" src="<?php echo base_url('uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$get['thumbnail_image']); ?>" style="margin:0 auto;"/></a>

									</div>

								</div>

								<div id="getMsg<?php echo $get['clients_photos_id']; ?>" style="font-size:12px;"><?php echo $get['photos']; ?></div>

							</div>

							<?php endif; ?>						

							<?php $ii++; endwhile; ?>

						</form>

					</td>

				</tr>

				<?php endif; ?>

				</table>

			</div>

		</div>

	</div>

</div>

<?php get_footer("admin/footer",array("datepicker","ce_alert","lightbox")); ?>

<script type="text/javascript">

$('#de').Zebra_DatePicker();

	$('#ed').Zebra_DatePicker();

	$('#fr').Zebra_DatePicker();

	$('#to').Zebra_DatePicker();



/* show password */

function reveal_pass(check_box){



    var textbox_elem = document.getElementById("password");



    if(check_box.checked){

		textbox_elem.setAttribute("type", "text");

    }else{

		textbox_elem.setAttribute("type", "password");

	}

}

/* show password */



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



function drop(event)

{

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



	xmlhttp.open("GET","<?php echo base_url('admin/dragAndDrop/'.$clients_id.'?type=clients&target_id='); ?>"+event.target.id+"&current_id="+current_id,true);

	xmlhttp.send();

}



<?php $timestamp = time();?>

$(function() {

	$('#file_upload').uploadifive({

		'formData'     : {

			'timestamp' : '<?php echo $timestamp;?>',

			'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',

			'upload'     : 'YES'

		},

		'uploadScript' : '<?php echo base_url('admin/edit_event/'.$clients_id); ?>',

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