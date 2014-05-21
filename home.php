<?php 
session_start(); 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="Description" content="Style Manor will show you how to wear the latest trends with day and night outfits, as picked out by stylists. We feature a new set of accessories every week. You get what you need all in one matching bundle-- no shopping through clutter, no subscriptions.&nbsp; Join now." />
<meta name="KeyWords" content="the style manor, style manor, style, accessories, look, fashion, style" />
<!-- The following meta tags are for tracking shares on Facebook -->
<meta property="og:title" content="Style Manor will show you how to wear the latest trends with day and night outfits, as picked out by stylists. We feature a new set of accessories every week. You get what you need all in one matching bundle-- no shopping through clutter, no subscriptions.&nbsp; Join now." />
<meta property="og:type" content="company" />
<meta property="og:site_name" content="Style Manor" />
<meta property="og:url" content="http://thestylemanor.com" />
<meta property="og:image" content="https://launchrock-assets.s3.amazonaws.com/facebook-files/0Z9g9VrH5mpR17a.jpg" />
<meta property="og:description" content="Stylish jewelry AND a chic handbag for just $39.99... Style Manor is a girl's best friend!  " />
<title>Style Manor</title>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<!--<script type="text/javascript" src="jquery-1.8.3.min.js"></script>-->

<script type="text/javascript" src="jquery.easing.1.3.js"></script>

<script type="text/javascript" src="dropdown.js"></script>

<link href="CSS_main.php" rel="stylesheet" media="screen" />
	
	<!--
<link rel="stylesheet" href="jqzoom/css/jquery.jqzoom.css" type="text/css">


<script src="csspopup.js" type="text/javascript"></script>

<script src="jqzoom/js/jquery-1.6.js" type="text/javascript"></script>

<script src="jqzoom/js/jquery.jqzoom-core.js" type="text/javascript"></script>

<script type="text/javascript">
	// zoom feature of main image
	$(document).ready(function() {
		$('.jqzoom').jqzoom({

			zoomType: 'innerzoom',

			lens: false,

			preloadImages: true,

			title: false,
			showEffect: 'fadein',
			hideEffect: 'fadeout',
			fadeinSpeed: 300,
			fadeoutSpeed: 400,
			alwaysOn: false

        	});

	
});


	// use Google Analytics to track page views
 	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-21950535-2']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
-->


<?php


include("shared variables.php");
/*
include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");

if($_SESSION["email"]=="" || $_SESSION["email"]==-1){$member=false;}
else {$member=true;}
/***************************************************
NOTES:
1. if we are not signed in then $_SESSION["email"]="".
2. 
**************************************************/
//this is used for the height for the separating divs
$v_buffer1 = 8;
//$h_buffer1 = $v_buffer1;
//the width for the timer table cells to be adjusted
$max_timer_segment_width = 45;
//$timer_h_buffer = 9;
$small_banner_width = 280;
$small_banner_height = 110;
$small_banner_buffer = floor(($main_home_width - $small_banner_width*3)/2);
/*
//some type of pink color. it is not used anywhere in this file
$custom_pink = "#F4518A";
$time=time();
$start_query=mysql_query("SELECT * FROM images WHERE active='no' AND start_date IS NOT NULL AND start_date<=".$time."");
while($row=mysql_fetch_assoc($start_query)){
	mysql_query("UPDATE images SET active='yes', start_date=NULL WHERE image_id=".$row['image_id']."");
}

$end_query=mysql_query("SELECT * FROM images WHERE active='yes' AND end_date IS NOT NULL AND end_date<=".$time."");
while($row=mysql_fetch_assoc($end_query)){
	mysql_query("UPDATE images SET active='no' WHERE image_id=".$row['image_id']."");
}

$bottom_banner_query=mysql_query("SELECT * FROM images WHERE active='yes' AND image_type='bottom banner' ORDER BY order_id");
$bottom_banner_image=mysql_fetch_assoc($bottom_banner_query);
// get info about current LotW from database
//this gets the current look of the week iteration number 
/*
$queue_head_array = mysql_fetch_assoc( mysql_query("SELECT number FROM variables WHERE name='lotw queue head';") );
$queue_tail_array = mysql_fetch_assoc( mysql_query("SELECT number FROM variables WHERE name='lotw queue tail';") );
//EDIT: lotw_sets where lotw_iteration
//gets row for the end time of look of the week, and images.
$set_data = mysql_fetch_assoc( mysql_query("SELECT * FROM banners WHERE iteration='".$queue_head_array["number"]."';") );

if($set_data!=false){
	if ($set_data["endtime"] < time()) {
	/*if ($queue_head_array["number"] == $queue_tail_array["number"]) {
		mysql_query("UPDATE lotw_sets SET duration=duration*2 WHERE lotw_iteration=".$set_data["lotw_iteration"].";");
	}*/
	//else {
	/*
		mysql_query("UPDATE variables SET number=number+1 WHERE name='lotw queue head';");
		$queue_head_array["number"] += 1;
		$set_data = mysql_fetch_assoc( mysql_query("SELECT * FROM banners WHERE iteration='".$queue_head_array["number"]."';") );
	//}
	}
}

/*
$mydate = getdate($set_data["endtime"]);

$time_until_next_close = $set_data["end_time"] - time();
$days = floor($time_until_next_close / (24*60*60));
$time_until_next_close -= $days*24*60*60;
$hours = floor($time_until_next_close / (60*60));
$time_until_next_close -= $hours*60*60;
$minutes = floor($time_until_next_close / 60);
*/
$popup_width = 560;
//old value 500
$popup_height = 400;
/*
//checks if the user clicked on signed in or register button
if ($_GET["join"] == "true") $call_popup_conditionally = "popup('sign_in',$popup_width,$popup_height); blanket()";
//if($_GET["reg"]=="true")$call_popup_conditionally = "popup('sign_up',$popup_width,$popup_height); blanket()";


if ($_GET["signup"] == "true") $call_popup_conditionally = "popup('sign_up',$popup_width,$popup_height); blanket()"; //$_SESSION["email"] = "";
*/
//if ($_GET["signup"] == "false") $_SESSION["email"] = "-1";

//if ($_SESSION["email"] == "") $call_popup_conditionally = "popup('sign_up',$popup_width,$popup_height); blanket()";
//$_SESSION["email"] = "";
//if ($_GET["join"] == "false") $_SESSION["email"] = "-1";
//if ($_SESSION["email"] == "") 


echo "

<style language='text/css'>
	/*body {width:100%;}*/
	/*this is to customize the blanket for the pop up, the one that covers the entire screen in black*/
	#blanket {	
		background-color: #111;	opacity: 0.65;	filter: alpha(opacity=65);	position: absolute;	z-index: 9001;	top: 	0px;	left: 0px;	width: 100%;}

	/*customizes the sign in window*/
	#sign_in {	color:white;	font-family:Gotham, Verdana;	position: absolute;	background:black;
		/*background-image: url('images/login frame.png');*/	background-size: $popup_width"."px $popup_height"."px;	width: $popup_width"."px;	height: $popup_height"."px;	z-index: 9002;}
	
	/*sets color for the sign in window#sign_in a { color: #000; }*/

	/*div for the background pop up window*/
	#sign_in_background {	margin: 21px 18px;
		/* thickness of the frame is 2.88% of the popup width and 4.32% of the popup height */	
		width: ".($popup_width*(1-0.032*2))."px;	
		height: ".($popup_height*(1-0.046*2))."px;	
		background:black;	
		background-size: ".($popup_width-18*2)."px ".($popup_height-21*2)."px;		
		/*background-image: url('images/sign-up-in background.png');*/}

	/*contents for the window*/
	#sign_in_contents {	
		padding: 6px 10px;	font-size: 10pt;}

	.custom_button {background-color: #FFF;		cursor: pointer;}

	/*this is for the sign up button in the pop up register box*/
	.custom_button.sign_up {	
		width: 95px;	height: 35px;	
		background-image: url('images/sign_up_reg.png');    
		background-size: 95px 35px;
	}

	/*this is for th sign in button in the sign in pop up box*/
	.custom_button.sign_in {	width: 100px;	height: 35px;	background-image: url('images/sign_in2.png');	background-size: 100px 35px;}

	#sign_up{
		color:white;
		font-family:Gotham, Verdana;
		position: absolute;	background:black;	
		/*background-image: url('logo.png');*/
		background-size:".$popup_width."px".($popup_height-130)."px;
		width:".$popup_width."px;
		height:".($popup_height-130)."px;
		z-index: 9002;		
	}

	#sign_up_background{
		font-size: 10pt;
		margin: 21px 18px;
		/* thickness of the frame is 2.88% of the popup width and 4.32% of the popup height */
		width: ".($popup_width*(1-0.032*2))."px;
		/*OLD VALUE:$popup_height*(1-0.046*2)*/
		height: ".($popup_height+80)."px;

		/*background:black;
		background-size: ".($popup_width-18*2)."px ".($popup_height-21*2)."px; */
	}

	#sign_up_contents{
		padding: 6px 10px;
		font-size: 10pt;
	}
	.daily_crush{color:blue;text-decoration:underline;}
	.dauly_crush:hover{color: $color_dark_pink;}

	/* UPDATE */
	a:hover, a:active, a:focus { color: $color_dark_pink;
 }


	/* OBSELETE social site link styling */
	/*************************************************
	.twitter-share-button, .tweet_container {
		float: left;
		margin: 0;
		padding: 0;
		min-width: 0;
		width: 90px;
	}
	.fb-like, .like_container {
		float: left;
		margin: 0;
		padding: 0;
		width: 90px;
	}
	.pin-it-button, .pin_it_container {
		float: left;
		margin: 0;
		padding: 0;
		width: 90px;
	}
	*******************************/
</style>

</head>
<!--

-->
<body>
<!-- REMAINING TASKS
1. header2.php
2. all link hrefs
3. hover effect for links (?)
4. dynamic JavaScript update for timer (make timer an iframe and refresh it automatically on a frequent basis)
-->


<!-- OBSELETE facebook JavaScript code -->
	<!--
	<div id='fb-root'></div>

	<script>(function(d, s, id) {

		var js, fjs = d.getElementsByTagName(s)[0];

		if (d.getElementById(id)) return;

		js = d.createElement(s);
		js.id = id;
		js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';

		fjs.parentNode.insertBefore(js, fjs);

	}(document, 'script', 'facebook-jssdk'));
	</script>
	-->

	<div style='width: ".($main_home_width + $header_hr_overflow*2)."px; margin: 0 auto;margin-top:5px'>
";

include("header.php");

		
		
	?>

<!--REMOVED THE CODE FOR THE SIGN UP SIGN IN POP UP WINDOW-->

		
<!-- THIS STARTS THE MAIN CONTENTS OF THE PAGE -->
		
		<div class='main_contents' style='width: <?php echo $main_home_width;?>px; margin: 0 auto'>
			<!--EDIT 1-->
			
			
			<div style='width: 100%; height: <?php echo $v_buffer1+10; ?>px'></div>
		
			<!--<iframe name='slider' frameborder='0' scrolling='no' src='slider.php' width='100%' height='px'></iframe>
			-->
			
			<a href='Shop.php' target='_top'><img src='images/home_banner.png' width='<?php echo $main_home_width;?>px' height='380px' usemap='#lead_banner' style='border: none' /></a>
			
			<div style='width: 100%; height: <?php echo $v_buffer1; ?>px'></div>
			<div style='width: 100%; height: <?php echo $v_buffer1; ?>px'></div>
			<!--changed src from as-seen-on.png-->
			<img src='images/as-seen-on.png' width='<?php echo $main_home_width; ?>px' height='50px' />
			<div style='width: 100%; height: <?php echo $v_buffer1; ?>px'></div>
			
		
<!----stores the small three banners at the bottom---------------------------------------------------->
			<div style='width: 100%; height: <?php echo $small_banner_height; ?>px'>
				<a href='how_it_works2.php'><img src='images/small-banner_left.png' width='<?php echo $small_banner_width; ?>px' height='<?php echo $small_banner_height; ?>px' style='float: left' /></a>
			
				<!--div separator-->
				<div style='width: <?php echo $small_banner_buffer; ?>px; height: <?php echo $small_banner_height; ?>px; float: left'></div>
				<a href='past_looks2.php'><img src='images/small-banner_middle.png' width='<?php echo $small_banner_width; ?>px' height='<?php echo $small_banner_height; ?>px' style='float: left' /></a>
			
				<!--div separator-->
				<div style='width:<?php echo $small_banner_buffer;?>px; height:<?php echo $small_banner_height;?>px; float: left'></div>
				<!--old src would be a php tag and then: echo $bottom_banner_image["directory"];-->
				<a href='shop.php'><img src='images/This Weeks.png' width='<?php echo $small_banner_width;?>px' height='<?php echo $small_banner_height;?>px' style='float: left' /></a>
			</div>




		<!--EDIT 2-->
			
		</div><!-- end container that has class=main_contents, width = $main_home_width -->

		<iframe name='Footer' frameborder='0' scrolling='no' src='footer.php' width='100%' height='<?php echo $footer2_height;?>px' style='margin-bottom: -4px'></iframe>
	</div>

<!-- end container that has width = $header_hr_width -->

<!--// mysql_close($connection);<!-- end PHP echo and PHP block -->

<!-- OBSELETE -->
<!--
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
-->
</body>

</html>

<!--  EDIT 1 lines
this div is used as a separator from the above content in the page
			<div style='width: 100%; height: $v_buffer1"."px'></div>-->
			<!--
			<div style='color:#990066;font-size:18pt;text-align:center;width: 100%;'>Notice: Due to server maintenance issues on 6/27, we will offer Ice and Baubles again today</div>
			-->
			
			<!--<div style='font-size:12pt;text-align:center;width: 100%;'>Hello Daily Crush // Goodbye Look of the Week. <a class='daily_crush' href='dailycrush.php'>read more</a></div>-->
			
			<!-- the iframe for the timer -->
			<!--<iframe name='timer' frameborder='0' scrolling='no' src='timer.php' width='100%' height='60px'></iframe>
			-->
			
			
			
<!-- OBSELETE social site links -->
		<!--
		<div class='pin_it_container'><a href='http://pinterest.com/pin/create/button/?url=http://thestylemanor.com/home.php&media=http://thestylemanor.com/images/products/".$set_data["name"]."/".$set_data["image_name"]."&description=I'm%20loving%20Style%20Manor's%20latest%20look!' class='pin-it-button' count-layout='horizontal'><img border='0' src='//assets.pinterest.com/images/PinExt.png' title='Pin It' /></a></div>
		<div class='tweet_container'><a href='https://twitter.com/share' class='twitter-share-button' data-lang='en'>Tweet</a></div>
		
		
		
<!--EDIT 2-->
<!---
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
		<div class='like_container'><div style='position: relative; top: 0px' class='fb-like' data-href='https://www.facebook.com/pages/Style-Manor/355403124486325' data-send='false' data-layout='button_count' data-width='90' data-show-faces='false' data-font='segoe ui'></div></div>
		<a href='invites.php' style='float: left; margin: -1px 10px 0 0'><img src='images/email button.png' width='22px' height='22px' /></a>
		<div style='float: right; font-size: 22pt; margin: -7px 0 0 0px' class='font_dark_pink'>Share</div>
		
		<img style='float: right; margin-bottom: 20px' src='images/paypal logo.png' width='72px' height='25px' />
		-->

		<!-- EDIT: pop up window
		<!--<iframe name='Header' frameborder='0' scrolling='no' src='header2.php' width='100%' height='$header2_height"."px'></iframe>
	<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
<!-- conditional sign up/in pop-up ---------------------------------------------------------------------->

		<!--this makes the blanket. do not remove id
		<div id='blanket' style='display: none'></div>
		
		<!--EDIT: removed; background-size:$popup_widthpx ($popup_height-100) -->
	
		<!--this displays it in the middle when it is shown by clicking the button, but will not display it in the middle when removing the display:none property-->
	
		<!--<body onload='$call_popup_conditionally'>  -->
		
		