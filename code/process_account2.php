<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX" />
<title>Signing Up | Style Manor</title>

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


<style language="text/css">
.custom_button {
	margin-top: 40px;
}
</style>

</head>

<?php
include("shared variables.php");
include("protected/salt.php");

/*
The user should arrive at this page only when account2.php has posted to it. account.php will post different kinds of account info entered by the user, depending on the version of the account.php.

version = 0  --> Initial member sign-up with email and password
version = 1  --> User is a member and has already completed all personal info fields before; they are just updating those fields now
version = 2  --> Initial member sign-up with all fields; I don't think we are using this right now
version = 3  --> User is a member who clicked on a special link that was emailed to them for resetting her password
version = 4  --> User clicked "forgot password?" and entered their email address for sending the special reset-password link to
*/



$errors[] = "no errors";	// initializes array for storing error messages and puts in its 0th element, "no errors"; if there are any errors and no dominant error, all errors will be displayed to the user
$dominant_error = "none";	// if dominant_error is anything other than "none", only it will be displayed

include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");
//gets email from the post by the account2.php file
$email = $_POST["email"];
$selection = mysql_query("SELECT email FROM users WHERE email='".$email."';");
// $account_exists will be false if there is no account associated with $email
$account_exists = mysql_fetch_row($selection);

//if somehow a person goes directly into this page without clicking a submit button from account2.php
$version = $_POST["version"];
if ($version == "") $dominant_error = "Error: denied access to change account information";

//for updating fields
if ($version == 1) {
	// compare password given by user to password stored in database
	$oldpw = $_POST["oldpw"];
	$encrypted_oldpw = crypt($oldpw, $salt);
	$selection = mysql_query("SELECT encrypted_pw FROM users WHERE email='".$_SESSION["email"]."';");
	$real_encrypted_oldpw_array = mysql_fetch_assoc($selection);
	if ($encrypted_oldpw != $real_encrypted_oldpw_array["encrypted_pw"]) $errors[] = "Old password given is not correct";
}

if ($version == 0 || $version == 1 || $version == 2 || $version == 3) {
	// check that new password is long enough and that the second type-out of the password matches the first
	$pw = $_POST["pw"];
	if ( ($version == 0 || $version == 3) && strlen($pw) < 6) $errors[] = "Your password must be at least 6 characters long";
	if ($version == 1 && strlen($pw) < 6 && $pw != "") $errors[] = "Your password must be at least 6 characters long";
	$pwconfirm = $_POST["pwconfirm"];
	if ($pwconfirm != $pw) $errors[] = "Mismatch between first and second entries of password";
	$encrypted_pw = crypt($pw, $salt);
}
//when a user has already an account and is going to change their email
if ($version == 0 || $version == 1 || $version == 2) {
	//regular expression to check email is in valid form
	$email_match=preg_match("/^(?!.*\.{2})[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/",$email);
	if(!$email_match){
		$errors[] = "Given email is not valid";
	}
	/*
	// check that new email given has one @-sign and at least one period
	$split_by_AT = explode("@", $email);
	//checks that the array when split by @ is equal to two
	if (count($split_by_AT) != 2) $errors[] = "Given email address is not valid";
	else {//checks that the length of the two array items is less then one to generate error
		if (strlen($split_by_AT[0]) < 1 || strlen($split_by_AT[1]) < 1) $errors[] = "Given email address is not valid";
		else {//splits the second item in the array about the dot/period
			$split_by_DOT = explode(".", $split_by_AT[1]);
			//checks if array split is less than two
			if (count($split_by_DOT) < 2) { $errors[] = "Given email address is not in valid form"; }
			elseif (strlen($split_by_DOT[0]) < 1 || strlen($split_by_DOT[1]) < 1) $errors[] = "Given email address is not valid";//when the arrays split have less than 1 characters each
		}
	}
	*/
	// check that new member's email has not already been taken
	if ($version == 0) {
		$selection = mysql_query("SELECT email FROM users WHERE email='".$email."';");
		$taken = mysql_fetch_row($selection);
		if ($taken != false) $dominant_error = "There is already an account associated with this email address. Only one account is permitted per email address.";
	}
}
//checks that the email is in the database
if ($version == 4) {
	if (! $account_exists) $errors[] = "There is no account associated with $email";
}



// BEGIN CASE THAT VERSION == 1 OR 2 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($version == 1 || $version == 2) {

	// check that phone number is in form XXX-XXX-XXXX, where the X's are numbers
	$phone = $_POST["phone"];
	$phone_match=preg_match('/^\d{3}-\d{3}-\d{4}$/',$phone);
	if(!$phone_match){$errors[]="Invalid phone number; must be in the form XXX-XXX-XXXX";}
	

	// check that first name is given and does not contain characters other than letters, numbers, spaces, hyphens, and periods
	$first = $_POST["first"];
	if ($first == "" || $first == "unnamed") $errors[] = "Missing first name";
	else {
		$first_name_match=preg_match('/^\pL+$/u',$first);
		if(!$first_name_match){$errors[]="First name contains unusual characters";}
	
	}

	// similar name check for last name as for first name
	$last = $_POST["last"];
	if ($last == "") $errors[] = "Missing last name";
	else {
		$last_name_match=preg_match('/^\pL+$/u',$last);
		if(!$last_name_match){$errors[]="Last name contains unusual characters";}
		
	}

	if ($version == 2) {
		// check that birthday was given and in readable format and that user is >= 18 years old
		$birthday_RAW = $_POST["birthday"];
		// strtotime() returns false if it couldn't read the string provided as a date
		$birthday = strtotime($birthday_RAW);
		if ($birthday_RAW == "") $errors[] = "Missing birthday";
		elseif ($birthday == false) $errors[] = "Birthday not given in correct format; use [month day year] or MM/DD/YYYY";
		elseif ($birthday > strtotime("-18 years")) $dominant_error = "Sorry, you must be at least 18 years old to use Style Manor.";
	}

	// check that home and billing address fields have all been provided (except ha2 and ba2), and that zip codes are in format XXXXX or XXXXX-XXXX, where the Xs are numbers

	$ha1 = $_POST["ha1"];
	$ha2 = $_POST["ha2"];
	$hacity = $_POST["hacity"];
	$hastate = $_POST["hastate"];
	$hazip = $_POST["hazip"];

	if ($ha1 == "") $errors[] = "Missing line 1 for home address";
	if ($hacity == "") $errors[] = "Missing city for home address";
	if ($hastate == "unselected") $errors[] = "Unselected state for home address";
	if ($hazip == "") {$errors[] = "Missing home ZIP code";}
	else {
		if(!preg_match('/^(\d{5})(-\d{4})?$/',$hazip)){
		$errors[]="Invalid Home ZIP code. must be of in form XXXXX or XXXXX-XXXX and contain numbers only.";
		}
	}
	
	// if user checks box "billing address same as home" then just copy all home address fields into billing address fields
	$same = $_POST["same"];
	if ($same == "true") {
		$ba1 = $ha1;
		$ba2 = $ha2;
		$bacity = $hacity;
		$bastate = $hastate;
		$bazip = $hazip;
	}
	else {
		$ba1 = $_POST["ba1"];
		$ba2 = $_POST["ba2"];
		$bacity = $_POST["bacity"];
		$bastate = $_POST["bastate"];
		$bazip = $_POST["bazip"];

		if ($ba1 == "") $errors[] = "Missing line 1 for billing address";
		if ($bacity == "") $errors[] = "Missing city for billing address";
		if ($bastate == "unselected") $errors[] = "Unselected state for billing address";
		
		if ($bazip == ""){ $errors[] = "Missing billing ZIP code";}
		else{
			if(!preg_match('/^(\d{5})(-\d{4})?$/',$bazip)){
			$errors[]="Invalid Billing ZIP code. must be of in form XXXXX or XXXXX-XXXX and contain numbers only.";
			}
		}
	}
}
// END CASE THAT VERSION == 1 OR 2 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// If successful, make sure the user is logged in with the correct (possibly new) email
if ($dominant_error == "none" && count($errors) <= 1 && $email != "" && ($version == 0 || $version == 1 || $version == 2 || $version == 3) ) $_SESSION["email"] = $email;



// in the case that a new member successfully joins, create his account, send activation email, and redirect to the home page

if ( ($dominant_error == "none") && (count($errors) <= 1) && ($version == 0 || $version == 2) && (! $account_exists) ) {

	// no errors and making a new member account (by inserting the account info into the database)

	$string = $email;
	include("protected/alphanum_encrypt2.php");
	//if someone invites another person to join. i dont think this is being used
	$inviter_email = "none";
	if ($_SESSION["inviter_email"] != ""){ $inviter_email = $_SESSION["inviter_email"];}
	//inserts new user email and password
	if ($version == 0) {
		mysql_query("INSERT INTO users (
			email,
			encrypted_email,
			encrypted_pw,
			inviter_email,
			join_date,
			last_login
		) VALUES (
			'".$email."',
			'".$string."',
			'".$encrypted_pw."',
			'".$inviter_email."',
			'".time()."',
			'".time()."'
		);");
	}
//not using this right now but keep it
	if ($version == 2) {
		mysql_query("INSERT INTO users (
			email,
			encrypted_email,
			encrypted_pw,
			inviter_email,
			join_date,
			last_login,
			first,
			last,
			birthday,
			phone,
			ha_1,
			ha_2,
			ha_city,
			ha_state,
			ha_zip,
			ba_1,
			ba_2,
			ba_city,
			ba_state,
			ba_zip
		) VALUES (
			'".$email."',
			'".$string."',
			'".$encrypted_pw."',
			'".$inviter_email."',
			'".time()."',
			'".time()."',
			'".$first."',
			'".$last."',
			'".$birthday."',
			'".$phone."',
			'".$ha1."',
			'".$ha2."',
			'".$hacity."',
			'".$hastate."',
			'".$hazip."',
			'".$ba1."',
			'".$ba2."',
			'".$bacity."',
			'".$bastate."',
			'".$bazip."'
		);");
	}

	mysql_close($connection);

	// initiate email
	$_SESSION["mail_already_sent"] = false;
	echo "
	<body onload=\"document.getElementById('emailer_form').submit();\">
		<form id=\"emailer_form\" method=\"post\" action=\"emailer2.php\">
			<input name=\"message_id\" value=\"2\" type=\"hidden\" />
			<input name=\"to\" value=\"$email\" type=\"hidden\" />
			<input name=\"report\" value=\"false\" type=\"hidden\" />
		</form>
	";
}//user requested a change of password
elseif ( ($dominant_error == "none") && (count($errors) <= 1) && ($version == 4) ) {

	// no errors and processing a request to send a password-reset email
	//time the user requested a link to reset password.
	$time = time();
	//change the time when the user requested a change of password
	mysql_query("UPDATE users SET
		pw_change_request_time = ".$time."
		WHERE email='".$email."'
	;");
	mysql_close($connection);
	//useful for later in emailer2.php
	$_SESSION["mail_already_sent"] = false;

	echo "
	<body onload=\"document.getElementById('emailer_form').submit();\">
		<form id=\"emailer_form\" method=\"post\" action=\"emailer2.php\">
			<input name=\"message_id\" value=\"3\" type=\"hidden\" />
			<input name=\"to\" value=\"$email\" type=\"hidden\" />
			<input name=\"time\" value=\"$time\" type=\"hidden\" />
		</form>
	";
}
else {
echo "
<body>


	<div style=\"width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px\">

";

include_once("page_view/headerview.php");
echo "
		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>

		<!--<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>-->

	
		<div id=\"container_outer\" class=\"font_fancy_family\">
		
			<div id=\"container_inner\" style=\"width: 650px\">
";
		if ($dominant_error != "none") { 
			echo "<h1>$dominant_error</h1>
			";
			if($version!=""){
				echo "
				<form method='post' action='account2.php'>
				<input type='hidden' value='".$version."' name='version' />
				<input type='submit' class='custom_button gray' value='OK' style='margin: 45px 0' />
				</form>
				";
			}
		}
		elseif (count($errors) > 1) {
			echo "<h1>Your application could not be processed for the following reasons:</h1>";
			echo "<ol style=\"text-align: left\">";
			for ($i = 1; $i <= count($errors)-1; $i++) {
				echo "<li>".$errors[$i]."</li>";
			}
			echo "</ol>";
		}
		else {
				// no errors so update the user's account info in the way appropriate to the version, then notify the user about a successful processing

			if ($version == 1) {

				if ($pw == "") {
						mysql_query("UPDATE users SET
							first = '".$first."',
							last = '".$last."',
							email = '".$email."',
							phone = '".$phone."',
							ha_1 = '".$ha1."',
							ha_2 = '".$ha2."',
							ha_city = '".$hacity."',
							ha_state = '".$hastate."',
							ha_zip = '".$hazip."',
							ba_1 = '".$ba1."',
							ba_2 = '".$ba2."',
							ba_city = '".$bacity."',
							ba_state = '".$bastate."',
							ba_zip = '".$bazip."'
							WHERE email='".$_SESSION["email"]."'
						;");
				}
				else {
						mysql_query("UPDATE users SET
							first = '".$first."',
							last = '".$last."',
							email = '".$email."',
							encrypted_pw = '".$encrypted_pw."',
							phone = '".$phone."',
							ha_1 = '".$ha1."',
							ha_2 = '".$ha2."',
							ha_city = '".$hacity."',
							ha_state = '".$hastate."',
							ha_zip = '".$hazip."',
							ba_1 = '".$ba1."',
							ba_2 = '".$ba2."',
							ba_city = '".$bacity."',
							ba_state = '".$bastate."',
							ba_zip = '".$bazip."'
							WHERE email='".$_SESSION["email"]."'
						;");
				}
					
					echo "
					<h1>Successfully updated account information.</h1>
					<button type=\"button\" class=\"custom_button gray\" onclick=\"document.location.href = 'home.php';\">Good</button>
					";
			}
			elseif ($version == 2) {
					mysql_query("UPDATE users SET
						first = '".$first."',
						last = '".$last."',
						birthday = '".$birthday."',
						phone = '".$phone."',
						ha_1 = '".$ha1."',
						ha_2 = '".$ha2."',
						ha_city = '".$hacity."',
						ha_state = '".$hastate."',
						ha_zip = '".$hazip."',
						ba_1 = '".$ba1."',
						ba_2 = '".$ba2."',
						ba_city = '".$bacity."',
						ba_state = '".$bastate."',
						ba_zip = '".$bazip."'
						WHERE email='".$_SESSION["email"]."'
					;");

					echo "
					<h1>Submission successful!</h1>
					<form action=\"process_purchase_request.php?purchase_version=".$_GET["purchase_version"]."\" method=\"post\">
						<input type=\"submit\" class=\"custom_button gray\" value=\"Proceed\" />
					</form>
					";
			}
			elseif ($version == 3) {
					mysql_query("UPDATE users SET
						encrypted_pw = '".$encrypted_pw."',
						pw_change_request_time = 0
						WHERE email='".$_SESSION["email"]."'
					;");

					echo "
					<h1>Password successfully reset.</h1>
					<button type=\"button\" class=\"custom_button gray\" onclick=\"document.location.href = 'home.php';\">OK</button>
					";
			}
		}
			
			// if processing failed on a non-dominant error, have the user post all the posted info back to account2.php so it can be re-populated with the same info (maybe this section should be integrated with the if-else sequence above)
			if ($dominant_error == "none" && count($errors) > 1) {
			echo "
				<form method=\"post\" action=\"account2.php\">
					<input type=\"hidden\" name=\"email\" value=\"".$_POST["email"]."\" />
					<input type=\"hidden\" name=\"phone\" value=\"".$_POST["phone"]."\" />
					<input type=\"hidden\" name=\"first\" value=\"".$_POST["first"]."\" />
					<input type=\"hidden\" name=\"last\" value=\"".$_POST["last"]."\" />
					<input type=\"hidden\" name=\"birthday\" value=\"".$_POST["birthday"]."\" />
					<input type=\"hidden\" name=\"ha1\" value=\"".$_POST["ha1"]."\" />
					<input type=\"hidden\" name=\"ha2\" value=\"".$_POST["ha2"]."\" />
					<input type=\"hidden\" name=\"hacity\" value=\"".$_POST["hacity"]."\" />
					<input type=\"hidden\" name=\"hastate\" value=\"".$_POST["hastate"]."\" />
					<input type=\"hidden\" name=\"hazip\" value=\"".$_POST["hazip"]."\" />
					<input type=\"hidden\" name=\"same\" value=\"".$_POST["same"]."\" />
					<input type=\"hidden\" name=\"ba1\" value=\"".$_POST["ba1"]."\" />
					<input type=\"hidden\" name=\"ba2\" value=\"".$_POST["ba2"]."\" />
					<input type=\"hidden\" name=\"bacity\" value=\"".$_POST["bacity"]."\" />
					<input type=\"hidden\" name=\"bastate\" value=\"".$_POST["bastate"]."\" />
					<input type=\"hidden\" name=\"bazip\" value=\"".$_POST["bazip"]."\" />
					<input type=\"hidden\" name=\"version\" value=\"".$version."\" />
					<input type=\"submit\" class=\"custom_button gray\" value=\"OK\" style=\"margin: 45px 0\" />
				</form>
			"; }
			
			mysql_close($connection);
			
			echo "


		</div></div>
<!-- end container_inner and container_outer -->

	
	<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>

	</div>

"; } ?><!-- end PHP echo and else statement -->

</body>

</html>