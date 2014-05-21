<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Contacting Us | Style Manor</title>

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



echo "





<style language=\"text/css\">


a {
	color: #000;
	text-decoration: underline;
}


a:hover, a:active, a:focus {
	color: $color_dark_pink;
}


</style>


</head>
";
//to load if the user is not signed in or they don't have an account


if($_SESSION["email"] == "" || $_SESSION["email"] == "-1") {$member=false;}
else{$member=true;}

//echo "<body onload=\"document.location.href = 'members_only2.php';\">";



echo "
<body>

	<div style=\"width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px\">

";
//this is to include the header
include_once("page_view/headerview.php");

echo "
		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
		


		<!--<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>
		-->
		

	<!--<div id=\"container_outer\" class=\"font_fancy_family\">-->
		<!--EDIT: padding:10% 9%-->
		
		<!--this div is for padding-->
		<div class=\"font_fancy_family\" style=\"padding: 5% 9%; font-size: 15pt\">

			

			We're always here for our members. For questions or assistance, you can email us day or night
			with any questions, issues, or suggestions. Please give us 24 hours to respond on a business
			day. Note: our office is closed on Saturdays and Sundays.<br />
			<br />
			

			<a href=\"mailto:info@thestylemanor.com\" style=\"text-decoration: underline\"><i>info@thestylemanor.com</i></a>


			
		</div><!--</div>--><!-- end padding div and container_outer -->

	
	<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>



"; ?><!-- end PHP echo -->

	</div>

<!-- end container -->
</body>

</html>