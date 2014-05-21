<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>As Seen On... | Style Manor</title>

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

$image_aspect_ratio = 500/750;
$image_height = 500;
$label_height = 60;

$top_padding = 10;
$bottom_padding = 40;
$side_padding = 10;

$competing_height = $header_height + $top_padding + $bottom_padding + $footer_height;
$max_height = $image_height + $label_height;
$inner_aspect_ratio = $max_height/($image_height/$image_aspect_ratio);


echo "


<script type=\"text/javascript\">
function sizeComponents() {
	var inner_height = ".$max_height.";
	if ( inner_height > (window.innerHeight - ".$competing_height.") ) inner_height = (window.innerHeight - ".$competing_height.");
	if ( inner_height < 200 ) inner_height = 200;

	var container_inner = document.getElementById('container_inner');
	container_inner.style.width = inner_height/".$inner_aspect_ratio." + 'px';
	container_inner.style.height = inner_height + 'px';

	var scale = inner_height/".$max_height.";

	var image = document.getElementById('image');
	image.style.width = scale*".($image_height/$image_aspect_ratio)." + 'px';
	image.style.height = scale*".$image_height." + 'px';

	var label = document.getElementById('label');
	label.style.height = scale*".$label_height." + 'px';
	label.style.fontSize = scale*15 + 'pt';
}
</script>


<style language=\"text/css\">
a { color: #000; text-decoration: underline }
a:hover, a:active, a:focus { color: $color_dark_pink }
div { background-size: 100% 100% }
div#container_outer { min-height: 0 }
</style>


</head>
<body onload=\"sizeComponents();\" onresize=\"sizeComponents();\">



	<div style=\"width:".($main_home_width + $header_hr_overflow*2)."px;margin:0px auto;margin-top:5px\">
";
	//this is to include the header
	include_once("page_view/headerview.php");

echo "
<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
<!--
<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header_height"."px\"></iframe>
-->
	
		<div id=\"container_outer\" class=\"font_fancy_family\">
			<div style=\"padding: $top_padding"."px $side_padding"."px $bottom_padding"."px $side_padding"."px\">
				<div id=\"container_inner\">

					<div id=\"image\" style=\"background-image: url('images/as seen on.png')\"></div>
					<div id=\"label\" style=\"width: 100%\">And more to come!&nbsp; If you are interested in featuring Style Manor, please email <a href=\"mailto:info@thestylemanor.com\">info@thestylemanor.com</a>.</div>

		</div></div></div>
<!-- end container_inner, padding div, and container_outer -->

	
		<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer_height"."px\" style=\"margin-bottom: -4px\"></iframe>
	
	</div>

"; ?><!-- end PHP echo -->

</body>

</html>