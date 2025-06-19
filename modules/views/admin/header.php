<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
	<title><?php echo $title; ?></title>
	<?php $last_update = time() - 60; ?>
	<?php header("HTTP/1.0 200 OK"); ?>
	<?php header("HTTP/1.1 200 OK"); ?>
	<?php header("Connection: Keep-alive"); ?>
	<?php header("Last-Modified: ".gmdate('D, d M Y H:i:s', $last_update)." GMT"); ?>
	<?php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>
	<?php header("Cache-Control: post-check=0, pre-check=0", false); ?>
	<?php header("Pragma: no-cache"); ?>
	<?php header("Content-Type: text/html; charset=UTF-8"); ?>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="noodp,noydir">
	<link href="<?php echo themes_url('images/favicon.ico'); ?>" rel="shortcut icon" type="image/x-icon" />
	<link href="<?php echo themes_url('images/favicon.ico'); ?>" rel="icon" type="image/x-icon" />
	<style type="text/css">
	<?php
		echo $css_stylesheet;
		include(FCPATH."/themes/default/css/main2.php");
		if(!empty($css))
		{
			foreach($css as $stylesheet)
			{
				include(FCPATH."/themes/default/css/".$stylesheet.".php");
			}
        }
	?>
	</style>
	<script type="text/javascript">
		document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, '');
	</script>
</head>
<body>
<div id="root" class="container">
<div id="ani">
	<header>
		<div class="wrap">
		<div class="header">
		<div class="header_body">
			<div style="float:left; padding:14px 0 0 20px;">
				<img src="<?php echo themes_url('images/logo_admin.png'); ?>" onclick="location.href = '<?php echo base_url('admin'); ?>'" style="cursor:pointer;" title="Zarek"/>
			</div>
			<?php if($this->session->userdata('admin')): ?>
				<div style="color:#fff;float:right;padding:10px 20px 0 0;text-align:right;">
					<span style="font-size:12px;"><?php echo date("F d, Y"); ?></span>&nbsp;&nbsp;&nbsp;<img src="<?php echo themes_url('images/calendar_icon.png'); ?>" />
					<br />
					<a href="<?php echo base_url(); ?>" style="font-size:12px;">View Page</a> | <span style="color:#ffaf67;font-size:12px;">Hi, Admin</span> | <a href="<?php echo base_url('auth/logout'); ?>" style="color:#4284f4;font-size:12px;">Logout</a>&nbsp;&nbsp;&nbsp;<img src="<?php echo themes_url('images/user_icon.png'); ?>" />
				</div>
			<?php else: ?>
				
			<?php endif; ?>
		</div>
		</div>
		</div>
		<div class="orange">
		</div>
	</header>
	<section>
		<div id="wrapper" class="wrap">
		<div class="body">
		<div class="content_size">
		<div class="cont_body">
		<?php
			if($this->session->userdata('admin'))
				$this->load->view('admin/menu');
		?>