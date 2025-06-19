<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','ce_alert','cc_box')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/create_event'); ?>" style="margin-left:20px;">Create Event</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/client_event'); ?>">Events</a>
		<a class="selected-menu" href="<?php echo base_url('admin/clients'); ?>">Print Prices</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<input class="input_text" type="text" name="sizes" value="<?php echo isset($sizes) ? $sizes : ""; ?>" placeholder="Sizes"/>
			<input class="input_text" type="text" name="price" value="<?php echo isset($price) ? $price : ""; ?>" placeholder="Price"/>
			<input type="submit" value="Add"/>
			<br /><br />
			<table width="100%">
			<tr class="tbl_head">
				<td colspan="3">&nbsp;<a style="color:#000;" href="<?php echo $link_1; ?>">Sizes&nbsp;<font style="font-size:60%;"><?php echo $symbol_1; ?></font></a> and <a style="color:#000;" href="<?php echo $link_2; ?>">Price<font style="font-size:60%;"><?php echo $symbol_2; ?></font></a></td>
			</tr>
			<?php
				$i = 0;
				$query = $this->QModel->sf('delivery_setup',$order_by);
				while($get = $this->QModel->g($query)):
			?>
			<?php if( ! $i): $i++; ?>
			<tr class="tbl_body">
				<td>&nbsp;Sizes: <?php echo $get['sizes']; ?></td>
				<td>&nbsp;Price $<?php echo $get['price']; ?></td>
				<td><a href="<?php echo base_url('admin/clients_edit/'.$get['delivery_setup_id']); ?>">Edit</a> | <a onclick="alert_box('delete','this Price and Size','<?php echo base_url('admin/delete_clients/'.$get['delivery_setup_id']); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete">Delete</a></td>
			</tr>
			<?php else: $i = 0; ?>
			<tr class="tbl_body2">
				<td>&nbsp;Sizes: <?php echo $get['sizes']; ?></td>
				<td>&nbsp;Price $<?php echo $get['price']; ?></td>
				<td><a href="<?php echo base_url('admin/clients_edit/'.$get['delivery_setup_id']); ?>">Edit</a> | <a onclick="alert_box('delete','this Price and Size','<?php echo base_url('admin/delete_clients/'.$get['delivery_setup_id']); ?>')" style="margin-right:5px; cursor:pointer;" alt="Delete">Delete</a></td>
			</tr>
			<?php endif; ?>
			<?php endwhile; ?>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",'ce_alert'); ?>