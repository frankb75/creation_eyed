<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header"); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%;">
	<div style="margin-bottom:25px; width:100%;">
		<a href="<?php echo base_url(''); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:18px;"><?php echo ucwords($this->segment->uri(0)); ?></span> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo ucwords($this->segment->uri(1)); ?></span>
	</div>
	<div style="color:#646468;font-size:18px;">
		<div style="color:#646468;font-family:Helvetica;font-size:24px;">Biography of Zarek</div>
		<br />
		<div style="overflow:hidden;">
			<div style="float:left; color:#646468; width:68%;">
				My passion for photography began at the age of six. True to my instincts and enthusiasm I made it my profession in 1988. Producing eye catching images, capturing pure emotions and preserving memories inspires me to continue to do what I have always loved. I view each situation with fresh eyes and a fresh approach.
				<br />
				<br />
				Shortly after graduating from R.I.T. with a BFA degree in Narrative, Documentary and Editorial photography, I opened my first studio in Connecticut and quickly developed a list of clients spanning Connecticut and New York. I regularly shot covers and fashion for a children’s fashion magazine, catalogues, local newspapers and headshots; and I became well known for my expertise and creativity in portraiture and weddings.
				<br />
				<br />
				In 1992 I welcomed an opportunity to expand my clientele and moved to Los Angeles . My Sherman Oaks studio quickly became one of the finest in L.A., and offers a full range of services including videography and digital imaging. With a keen eye and innovative techniques, I travel the world photographing weddings, corporate parties, portraits, and specially commissioned projects. Among my clients are Anheuser-Busch, G.E., Elite Travel, Angelino, LA Parent, The Sherman Oaks Galleria, LA Direct Magazine and others.
				<br />
				<br />
				I am proud to be an active member of the Greater San Fernando Valley Chamber of Commerce, Sherman Oaks Chamber of Commerce, Bass Lake Chamber of Commerce, and reside on the board of the Sherman Oaks Beautification Committee.
				<br />
				<br />
				<div style="color:#646468;font-family:Helvetica;font-size:18px;">Affiliated Associations:</div>
				<br />
				<a href="http://www.shermanoakschamber.org/" target="_new"><img src="<?php echo themes_url('images/sherman_oaks.png'); ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://www.midvalleychamber.com/" target="_new"><img src="<?php echo themes_url('images/mv.png'); ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://www.ppa.com/splash.cfm" target="_new"><img src="<?php echo themes_url('images/ppa.png'); ?>" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://www.photoshopuser.com/" target="_new"><img src="<?php echo themes_url('images/nap.png'); ?>" /></a>
			</div>
			<div style="float:right; width:30%; text-align:center;">
				<img src="<?php echo themes_url('images/zarek.png'); ?>" />
				<div style="color:#646468;font-size:14px;">Me with my first camera.</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer("footer"); ?>