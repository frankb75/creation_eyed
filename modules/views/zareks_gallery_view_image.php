<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style>

	.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

</style>

<div style="text-align:right">

	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>

</div>

<div style="margin:0 auto; width:85%; overflow:hidden;">

	<div style="float:left; font-family:Helvetica; margin-bottom:20px; width:100%;">

		<a href="<?php echo base_url(); ?>">

			<img src="<?php echo themes_url('images/home_icon.png'); ?>" />

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<a href="<?php echo base_url($this->segment->uri(0)); ?>">

			<span style="color:#646468;font-size:18px;">

				<?php echo ucwords($this->segment->uri(0)); ?>

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<a href="<?php echo base_url('gallery/zareks'); ?>">

			<span style="color:#646468;font-size:18px;">

				Zarek's

			</span>

		</a>

		<img src="<?php echo themes_url('images/arrow_icon.png'); ?>" />

		<span style="color:#646468;font-size:24px;">

			<?php echo $photos; ?>

		</span>

	</div>

</div>

<div style="overflow:hidden; margin-top:20px;">

	<div style="margin:0 auto; font-family:Helvetica; width:70%; overflow:hidden;">

		<div style="float:left; width:48%; overflow:hidden; background:#ffffff; height:400px;">

			<div style="overflow:hidden; padding:15px;">

				<div style="height:340px; overflow:hidden;">

					<a href="javascript:void(0);"><img id="image" src="<?php echo base_url("uploads/gallery/zareks/{$zareks_id}/original/".$original_image); ?>" style="display:block;" width="360" height="340"/></a>

				</div>

				<div style="overflow:hidden;">

					<div style="float:left; color:#000000; font-size:130%; font-weight:bold; padding-top:10px;">

						<?php echo $photos; ?>

					</div>

					<div style="float:right;"><!--Image here--></div>

				</div>

			</div>

		</div>

		<div style="float:right; width:36%; overflow:hidden;">

			<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:13px 0;">

				&nbsp;

			</div>

			<a id="viewBNW" href="javascript:void(0);" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;" onclick="blackAndWhite(1); return false;">

				<img src="<?php echo themes_url('images/icon_blackandwhite.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Black and White

			</a>

			<a href="<?php echo base_url('gallery/zareks_gallery_image_purchase/'.$zareks_id.'/'.$zareks_photos_id); ?>" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;">

				<img src="<?php echo themes_url('images/icon_purchase.png'); ?>" style="vertical-align:middle; margin-right:5px;"> Purchase Image

			</a>

			<a href="<?php echo base_url('gallery/zareks'); ?>" style="display:block; padding:15px 30px; background:#242424; color:#ffffff; font-size:130%; font-weight:bold; margin-top:2px;">

				<img src="<?php echo themes_url('images/icon_return.png'); ?>" style="vertical-align:middle; margin-right:5px;"> Return to Images

			</a>

			<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:13px 0;">

				&nbsp;

			</div>

		</div>

	</div>

	<div style="margin:0 auto; font-family:Helvetica; width:70%; overflow:hidden; margin-top:30px;">

		<p style="color:#646468; font-size:130%;">These images are for web viewing purposes only. Your actual photos will be professionally printed from the original high quality images. All images are copyright of the photographer.</p>

	</div>

</div>

<?php get_footer("footer"); ?>

<script type="text/javascript">

	function blackAndWhite(val)

	{

		if(val == 1)

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','blackandwhite');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(2)');

			document.getElementById('viewBNW').innerHTML = '<img src="<?php echo themes_url('images/icon_Color.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Color';

		}

		else

		{

			document.getElementById('image').removeAttribute('class');

			document.getElementById('image').setAttribute('class','Color');

			document.getElementById('viewBNW').removeAttribute('onclick');

			document.getElementById('viewBNW').setAttribute('onclick','blackAndWhite(1)');

			document.getElementById('viewBNW').innerHTML = '<img src="<?php echo themes_url('images/icon_blackandwhite.png'); ?>" style="vertical-align:middle; margin-right:5px;"> View in Black and White';

		}

	}

</script>