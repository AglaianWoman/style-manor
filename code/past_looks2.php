<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Past Looks | Style Manor</title>
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


<?php include("shared variables.php");


$total_page_width=$main_home_width + $header_hr_overflow*2;


echo "

<div style='width:".($main_home_width + $header_hr_overflow*2)."px; margin:0px auto;margin-top:5px'>

";

	include_once("page_view/headerview.php");
echo "
	<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
	<!--
	<iframe name='Header' frameborder='0' scrolling='no' src='header2.php' width='100%' height='$header_height"."px'></iframe>
	-->
	";
	?>

<!--EDIT: removed id=container_outer<div class='font_fancy_family'>
<div style='padding: 35px 30px 45px 30px'>
		

<div id='container_inner' style='width: 560px;width:360px'>

	-->		

<!-- old Kizoa slideshow
			
<div style='background-color: #BBB'>
			

<object width='560' height='420'>

				
<param name='movie' value='http://pf.kizoa.com/sflite.swf?did=2447112&k=1573291'></param>

				
<param name='wmode' value='transparent'></param><param name='allowFullScreen' value='true'></param>

			
<embed src='http://pf.kizoa.com/sflite.swf?did=2447112&k=1573291' type='application/x-shockwave-flash' wmode='transparent' width='560' height='420' allowFullScreen='true'></embed>
			

</object>
			
<br /><a href='http://www.kizoa.com/slideshow/d2447112k1573291o2/past-looks'><b>Past Looks</b></a> - <i><a href='http://www.kizoa.com'>slideshows</a></i>
			

</div>-->

<!--   <iframe width='420' height='315' src='http://www.youtube.com/embed/vJKn2INktjo?rel=0' frameborder='0' allowfullscreen></iframe>

   old video-->

 <iframe width='640px' height='480px' src='http://www.youtube.com/embed/QGDVYYLVWXY?rel=0' frameborder='0' allowfullscreen></iframe> 

<!--    </div></div></div>


end container_inner, padding div, and container_outer -->



<?php 
echo "	

<iframe name='Footer' frameborder='0' scrolling='no' src='footer2.php' width='100%' height='$footer_height"."px' style='margin-bottom: -4px'></iframe>


</div>

"; 

?>   <!-- end PHP echo -->

</body>

</html>