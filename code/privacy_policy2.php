<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Privacy Policy | Style Manor</title>

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
<link href="CSS_main.php" rel="stylesheet" media="screen" /><style type="text/css">body{font-family:Gotham, Verdana;}</style>

<style language="text/css">
a {
	color: #000;
}
a:hover, a:active, a:focus {
	text-decoration: underline;
}
body {
	font-size: 9pt;
	font-family: Arial, Helvetica, sans-serif;
}
h1 {
	font-size: 14pt;
	font-weight: bold;
}
h2 {
	font-size: 10pt;
	font-weight: bold;
}
h3 {
	display: inline;
	font-size: 10pt;
	font-weight: normal;
	font-style: italic;
}
h3.indent_removed {
	margin-left: -13px;		/* removes all remaining indent caused by being contained by ul */
}
ul {
	margin-left: -27px;		/* remove most of the indent */
	font-size: 10pt;
}
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


<?php include("shared variables.php");

echo "
<body>


<!--<div style=\"min-width: $page_min_width"."px\">-->
	<div style=\"width:".($main_home_width+$header_hr_overflow*2)."px;margin:0 auto; margin-top:5px\">
";
	include_once("page_view/headerview.php");
echo "
	<div style='width: 100%; height:".($v_buffer1+30)."px'></div>
	<!--
	<iframe name=\"Header\" frameborder=\"0\" scrolling=\"no\" src=\"header2.php\" width=\"100%\" height=\"$header2_height"."px\"></iframe>
	-->

	<!--EDIT: deleted id=container_outer-->
<!--<div style=\"width:".($page_home_width+$header_hr_overflow*2)."px;margin:0px auto; margin-top:5px\">-->
		
";
?>

<!--EDIT: removed class=font_fancy_family-->
		<div style='padding: 0px 25px 10px 25px; text-align: left'>
			<h1>PRIVACY POLICY</h1>

			<p>Style Manor ("Style Manor," "we," "our," "us") knows that you care about how your personal information is used and shared, and we take your
			privacy seriously. Please read the following to learn more about our privacy policy. By visiting the Style Manor website and domain name, and
			any other linked pages, features, content, or application services offered from time to time by Style Manor in connection therewith
			(collectively, the "Website"), or using any of our services, you acknowledge that you accept the practices and policies outlined in this
			Privacy Policy.</p>

			<br />
			
			<h2>WHAT DOES THIS PRIVACY POLICY COVER?</h2>

			<p>This Privacy Policy covers Style Manor's treatment of personally identifiable information ("Personal Information") that Style Manor gathers
			when you are accessing Style Manor's Website and when you use Style Manor services. This policy does not apply to the practices of companies
			that Style Manor does not own or control, or to individuals that Style Manor does not employ or manage.</p>

			<br />
			<h2>WHAT PERSONAL INFORMATION DOES STYLE MANOR COLLECT?</h2>

			<p>The information we gather from customers enables us to personalize and improve our services, and to allow our users to set up a user account
			and make purchases via the Website. We collect the following types of information from our customers.</p>

			<p><h3>Personal Information You Provide to Us:</h3><br />
			We receive and store any information you enter on our Website or provide to us. The types of Personal Information collected may include your
			name, email address, gender, birthday, zip code, country, IP address, browser information. If you make a purchase through our Website, your
			credit card number, credit card security code, expiration date, billing address, and shipping addresses will be stored in Paypal's database.
			You can choose not to provide us with certain information, but then you may not be able to take advantage of many of our special features, and
			you may not be able to complete a purchase through the Website. The Personal Information you provide is used for such purposes as allowing you
			to purchase items, improving the content of the Website, customizing the advertising and content you see, and communicating with you about
			specials and new features.</p>

			<p>We do not direct any of our content specifically to children. Users of our Website are required to be at least 18 years old, and any user
			under 18 is not an authorized user. Additionally, if we learn that a user is under 13 years of age, we will promptly delete any Personal
			Information we have collected about that user.</p>

			<ul><h3 class='indent_removed'>Personal Information Collected Automatically:</h3><br />
			<li>We receive and store certain types of information whenever you interact with our Website or services. Style Manor automatically receives
			and records information on our server logs from your browser including your IP address, cookie information, the page you requested, and any
			items you may purchase. This information may be used to customize the content you see on our Website or to communicate with you about specials
			and new features.</li>
			<li>Usage information, such as the numbers and frequency of visitors to our site and its components may also be used in aggregate form, that
			is, as a statistical measure, and not in a manner that would identify you personally. This type of aggregate data enables us to figure out how
			often customers use parts of the Website or services so that we can make the Website appealing to as many customers as possible, and improve
			those services. As part of this use of information, we may provide aggregate information to our partners about how our customers, collectively,
			use our site. We share this type of statistical data so that our partners also understand how often people use their services and our Website,
			so that they, too, may provide you with an optimal online experience. Style Manor never discloses aggregate information to a partner in a manner
			that would identify you personally.</li></ul>

			<p><h3>E-mail Communications:</h3><br />
			We may receive a confirmation when you open an email from Style Manor if your computer supports this type of program. Style Manor uses this
			confirmation to help us make emails more interesting and helpful and improve our service. If you do not want to receive email or other mail from
			us, please indicate your preference by making a modification on your account page, or by using the "Unsubscribe" feature in any email we send to
			you.</p>

			<ul><h3 class='indent_removed'>What About Cookies?</h3><br />
			<li>Cookies are alphanumeric identifiers that we transfer to your computer's hard drive through your browser to enable our systems to
			recognize your browser and tell us how and when pages in our site are visited and by how many people. Style Manor cookies do not collect Personal
			Information, and we do not combine the general information collected through cookies with other Personal Information to tell us who you are or
			what your screen name or email address is.</li>
			<li>Most browsers have an option for turning off the cookie feature, which will prevent your browser from accepting new cookies, as well as
			(depending on the sophistication of your browser software) allowing you to decide on acceptance of each new cookie in a variety of ways. We
			strongly recommend that you leave the cookies activated, however, because cookies enable you to take advantage of some of our Website's most
			attractive features.</li>
			<li>We may use cookies to compile usage or "clickstream" information about you or others who use your computer. This information allows us to,
			among other things, deliver targeted content that we believe will be of most interest to you.</li></ul>

			<br />
			<h2>WILL STYLE MANOR SHARE ANY OF THE PERSONAL INFORMATION IT RECEIVES?</h2>

			<p>Personal Information about our customers is an integral part of our business. We neither rent nor sell your Personal Information to anyone. We
			share your Personal Information only as described below.</p>

			<p>Employees: We restrict access to your Personal Information to those employees who need to know that information to provide products or
			services to you.</p>

			<p>Protection of Style Manor and Others: We may release Personal Information when we believe in good faith that release is necessary to comply
			with that law; enforce or apply our conditions of use and other agreements; or protect the rights, property, or safety of Style Manor, our
			employees, our users, or others. This includes exchanging information with other companies and organizations for fraud protection and credit risk
			reduction.</p>

			<br />
			<h2>IS PERSONAL INFORMATION ABOUT ME SECURE?</h2>

			<p>Your Style Manor account for Personal Information is protected by a password for your privacy and security. You need to prevent unauthorized
			access to your account and Personal Information by selecting and protecting your password appropriately and limiting access to your computer and
			browser by signing off after you have finished accessing your account.</p>

			<p>When Style Manor's order form asks users to enter Personal Information such as a credit card number, that information is encrypted with
			industry-standard Secure Socket Layers ("SSL") encryption to keep your online order safe and secure. When the letters "http" in the URL address
			change to "https", the "s" indicates you are in a secure area employing SSL. Style Manor also maintains physical, electronic, and procedural
			safeguards that comply with federal regulations to protect your Personal Information.</p>

			<p>Style Manor endeavors to protect user information to ensure that user account information is kept private; however, Style Manor cannot
			guarantee the security of user account information. Unauthorized entry or use, hardware or software failure, and other factors, may compromise
			the security of user information at any time.</p>

			<p>The Website may contain links to other sites. Style Manor is not responsible for the privacy policies and/or practices on other sites. When
			linking to another site you should read the privacy policy stated on that site. This Privacy Policy only governs information collected on the
			Website.</p>

			<br />
			<h2>WHAT PERSONAL INFORMATION CAN I ACCESS?</h2>

			<p>Style Manor allows you to access the following information about you for the purpose of viewing, and in certain situations, updating that
			information. This list may change as our Website changes.</p>

			<ul><li>E-mail address</li>
			<li>Gender</li>
			<li>Zip code</li>
			<li>Country</li>
			<li>Shipping & billing information</li></ul>

			<br />
			<h2>WHAT CHOICES DO I HAVE?</h2>

			<ul><li>As stated previously, you can always opt not to disclose information to use, even though it may be needed to take advantage of certain
			Style Manor features, including the ability to purchase items through the Website.</li>
			<li>You are able to add or update certain information on pages, such as those listed in the "What Personal Information Can I Access" section
			above. When you update information, however, we may maintain a copy of the unrevised information in our private records.</li>
			<li>If you do not wish to receive email or other mail from us, including promotional offers, please indicate this preference by changing your
			account settings, or by notifying us by using the "Unsubscribe" feature in any email we send to you. Please note that if you do not want to receive
			legal notices from us, such as this Privacy Policy, those legal notices will still govern your use of the Style Manor Website, and you are
			responsible for reviewing such legal notices for changes.</li></ul>

			<br />
			<h2>CHANGES TO THIS PRIVACY POLICY</h2>

			<p>Style Manor may amend this Privacy Policy from time to time. Use of information we collect now is subject to the Privacy Policy in effect at the
			time such information is used. If we make changes in the way we use Personal Information, we will notify you by posting an announcement on our
			Website or sending you an email. Users are bound by any changes to the Privacy Policy when he or she uses the Website after such changes have been
			first posted.</p>

			<br />
			<h2>QUESTIONS OR CONCERNS</h2>

			<p>If you have any questions or concerns regarding our Privacy Policy, please contact us at
			<a href='mailto:info@thestylemanor.com' target='_new'>info@thestylemanor.com</a>.</p>

		</div>
<!-- end padding div and container_outer -->
<?php
echo "
		<iframe name=\"Footer\" frameborder=\"0\" scrolling=\"no\" src=\"footer2.php\" width=\"100%\" height=$footer2_height"."px style=\"margin-bottom: -4px\"></iframe>
	</div>
"; ?><!-- end PHP echo -->

<!-- end min-width container -->
</body>

</html>