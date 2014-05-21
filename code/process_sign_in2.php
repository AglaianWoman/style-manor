<?php
session_start();
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX" />
<title>Signing In | Style Manor</title>

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
</style>

</head>

<!--		A user will get to this page if they are signing in by clicking the sign in custom button on home2.php-->

<?php
include("shared variables.php");
include("protected/salt.php");
//gets email from the post method that posted to this page
$email = $_POST["email"];
//encrypt password
$submitted_encrypted_pw = crypt($_POST["pw"], $salt);
//to detect error
$error = "none";
//connects to database
include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");
//gets encrypted password fro given email
$selection = mysql_query("SELECT encrypted_pw FROM users WHERE email='".$email."';");
//returns an array. if there were no rows to select then it returns false.
$real_encrypted_pw = mysql_fetch_row($selection);
//if the array for password is false, then there is no account with the given email
if ($real_encrypted_pw == false) $error = "Sorry, we don't have an account associated with the email $email";
//pasword not correct
elseif ($submitted_encrypted_pw != $real_encrypted_pw[0]) $error = "Incorrect password given for $email";
//no errors. log in user and redirect to home page
if ($error == "none") {	

//to set email when user is logged in
	$_SESSION["email"] = $email;	
	//update login count
	mysql_query("UPDATE users SET
		last_login = ".time().",
		login_count = login_count+1
		WHERE email = '".$email."'
	;");	
	session_write_close();
	//header("Location: /./");
	//exit;
	//$url="home.php";
	//header("Location: " . $url);
	//exit;
	//redirect to home page
	echo "<body onload=\"document.location.href = 'home.php';\">";
}
else {
echo "
<body>

	<div style='width:".($main_home_width+$header_hr_overflow*2)."px;margin:0px auto;margin-top:5px'>
	";
	 include("page_view/headerview.php");
	 echo "
	<!--
	<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>
	-->
	<!--EDIT: removed id=container_outer-->
	<div class='font_fancy_family' style='width:100%;text-align: center;background-color: #FFF;color: #000;height:350px'>
		<div id='container_inner' style='width: 400px'>  

			<h1>$error</h1>		
			<!--makes a form for the error and posts to accounttest.php-->
			<form id='forgot_pw_form' method='post' action='account2.php'>
				<input name='version' value='4' type='hidden' />
			</form>
			<form method='post' action='home.php'>
				<input type='hidden' name='email' value='$email' />
				";
							
				if ($error == "Incorrect password given for $email"){
				echo "
				<br />
				<div onclick=\"document.getElementById('forgot_pw_form').submit()\" class='forgot_pw'>Forgot password?</div>
				<br />
				";
			} 
			echo "
				<input type='submit' class='custom_button gray' style='margin-top: 45px' value='OK' />
			</form>
	</div></div>
<!-- end container_inner and container_outer -->	
	<iframe name='Footer' frameborder='0' scrolling='no' src='footer2.php' width='100%' height='<?php echo $footer2_height; ?>px' style='margin-bottom: -4px'></iframe>

	</div>";

 } //end else statement
mysql_close($connection); ?><!-- end PHP ech0-->

</body>

</html>