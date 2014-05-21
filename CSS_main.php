<?php
header("Content-type: text/css");
include("shared variables.php");

echo <<<CSS



/*************************** BEGIN CSS *****************************/


@charset "utf-8";


body {
	margin: 0;
	/*font-family: Gotham, Verdana, Helvetica, sans-serif;*/
	text-align: center;
	background-color: #FFF;
	font-family: Verdana, Times New Roman, sans-serif;
}
a {
	padding: 0;
	text-decoration: none;
	color: #FFF;
	outline: none;
}
a img {
	border: none;
}
h1 {
	margin-top: 50px;
}

#list {float:right; z-index:100}

.top_row_header, .middle_row_header {list-style:none;}

.top_row_header li, .middle_row_header li {float:right;}

.sub_menu {display: none; width:200px; list-style:none; position:absolute; float:left; color:black; margin-left:-30px;padding:0px}

.sub_menu li {float:left}

.sub_menu li div {width:200px; text-align:center}

#list .middle_row_header li:hover .sub_menu_header {display:block}

div#container_outer {
	width: 100%;
	min-height: 600px;
	text-align: center;
	background-color: #FFF;
	color: #000;
}
div#container_inner {		/* For centering to work, must be encapsulated by container_outer */
	width: 400px;		/* Fixed width should be overriden for each instance */
	margin: 0 auto;
}

.black_field {
	background-color: #000;
	color: #FFF;
	font-family: Gotham, Verdana, serif;
}
.pink_field {

	background-color: #616D7E;

	color: #fff;

	font-family: Gotham, Verdana, Arial, serif;

}

.font_dark_pink {
	color: $color_dark_pink;
}
.font_money_green {
	color: #FF0066;
}
.font_regular_family {
	font-family: Gotham, Verdana, sans-serif;
}
.font_regular_light_family {
	font-family: Gotham, Verdana, sans-serif;
}
.font_fancy_family {
	font-family: Gotham, Verdana;
}


.black_field a:hover, .black_field a:active, .black_field a:focus {
	color: $color_dark_pink;
}

.forgot_pw {
	text-decoration: underline;
	cursor: pointer;
	font-size: 10pt;
}

.custom_tb_frame {
	width: 250px;
	height: 30px;
	background-image: url('images/textbox frame.png');
	background-size: 250px 30px;
}
.custom_tb {
	width: 240px;
	height: 100%;
	margin-top: -0.5px;
	padding: 0px 5px 0 5px;
	background: none;
	color: #AAA;
	border: none;
	font-size: 10pt;
}


.custom_button { 
	outline: none;
	border: none;
	text-align: center;
	font-weight: bold;
	cursor: default;
	width: 120px;		/* should override width, height, and anything else needed to tailor to needs */
	height: 35px;	
	font-size: 11pt;
	background-image: url('images/gray button.png');
	background-color: none;
	/*background-size: 120px 35px;*/
}/*added cursor:pointer to both */
.custom_button.gray { background-image: url('images/gray button.png');cursor:pointer }
.custom_button.green { background-image: url('images/green button.png');cursor:pointer }



CSS;
?>