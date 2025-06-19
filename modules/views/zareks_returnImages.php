<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div style="margin-bottom:10px; text-align:right;"><input class="input_cart" type="submit" name="continue" value="Continue" style="color:#fff;"/></div>
<?php
	$query = $this->QModel->sfwa('zareks_photos','zareks_id',$zareks_id,'CAST(photos AS DECIMAL(10,2)) ASC');
	$count = $this->QModel->c($query);
	while($get = $this->QModel->g($query)):
	$zareks_photos_id = $get['zareks_photos_id'];
	$photos = $get['semi_original_image'];
	$original_image = $get['original_image'];
	$clients_photos_created = $get['clients_photos_created'];
?>
	<div style="overflow:hidden; background:#ffffff; height:290px; width:31.5%; float:left; overflow:hidden; margin-left:9px; margin-bottom:9px;">
		<div style="text-align:center; width:auto; height:224px; overflow:hidden; margin:10px 10px 5px 10px; background:#e2e2e2;">
			<a href="<?php echo base_url('uploads/gallery/zareks/'.$zareks_id.'/original/'.$original_image); ?>" rel="lightbox[jnk]">
				<table style="height:224px; margin:0 auto;">
				<tr>
					<td style="vertical-align:middle"><img src="<?php echo base_url("uploads/gallery/zareks/".$zareks_id."/semi-original/".$photos); ?>"/></td>
				</tr>
				</table>
			</a>
		</div>
		<div style="margin-left:10px; font-size:12px;"><?php echo $get['photos']; ?></div>
		<div style="height:44px; overflow:hidden;">
			<?php
				if($this->session->userdata('img_zareks_id'.$zareks_photos_id)):
			?>
				<input type="checkbox" name="selected[]" value="<?php echo $zareks_photos_id; ?>" style="padding:10px; margin-left:10px; margin-top:10px;" checked />
			<?php else: ?>
				<input type="checkbox" name="selected[]" value="<?php echo $zareks_photos_id; ?>" style="padding:10px; margin-left:10px; margin-top:10px;"/>
			<?php endif; ?>
			<?php if($this->session->userdata('myfavorites')): ?>
			<?php
				$q = $this->QModel->sfwa('myfavorites',array('email_address','photos_id','locate'),array($this->session->userdata('myfavorites'),$zareks_photos_id,'Zareks'));
				if($this->QModel->c($q)):
			?>
				<img id="star<?php echo $zareks_photos_id; ?>" src="<?php echo themes_url('images/icon_btnstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $zareks_id; ?>,<?php echo $zareks_photos_id; ?>);"/>
			<?php else: ?>
				<img id="star<?php echo $zareks_photos_id; ?>" src="<?php echo themes_url('images/icon_disstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $zareks_id; ?>,<?php echo $zareks_photos_id; ?>);"/>
			<?php endif; ?>
			<?php else: ?>
				<img id="star<?php echo $zareks_photos_id; ?>" src="<?php echo themes_url('images/icon_disstar.png'); ?>" style="float:right; margin-right:5px; cursor:pointer;" onclick="markAsFavorite(<?php echo $zareks_id; ?>,<?php echo $zareks_photos_id; ?>);"/>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile; ?>
<div style="clear:both;">&nbsp;</div>
<div style="margin-top:10px; text-align:right;"><input class="input_cart" type="submit" name="continue" value="Continue" style="color:#fff;"/></div>