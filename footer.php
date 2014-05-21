<html>
<head>
<title>Footer</title>
<link href="CSS_main.php" rel="stylesheet" media="screen" />

<?php include("shared variables.php");
/*$scale = $footer_height/71;
$link_spacing = $scale*30;
$link_size = $scale*16;
$padding_top = ($footer_height - $link_size - 20)/2;
$padding_right = $scale*35;*/
?>


<!-- I was getting this weird bug where styles didn't work on divs. Styles did work on lists though. -->

<style language="text/css">
body {
	margin:0px;
	padding-top: 20px;
	font-size: 7pt;
	text-align: right;	/* makes all text outside of the list of links align to the right */
}
a { color: #000; }
ul {
	margin: 0;
	padding: 0;
	float: left;
}
ul li {
	float: left;
	margin: 0;
	padding: 0;
	margin-right: 10px;
	list-style: none;
}

ul li a {
	outline: none;
}
a:hover, a:active,a:focus{text-decoration:underline}
/*a:hover, a:active, a:focus { color: ??? }*/
</style>
</head>


<body>


<ul>
	<!--<li><a href="home2.php" target="_top">ABOUT US</a></li>-->
	<li><a href="privacy_policy2.php" target="_top">PRIVACY POLICY</a></li>
	<li><a href="return_policy.php" target="_top">RETURN POLICY</a></li>
	<li><a href="faq.php" target="_top">FAQ</a></li>
	<!--<li><a href="/blog" target="_blank">BLOG</a></li>-->
</ul>
&copy; 2012 Style Manor, All rights reserved.

</body>
</html>
