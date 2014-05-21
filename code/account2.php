<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Information | Style Manor</title>

<script type="text/javascript" src="dropdown/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function () {	
	
	$('#list .middle_row li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(500);

		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);			
		}
	);
	
});
</script>
<link href="CSS_main.php" rel="stylesheet" media="screen" />


<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21950535-2']);
  _gaq.push(['_setDomainName', 'thestylemanor.com ']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>


<?php include("shared variables.php");
/************
versions:
version 0: when there is not email in the session. the user is not signed in or does not have an account
version 1: if the user is signed in 
*************/

//just an array with all the states
$state_names = array("Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Inidiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachussets", "Michigan", "Minnesota", "Mississppi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
$state_abbreviations = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
//gets the email from the post email from the pop up sign
$email = $_POST["email"];
if ($email == "") $email = $_SESSION["email"];
//connects to database
include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");
//to the entire information based on a user's email
$selection = mysql_query("SELECT * FROM users WHERE email='".$email."';");
//gets users information based on email in form of an array association
$info_array = mysql_fetch_assoc($selection);

//if post version is 2, change it to 1 
if($_POST['version']==2){$_POST['version']=1;}
//checks if post version is empty
if ($_POST["version"] == "") {
//if the session has no email to it
	if ($_SESSION["email"] == "" || $_SESSION["email"] == "-1") 
	{
	$_POST["version"] = 0;//when user not signed in/dont have an account
	}
	else {$_POST["version"] = 1;} //if the user is signed in, put version=1}
}
//when a person has clicked the register box or is about to register put this message
$message = "Thanks for joining us. Just create a password, and you're all set. (You will be asked for more details once you make a purchase.)";
$message_size = "14pt";
//when the user is signed in, get all the info about the user from database
if ($_POST["version"] == 1 || $_POST["version"] == 2) {
	if ($_POST["birthday"] == "") $_POST["birthday"] = $info_array["birthday"];
	if ($_POST["birthday"] == "") $_POST["birthday"] = "MM/DD/YYYY";
	if ($_POST["email"] == "") $_POST["email"] = $info_array["email"];
	if ($_POST["phone"] == "") $_POST["phone"] = $info_array["phone"];
	if ($_POST["first"] == "") $_POST["first"] = $info_array["first"];
	if ($_POST["last"] == "") $_POST["last"] = $info_array["last"];
	if ($_POST["ha1"] == "") $_POST["ha1"] = $info_array["ha_1"];
	if ($_POST["ha2"] == "") $_POST["ha2"] = $info_array["ha_2"];
	if ($_POST["hacity"] == "") $_POST["hacity"] = $info_array["ha_city"];
	if ($_POST["hastate"] == "") $_POST["hastate"] = $info_array["ha_state"];
	if ($_POST["hazip"] == "") $_POST["hazip"] = $info_array["ha_zip"];
	if ($_POST["ba1"] == "") $_POST["ba1"] = $info_array["ba_1"];
	if ($_POST["ba2"] == "") $_POST["ba2"] = $info_array["ba_2"];
	if ($_POST["bacity"] == "") $_POST["bacity"] = $info_array["ba_city"];
	if ($_POST["bastate"] == "") $_POST["bastate"] = $info_array["ba_state"];
	if ($_POST["bazip"] == "") $_POST["bazip"] = $info_array["ba_zip"];
}
//when a person wants to change their account info
if ($_POST["version"] == 1) {
	if ($info_array["first"] == "unnamed"){ //$message = "You will be required to supply this information before you make your first purchase.";
		$message="please supply the information below to so we can serve you better.";
	}
	else $message = "ACCOUNT";
	$message_size = "14pt";
}
//when first time an account is made(no info about address,etc) i dont think this is used
elseif ($_POST["version"] == 2) {
	$message = "Congratulations on your first purchase! For this time only, we need you to give us some information about yourself so we can serve you effectively. (Account information may be revised later on the page titled 'Account'.)";
	$message_size = "12pt";
}
//reset password. this is used only when the user is logged in and clicking the account link
elseif ($_POST["version"] == 3) {
	$message = "Reset password for ".$info_array["email"];
	$message_size = "13pt";
}
//send email password request. this is set when the user clicks on forgot password in the pop up box at the home page
elseif ($_POST["version"] == 4) {
	$message = "Type in your email address and we'll send you a link to change your password.";
	$message_size = "13pt";
}

mysql_close($connection);

echo "


<style language='text/css'>
#container_inner {
	border: solid 1px #DDD;
	padding: 15px;
	background-color: #EEE;
}
div#white_field {
	width: 100%;
	border: solid 1px #BBB;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11pt;
	background-color: #FFF;
}
.custom_button { 
	width: 145px;
	height: 43px;
	margin: 0 auto;
	font-size: 14pt;
       font-family: Franklin Gothic Demi Cond, Arial, Helvetica, sans-serif;
	background-size: 145px 43px;
}
div.spacer_row {
	display: inline;
	width: 1px;
	height: 50px;
}
</style>

</head>

<body>

	<div style='width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px'>
";
		include_once("page_view/headerview.php");
echo "
		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
		<!--
		<iframe name='Header' frameborder='0' scrolling='no' src='header2.php' width='100%' height='$header_height"."px'></iframe>
		-->
	
		<div id='container_outer'>
		
			<div style='padding: 40px'><div id='container_inner' style='width: 580px'><div id='white_field'>
				<div style='padding: 20px'>
		
					<div class='font_regular_light_family' style='font-size: $message_size'>$message</div>
						<hr />
						<br />
					
			<!--this posts to process_account2.php all the information to be processed, with the get method it appends the variables names and values-->
					<form method='post' action='process_account2.php?purchase_version=".$_GET["purchase_version"]."'>
							
							<table cellspacing='8px' style='margin: 20px auto 0 auto; text-align: left'>
								<colgroup>
									<col span='1' />
									<col span='1' />
								</colgroup>
				";
				//not signed in/ dont have an account. it will create a form if the user wants to register
				if ($_POST["version"] == 0) {
					echo "
								<tr>
									<td><b>Email</b></td>
							
									<td>
									<div class='custom_tb_frame'><input class='custom_tb' type='text' name='email' value='".$_POST['email']."' maxlength='50' /></div>
									</td>
								</tr>
					
								<tr>
									<td><b>Password</b></td>
								
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pw' 	value='' maxlength='20' /></div>
									</td>
								</tr>
					
								<tr>
									<td><b>Password confirmation</b></td>
									
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pwconfirm' value='' maxlength='20' /></div></td>
								</tr>
					";
				}//when the user wants to reset password.
				elseif ($_POST["version"] == 3) {
					echo "
								<input name='email' value='".$_POST['email']."' type='hidden' />
								
								<tr>
									<td><b>Password</b></td>
									
									<td><div class='custom_tb_frame'>
									<input class='custom_tb' type='password' name='pw' value='' maxlength='20' /></div>
									</td>
								</tr>
						
								<tr>
									<td><b>Password confirmation</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pwconfirm' value='' maxlength='20' /></div></td>
								</tr>
					";
				}//to send email to change password to user
				elseif ($_POST["version"] == 4) {
					echo "
								<tr>
									<td><b>Email</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='email' value='".$_POST['email']."' maxlength='50' /></div></td>
								</tr>
					";
				}//if the user is signed in
				else {
					//if ($_POST["version"] == 1){
					echo "
								<tr>
									<td><b>Current password *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='oldpw' value='' maxlength='20' /></div></td>
								</tr>
								<tr>
									<td><b>New password</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pw' value='' maxlength='20' /></div></td>
								</tr>
								<tr>
									<td><b>New password confirmation</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pwconfirm' value='' maxlength='20' /></div></td>
								</tr>
					";
					//}
					/*
					if ($_POST["version"] == 2){ echo "
								<tr>
									<td><b>Password</b></td>	
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pw' value='' maxlength='20' /></div></td>
								</tr>
								<tr>
									<td><b>Password confirmation</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='password' name='pwconfirm' value='' maxlength='20' /></div></td>
								</tr>
					";}*/
					echo "
								<!--this serve as rows separators-->
								<tr></tr><tr></tr><tr></tr><tr></tr>
								<tr>
									<td><b>Email</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='email' value='".$_POST['email']."' maxlength='50' /></div></td>
								</tr>
								<tr>
									<td><b>Phone number * <br />(XXX-XXX-XXXX)</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='phone' value='".$_POST['phone']."' maxlength='12' /></div></td>
								</tr>
								<!--another row separator-->
								<tr></tr><tr></tr><tr></tr><tr></tr>
								
								<tr>
									<td><b>First name *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='first' value='".$_POST['first']."' maxlength='50' /></div></td>
								</tr>
								<tr>
									<td><b>Last name *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='last' value='".$_POST['last']."' maxlength='50' /></div></td>
								</tr>
								
								<tr></tr><tr></tr><tr></tr><tr></tr>
					";/*
					if ($_POST["version"] == 2) echo "
							<tr>
								<td><b>Birthday</b></td>
								<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='birthday' value='".$_POST['birthday']."' maxlength='18' /></div></td>
							</tr>
							
							<tr></tr><tr></tr><tr></tr><tr></tr>
					*/
					echo "
								<tr>
									<td><b>Home address line 1 *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='ha1' value='".$_POST['ha1']."' maxlength='50' /></div></td>
								</tr>
								<tr>
									<td><b>Home address line 2</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='ha2' value='".$_POST['ha2']."' maxlength='50' /></div></td>
								</tr>
								<tr>
									<td><b>City *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='hacity' value='".$_POST['hacity']."' maxlength='50' /></div></td>
								</tr>
								<tr>
									<td><b>State *</b></td>
									<td>
										<select name='hastate'>
					";
					echo "
											<option value='unselected'>Unselected</option>";
						for ($i = 0; $i <= 49; $i++) {
							if ($_POST["hastate"] != $state_abbreviations[$i]){
								echo "
											<option value='".$state_abbreviations[$i]."'>$state_names[$i]</option>";
								}
							else{ 
								echo "
											<option value='".$state_abbreviations[$i]."' selected='selected'>$state_names[$i]</option>";
								}
						}
						
					echo "
										</select></td>
								</tr>
								
								<tr>
									<td><b>ZIP code *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='hazip' value='".$_POST['hazip']."' maxlength='10' /></div></td>
								</tr>
							
								<tr></tr><tr></tr><tr></tr><tr></tr>
								<tr>
									<td style='font-size: 11pt'>Billing address is same as home **</td>
									<td><input type='checkbox' name='same' ";
									
						if ($_POST["same"] == "true"){ echo "checked='checked' ";} 
								
					echo "
									value='true' style='outline: none' /></td>
								</tr>
							
								<tr></tr>
							
								<tr>
									<td><b>Billing address line 1 *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='ba1' value='".$_POST['ba1']."' maxlength='50' /></div></td>
								</tr>
							
								<tr>
									<td><b>Billing address line 2</b></td>	
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='ba2' value='".$_POST['ba2']."' maxlength='50' /></div></td>
								</tr>
					
								<tr>
									<td><b>City *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='bacity' value='".$_POST['bacity']."' maxlength='50' /></div></td>
								</tr>
							
								<tr>
									<td><b>State *</b></td>
									<td>
										<select name='bastate'>
											<option value='unselected'>Unselected</option>
					";
					for ($i = 0; $i <= 49; $i++) {
						if ($_POST["bastate"] != $state_abbreviations[$i]){ 
							echo "		  <option value='".$state_abbreviations[$i]."'>$state_names[$i]</option>";}
						else {
							echo "		  <option value='".$state_abbreviations[$i]."' selected='selected'>$state_names[$i]</option>";}
					}
							
					
					
			echo "
					
										</select></td>
								</tr>
							
								<tr>
									<td><b>ZIP code *</b></td>
									<td><div class='custom_tb_frame'><input class='custom_tb' type='text' name='bazip' value='".$_POST['bazip']."' maxlength='10' /></div></td>
								</tr>
				
				
								<tr>
									<td colspan='2'>
										* fields are required <br />
										** if selected, then there is no need to fill out billing address part
									</td>
								</tr>
							";
						}//end else
						echo "
							</table>
						<input type='hidden' name='version' value='".$_POST["version"]."' />
						<input type='submit' class='custom_button green' value='Submit' style='margin: 45px' />
					</form>
			";
				
					?>
		</div></div></div></div></div>
<!-- end padding div2, white_field, container_inner, padding div1, and container_outer -->

	
		<iframe name='Footer' frameborder='0' scrolling='no' src='footer2.php' width='100%' height='<?php echo $footer2_height?>px' style='margin-bottom: -4px'></iframe>



<!-- end PHP echo -->

	</div>

<!-- end container -->
</body>

</html>