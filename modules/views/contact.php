<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php get_header("header"); ?>
<div style="text-align:right">
	<img src="<?php echo themes_url('images/icon_arrow.png'); ?>" style="float:right"/>
</div>
<div style="margin-left:auto; font-family:Helvetica; margin-right:auto; width:85%; overflow:hidden;">
	<div style="margin-bottom:25px; width:100%;">
		<a href="<?php echo base_url(''); ?>"><img src="<?php echo themes_url('images/home_icon.png'); ?>" /></a> <img src="<?php echo themes_url('images/arrow_icon.png'); ?>" /> <span style="color:#646468;font-size:24px;"><?php echo ucwords($this->segment->uri(0)); ?></span>
	</div>
	<div style="color:#646468;font-size:16px;">
		<div style="font-size:18px;">
			Photography & Video By Zarek has 2 Locations to serve you better:<br />
		</div>
		<br />
		<b>SHERMAN OAKS:</b>
		<br />
		<a href="http://www.mapquest.com/maps?address=5823+Vesper+Ave&city=Van+Nuys&state=CA&zipcode=91411&redirect=true" target="_new" style="color:#ea0000;">5823 Vesper Ave., Sherman Oaks, CA 91411</a>
		<br />
		(Click on address for map and directions)
		<br />
		<span style="color:#1155cc;font-size:16px;font-weight:bold;">(818) 304-0334</span>
		<br />
		<br />
		<b>BASS LAKE:</b>
		<br />
		<a href="http://www.mapquest.com/maps?address=53703+Oak&city=Bass+Lake&state=CA&zipcode=93604&redirect=true" target="_new" style="color:#ea0000;">P.O. Box 541, Bass Lake, CA 93604</a>
		<br />
		(Click on address for map and directions)
		<br />
		<span style="color:#1155cc;font-size:16px;font-weight:bold;">(559) 658-7564</span>
		<br />
		<br />
		<div style="font-size:18px;">
			For more info, please contact the studio using the form below.
		</div>
		<br />
		<br />
		<form method="POST">
			<table style="float:left; width:45%;color:#646468;">
				<tr>
					<td>Name:</td>
					<td><input style="margin-left:5px; border:0; border:1px solid #d9d9d9; background:#fff; width:250px; outline:0; color:#646468; height:30px;" type="text" name="fullname" value="<?php echo isset($fullname) ? $fullname : ""; ?>" /></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input style="margin-left:5px; border:0; border:1px solid #d9d9d9; background:#fff; width:250px; outline:0; color:#646468; height:30px;" type="text" name="email" value="<?php echo isset($email) ? $email : ""; ?>" /></td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td><input style="margin-left:5px; border:0; border:1px solid #d9d9d9; background:#fff; width:250px; outline:0; color:#646468; height:30px;" type="text" name="pnumber" value="<?php echo isset($pnumber) ? $pnumber : ""; ?>" /></td>
				</tr>
				<tr>
					<td>Date Of Event:</td>
					<td><input style="margin-left:5px; border:0; border:1px solid #d9d9d9; background:#fff; width:250px; outline:0; color:#646468; height:30px;" type="text" name="date_event" value="<?php echo isset($date_event) ? $date_event : ""; ?>"/></td>
				</tr>
			</table>
			<table style="float:left; width:45%;">
				<tr>
					<td>Type of Inquiry:</td>
					<td>
						<select class="input_text" name="typephoto" style="border:0; border:1px solid #d9d9d9; background:#fff; width:100px; outline:0; color:#646468; height:30px;">
							<option>Select...</option>
							<?php if(isset($typephoto) ? $typephoto == "Wedding" : ""): ?>
								<option selected>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Bar Mitzvah" : ""): ?>
								<option>Wedding</option>
								<option selected>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Corporate Event" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option selected>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Portrait" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option selected>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Pregnancy" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option selected>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Headshot" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option selected>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Digital Imaging" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option selected>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Video" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option selected>Video</option>
								<option>Other</option>
							<?php elseif(isset($typephoto) ? $typephoto == "Other" : ""): ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option selected>Other</option>
							<?php else: ?>
								<option>Wedding</option>
								<option>Bar Mitzvah</option>
								<option>Corporate Event</option>
								<option>Portrait</option>
								<option>Pregnancy</option>
								<option>Headshot</option>
								<option>Digital Imaging</option>
								<option>Video</option>
								<option>Other</option>
							<?php endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top;">Comments:</td>
					<td>
						<textarea name="comment" style="border:0; border:1px solid #d9d9d9; background:#fff; width:250px; outline:0; color:#646468; height:100px;"><?php echo isset($comment) ? $comment : ""; ?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Submit" /></td>
				</tr>
				<tr>
					<td></td>
					<td><?php echo isset($error) ? '<span style="color:red; font-size:14px;">'.$error.'</span>' : ""; echo $this->session->flashdata('success'); ?></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php get_footer("footer"); ?>