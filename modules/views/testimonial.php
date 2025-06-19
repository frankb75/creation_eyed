<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header",array('testimonial_css','nano')); ?>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%;">
	<div style="margin-bottom:25px; width:100%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo ucwords($this->segment->uri(1)); ?></span>
	</div>
	<div style="margin:0 auto; width:75%;">
		<div style="text-align:center;">
			<img src="<?php echo themes_url('images/testimonials.jpg'); ?>" style="width:60%;height:auto;max-height: auto;max-width: auto;" />
		</div>
		<div class="nano" style="height:400px;">
			<div style="color:#646468;" class="nano-content">
				<?php
					$query_wedding = $this->QModel->sf(
						'client_testimonials',
						'testimonial_id DESC'
					);
					
					if( ! $this->QModel->c($query_wedding)):
				?>
					<div style="width:100%;color:#646468;font-size:18px;text-align:center;">
						No Records Found!
					</div>
				<?php else: ?>
					<?php 
						$i = 0;
						while($get = $this->QModel->g($query_wedding)):
						$testimonial_id = $get['testimonial_id'];
						$category = $get['category'];
						$client_name = $get['client_name'];
						$testimonials = $get['testimonials'];
					?>
					<br />
					<?php echo $testimonials; ?>
					<br />
					~ <span style="color:#000;"><?php echo $client_name; ?></span>
					<br />
					<br />
					<div style="border:1px dashed #0a0a0c;"></div>
					<?php
						$i++;
						endwhile; 
					?>
				<?php endif; ?>
			</div>
		</div>
		<table>
			<tr>
				<td style="width:65%;">
					<div style="overflow:hidden;">
						<div style="float:left;color:#d4d4d4;text-align:center;width:70%;padding:20px 10px 10px 10px;">
							<script src='//www.weddingwire.com/assets/vendor/widgets/my-reviews.js' type='application/javascript'></script>
							<div class='ww-reset ww-reviews-widget' id='ww-widget-reviews'>
								<div class='ww-reviews-placeholder'>
									Read all of our
									<a href="http://www.weddingwire.com/biz/photography-video-by-zarek-sherman-oaks/246b2b217cb8a3a8.html" target="_blank">Photography Reviews
									</a>at
									<a alt="Weddings, Wedding Cakes,  Wedding Planning, Wedding Checklists, Free Wedding Websites, Wedding Dresses, Wedding Ideas &amp; more" href="http://www.weddingwire.com"><img alt="Wwlogo 83x19" src="//www.weddingwire.com/assets/widgets/logo/WWlogo-83x19.gif" />
									</a>
								</div>
							</div>
							<script>
							  WeddingWire.createReview({"vendorId":"246b2b217cb8a3a8", "id":"ww-widget-reviews" });
							</script>
						</div>
						<div style="float:right;margin-top:130px;width:20%;">
							<a href="http://www.weddingwire.com/biz/photography-video-by-zarek-sherman-oaks-bass-lake/246b2b217cb8a3a8.html" target="_new"><img alt="WeddingWire" src="http://www.weddingwire.com/assets/badges/BCA-2015/BCA2015-logo-77dd79725dab55e769b6d0984dbcb444.png" style="width:90%;height:auto;max-height: auto;max-width: auto;" style="width:90%;height:auto;max-height: auto;max-width: auto;" /></a>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php get_footer("footer",array("nano")); ?>
<script>
	 $(".nano").nanoScroller({
       alwaysVisible: true,
       scroll: "top"    
   });
 
</script>