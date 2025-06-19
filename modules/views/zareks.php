<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array("client_css")); ?>

<div style="margin-left:auto; margin-right:auto; width:85%; overflow:hidden;">
	<div style="color:#646468;font-size:24px;">
		Gallery Selections
	</div>
	<select class="input_text" onchange="open_div(this.value);">
		<option>Select a Gallery...</option>
		<?php
			$query2 = $this->QModel->query("SELECT * FROM zareks WHERE posted='Yes' AND expiration_date > CURDATE() ORDER BY zareks_id ASC");
		?>
		<?php while($get2 = $this->QModel->g($query2)): ?>
			<option value="<?php echo $get2['zareks_id']; ?>-<?php echo base_url('gallery/zareks_gallery_view/'.$get2['zareks_id']); ?>-FALSE"><?php echo $get2['client_name']; ?></option>
		<?php endwhile; ?>
	</select>
	<br />
	<br />
	<hr color="#555556" />
	<br />
</div>
<div id="contgallery" style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<?php 
		$query = $this->QModel->query("SELECT * FROM zareks WHERE posted='Yes' AND expiration_date > CURDATE() ORDER BY zareks_id ASC");
		$count = $this->QModel->c($query);
	?>
	<?php if($count == 0): ?>
		<div style="width:100%; font-size:18px;">
			No Records Found!
		</div>
	<?php else: ?>
	<?php
		while($get = $this->QModel->g($query)):
		$zareks_id = $get['zareks_id'];
		$client_name = $get['client_name'];
		$date_client = $get['date_client'];
		$expiration_date = $get['expiration_date'];
		$posted = $get['posted'];
		$client_created = $get['client_created'];
	?>
		<a href="<?php echo base_url('gallery/zareks_gallery_view/'.$zareks_id); ?>">
			<div style="float:left; width:224px; padding-bottom:20px; overflow:hidden;">
				<div style="width:224px; height:224px; text-align:center; /* background:#e2e2e2; */ text-align:center; overflow:hidden;">
					<div style="height:224px; width:224px; display:table-cell; vertical-align:middle;">
						<img src="<?php echo base_url("uploads/gallery/zareks/".$zareks_id."/semi-original/".$get['semi_original_image']); ?>" style="margin:0 auto;"/>
					</div>
				</div>
                        <h2 style="color: #000; text-align: center;"><?php echo $client_name; ?></h2>
			</div></a>
		<div style="float:left;padding:5px;"></div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer("footer",array('client')); ?>