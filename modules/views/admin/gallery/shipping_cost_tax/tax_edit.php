<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient','ce_alert','cc_box')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/shipping_cost'); ?>" style="margin-left:20px;">Shipping Cost</a>
		<a class="selected-menu" href="<?php echo base_url('admin/tax'); ?>">Tax</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
		<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST">
			<input class="input_text" type="text" name="tax" value="<?php echo isset($tax) ? $tax : ""; ?>" placeholder="Tax" />
			<input type="submit" value="Edit"/>
		</form>
	</div>
</div>
<?php get_footer("admin/footer",'ce_alert'); ?>