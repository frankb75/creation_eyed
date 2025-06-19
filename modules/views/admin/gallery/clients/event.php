<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','adminClient')); ?>
	<div style="background:#c6c7cb; overflow:hidden; padding-top:23px;">
		<a class="unselected-menu" href="<?php echo base_url('admin/create_event'); ?>" style="margin-left:20px;">Create Event</a>
		<a class="selected-menu" href="<?php echo base_url('admin/client_event'); ?>">Events</a>
		<a class="unselected-menu" href="<?php echo base_url('admin/clients'); ?>">Print Prices</a>
	</div>
	<div style="padding:20px; overflow:hidden;">
	<?php echo $this->session->userdata('success'); ?>
		<table width="100%">
		<tr class="tbl_head">
			<td style="width:25%">&nbsp;Event Name</td>
			<td style="width:25%">Event Date</td>
			<td style="width:20%">Expiration Date</td>
			<td style="width:20%">Posted</td>
			<td style="width:10%"></td>
		</tr>
		<?php
			$i = 0;
			$query = $this->QModel->sf('clients','date_client DESC');
			while($get = $this->QModel->g($query)):
		?>
		<?php if( ! $i): $i++; ?>
		<tr class="tbl_body">
			<td>&nbsp;<?php echo $get['client_name']; ?></td>
			<td><?php echo date("m/d/Y",strtotime($get['date_client'])); ?></td>
			<td><?php echo date("m/d/Y",strtotime($get['expiration_date'])); ?></td>
			<td><?php echo $get['posted']; ?></td>
			<td>
				<a href="<?php echo base_url('admin/edit_event/'.$get['clients_id']); ?>">Edit</a> | 
				<a href="<?php echo base_url('admin/delete_event/'.$get['clients_id']); ?>">Delete</a>
			</td>
		</tr>
		<?php else: $i = 0; ?>
		<tr class="tbl_body2">
			<td>&nbsp;<?php echo $get['client_name']; ?></td>
			<td><?php echo date("m/d/Y",strtotime($get['date_client'])); ?></td>
			<td><?php echo date("m/d/Y",strtotime($get['expiration_date'])); ?></td>
			<td><?php echo $get['posted']; ?></td>
			<td>
				<a href="<?php echo base_url('admin/edit_event/'.$get['clients_id']); ?>">Edit</a> | 
				<a href="<?php echo base_url('admin/delete_event/'.$get['clients_id']); ?>">Delete</a>
			</td>
		</tr>
		<?php endif; ?>
		<?php endwhile; ?>
		</table>
	</div>
</div>
<?php get_footer("admin/footer"); ?>