<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','ce_editor','admin_categorycss','ce_alert')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Contact Information - Testimonials
	</div>
	<div style="padding:20px 20px 0 20px; overflow:hidden">
		<form method="POST">
			<div class="photo_head">
				Create Testimonials
			</div>
			<br />
			<table>
				<tr>
					<td>Category:</td>
					<td>
						<select class="input_text" name="category">
						<?php if(isset($category) ? $category == "Weddings" :""): ?>
							<option value="">- Select Category -</option>
							<option selected>Weddings</option>
							<option>Portraits</option>
							<option>Headshots</option>
							<option>Bar Mitzvahs</option>
						<?php elseif(isset($category) ? $category == "Portraits" :""): ?>
							<option value="">- Select Category -</option>
							<option>Weddings</option>
							<option selected>Portraits</option>
							<option>Headshots</option>
							<option>Bar Mitzvahs</option>
						<?php elseif(isset($category) ? $category == "Headshots" :""): ?>
							<option value="">- Select Category -</option>
							<option>Weddings</option>
							<option>Portraits</option>
							<option selected>Headshots</option>
							<option>Bar Mitzvahs</option>
						<?php elseif(isset($category) ? $category == "Bar Mitzvahs" :""): ?>
							<option value="">- Select Category -</option>
							<option>Weddings</option>
							<option>Portraits</option>
							<option>Headshots</option>
							<option selected>Bar Mitzvahs</option>
						<?php else: ?>
							<option value="">- Select Category -</option>
							<option>Weddings</option>
							<option>Portraits</option>
							<option>Headshots</option>
							<option>Bar Mitzvahs</option>
						<?php endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input class="input_text" type="text" name="client_name" value="<?php echo isset($client_name) ? $client_name : ""; ?>" /></td>
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
					</td>
				</tr>
			</table>
		</form>
		<br />
		<div style="padding:50px 20px 0 20px;">
			<table style="width:100%;">
				<tr class="tbl_head" style="font-size:16px;">
					<td style="width:20%;">&nbsp;Name</td>
					<td style="width:30%;">&nbsp;Message</td>
					<td style="width:20%;">&nbsp;Category</td>
					<td style="width:20%;">&nbsp;Date and Time Created</td>
					<td style="width:10%;"></td>
				</tr>
				<tr>
					<td><br /></td>
				</tr>
				<?php 
		
					$query = $this->QModel->sf('client_testimonials');
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
						$testimonial_id = $get['testimonial_id'];
						$category = $get['category'];
						$client_name = $get['client_name'];
						$testimonials = $get['testimonials'];
						$date_time_created = $get['date_time_created'];
						
						
					?>
					<?php if($i == 0): ?>
						<tr>
							<td><?php echo $client_name; ?></td>
							<td><div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap; width:250px;"><?php echo $testimonials; ?></div></td>
							<td style="text-align:left;"><?php echo $category; ?></td>
							<td><?php echo $date_time_created; ?></td>
							<td style="text-align:center;">
								<a href="<?php echo base_url('admin/edit_testimonials/'.$testimonial_id); ?>"><img src="<?php echo themes_url('images/icon_edit_small.png'); ?>" /></a> | 
								<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="alert_box('delete','this testimonial','<?php echo base_url('admin/delete_testimonials/'.$testimonial_id); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete"/>
							</td>
						</tr>
					<?php $i++; ?>
					<?php else: ?>
						<tr style="background:#c1c1c1;">
							<td><?php echo $client_name; ?></td>
							<td><div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap; width:250px;"><?php echo $testimonials; ?></div></td>
							<td style="text-align:left;"><?php echo $category; ?></td>
							<td><?php echo $date_time_created; ?></td>
							<td style="text-align:center;">
								<a href="<?php echo base_url('admin/edit_testimonials/'.$testimonial_id); ?>"><img src="<?php echo themes_url('images/icon_edit_small.png'); ?>" /></a> | 
								<img src="<?php echo themes_url('images/close_Button_red.png'); ?>" onclick="alert_box('delete','this testimonial','<?php echo base_url('admin/delete_testimonials/'.$testimonial_id); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete"/>
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
<?php get_footer("admin/footer",array('ce_editor','ce_alert')); ?>
<script type="text/javascript">
window.onload = function(){
    ce_editor_initialized();
};
</script>