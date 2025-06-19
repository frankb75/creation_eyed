<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/zareks_create_event'); ?>" style="margin-left:20px;">Create Event</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/zareks_event'); ?>">Events</a>
		<a class="selected-menu" href="<?php echo base_url('admin/zareks'); ?>">Print Prices</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<input class="input_text" type="text" name="sizes" value="<?php echo isset($sizes) ? $sizes : ""; ?>" placeholder="Sizes"/>
			<input class="input_text" type="text" name="price" value="<?php echo isset($price) ? $price : ""; ?>" placeholder="Price"/>
			<input type="submit" value="<?php echo (isset($edit) ? $edit : "") ? "Edit" : "Add"; ?>"/>
			<br /><br />
			<table width="100%">
			<tr class="tbl_head">
				<td colspan="3">&nbsp;Sizes and Price</td>
			</tr>
			<?php
				$i = 0;
				$query = $this->QModel->sf('delivery_setup_zarek','CAST(sizes AS DECIMAL(10,2)) ASC');
				while($get = $this->QModel->g($query)):
			?>
			<?php if( ! $i): $i++; ?>
			<tr class="tbl_body">
				<td style="width:40%;">&nbsp;Sizes: <?php echo $get['sizes']; ?></td>
				<td style="width:40%;">&nbsp;Price $<?php echo $get['price']; ?></td>
				<td style="width:20%;">&nbsp;<a href="<?php echo base_url('admin/zareksDeliverySetupedit/'.$get['delivery_setup_id']); ?>">Edit</a> | <a href="<?php echo base_url('admin/delete_deliverySetupZareks/'.$get['delivery_setup_id']); ?>">Delete</a></td>
			</tr>
			<?php else: $i = 0; ?>
			<tr class="tbl_body2">
				<td style="width:40%;">&nbsp;Sizes: <?php echo $get['sizes']; ?></td>
				<td style="width:40%;">&nbsp;Price $<?php echo $get['price']; ?></td>
				<td style="width:20%;">&nbsp;<a href="<?php echo base_url('admin/zareksDeliverySetupedit/'.$get['delivery_setup_id']); ?>">Edit</a> | <a href="<?php echo base_url('admin/delete_deliverySetupZareks/'.$get['delivery_setup_id']); ?>">Delete</a></td>
			</tr>
			<?php endif; ?>
			<?php endwhile; ?>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer"); ?>