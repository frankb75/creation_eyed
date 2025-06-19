<?php

echo file_get_contents('https://dev.barraganmedia.com/zarek/proxies/header-proxy.php');

if($this->session->userdata('admin')): ?>
	<div style="color:#fff; background:#000; border-bottom:1px solid #fff; text-align:right;">
		<a href="<?php echo base_url('admin'); ?>" style="font-size:12px;">Admin Page</a> | <span style="color:#ffaf67;font-size:12px;">Hi, Admin</span> | <a href="<?php echo base_url('auth/logout'); ?>" style="color:#4284f4;font-size:12px;">Logout</a>&nbsp;&nbsp;&nbsp;<img src="<?php echo themes_url('images/user_icon.png'); ?>" />
	</div>
<?php endif; ?>
<div id="root" class="container">
<div id="ani" class="container">
	<header style="display:none;">
		<div class="wrap">
		<div class="header" >
		<div class="header_body">
			<div>
				
			</div>
			<?php if($this->segment->uri(2) == "clients" 
			OR $this->segment->uri(2) == "clients_gallery_view" 
			OR $this->segment->uri(2) == "clients_gallery_view_image" 
			OR $this->segment->uri(2) == "clients_gallery_image_purchase" 
			OR $this->segment->uri(2) == "favorites"
			OR $this->segment->uri(2) == "zareks"
			OR $this->segment->uri(2) == "zareks_gallery_view_image"
			OR $this->segment->uri(2) == "clients_gallery_image_purchase"
			): ?>
			<div style="float:right; width:300px; border:1px solid #3d3d3d; border-radius:5px; background:#2c2c2f">
				<div style="background:#1d1d20; color:#948f8f; padding:10px; border-top-left-radius:5px; border-top-right-radius:5px;">My Cart</div>
				<div style="color:#fff; text-align:center; padding:10px;">
					<?php
						$query = $this->QModel->sfwa("cart","session_id",$this->session->userdata('isCart'));
						$total_price = 0;
						while($get = $this->QModel->g($query))
						{
							// Get folder name.
							$query2 = $this->QModel->sfwa('clients_photos','clients_photos_id',$get['clients_photos_id']);
							$get2 = $this->QModel->g($query2);
							
							// Get delivery_setup
							$query3 = $this->QModel->sfwa('delivery_setup','delivery_setup_id',$get['delivery_setup_id']);
							$get3 = $this->QModel->g($query3);
							$total_price += $get3['price'];
							$quantity_price = $get3['price'] * $get['quantity'];
						}
					?>
					<img src="<?php echo themes_url('images/icon_cart2.png'); ?>" style="vertical-align:middle;"/> <?php echo $this->QModel->c($query); ?> items - $<?php echo number_format($total_price,2); ?>
					<br /><br />
					<input class="input_cart" type="submit" value="View Cart" style="float:right; cursor:pointer;" onclick="location.href = '<?php echo base_url('gallery/clients_gallery_view_addtocart'); ?>'"/>
					<div style="clear:both;"></div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		</div>
		</div>
	</header>
	<section>
		<div id="wrapper" class="wrap">
		<div class="body">
		<div class="cont_body">
