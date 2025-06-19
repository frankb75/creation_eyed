<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','ce_alert','cc_box')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/shipping_cost'); ?>" style="margin-left:20px;">Shipping Cost</a>
		<a class="selected-menu" href="<?php echo base_url('admin/tax'); ?>">Tax</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<br /><br />
			<table width="100%">
			<tr class="tbl_head">
				<td colspan="2">&nbsp;Tax</td>
			</tr>
			<?php
				$i = 0;
				$query = $this->QModel->sf('tax');
				while($get = $this->QModel->g($query)):
			?>
			<?php if( ! $i): $i++; ?>
			<tr class="tbl_body">
				<td>&nbsp; <?php echo $get['tax']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/tax_edit/'.$get['tax_id']); ?>">Edit</a></td>
			</tr>
			<?php else: $i = 0; ?>
			<tr class="tbl_body2">
				<td>&nbsp; <?php echo $get['tax']; ?></td>
				<td style="text-align:center;"><a href="<?php echo base_url('admin/tax_edit/'.$get['tax_id']); ?>">Edit</a></td>
			</tr>
			<?php endif; ?>
			<?php endwhile; ?>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",'ce_alert'); ?>