<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="menu">
	<?php if(isset($menu) ? $menu == 3 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/events'); ?>'">Events</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/events'); ?>'">Events</div>
		</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 4 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/portraits'); ?>'">Portraits</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/portraits'); ?>'">Portraits</div>
		</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 5 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/headshots'); ?>'">Headshots</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/headshots'); ?>'">Headshots</div>
		</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 6 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/digital_imaging'); ?>'">Digital Imaging</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/digital_imaging'); ?>'">Digital Imaging</div>
		</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 7 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/video'); ?>'">Video</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/video'); ?>'">Video</div>
		</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 1 : "" OR isset($menu) ? $menu == 2 : ""): ?>
	<div id="gallery" class="nav" onclick="gallery('not')">
	<?php else: ?>
	<div id="gallery" class="nav" onclick="gallery('drop')">
	<?php endif; ?>
		<div style="float:left;">
			<?php if(isset($menu) ? $menu == 1 : "" OR isset($menu) ? $menu == 2 : "" OR isset($menu) ? $menu == 9 : ""): ?>
				<img id="up" src="<?php echo themes_url('images/arrow-up-icon.png'); ?>" style="display:none; padding:0 10px 0 20px;" />
				<img id="down" src="<?php echo themes_url('images/arrow-down-icon.png'); ?>" style="padding:0 10px 0 20px;" />
			<?php else: ?>
				<img id="up" src="<?php echo themes_url('images/arrow-up-icon.png'); ?>" style="padding:0 10px 0 20px;" />
				<img id="down" src="<?php echo themes_url('images/arrow-down-icon.png'); ?>" style="display:none; padding:0 10px 0 20px;" />
			<?php endif; ?>
		</div>
		<div class="nav_cont">Gallery</div>
	</div>
	<?php if(isset($menu) ? $menu == 1 : ""): ?>
		<div id="g_01" class="nav_cont nav_below" style="border-bottom:1px solid #2a2d33; display:block; background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;" onclick="location.href='<?php echo base_url('admin/create_event'); ?>'">Client's</div>
		<div id="g_02" class="nav_cont nav_below" style="display:block;" onclick="location.href='<?php echo base_url('admin/zareks_create_event'); ?>'">Zarek's</div>
		<div id="g_03" class="nav_cont nav_below" style="display:block;" onclick="location.href='<?php echo base_url('admin/shipping_cost'); ?>'">Shipping Cost and Tax</div>
	<?php elseif(isset($menu) ? $menu == 2 : ""): ?>
		<div id="g_01" class="nav_cont nav_below" style="border-bottom:1px solid #2a2d33; display:block;" onclick="location.href='<?php echo base_url('admin/create_event'); ?>'">Client's</div>
		<div id="g_02" class="nav_cont nav_below" style="display:block; background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;" onclick="location.href='<?php echo base_url('admin/zareks_create_event'); ?>'">Zarek's</div>
		<div id="g_03" class="nav_cont nav_below" style="display:block;" onclick="location.href='<?php echo base_url('admin/shipping_cost'); ?>'">Shipping Cost and Tax</div>
	<?php elseif(isset($menu) ? $menu == 9 : ""): ?>
		<div id="g_01" class="nav_cont nav_below" style="display:block;" onclick="location.href='<?php echo base_url('admin/create_event'); ?>'">Client's</div>
		<div id="g_02" class="nav_cont nav_below" style="display:block;" onclick="location.href='<?php echo base_url('admin/zareks_create_event'); ?>'">Zarek's</div>
		<div id="g_03" class="nav_cont nav_below" style="border-bottom:1px solid #2a2d33; display:block; background:url('<?php echo themes_url('images/arrow-side.png'); ?>') right no-repeat #282a2e;" onclick="location.href='<?php echo base_url('admin/shipping_cost'); ?>'">Shipping Cost and Tax</div>
	<?php else: ?>
		<div id="g_01" class="nav_cont nav_below" onclick="location.href='<?php echo base_url('admin/create_event'); ?>'">Client's</div>
		<div id="g_02" class="nav_cont nav_below" onclick="location.href='<?php echo base_url('admin/zareks_create_event'); ?>'">Zarek's</div>
		<div id="g_03" class="nav_cont nav_below" onclick="location.href='<?php echo base_url('admin/shipping_cost'); ?>'">Shipping Cost and Tax</div>
	<?php endif; ?>
	<?php if(isset($menu) ? $menu == 8 : ""): ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont_select" onclick="location.href='<?php echo base_url('admin/contact_info'); ?>'">Contact Information</div>
		</div>
	<?php else: ?>
		<div class="nav">
			<div style="float:left;">
				<img src="<?php echo themes_url('images/space.png'); ?>" style="padding:0 10px 0 20px;" />
			</div>
			<div class="nav_cont" onclick="location.href='<?php echo base_url('admin/contact_info'); ?>'">Contact Information</div>
		</div>
	<?php endif; ?>
</div>
<script type="text/javascript">
	function gallery(mode)
	{
		if(mode == "drop")
		{
			document.getElementById('up').style.display = "none";
			document.getElementById('down').style.display = "inline";
			document.getElementById('g_01').style.display = "block";
			document.getElementById('g_02').style.display = "block";
			document.getElementById('g_03').style.display = "block";
			document.getElementById('gallery').removeAttribute('onclick');
			document.getElementById('gallery').setAttribute('onclick','gallery(\'not\')');
		}
		else
		{
			document.getElementById('up').style.display = "inline";
			document.getElementById('down').style.display = "none";
			document.getElementById('g_01').style.display = "none";
			document.getElementById('g_02').style.display = "none";
			document.getElementById('g_03').style.display = "none";
			document.getElementById('gallery').removeAttribute('onclick');
			document.getElementById('gallery').setAttribute('onclick','gallery(\'drop\')');
		}
	}
</script>