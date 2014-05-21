<?php

$page_min_width = 800;

$header_height = 100;		// baseline = 149; good = 100
$header2_height = 100;
// OBSELETE
$home_header_size = 28;
$col_left_width = 300;		// baseline = 434; good = 300
$col_right_width = 400;		// baseline = 500; good = 400
$footer_height = 50;
$footer2_height = 50;
$backend_header_height = 54;


$main_home_width = 1000;		// contains all content in home page, header, and footer EXCEPT the extended horizontal rule of the header
$header_hr_overflow = 10;




$color_dark_pink = "#CB0065";	// old = "#D70080"

$tab_height = 525;		// old = 150
$tab_border_thickness = 2;
$tab_label_width = 110;
$tab_label_height = 25;
$tab_border_color = "#DDD";

$tab_pink_label_width = 160;
$tab_pink_border_thickness = 2;
$tab_pink_main_padding = 6;



$special_offer_expiration = "May 21 2012";

date_default_timezone_set("America/Los_Angeles");
$launch_time = strtotime("March 6, 2012");
$admin_emails = array("rodeheff@usc.edu", "jacob@rodeheffer.net", "sharon@thestylemanor.com", "sharvuong@gmail.com","laxpaul17@gmail.com");
$suffix_for_complete_set = " Collection";

$prime_numbers = array(2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71);




$all_collection_name = array(1=>"breakfast at tiffany's",2=>"simplicity",3=>"ostrich",4=>"inspire me");








function format_money($money) {
	$explosion = explode(".", $money);
	if (count($explosion) == 1) $money .= ".00";
	elseif (strlen($explosion[1]) == 1) $money .= "0";
	elseif (strlen($explosion[1]) > 2) {
		$money = ceil($money*100)/100;
		$money = format_money($money);
	}
	/*if (round($money) == $money) $money .= ".00";
	elseif (round($money*10) == $money*10) $money .= "0";
	else $money = ceil($money*100)/100;*/
	return $money;
}






















?>