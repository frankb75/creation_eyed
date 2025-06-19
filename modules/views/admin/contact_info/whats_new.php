<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','ce_editor','admin_categorycss','ce_alert','ce_datepicker')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Contact Information - What's New
	</div>
	<div style="padding:20px 20px 0 20px; overflow:hidden">
		<form method="POST">
			<div class="photo_head">
				Create What's New
			</div>
			<br />
			<table>
				<tr>
					<td>Title:</td>
					<td><input class="input_text" type="text" name="new_title" value="<?php echo isset($new_title) ? $new_title : ""; ?>" /></td>
				</tr>
				<tr>
					<td>Date:</td>
					<td><input id="dp" class="input_text" type="text" name="new_date" value="<?php echo isset($new_date) ? $new_date : ""; ?>" /></td>
				</tr>
				<tr>
					<td style="vertical-align:top;">Message:</td>
					<td>
						<textarea class="input_text" name="message" style="width:100%;height:150px;"><?php echo isset($message) ? $message : ""; ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;">
						<input class="input_submit" type="submit" name="submit" value="Submit" />
						<?php if($this->segment->uri(2) == "whats_new"): ?>
						<?php else: ?>
							<input class="input_submit" type="submit" name="cancel" value="Cancel" />
						<?php endif ?>
					</td>
				</tr>
			</table>
		</form>
		<br />
		<div style="padding:50px 20px 0 20px;">
			<table style="width:100%;">
				<tr class="tbl_head" style="font-size:16px;">
					<td style="width:20%;">&nbsp;Title</td>
					<td style="width:30%;">&nbsp;Message</td>
					<td style="width:20%;">&nbsp;Date and Time Created</td>
					<td style="width:10%;"></td>
				</tr>
				<tr>
					<td><br /></td>
				</tr>
				<?php 
		
					$query = $this->QModel->sf('whats_new');
					$count = $this->QModel->c($query);
				?>
				<?php if($count == 0): ?>
					<tr>
						<td colspan="5" align="center">No Records Found!</td>
					</tr>
				<?php else: ?>
					<?php
						$i = 0;
						while($get = $this->QModel->g($query)):
						$whats_new_id = $get['whats_new_id'];
						$title = $get['title'];
						$date = $get['date'];
						$message = $get['message'];
						$date_created = $get['date_created'];
						
					?>
					<?php if($i == 0): ?>
						<tr>
							<td><?php echo $title; ?> </td>
							<td><div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap; width:250px;"><?php echo $message; ?></div></td>
							<td><?php echo $date_created; ?></td>
							<td style="text-align:center;">
								<a href="<?php echo base_url('admin/edit_whats_new/'.$whats_new_id); ?>"><img src="<?php echo themes_url('images/icon_edit_small.png'); ?>" /></a> | 
								<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="alert_box('delete','this testimonial','<?php echo base_url('admin/delete_whats_new/'.$whats_new_id); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete"/>
							</td>
						</tr>
					<?php $i++; ?>
					<?php else: ?>
						<tr style="background:#c1c1c1;">
							<td><?php echo $title; ?></td>
							<td><div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap; width:250px;"><?php echo $message; ?></div></td>
							<td><?php echo $date_created; ?></td>
							<td style="text-align:center;">
								<a href="<?php echo base_url('admin/edit_whats_new/'.$whats_new_id); ?>"><img src="<?php echo themes_url('images/icon_edit_small.png'); ?>" /></a> | 
								<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="alert_box('delete','this testimonial','<?php echo base_url('admin/delete_whats_new/'.$whats_new_id); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete"/>
							</td>
						</tr>
					<?php $i=0; ?>
				<?php endif; ?>
				<?php endwhile; ?>
				<?php endif; ?>
			</table>
			<br />
			<br />
		</div>
	</div>
</div>
<div id="cc"></div>
<div id="cc-panel"></div>
<?php get_footer("admin/footer",array('ce_editor','ce_alert','ce_datepicker')); ?>
<script type="text/javascript">
window.onload = function(){
    ce_editor_initialized();
	ce_date_picker('dp');
};
</script>