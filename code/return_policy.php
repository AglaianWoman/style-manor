<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<title>RETURN POLICY</title>

<meta name="ROBOTS" content="NOINDEX" />

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

<style type="text/css">
body {
/*font-family: Segoe UI Light, Arial, sans-serif;
*/
font-family:Gotham, Verdana;
font-size: 14pt;
}
b {font-size: 18pt;width:100%}

</style>
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
</head>
<?php

include("shared variables.php");

echo "

	<div style=\"width: ".($main_home_width + $header_hr_overflow*2)."px; margin: 0 auto;margin-top:5px\">
";
	//this is to include the header
	include_once("page_view/headerview.php");

echo "
<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
<!--
<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>-->
";
?>
	<b style='text-align:center'>RETURN POLICY</b><br />
	<div style='padding: 0px 0px 10px 0px;text-align:left;width:100%'>
		<span>Style Manor gladly accepts any items you are unhappy with.&nbsp;  You may return within 18 days of purchase date.&nbsp;  To help keep our prices low, we will charge a $6.95
		restocking fee, unless the item was sent to you in a damaged condition.&nbsp;  Items must have original packaging and will not be accepted if it has been used or worn.&nbsp; 
		Returns are eligible for Style Manor credit and the restocking fee will be automatically deducted.</span><br />
	</div>
<?php
echo "
	<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\"></iframe>
</div><!--end outermost div container-->
";
?>

</body>
</html>

