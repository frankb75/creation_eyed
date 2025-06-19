<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array('cc_box','video_css')); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<div style="float:left; margin-bottom:20px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <a href="<?php echo base_url($this->segment->uri(0)); ?>"><span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo $categ; ?></span>
	</div>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<?php 
		$query = $this->QModel->query("SELECT * FROM videos WHERE category='".mysqli_real_escape_string($this->db->conn_id(),$categ)."' ORDER BY video_id ASC");
		
		if( ! $this->QModel->c($query)):
	?>
		<div style="width:100%;color:#646468;font-size:20px;text-align:center;">
			No Records Found!
		</div>
	<?php else: ?>
		<table style="width:100%;">
			<tr>
				<td style="width:100%; color:#646468; vertical-align:top; padding:5px;">
					<div style="background:url('<?php echo themes_url('images/flat_screen.png'); ?>'); background-size:100% 100%; padding:13px 18px 90px 18px;">
						<div id="embedded" style="height:400px;"><?php echo $description; ?></div>
					</div>
					<span id="embedded_title" style="font-size:32px;"><?php echo $video_title; ?></span>
				</td>
			</tr>
			<tr>
				<td><br /></td>
			</tr>
			<tr>
				<td>
					<div style="font-size:24px;color:#646468;">
						Video Thumbnails:
					</div>
				</td>
			</tr>
		</table>
		<div class="thumb_scroll" style="height:180px;">
			<ul style="width:5300px;">
				<?php 
					$i = 0;
					while($get = $this->QModel->g($query)):
					$video_id = $get['video_id'];
					$video_title = addslashes($get['video_title']);
					$description = $get['description'];
					$video = addslashes($get['video']);
					$video_type = $get['video_type'];
				?>
				<li style="display:inline-block; float:left;">
					<div style="padding:10px;" onclick="vidz('<?php echo $video_title; ?>','<?php echo $video; ?>','<?php echo $video_type; ?>')" style="cursor:pointer;">
						<?php if($video_type == "youtube"): ?>
							<img src="<?php echo "https://i.ytimg.com/vi/{$get['video']}/default.jpg"; ?>"/>
						<?php else: ?>
							<?php $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$video.php")); ?>
							<img src="<?php echo $hash[0]['thumbnail_medium']; ?>" style="width:120px; height:90px;"/>
						<?php endif; ?>
						<br />
						<?php echo $video_title; ?>
					</div>
				</li>
				<?php
					$i++;
					endwhile; 
				?>
			</ul>
		<div>
	<?php endif; ?>
</div>
<?php get_footer("footer"); ?>
<script>
	function vidz(video,embed,type)
	{
		if(type == "youtube")
		{
			document.getElementById('embedded').innerHTML = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + embed + '" frameborder="0" allowfullscreen></iframe>';
			document.getElementById('embedded_title').innerHTML = video;
		}
		else
		{
			document.getElementById('embedded').innerHTML = '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/' + embed + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			document.getElementById('embedded_title').innerHTML = video;
		}
	}
</script>