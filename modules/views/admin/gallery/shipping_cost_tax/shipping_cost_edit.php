<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','ce_alert','cc_box')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="selected-menu" href="<?php echo base_url('admin/shipping_cost'); ?>" style="margin-left:20px;">Shipping Cost</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/tax'); ?>">Tax</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<input class="input_text" type="text" name="shipping_cost" value="<?php echo isset($shipping_cost) ? $shipping_cost : ""; ?>" placeholder="Shipping Cost" />
			<input class="input_text" type="text" name="description" value="<?php echo isset($description) ? $description : ""; ?>" placeholder="Description" />
			<input type="submit" value="Edit"/>
			<br /><br />
			<table width="100%">
			<tr class="tbl_head">
				<td colspan="2">&nbsp;Shipping Cost</td>
			</tr>
			<?php
				$i = 0;
				$query = $this->QModel->sf('shipping_cost');
				while($get = $this->QModel->g($query)):
			?>
			<?php if( ! $i): $i++; ?>
			<tr class="tbl_body">
				<td>&nbsp; <?php echo $get['shipping_cost']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/shipping_cost_edit/'.$get['shipping_cost_id']); ?>">Edit</a></td>
			</tr>
			<?php else: $i = 0; ?>
			<tr class="tbl_body2">
				<td>&nbsp; <?php echo $get['shipping_cost']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/shipping_cost_edit/'.$get['shipping_cost_id']); ?>">Edit</a></td>
			</tr>
			<?php endif; ?>
			<?php endwhile; ?>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",'ce_alert'); ?>