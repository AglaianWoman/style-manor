<?php session_start(); ?>
<html>
<head>
<title>FAQ</title>
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
<link href="tabs/CSS_tabs_pink.php" rel="stylesheet" media="screen" />
<style type="text/css">body{font-family:Gotham, Verdana;}</style>
<script type="text/javascript">
<!--
function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
var popup=window.open(href, windowname, 'width=400,height=550,left=640,top=100,resizable=yes,scrollbars=yes');
popup.focus();
return false;
}
//-->
</script>

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
$width = 800;
$body_height = 500;
$body_width = $width + -2*$tab_pink_border_thickness;
$spare_width = $width - 2*$tab_pink_label_width - 1;	// -1 for the gap between the two labels
$col_width = ($body_width - $tab_pink_main_padding*3)/2;

if($_SESSION["email"] == "" || $_SESSION["email"] == "-1") {$member=false;}
else{$member=true;}

echo "

<style>
div.column { width: $col_width"."px }a{color:black}
</style>
</head>
<body>

	<div style=\"width:".($main_home_width+$header_hr_overflow*2)."px;margin:0px auto; margin-top:5px\">
		";
//this is to include the header
include_once("page_view/headerview.php");

echo "
		<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
	<!--
	<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\" style=\"margin-bottom: -4px\"></iframe>-->
<!--<div id=\"container_outer\"><div id=\"container_inner\" style=\"width: $width"."px\">-->

	<!--<a class=\"label active\" href=\"tab_faq.php\">FAQ</a>
	<div class=\"gap_filler\"></div>
	<a class=\"label\" href=\"tab_member_care.php\">Member Care</a>
	<div class=\"gap_filler\" style=\"width: $spare_width"."px\"></div>-->

	<!--   <div class=\"half_border\" style=\"width: 100%;height:4px;background:blue\"></div>   -->

	<!--   <div class=\"border\" style=\"height: $body_height"."px\"></div>	--><!--EDIT width:$body_width-->
	<div id=\"body\" style=\"width:100%; height: $body_height"."px\">		<div id=\"text\">
		<div class=\"column\" style=\"float: left\">
			<b>General Info</b><br />
			<a href=\"tabs/faq_answers.php#whatismanor\" target=\"faq_window\" onClick=\"return popup(this.href, 'faq_window')\" >What is Style Manor?</a><br />
			<a href=\"tabs/faq_answers.php#howdoesmanorofferprices\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How does Style Manor offer such great prices?</a><br />
			<a href=\"tabs/faq_answers.php#willibechargedanythingtobemember\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Will I be charged anything to be a Style Manor member?</a><br />
			<a href=\"tabs/faq_answers.php#whyshouldishopwithmanor\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Why should I shop with Style Manor?</a><br />
			<a href=\"tabs/faq_answers.php#howdoibecomemember\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I become a member?</a><br />
			<br />
			<b>Member Accounts</b><br />
			<a href=\"tabs/faq_answers.php#howdoichangepassword\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I change my password?</a><br />
			<a href=\"tabs/faq_answers.php#iforgotpasswordwhatdoido\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">I forgot my password. What do I do?</a><br />
			<a href=\"tabs/faq_answers.php#howdoichangeaddress\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I change my shipping and/or billing address?</a><br />
			<a href=\"tabs/faq_answers.php#canihaveaddressesonfile\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Can I have multiple shipping addresses on file?</a><br />
			<a href=\"tabs/faq_answers.php#howdoiupdateinformation\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I update my payment information?</a><br />
			<a href=\"tabs/faq_answers.php#howdoisubscribeorunsubscribetoemails\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I subscribe or unsubscribe to emails?</a><br />
			<br />
			<b>Shipping</b><br />
			<a href=\"tabs/faq_answers.php#howwillittaketogetorder\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How long will it take to get my order?</a><br />
			<a href=\"tabs/faq_answers.php#whatiforderiswithinwindow\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">What if my order is not delivered within the Estimated Delivery Dates window?</a><br />
			<a href=\"tabs/faq_answers.php#howdoitrackprogressoforder\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I track the progress of my order?</a><br />
			<a href=\"tabs/faq_answers.php#whycantishiporservice\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Why can't I ship overnight or 2-day service?</a><br />
			<a href=\"tabs/faq_answers.php#canishiptoboxesoraddresses\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Can I ship to PO boxes or APO/AFO addresses?</a><br />
			<a href=\"tabs/faq_answers.php#doesmanorship\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Does Style Manor ship internationally?</a>
		</div>
		<div class=\"column\" style=\"float: right\">
			<b>Returns, Credits, and Refunds</b><br />
			<a href=\"tabs/faq_answers.php#whatispolicy\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">What is Style Manor's return policy?</a><br />
			<a href=\"tabs/faq_answers.php#howdoihavetoreturnitemtomanor\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How long do I have to return an item to Style Manor?</a><br />
			<a href=\"tabs/faq_answers.php#howdoireturnitemtomanor\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I return an item to Style Manor?</a><br />
			<a href=\"tabs/faq_answers.php#caniexchangeitem\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Can I exchange an item?</a><br />
			<a href=\"tabs/faq_answers.php#whatifitemwasintransit\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">What if my item was damaged in transit?</a><br />
			<a href=\"tabs/faq_answers.php#howwilliknowthatmanorhasreceivedreturn\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How will I know that Style Manor has received my return?</a><br />
			<a href=\"tabs/faq_answers.php#howwillittaketoreceivecredit\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How long will it take to receive my credit? How do I use a credit?</a><br />
			<a href=\"tabs/faq_answers.php#docreditsexpire\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Do Style Manor credits expire?</a><br />
			<a href=\"tabs/faq_answers.php#howdoireturngift\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">How do I return a gift?</a><br />
			<a href=\"tabs/faq_answers.php#doihavetobecomemembertoreturngift\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Do I have to become a member to return a gift?</a><br />
			<a href=\"tabs/faq_answers.php#ifibuyagiftforsomeonewhoismemberofmanorcantheyreturnit\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">If I buy a gift for someone who is not a member of Style Manor, can they return it?</a><br />
			<a href=\"tabs/faq_answers.php#caniconvertcreditstocash\" target=\"faq_window\" onClick=\"return popup(this, 'faq_window')\">Can I convert my Style Manor credits to cash?</a>
		</div>
	</div></div><!-- end div#text and div#body -->
	<!--<div class=\"border\" style=\"height: $body_height"."px;background:green\"></div>-->
	   <!--   <div class=\"border\" style=\"width: 100%;height:4px;background:red\"></div>   -->
<!--</div></div>--><!-- end container_inner and container_outer -->
<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=\"$footer2_height"."px\" style=\"margin-bottom: -4px\"></iframe>
</div>
"; ?><!-- end PHP echo -->

</body>
</html>