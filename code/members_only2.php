<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Denied Access | Style Manor</title>

<link href="CSS_main.php" rel="stylesheet" media="screen" />


<?php 

include("shared variables.php");
echo "<style type=\"text/css\">

.custom_button gray{cursor:pointer}
</style>
</head>

<body>

<div style=\"width:".($main_home_width+ $header_hr_overflow*2)."px;margin:0px auto; margin-top:5px\">


<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>

	
<div class=\"font_fancy_family\">
		<div id=\"container_inner\" style=\"width: 100%;height:350px\">

			<h1>Sorry, the contents of this page are reserved for members only.</h1>
			<button type=\"button\" class=\"custom_button gray\" style=\"margin-top: 45px\" onclick=\"document.location.href = 'home2.php';\">OK</button>


	</div>   <!---end container inner-->
	
	</div>
<!-- end container_outer -->

	
<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>



</div>




"; ?><!-- end PHP echo -->

</body>

</html>