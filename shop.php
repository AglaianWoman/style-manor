<?php session_start(); ?>
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
<title>Shop</title>

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

<?php


include("shared variables.php");
include("protected/dbconnect_auto.php");
mysql_select_db("thesty10_auto-manipulate");


echo "
</head>
<body>
<div style=\"width: ".($main_home_width + $header_hr_overflow*2)."px; margin: 0 auto\">
";
include_once("page_view/headerview.php");
echo "
<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
	
<!--EDIT: original src=header2.php
<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>-->

<iframe src=\"http://stylemanor.goodsie.com/embed?extkey=0e952e2a-cc7f-4280-b65f-db1ea95de6e1\" width=\"100%\" height=\"500\" style=\"border:none;\"></iframe>

<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>

";
?>

</body>
</html>