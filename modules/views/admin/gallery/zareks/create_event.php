<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','datepicker')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="selected-menu" href="<?php echo base_url('admin/zareks_create_event'); ?>" style="margin-left:20px;">Create Event</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/zareks_event'); ?>">Events</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/zareks'); ?>">Print Prices</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; ?>
		<form method="POST" enctype="multipart/form-data">
			<table style="font-size:14px; float:left; width:50%">
			<tr>
				<td>Event Name:</td>
				<td><input class="input_text" type="text" name="event_name" value="<?php echo isset($event_name) ? $event_name : ""; ?>"/></td>
			</tr>
			<tr>
				<td>Date Event:</td>
				<td><input id="de" class="input_text" type="text" name="date_event" value="<?php echo isset($date_event) ? $date_event : ""; ?>"/></td>
			</tr>
			<tr>
				<td>Expiration Date:</td>
				<td><input id="ed" class="input_text" type="text" name="expiration_date" value="<?php echo isset($expiration_date) ? $expiration_date : ""; ?>"/></td>
			</tr>
			</table>
			<table style="font-size:14px; float:left">
			<tr>
				<td>Cover Image:</td>
				<td><input class="input_text" type="file" name="file" style="background:#fff;"/></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right"><input type="submit" value="Add"/></td>
			</tr>
			</table>
			<div style="clear:both;"></div>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",array("jquery","datepicker")); ?>
<script type="text/javascript">
	$('#de').Zebra_DatePicker();
	$('#ed').Zebra_DatePicker();
</script>