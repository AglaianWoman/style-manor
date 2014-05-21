<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX" />
<title>Sending Email | Style Manor</title>

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
<!--<style langunage="text/css">
</style>-->

</head><!--		will get to this page when accounttest.php posts to it-->
<?php
include("shared variables.php");
//need this line before doing any emailing
require_once "Mail.php";

// send email// message ID is posted to this page by the page that initiates the email. usually posted by the process_Account2.php file
$message_id = $_POST["message_id"];// mail_already_set gets set to true at the end of sending a message in this file// it is set to false by the email-initiator page// it prevents users from resending the same message by refreshing page
if ($_SESSION["mail_already_sent"] == true) { $message_id = -1; }	// prevents users from resending the same message by refreshing page// default message displayed to user; if email is successful, this message gets overriden
$valid_message_id = false;
$mail_report = "Error: either there was no message waiting to be sent, or the email programming code was incorrect";

$from = "Style Manor <info@thestylemanor.com>";
// addresses to send to are posted by the email initiator page
$to = $_POST["to"];
// default, unset subject and body
$subject = "error";
$body = "error";
// host and port number was obtained from justhost.com interface
$host = "mail.thestylemanor.com";
$port = "2626";
/*this is to send the email*/
//$username = "jacrod@thestylemanor.com";
//$password = "Smbrujan12";
$username="paul@thestylemanor.com";
$password="pr1790UCLA";
// $smtp will be used when actually executing the mail function//takes the name of the backend and an array of backend parameters
$smtp = Mail::factory('smtp',
  array ('host' => $host,
	'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));
// the following if-else chain sets the subject, body, etc. of the message depending on the message ID
if ($message_id === "1") {
	$valid_message_id = true;
	$get_clause = "";
	if ($_SESSION["email"] != "" && $_SESSION["email"] != "-1") {
		$from = $_SESSION["email"];
		$string = $from;		//to encrypt the string above which contains the email of the person
		include("protected/alphanum_encrypt2.php");		//for inviter email
		$get_clause = "?inviter_email=".$string;
	}
	$subject = "Invitation to Style Manor";

	$body = "Welcome to the Style Manor experience! Every week, a fresh \"Look of the Week\" will feature a matching SET of accessories.\n\nFor just $39.99, the \"Look of the Week\" will include a gorgeous handbag and a mix of trendy earrings, necklace, and/or bracelet-- just like what you see on the home page. And to spice up the deal, we offer FREE shipping.  We'll even give you day and night styling tips for each set, so you won't have to figure out how to coordinate with different outfits.\n\nYou definitely deserve to be pampered by stylists, and so do your friends. Make sure to share with them: http://www.thestylemanor.com/gateway.php".$get_clause.".\n\nYour SPAM filter may block your Style Manor newsletter. Ensure that you get all the goods by adding info@thestylemanor.com to your address book.\n\n\nThank you,\n\nStyle Manor Team";
}
elseif ($message_id === "2") {
	$valid_message_id = true;
	$subject = "Style Manor";	//gets email of user to send email. posted by process_account2.php
	$string = $to;
	include("protected/alphanum_encrypt.php");
	$link = "http://www.thestylemanor.com/activate2.php?code=".$string."&email=".$to;

	$body = "Activate your account by visiting this link:\n\n".$link."\n\nYour SPAM filter may block your Style Manor newsletter. Ensure that you get all the goods by adding info@thestylemanor.com to your address book.\n\n\nThank you,\n\nStyle Manor Team";
}
//when user requested password change
elseif ($message_id === "3") {
	$valid_message_id = true;
	$subject = "Style Manor";
	$string = $_POST["time"];
	include("protected/alphanum_encrypt.php");
	$link = "http://www.thestylemanor.com/change_password2.php?code=".$string."&email=".$to;
	//what the body of the email will contain
	$body = "Reset your account's password by visiting this link:\n\n".$link."\n\n\nThank you,\n\nStyle Manor Team";
}
elseif ($message_id == "4") {
	$valid_message_id = true;
	$subject = "Style Manor";
	if ($_POST["invitee_email"] == "") $_POST["invitee_email"] = "someone you invited";
	
	$body = "Congrats!\n\nYou just earned $10 shopping credit on Style Manor because ".$_POST["invitee_email"]." made a purchase.\n\n\nThank you,\n\nStyle Manor Team";
}


// END MESSAGES ///////////////////////////////////////////////////////////////////////////////////

if ($valid_message_id) {
	$headers = array (
		'From' => $from,
		'To' => $to,
		'Subject' => $subject
		);	// this is how you attempt to actually send the mail
	$mail = $smtp->send($to, $headers, $body);	// this checks if the attempt failed
	if (PEAR::isError($mail)) {$mail_report = $mail->getMessage();}
	else {$mail_report = "Mail sent"; //mail successfully sent
	}
	$_SESSION["mail_already_sent"] = true;
}
$_POST["to"] = "nobody";
$_POST["message_id"] = "-1";

// Either redirect to home page or display message about whether the email was sent successfully
if ($_POST["report"] == "false") {echo "<body onload=\"document.location.href = 'home.php'\">";}
else{
 echo "
<body><!--outputs the body with the mail report message-->
	<div style=\"width: ".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px\">
";

include_once("page_view/headerview.php");
	echo "
			<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
			<!--
			<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>-->
			
			<!--EDIT:removed id=container_outer-->
			<div class=\"font_fancy_family\" style=\"width:100%;height:400px\">
			<!--commented the line below out-->
			<!--  <div id=\"container_inner\" style=\"width: 400px\">   -->
				<h1>$mail_report</h1>
			<!--</div>-->	
			</div>
	<!-- end container_inner and container_outer -->
		
			<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>

		</div>


	"; 
}
?><!-- end PHP echo -->
</body>
</html>