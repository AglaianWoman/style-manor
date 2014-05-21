
<?php
//$scale = $header2_height/149;
// behavior depending on whether user is a member

//this prints out the top row when the user is not signed in/does not have an account
/*
			if (isset($_SESSION["email"])) {
				echo "
					<li><a href=\"sign_out2.php\" target=\"_top\"><img src=\"images/header and footer/sign_out.png\" width=\"60px\" height=\"14px\" /></a></li>
				
					<li><a  href=\"account2.php\" target=\"_top\"><img src=\"images/header and footer/account_small.png\" width=\"72px\" height=\"14px\" /></a></li>";
				
			}
			
			
			if(!isset($_SESSION["email"])){
				echo "
				<li><a href=\"home.php?signup=true&join=false\" target=\"_top\"><img src=\"images/header and footer/register2.png\" width=\"73px\" height=\"15px\" /></a></li>
				";
			}
			else {
				echo " 
				<li>
				<a href=\"contact_us2.php\" target=\"_top\"><img src=\"images/header and footer/contact_us.png\" width=\"100px\" height=\"15px\" /></a></li>
				";
			}
			*/
			
?>


<div style='margin-left: <?php echo $header_hr_overflow;?>px; width: <?php echo $main_home_width; ?>px; height:<?php echo ($header2_height - 20);?>px;'>

	<!--<div style=\"width:$main_home_width"."px; height: ".($header2_height-20)."px;float:left\">
    -->
	
	<!-- absolute position needed for reason so that logo and links can occupy same line --><!--added this div to enclose the image-->	
	<!--div for the logo that goes to the left-->
	<div style='float:left;margin:0px; padding:0px; height:100%'>
		<a href='home.php' target='_top'><img src='images/logo-navbar.png' width='350px' height='75px' style='position: relative; float: left' /></a>
	</div>
	
	<!--this div will contain all the links -->
	<div class='header_container' style='position:relative; float: right; margin: 0px 0px 0 0; text-align: right; width:600px'>
	
		
		<div style='float: right; margin: 0px 0px 0 0; text-align: right;width:100%;height:20px'>
		
			<ul class='top_row_header'>

			
					<li><a href='home.php?join=true&signup=false' target='_top' class='sign-up-in'><img src='images/header_footer/sign_in_small.png' width='51px' height='14px' /></a></li>
				
				
					<li><a href='contact_us2.php' target='_top'><img src='images/header_footer/contact_us_small.png' width='84px' height='14px' /></a></li>
	
			</ul>
		</div> <!--ends div with top links-->
		
		<!--starts div with the middle main links-->
		<div id='list'>
			<ul class='middle_row_header'>

				<li><a href='press2.php' target='_top' ><img src='images/header_footer/Press.png' width='54px' height='15px' /></a></li>
			
				<li><a href='how_it_works2.php' target='_top' ><img src='images/header_footer/how_it_works.png' width='118px' height='15px' /></a>
				
					<ul class='sub_menu sub_menu_header'>
						<li><div><a href='shop_collection.php?id=1' style='text-decoration: none;color:black'>my test</a></div></li>
					</ul>
				</li>
			
				<li><a href='shop_collection.php'  target='_top'><img src='images/header_footer/shop_collections.png' width='144px' height='15px' /></a>
					<!--sub_menu is used to position this submenu
					sub_menu_header is used as css to show this menu when the user does not have javascript
					-->
					<ul class='sub_menu sub_menu_header'>
						<li><div><a href='shop_collection.php?id=1' style='text-decoration: none;color:black'>Breakfast at Tiffany's</a></div></li>
						<li><div><a href='shop_collection.php?id=2' style='text-decoration: none;color:black'>Simplicity</a></div></li>
						<li><div><a href='shop_collection.php?id=3' style='text-decoration: none;color:black'>Ostrich</a></div></li>
						<li><div><a href='shop_collection.php?id=4'style='text-decoration: none;color:black'>Inspire Me</a></div></li>
					</ul>
				</li>
			
				<li><a href='shop.php' target='_top'><img src='images/header_footer/shop_categories.png' width='135px' height='15px' /></a>
		
				</li>
				<li><a href='home.php' target='_top' ><img src='images/header_footer/home2.png' width='51px' height='15px' /></a></li>
			</ul>
		</div><!--end div that contains middle links-->
		<!--there where two break lines here-->
	
	<br />
	<br />
	
	<img src='images/always-free-shipping.png' width='184px' height='21px' style='float: right; margin:9px 0px 0 0' />
	
	</div><!--end div that contains the links-->


</div><!--end of outermost div-->
<!--this creates the vertical bar-->
<div style='float:left;width:100%; height: 2px; background-color: #C2C2C2'></div>

