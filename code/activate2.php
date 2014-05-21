<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Activation | Style Manor</title>
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


</head>

<body>

<?php include("shared variables.php");

//the link sent to the user has some variables posted to it and can be access with the get method
$code = $_GET["code"];
$email = $_GET["email"];
$message = "Programming error";

// check that the code corresponds to the given email. must be in a variable named $string
$string = $email;
//this is to decode/encode the string variable
include("protected/alphanum_encrypt.php");
//the encoded email must be the same as the code
if ($string != $code) $message = "Incorrect code for given email address.";
else {
	// connecting to database
	include("protected/dbconnect_auto.php");
	mysql_select_db("thesty10_auto-manipulate");
	//gets column of email
	$selection = mysql_query("SELECT email FROM users WHERE email='".$email."';");
	$email_exists = mysql_fetch_row($selection);
	//will return false if it doesn't exist
	if ($email_exists == false) {$message = "Your account has been deleted because you took more than 3 weeks to activate it. Please try signing up again.";}
	else {
	//update that account has  been activated
		mysql_query("UPDATE users SET activated = 1 WHERE email='".$email."';");
		//message when account is activated
		$message = "Account of $email successfully activated. Your SPAM filter may block your Style Manor newsletter, so please add info@thestylemanor.com to your address book.";
	}
	//close connection to database
	mysql_close($connection);
}

echo "

	<div style=\"width:".($main_home_width+$header_hr_overflow*2)."px;margin: 0px auto\">
";
include_once("page_view/headerview.php");
?>

		<div style='width: 100%; height:<?php echo ($v_buffer1+30); ?>px'></div>
		<!--<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>-->

		<!--prints out the message inside this div-->
		<div class='font_fancy_family' style='width: <?php echo $main_home_width;?>px; margin: 0 auto'>
		<!--<div id=\"container_outer\" class=\"font_fancy_family\">
			<div id=\"container_inner\" style=\"width: 650px\">-->
				
			<h1><?php echo $message;?></h1>
			<button type='button' class='custom_button gray' style='margin-top: 45px' onclick="document.location.href = 'home.php';">OK</button>

		</div>
		<!-- end container_inner and container_outer -->

		<iframe name='Footer' frameborder='0' scrolling='no' src='footer2.php' width='100%' height='<?php echo $footer2_height;?>px' style='margin-bottom: -4px'></iframe>
	
	</div>



</body>

</html>