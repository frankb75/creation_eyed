<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','ce_alert','cc_box')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/clients'); ?>" style="margin-left:20px;">Print Prices</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/create_event'); ?>">Create Event</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/client_event'); ?>">Events</a>
		<a class="selected-menu" href="<?php echo base_url('admin/shipping_cost'); ?>">Shipping Cost</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/tax'); ?>">Tax</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<br /><br />
			<table width="100%">
			<tr class="tbl_head">
				<td>&nbsp;Shipping Cost</td>
				<td>&nbsp;Description</td>
				<td></td>
			</tr>
			<?php
				$i = 0;
				$query = $this->QModel->sf('shipping_cost');
				while($get = $this->QModel->g($query)):
			?>
			<?php if( ! $i): $i++; ?>
			<tr class="tbl_body">
				<td>&nbsp; <?php echo $get['shipping_cost']; ?></td>
				<td>&nbsp; <?php echo $get['description']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/shipping_cost_edit/'.$get['shipping_cost_id']); ?>">Edit</a></td>
			</tr>
			<?php else: $i = 0; ?>
			<tr class="tbl_body2">
				<td>&nbsp; <?php echo $get['shipping_cost']; ?></td>
				<td>&nbsp; <?php echo $get['description']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/shipping_cost_edit/'.$get['shipping_cost_id']); ?>">Edit</a></td>
			</tr>
			<?php endif; ?>
			<?php endwhile; ?>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",'ce_alert'); ?>