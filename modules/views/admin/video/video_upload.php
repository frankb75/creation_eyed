<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("admin/header",array('admin_bodycss','admin_categorycss')); ?>
	<div style="background:#c6c7cb;font-size:30px;overflow:hidden; padding:12px 0 14px 15px;">
		Video - <?php echo $categ; ?>
	</div>
	<div style="padding:50px 20px 0 20px; overflow:hidden">
	<?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?>
		<form method="POST" enctype="multipart/form-data">
			<div class="photo_head" style="width:87%;">
				Upload Photo
			</div>
			<div style="overflow:hidden;">
				<table>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							Youtube Video ID:
						</td>
						<td style="vertical-align:top;">
							<input class="input_text" type="text" name="video_id" placeholder="Enter youtube video id here" value="<?php echo isset($video_id) ? $video_id : ""; ?>" style="width:700px" />
						</td>
					</tr>
					<tr>
						<td>
							Video Title:
						</td>
						<td style="vertical-align:top;">
							<input class="input_text" type="text" name="video_title" placeholder="Video title" value="<?php echo isset($video_title) ? $video_title : ""; ?>" style="width:700px" />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;">OR</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							Vimeo Video ID:
						</td>
						<td style="vertical-align:top;">
							<input class="input_text" type="text" name="video_id2" placeholder="Enter vimeo video id here" value="<?php echo isset($video_id2) ? $video_id2 : ""; ?>" style="width:700px" />
						</td>
					</tr>
					<tr>
						<td>
							Video Title:
						</td>
						<td style="vertical-align:top;">
							<input class="input_text" type="text" name="video_title2" placeholder="Video title" value="<?php echo isset($video_title2) ? $video_title2 : ""; ?>" style="width:700px" />
						</td>
					</tr>
				</table>
			</div>
			<br />
			<div style="width:85%;text-align:right;">
				<input id="btn" class="input_submit" type="submit" name="upload_video" value="Upload Video" onclick="loading()"/>
				<div id="loading" style="display:none;"><img src="<?php echo themes_url('images/loading2.gif'); ?>"/> Uploading. Please wait...</div>
			</div>
		</form>
		<div style="padding:50px 20px 0 20px;">
		<table style="width:100%;">
			<tr class="tbl_head">
				<td colspan="2">&nbsp;Videos</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php
				$query = $this->QModel->sfwa(
					'videos',
					array('category'),
					array($categ)
				);
				if( ! $this->QModel->c($query)):
			?>
			<tr>
				<td><span style="font-size:14px;">No video uploaded.</span></td>
			</tr>
			<?php else: ?>
			<tr>
				<td style="text-align:left;">
					<?php $i = 1; while($get = $this->QModel->g($query)): ?>
					<?php if($i == 6): $i = 1; ?>
					<div style="height:150px; width:150px; text-align:center; float:left;">
						<div style="text-align:left;">
							<a href="<?php echo base_url('admin/video_delete/'.$get['video_id']); ?>"><img src="<?php echo themes_url('images/close_button_red.png'); ?>" /></a>
						</div>
						<div style="height:150px; width:150px;">
							<?php echo $get['description']; ?>
						</div>
					</div>
					<?php else: $i++; ?>
					<div style="height:200px; width:150px; text-align:center; float:left;">
						<div style="text-align:left;">
							<a href="<?php echo base_url('admin/video_delete/'.$get['video_id']); ?>"><img src="<?php echo themes_url('images/close_button_red.png'); ?>" /></a>
						</div>
						<div style="height:150px; width:150px;">
							<?php echo $get['description']; ?>
						</div>
						<div style="text-align:left;"><?php echo $get['video_title']; ?></div>
					</div>
					<?php endif; ?>
					<?php endwhile; ?>
				</td>
			</tr>
			<?php endif; ?>
		</table>
		<br />
		<a href="<?php echo base_url('admin/video'); ?>" style="color:#727272;font-size:18px;">&laquo;Back</a>
	</div>
	</div>
</div>
<?php get_footer("admin/footer"); ?>
<script>
	function loading()
	{
		document.getElementById('btn').style.display = "none";
		document.getElementById('loading').style.display = "block";
	}
</script>