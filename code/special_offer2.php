<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="ROBOTS" content="NOINDEX" />
<meta name="Description" content="Style Manor will show you how to wear the latest trends with day and night outfits, as picked out by stylists. We feature a new set of accessories every week. You get what you need all in one matching bundle-- no shopping through clutter, no subscriptions.&nbsp; Join now." />
<meta name="KeyWords" content="the style manor, style manor, style, accessories, look, fashion, style" />
<!-- The following meta tags are for tracking shares on Facebook -->
<meta property="og:title" content="Style Manor will show you how to wear the latest trends with day and night outfits, as picked out by stylists. We feature a new set of accessories every week. You get what you need all in one matching bundle-- no shopping through clutter, no subscriptions.&nbsp; Join now." />
<meta property="og:type" content="company" />
<meta property="og:site_name" content="Style Manor" />
<meta property="og:url" content="http://thestylemanor.com" />
<meta property="og:image" content="https://launchrock-assets.s3.amazonaws.com/facebook-files/0Z9g9VrH5mpR17a.jpg" />
<meta property="og:description" content="Stylish jewelry AND a chic handbag for just $39.99... Style Manor is a girl's best friend!  " />
<title>Style Manor Special</title>


<link rel="stylesheet" href="jqzoom/css/jquery.jqzoom.css" type="text/css">
<link href="CSS_main.php" rel="stylesheet" media="screen" />
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






<?php

$_SESSION["special_offer"] = "krazyrayray";

include("shared variables.php");
include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");


$HHscale = $home_header_size/37;
$CLscale = $col_left_width/434;
$CRscale = $col_right_width/500;

$col_left_margin = 20;
$col_spacer = 80;

$min_width = $col_left_margin + $col_left_width + $col_spacer + $col_right_width;

// extras (stuff at bottom of right column)

$share_label_height = $CRscale*40;			// baseline = $CRscale*40; good = $CRscale*40
$share_mar_top = 20;
$share_mar_bottom = 15;
$notes_size = $CRscale*12;
$notes_width = $notes_size*38;
$extras_mar_bottom = 80;

// get info about Jennifer Lopez set from database
// lotw_iteration for Jennifer Lopez is 10
// expiration time for this temporary offer is given in shared variables.php
$lotw_iteration = 10;
$end_time = strtotime($special_offer_expiration);

$set_data = mysql_fetch_assoc( mysql_query("SELECT * FROM lotw_sets WHERE lotw_iteration=".$lotw_iteration.";") );
//$newendtime=strtotime("+21 days");
if ($end_time < time()) {
	$days = 0;
	$hours = 0;
	$minutes = 0;
}
else {
	$time_until_next_close = $end_time - time();
	$days = floor($time_until_next_close / (24*60*60));
	$time_until_next_close -= $days*24*60*60;
	$hours = floor($time_until_next_close / (60*60));
	$time_until_next_close -= $hours*60*60;
	$minutes = floor($time_until_next_close / 60);
}

$discount = format_money((1 - $set_data["price"]/$set_data["value"])*100)."%";
$savings = "$".format_money($set_data["value"] - $set_data["price"]);

$showcase_size = 0;
for ($i = 1; $i <= 8; $i++) {
	if ($set_data["showcase".$i] == "") break;
	$showcase_size++;
}

// showcase images

$item_spacing = 2;
$item_width = 80;
$item_height = 0.9*$item_width;
$image_size = 0.9*$item_height;
$anchor_vert_padding = ($item_height - $image_size)/2;
$anchor_hori_padding = ($item_width - $image_size)/2;

$max_row_size = floor($col_right_width / ($item_width+$item_spacing));
$row_sizes = array();
$row_indents = array();
$unused_items = $showcase_size;
for ($row = 0; $unused_items > 0; $row++) {
	if ($unused_items < $max_row_size) $row_sizes[$row] = $unused_items;
	else $row_sizes[$row] = $max_row_size;
	$row_indents[$row] = ($col_right_width - $row_sizes[$row]*$item_width - $row_sizes[$row]*($item_spacing-1)) / 2;
	$unused_items -= $row_sizes[$row];
}

$list_height = count($row_sizes)*$item_height;





echo "




<style language=\"text/css\">
a:hover, a:active, a:focus { color: $color_dark_pink;
 }

div#timer {

	width: 100%;

	height: ".($CLscale*95)."px;

	margin-bottom: ".($CLscale*28)."px;

	background-image: url('images/timer background.png');

	background-size: ".($CLscale*385)."px ".($CLscale*95)."px;

	background-repeat: no-repeat;

	background-position: center;

}

div.timer_subframe {

	width: 100%;

	height: ".($CLscale*59)."px;

	background-image: url('images/timer subframe.png');

	background-size: 100% ".($CLscale*59)."px;

	font-family: Segoe Print, Forte, serif;
	font-size: ".($CLscale*23)."pt;
	line-height: ".($CLscale*59)."px;

}

div.timer_subframe_label {

	width: 100%;

	margin-top: ".($CLscale*-3)."px;

	font-size: ".($CLscale*10)."pt;

}

div.timer_subframe_container {

	width: ".($CLscale*69)."px;

	float: left;

}

div.timer_subframe_spacer {

	width: ".($CLscale*31)."px;

	height: 1px;

	float: left;

}

#blanket {
	background-color: #111;
	opacity: 0.65;
	filter: alpha(opacity=65);
	position: absolute;
	z-index: 9001;
	top: 0px;
	left: 0px;
	width: 100%;
}
#sign-up-in {
	position: absolute;
	background-image: url('images/login frame.png');
	background-size: $popup_width"."px $popup_height"."px;
	width: $popup_width"."px;
	height: $popup_height"."px;
	z-index: 9002;
}
#sign-up-in a { color: #000; }
#sign-up-in_background {
	margin: 21px 18px;
	/* thickness of the frame is 2.88% of the popup width and 4.32% of the popup height */
	width: ".($popup_width*(1-0.032*2))."px;
	height: ".($popup_height*(1-0.046*2))."px;
	background-image: url('images/sign-up-in background.png');
	background-size: ".($popup_width-18*2)."px ".($popup_height-21*2)."px;
}
#sign-up-in_contents {
	padding: 6px 10px;
	font-size: 10pt;
}

.custom_button {
	background-color: #FFF;
	cursor: pointer;
}
.custom_button.sign_up {
	width: 95px;
	height: 35px;
	background-image: url('images/sign up.png');
	background-size: 95px 35px;
}
.custom_button.sign_in {
	width: 100px;
	height: 35px;
	background-image: url('images/sign in.png');
	background-size: 100px 35px;
}
.custom_button.buy_set {
	width: ".($CLscale*183)."px;
	height: ".($CLscale*70)."px;
	background-color: #000;
	background-image: url('images/buy set button.png');
	background-size: ".($CLscale*183)."px ".($CLscale*70)."px;
}

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
/*.share_label {
	width: 60px;
	text-align: right;
	font-size: $share_label_height"."px;
}*/


</style>

</head>
<body>



<div id=\"fb-root\"></div>

<script>(function(d, s, id) {

	var js, fjs = d.getElementsByTagName(s)[0];

	if (d.getElementById(id)) return;

	js = d.createElement(s);
	js.id = id;
	js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1\";

	fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));
</script>

<div style=\"width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px\">



<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>
<!--
<div id=\"container_outer\"><div id=\"container_inner\" style=\"width: $main_home_width"."px\">--><div style=\"width:$main_home_width"."px\">
<!--padding-top:$HHscale*10;padding-bottom:$HHscale*20-->
		<div style=\"width: 100%; padding: ".($HHscale)."px 0 ".($HHscale)."px 0\">

			<span style=\"font-size: $home_header_size"."pt\">The Jennifer Lopez Collection exclusively for Krazyrayray fans</span><br />
			<span style=\"font-size: ".($HHscale*18)."pt\" class=\"font_dark_pink\">Stylist-picked, free shipping</span>
		</div>
<iframe name=\"timer\" frameborder=\"0\" scrolling=\"no\" src=\"timertest.php?special=true\" width=\"100%\" height=\"60px\"></iframe>
<div style=\"width:100%;height:20px\"></div>


		<div style=\"width: $col_left_width"."px; margin-left: $col_left_margin"."px; float: left\"><!-- The left column -->

			<div class=\"pink_field\" style=\"width: 100%; padding-top: ".($CLscale*22)."px\">

				<!--<div id=\"timer\"><div style=\"padding-top: ".($CLscale*8)."px\">
					<div class=\"timer_subframe_spacer\" style=\"width: ".($CLscale*77)."px\"></div>
					<div class=\"timer_subframe_container\">
						<div class=\"timer_subframe\">$days</div>
						<div class=\"timer_subframe_label\">Days</div></div>
					<div class=\"timer_subframe_spacer\"></div>
					<div class=\"timer_subframe_container\">
						<div class=\"timer_subframe\">$hours</div>
						<div class=\"timer_subframe_label\">Hours</div></div>
					<div class=\"timer_subframe_spacer\"></div>
					<div class=\"timer_subframe_container\">
						<div class=\"timer_subframe\">$minutes</div>
						<div class=\"timer_subframe_label\">Minutes</div></div>
				</div></div><!-- end timer -->
				<div style=\"width: 100%; height: ".($CLscale*89)."px\">

					<div class=\"font_money_green\" style=\"float: left; margin: ".($CLscale*12)."px 0 0 ".($CLscale*45)."px; font-size: ".($CLscale*32)."pt\">
						$".$set_data["price"]."
					</div>

					<div style=\"width: ".($CLscale*183)."px; margin-right: ".($CLscale*24)."px; float: right\">

						<a href=\"purchase.php?special_offer=Krazyrayray&purchase_version=complete\"><div class=\"custom_button buy_set\"></div></a>
						<a class=\"font_regular_light_family\" href=\"purchase.php?special_offer=Krazyrayray\" style=\"font-size: ".($CLscale*17)."pt; text-decoration: underline\">Or buy separately</a>
					</div>

				</div>
				<div class=\"font_regular_family\" style=\"padding-top: ".($CLscale*30)."px; font-size: ".($CLscale*11)."pt\">

					<div style=\"float: left; width: ".($CLscale*144)."px\">Value<br /><span style=\"font-size: ".($CLscale*18)."pt\">$".$set_data["value"]."</span></div>

					<div style=\"float: left; width: ".($CLscale*144)."px\">Discount<br /><span style=\"font-size: ".($CLscale*18)."pt\">$discount</span></div>

					<div style=\"float: left; width: ".($CLscale*144)."px\">Savings<br /><span style=\"font-size: ".($CLscale*18)."pt\">$savings</span></div>

				</div>

				<div style=\"width: ".($CLscale*360)."px; margin: ".($CLscale*70)."px auto 0 auto; text-align: left\">

					".$set_data["includes_text"]."
				</div>
				<!--<div style=\"padding: ".($CLscale*50)."px 0 ".($CLscale*20)."px ".($CLscale*30)."px; text-align: left\">

					<img src=\"images/gift box.gif\" width=\"".($CLscale*105)."px\" height=\"".($CLscale*40)."px\" style=\"float: left\" />

					<div style=\"padding-top: ".($CLscale*6)."px\"><a href=\"process_purchase_request.php?purchase_version=complete\" style=\"margin-left: $CLscale28"."px; font-size: ".($CLscale*14)."pt\"><b>Buy it for a friend!</b></a></div>

				</div>-->
				<div style=\"width: 100%; height: ".($CLscale*30)."px\">
</div>
			</div>

			<div style=\"width: 100%; height: 20px\"></div>
			
			<iframe name=\"Tabs\" frameborder=\"0\" scrolling=\"no\" src=\"tabs/tab_styling_tips.php\" width=\"100%\" height=\"$tab_height"."px\" style=\"margin-bottom: 20px\"></iframe>

		</div>

<!-- end left column -->


		<div style=\"margin-left: $col_spacer"."px; text-align: left; float: left\"><!-- The right column -->

			<div style=\"display: block; width: $col_right_width"."px; height: $col_right_width"."px\">
				<a href=\"images/products/".$set_data["name"]."/".$set_data["showcase1"]."\" class=\"jqzoom\" rel=\"gal1\"><img src=\"images/products/".$set_data["name"]."/".$set_data["showcase1"]."\" width=\"$col_right_width"."px\" height=\"$col_right_width"."px\" />
</a>
			</div>
			<div style=\"width: $col_right_width"."px\"><!-- showcase thumbnails -->
				<ul id=\"thumblist\" style=\"height: $list_height"."px; padding: 0; margin: 6px 0 0 0\">

					";
					$image = 1;
					$class = "zoomThumbActive";
					for ($row = 0; $row <= count($row_sizes)-1; $row++) {
						if ($row > 0) echo "<br />";
						for ($i = 1; $i <= $row_sizes[$row]; $i++) {
							if ($i == 1) $left_margin = $row_indents[$row];
							else $left_margin = $item_spacing;

							echo "
							<li style=\"width: $item_width"."px; height: $item_height"."px; margin: 0 0 0 $left_margin"."px\">
							<a class=\"$class\" style=\"padding: $anchor_vert_padding"."px $anchor_hori_padding"."px\" href=\"javascript:void(0);\" rel=\"{gallery: 'gal1', smallimage: './images/products/".$set_data["name"]."/".$set_data["showcase".$image]."', largeimage: './images/products/".$set_data["name"]."/".$set_data["showcase".$image]."'}\">
								<img src=\"images/products/".$set_data["name"]."/".$set_data["showcase".$image]."\" width=\"$image_size"."px\" height=\"$image_size"."px\" />
							</a></li>
							";

							if ($class == "zoomThumbActive") $class = "";
							$image++;
						}
					}
					echo "
				</ul>
			</div>
			<div style=\"width: $col_right_width"."px; text-align: center; margin-bottom: $extras_mar_bottom"."px\">

				<div style=\"margin-top: 10px; width: 100%; height: 20px\">
					
					<div class=\"pin_it_container\"><a href=\"http://pinterest.com/pin/create/button/?url=http://thestylemanor.com/home.php&media=http://thestylemanor.com/images/products/".$set_data["name"]."/".$set_data["image_name"]."&description=I'm%20loving%20Style%20Manor's%20latest%20look!\" class=\"pin-it-button\" count-layout=\"horizontal\"><img border=\"0\" src=\"//assets.pinterest.com/images/PinExt.png\" title=\"Pin It\" /></a></div>
					<div class=\"tweet_container\"><a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"en\">Tweet</a></div>
					
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>
					<div class=\"like_container\"><div style=\"position: relative; top: 0px\" class=\"fb-like\" data-href=\"https://www.facebook.com/pages/Style-Manor/355403124486325\" data-send=\"false\" data-layout=\"button_count\" data-width=\"90\" data-show-faces=\"false\" data-font=\"segoe ui\"></div></div>
					<a href=\"invites.php\" style=\"float: left; margin: -1px 10px 0 0\"><img src=\"images/email button.png\" width=\"22px\" height=\"22px\" /></a>
					<div style=\"float: right; font-size: 22pt; margin: -7px 0 0 0px\" class=\"font_dark_pink\">Share</div>
					
				</div>

				<div style=\"width: $notes_width"."px; margin: 20px auto 0 auto; font-size: $notes_size"."pt; text-align: left\">
					A new deal is released every Wednesday at 12:01AM and will be available for 7 days.&nbsp; Have your friends join now to get the latest fashion tips and deals with you!
				</div>


			</div>
			<img style=\"float: right; margin-bottom: 20px\" src=\"images/paypal logo.png\" width=\"72px\" height=\"25px\" />
		</div>





	<!--</div></div>-->
<!-- end container_inner and container_outer -->


	
<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>

</div>

<!-- end container -->

"; mysql_close($connection); ?><!-- end PHP echo -->

<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
</body>

</html>