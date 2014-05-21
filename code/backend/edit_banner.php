<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>banner formatter</title>
<style type="text/css">
table{
border-style:solid;
}
th,td{border-style:dashed}
#description{font-size:14pt}

message {font-size:12pt; color:blue}

</style>
</head>

<?php

include("../shared variables.php");



$is_not_admin = true;

for ($i = 0; $i <= count($admin_emails)-1; $i++) {
	
	if ($_SESSION["email"] == $admin_emails[$i]) {
		$is_not_admin = false;	
		break;
	}
}

if ($is_not_admin) echo "<body onload=\"document.location.href = '../home.php';\">";
else {
include("../protected/dbconnect_auto.php");

mysql_select_db("thesty10_auto-manipulate");
$error="";
$iterator="";


if(isset($_POST['edit'])&&$_POST['edit']!="")
{$iterator=$_POST['edit'];}

if(isset($_POST['iteration'])&&$_POST['iteration']!="")
{$iterator=$_POST['iteration'];}


if(isset($_POST['change_data']))
{

$banner_time=strtotime($_POST['endtime']);

if($_POST['main_banner']=="")
{$error.="enter the name of the main banner, including extention name.<br />";}
if($_POST['bottom_banner']=="")
{$error.="enter the name of the picture for the bottom right banner, including extension name.<br />";}
if($_POST['name']=="")
{$error.="must have a name for the folder.<br />";}
if($_POST['endtime']=="")
$error.="must have a correct date.<br />";
if($banner_time==false)
	{$error.="cannot convert the date. please enter a correct date.<br />";}

if($error=="")
{
mysql_query("UPDATE banners SET name='".$_POST['name']."',endtime=".$banner_time.", weekly_timer=".$banner_time.",
main_banner='".$_POST['main_banner']."', right_banner='".$_POST['bottom_banner']."', slide2='".$_POST['slider2']."',
slide3='".$_POST['slider3']."', slide4='".$_POST['slider4']."', slide5='".$_POST['slider5']."', slide6='".$_POST['slider6']."', slide7='".$_POST['slider7']."' WHERE iteration=".$iterator."");
$error="Update successful";
}
else {$error="the following error(s) occured:<br />".$error;}

}

if($iterator!=""){
$query=mysql_query("SELECT * from banners WHERE iteration=".$iterator.";");

$row=mysql_fetch_assoc($query);
$time=Date("F j Y",$row['endtime']);
echo "<body>
<div  class='message'>$error</div>
<form method='post' action='edit_banner.php'>
<table>
	<tr>
		<th>name</th>
		<th>endtime</th>
		<th>main banner</th>
		<th>bottom banner</th>
		<th>slider 2</th>
		<th>slider 3</th>
		<th>slider 4</th>
		<th>slider 5</th>
		<th>slider 6</th>
		<th>slider 7</th>
	</tr>
	<tr>
		<td><input type='text' value='".$row['name']."' name='name' /></td>
		<td><input type='text' value='".$time."' name='endtime' /></td>
		<td><input type='text' value='".$row['main_banner']."' name='main_banner' /></td>
		<td><input type='text' value='".$row['right_banner']."' name='bottom_banner' /></td>
		<td><input type='text' value='".$row['slide2']."' name='slider2' /></td>
		<td><input type='text' value='".$row['slide3']."' name='slider3' /></td>
		<td><input type='text' value='".$row['slide4']."' name='slider4' /></td>
		<td><input type='text' value='".$row['slide5']."' name='slider5' /></td>
		<td><input type='text' value='".$row['slide6']."' name='slider6' /></td>
		<td><input type='text' value='".$row['slide7']."' name='slider7' /></td>
	</tr>
</table>
<br />
<input type='hidden' value='".$row['iteration']."' name='iteration' />
<input type='submit' name='change_data' value='change data' /> 
</form>
<br />
<a href='banner_manager.php'>back to banner manager</a>
<div id='description'>
<br />
</span>How to use the editor above:</span>
<ul>
	<li>name: this should be the name of the folder that is in the directory images/products where the pictures for the sliders and the bottom right banner of the home page are going to be stored</li>
	<li>endtime: this is where you enter the time when the product featured during the day/week will end. you can enter the date like 'July 11 2012' and it will automatically convert it into a timestamp</li>
	<li>main banner:the main picture for the day that always appears first on the slider. include file extension along with the name</li>
	<li>bottom banner: the name of the picture at the bottom right of the homepage. include file extension along with the name</li>
	<li>slider 2, slider 3, slider 4, slider 5, slider 6, slider 7: the names of the rest of the pictures that go into the slider, not counting already the main banner since we have already added that in the other column. include file extension</li>
	
</ul>

</div>
";
}
else{echo "<body onload=\"document.location.href='banner_manager.php'\">";}
}
mysql_close();
?>
</body>
</html>