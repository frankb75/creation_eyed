<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('login_css','admin_bodycss')); ?>
<div class="login">
	<div class="login_body">
		<div style="font-size:24px;font-weight:bold;text-align:center;">
			Admin Login
		</div>
		<br />
		<form method="POST">
			<table>
				<tr>
					<td>Username:</td>
					<td><input class="input_text" type="text" name="username" value="<?php echo isset($username) ? $username : ""; ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input class="input_text" type="password" name="password" value="" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<font id="error" style="color:#ff0000;"><?php echo isset($error) ? $error : ""; echo $this->session->flashdata('success'); ?></font>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right;"><input class="submit" type="submit" name="submit" value="Submit" /></td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php get_footer("admin/footer"); ?>