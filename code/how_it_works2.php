<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>How It Works | Style Manor</title>

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

</head>
<body>



<?php 

include("shared variables.php");

echo "



	<!--contains everthing in the page-->
	<div style=\"width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px\">

";
	include_once("page_view/headerview.php");
echo "

		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
		
		<!--
		<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header_height"."px\"></iframe>
		-->
		
		<div id=\"container_outer\" class=\"font_fancy_family\"><div style=\"padding: 10px 30px 45px 30px\">
			<div id=\"container_inner\" style=\"width: 855px\">

				<img src=\"images/how it works contents.png\" width=\"855px\" height=\"536px\" />

		</div></div></div>
	<!-- end container_inner, padding div, and container_outer -->
		
		<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer_height"."px\" style=\"margin-bottom: -4px\"></iframe>

	</div>

"; ?><!-- end PHP echo -->

</body>

</html>

