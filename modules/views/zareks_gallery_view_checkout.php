<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php get_header("header",array("client_css")); ?>

<style type="text/css">

	.clients_gallery img{ max-width:100% !important; width:100%; height:auto; display:block; }

	.payment_proccess th{ padding:10px; background:#404040; color:#ffffff; border-left:2px solid #17171a; }

	*table, tr, td, th{ border:1px solid #ffffff; }

</style>

<?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?>

<div style="margin:0 auto; width:85%; overflow:hidden; color:#ffffff;">

		<?php echo isset($error) ? '<span style="color:red;">'.$error.'</span>' : ""; ?>

	<div style="overflow:hidden;">

		<div style="float:left; width:430px; overflow:hidden;">

			<div style="background:#333333; border-top-right-radius:5px; border-top-left-radius:5px; padding:8px 0;">

				&nbsp;

			</div>

			<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:18px; font-weight:bold; text-align:center;">

				<?php

					if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

						echo "Authorization to charge my credit card";

					else

						echo $delivery_type;

				?>

			</div>

			<form method="POST">

			<?php if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2"): ?>

				<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:16px; margin-top:2px; text-align:center;">

					<input type="radio" name="card_type" value="Visa" <?php echo (isset($card_type) ? $card_type == "Visa" : "") ? "checked" : ""; ?> /> Visa

					<input type="radio" name="card_type" value="Mastercard" <?php echo (isset($card_type) ? $card_type == "Mastercard" : "") ? "checked" : ""; ?> /> Mastercard

				</div>

			<?php endif; ?>

			<div style="padding:10px 25px; background:#242424; color:#ffffff; font-size:14px; margin-top:2px;">

				<table style="font-size:14px; margin-top:15px;">

				<?php if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2"): ?>

					<tr>

						<td>Cardholder Name: </td>

						<td style="text-align:right;"><input type="text" name="cardholder_name" value="<?php echo isset($cardholder_name) ? $cardholder_name : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Account Number: </td>

						<td style="text-align:right;"><input type="text" name="account_number" value="<?php echo isset($account_number) ? $account_number : ""; ?>" maxlength="16" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Expiration Date: </td>

						<td style="text-align:right;"><input type="text" name="expiration_date" value="<?php echo isset($expiration_date) ? $expiration_date : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td colspan="2">CVV (3 digit number on back of card) <input type="text" name="cvv" value="<?php echo isset($cvv) ? $cvv : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:130px; outline:0; color:#fff; height:20px;" maxlength="3"/></td>

					</tr>

					<tr>

						<td>Billing Address: </td>

						<td style="text-align:right;"><input id="address" type="text" name="billing_address" value="<?php echo isset($billing_address) ? $billing_address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>City:</td>

						<td><input type="text" name="city" value="<?php echo isset($city) ? $city : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:230px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>State:</td>

						<td><input type="text" name="state" value="<?php echo isset($state) ? $state : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:230px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Zip Code:</td>

						<td><input type="text" name="zip_code" value="<?php echo isset($zip_code) ? $zip_code : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:230px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td></td>

						<td>

							Same Shipping Address?

							<br />

							<input id="shipping_address_type" type="radio" name="same_shipping_address" onClick="same_shipping_addressboom(this.value)" value="Yes" <?php echo (isset($same_shipping_address) ? $same_shipping_address == "Yes" : "") ? "checked" : "" ?> /> Yes

							<input id="shipping_address_type2" type="radio" name="same_shipping_address" onClick="same_shipping_addressboom(this.value)" value="No" <?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "checked" : "" ?> /> No

						</td>

					</tr>

					<?php if(isset($same_shipping_address) ? $same_shipping_address == "Yes" : ""): ?>

					<tr id="address_ship" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "Yes" : "") ? "" : "none" ?>;">

					<?php else: ?>

					<tr id="address_ship" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

					<?php endif; ?>

						<td>Shipping Address: </td>

						<td style="text-align:right;"><input id="shipping_address" type="text" name="shipping_address" value="<?php echo isset($shipping_address) ? $shipping_address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="city" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>City:</td>

						<td style="text-align:right;"><input type="text" name="shipping_city" value="<?php echo isset($shipping_city) ? $shipping_city : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="state" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>State:</td>

						<td style="text-align:right;"><input type="text" name="shipping_state" value="<?php echo isset($shipping_state) ? $shipping_state : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="zip_code" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>Zip Code:</td>

						<td style="text-align:right;"><input type="text" name="shipping_zip_code" value="<?php echo isset($shipping_zip_code) ? $shipping_zip_code : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Phone #: </td>

						<td style="text-align:left;">

							(<input type="text" name="phone_number1" value="<?php echo isset($phone_number1) ? $phone_number1 : ""; ?>" maxlength="3" placeholder="xxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:30px; outline:0; color:#fff; height:20px;"/>) 

							<input type="text" name="phone_number2" value="<?php echo isset($phone_number2) ? $phone_number2 : ""; ?>" maxlength="3" placeholder="xxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:30px; outline:0; color:#fff; height:20px;"/> - 

							<input type="text" name="phone_number3" value="<?php echo isset($phone_number3) ? $phone_number3 : ""; ?>" maxlength="4" placeholder="xxxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:40px; outline:0; color:#fff; height:20px;"/>

						</td>

					</tr>

					<tr>

						<td>Email Address: </td>

						<td style="text-align:right;"><input type="text" name="email_address" value="<?php echo isset($email_address) ? $email_address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

				<?php else: ?>

					<tr>

						<td>First Name: </td>

						<td style="text-align:right;"><input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Last Name: </td>

						<td style="text-align:right;"><input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Address: </td>

						<td style="text-align:right;"><input id="address" type="text" name="address" value="<?php echo isset($address) ? $address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>City: </td>

						<td style="text-align:right;"><input type="text" name="city" value="<?php echo isset($city) ? $city : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Country: </td>

						<td style="text-align:right;">

							<select name="country" style="outline:0; border:0; border-bottom:2px solid #333; width:250px; background:transparent; height:25px; color:#fff; cursor:pointer;">

								<option style="background:#242424; color:#fff">United States</option>

								<option style="background:#242424; color:#fff">Canada</option>

							</select>

						</td>

					</tr>

					<tr>

						<td>State: </td>

						<td style="text-align:right;"><input type="text" name="state" value="<?php echo isset($state) ? $state : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Zip Code: </td>

						<td style="text-align:right;"><input type="text" name="zip_code" value="<?php echo isset($zip_code) ? $zip_code : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td></td>

						<td>

							Same Shipping Address?

							<br />

							<input id="shipping_address_type" type="radio" name="same_shipping_address" onClick="same_shipping_addressboom(this.value)" value="Yes" <?php echo (isset($same_shipping_address) ? $same_shipping_address == "Yes" : "") ? "checked" : "" ?> /> Yes

							<input id="shipping_address_type2" type="radio" name="same_shipping_address" onClick="same_shipping_addressboom(this.value)" value="No" <?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "checked" : "" ?> /> No

						</td>

					</tr>

					<?php if(isset($same_shipping_address) ? $same_shipping_address == "Yes" : ""): ?>

					<tr id="address_ship" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "Yes" : "") ? "" : "none" ?>;">

					<?php else: ?>

					<tr id="address_ship" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

					<?php endif; ?>

						<td>Shipping Address: </td>

						<td style="text-align:right;"><input id="shipping_address" type="text" name="shipping_address" value="<?php echo isset($shipping_address) ? $shipping_address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="city" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>City:</td>

						<td style="text-align:right;"><input type="text" name="shipping_city" value="<?php echo isset($shipping_city) ? $shipping_city : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="state" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>State:</td>

						<td style="text-align:right;"><input type="text" name="shipping_state" value="<?php echo isset($shipping_state) ? $shipping_state : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr id="zip_code" style="display:<?php echo (isset($same_shipping_address) ? $same_shipping_address == "No" : "") ? "" : "none" ?>;">

						<td>Zip Code:</td>

						<td style="text-align:right;"><input type="text" name="shipping_zip_code" value="<?php echo isset($shipping_zip_code) ? $shipping_zip_code : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

					<tr>

						<td>Phone #: </td>

						<td style="text-align:left;">

							(<input type="text" name="phone_number1" value="<?php echo isset($phone_number1) ? $phone_number1 : ""; ?>" maxlength="3" placeholder="xxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:30px; outline:0; color:#fff; height:20px;"/>) 

							<input type="text" name="phone_number2" value="<?php echo isset($phone_number2) ? $phone_number2 : ""; ?>" maxlength="3" placeholder="xxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:30px; outline:0; color:#fff; height:20px;"/> - 

							<input type="text" name="phone_number3" value="<?php echo isset($phone_number3) ? $phone_number3 : ""; ?>" maxlength="4" placeholder="xxxx" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:40px; outline:0; color:#fff; height:20px;"/>

						</td>

					</tr>

					<tr>

						<td>Email Address: </td>

						<td style="text-align:right;"><input type="text" name="email_address" value="<?php echo isset($email_address) ? $email_address : ""; ?>" style="margin-left:5px; border:0; border-bottom:2px solid #333; background:transparent; width:250px; outline:0; color:#fff; height:20px;"/></td>

					</tr>

				<?php endif; ?>

				</table>

				<div style="overflow:hidden; margin-top:30px;">

					<?php

						if($this->input->get('r'))

							$return_url = base_url('gallery/zareks_gallery_view_addtocart?r='.$this->input->get('r'));

						else

							$return_url = base_url('gallery/zareks');

					?>

					<div style="float:right"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" name="checkout" value="Place Order"/></div>

					<div style="float:left"><input style="margin-top:10px; font-size:95%; border-radius:5px; padding:3px 8px; cursor:pointer;" type="submit" value="Return to Shopping Cart" onclick="location.href = '<?php echo $return_url; ?>'; return false;"/></div>

				</div>

			</div>

			</form>

			<div style="background:#333333; border-bottom-right-radius:5px; border-bottom-left-radius:5px; padding:8px 0;">

				&nbsp;

			</div>

		</div>

	</div>

</div>

<?php get_footer("footer", array('client','jquery')); ?>

<script>

function same_shipping_addressboom(ship_address){

	if(ship_address == 'No')

	{

		document.getElementById('shipping_address').value = "";

		document.getElementById("address_ship").style.display = "table-row";

		document.getElementById("city").style.display = "table-row";

		document.getElementById("state").style.display = "table-row";

		document.getElementById("zip_code").style.display = "table-row";

	}

	else

	{

		var address = document.getElementById('address');

		var userinput = address.value;

		document.getElementById('shipping_address').value = userinput;

		document.getElementById("address_ship").style.display = "table-row";

		document.getElementById("city").style.display = "none";

		document.getElementById("state").style.display = "none";

		document.getElementById("zip_code").style.display = "none";

	}

}

$('#phone_number').keyup(function() {

  var foo = $(this).val().split("-").join("");

  foo = foo.match(new RegExp('.{1,4}$|.{1,3}', 'g')).join("-");

  $(this).val(foo);

});

</script>