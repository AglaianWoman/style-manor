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
#banner_table th,#banner_table td{border: 1px dashed black;}
</style>
</head>

<?php

include("../shared variables.php");


//to check if a person is not an administrator
$is_not_admin = true;

for ($i = 0; $i <= count($admin_emails)-1; $i++) {
	
	if ($_SESSION["email"] == $admin_emails[$i]) {
		$is_not_admin = false;	
		break;
	}
}
//if person logged in is not an administrator redirect  them to the home page
if ($is_not_admin) echo "<body onload=\"document.location.href = '../home.php';\">";
else {
//this file is to connect to the sql server
include("../protected/dbconnect_auto.php");
//select database
mysql_select_db("thesty10_auto-manipulate");
$message="";
//this checks if submit button was clicked
if(isset($_POST['add']))
{
	$end_time=strtotime($_POST['endtime']);
	//echo $_POST['name'].",".$_POST['endtime'].$_POST['main_banner'].",".$_POST['bottom_banner'].",".$_POST['slider2'].",".$_POST['slider3'].",".$_POST['slider4'].",".$_POST['slider5'].",".$_POST['slider6'].",".$_POST['slider7'];
	if($_POST['name']=="")
	{$message.="enter a name for the offer.<br />";}
	if($end_time==false)
	{$message.="enter the appropriate text for a date this offer is going to end<br />";}
	if($_POST['main_banner']=="")
	{$message.="enter the file name(including extension) for the main  banner<br />";}
	if($_POST['bottom_banner']=="")
	{$message.="enter file name(including extension) for the banner at the bottom right of the home page <br />";}
	$name=$_POST['name'];
	$main_banner=$_POST['main_banner'];
	$bottom_banner=$_POST['bottom_banner'];
	$slide2=$_POST['slider2'];
	$slide3=$_POST['slider3'];
	$slide4=$_POST['slider4'];
	$slide5=$_POST['slider5'];
	$slide6=$_POST['slider6'];
	$slide7=$_POST['slider7'];
	if($message=="")
	{
		$tail=mysql_fetch_assoc(mysql_query("SELECT number FROM variables WHERE name='lotw queue tail'"));
		$tail_it=$tail['number']+1;
		
		$query="INSERT INTO banners (name, iteration, endtime, main_banner, right_banner, slide2, slide3, slide4, slide5, slide6, slide7)
		 VALUES ('".$name."', ".$tail_it.", ".$end_time.", '".$main_banner."', '".$bottom_banner."', '".$slide2."', '".$slide3."', '".$slide4."', '".$slide5."', '".$slide6."', '".$slide7."')";
		if(mysql_query($query))
		{
		mysql_query("UPDATE variables SET number=".$tail_it." WHERE name='lotw queue tail'");
		$message="<div style='color:blue;font-size:14pt'>Update successful</div>";
		}
		else{$message="did not insert successfully";}
	}
	else{$message="Could not add item for the following reasons:<br />".$message;}
	
}
//get the current iteration for displaying banners
$head=mysql_fetch_assoc(mysql_query("SELECT number FROM variables WHERE name='lotw queue head'"));
//creates query to get the rows in the banners table and order them by iteration number
$query=mysql_query("SELECT * from banners ORDER BY iteration;");
echo "<body>
<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
<div style='color:red;font-size:13pt'>$message</div>
<table id='banner_table'>
<tr>
<th>name</th>
<th>iteration</th>
<th>duration</th>
<th>endtime</th>
<th>main banner</th>
<th>bottom right banner</th>
<th>slider 2</th>
<th>slider 3</th>
<th>slider 4</th>
<th>slider 5</th>
<th>slider 6</th>
<th>slider 7</th>
</tr>
";
while($row=mysql_fetch_assoc($query))
{
$time=Date("F j Y",$row['endtime']);
if($row['iteration']==$head['number'])
echo "<tr style='background-color:yellow'>";
else echo "<tr>";
echo "
<td>".$row['name']."</td>
<td>".$row['iteration']."</td>
<td>".$row['duration']."</td>
<td>".$time."</td>
<td>".$row['main_banner']."</td>
<td>".$row['right_banner']."</td>
<td>".$row['slide2']."</td>
<td>".$row['slide3']."</td>
<td>".$row['slide4']."</td>
<td>".$row['slide5']."</td>
<td>".$row['slide6']."</td>
<td>".$row['slide7']."</td>
<td>
<form method='post' action='edit_banner.php'>
	<input type='hidden' value='".$row['iteration']."' name='edit' />
	<input type='submit' value='edit' />
	</form>
	</td>
</tr>
";
}
echo "</table>

<form method='post' action='banner_manager.php'>
<table>
	<tr>
		<th>name</th>
		<th>end time</th>
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
		<td><input type='text' value='' name='name' /></td>
		<td><input type='text' value='' name='endtime' /></td>
		<td><input type='text' value='' name='main_banner' /></td>
		<td><input type='text' value='' name='bottom_banner' /></td>
		<td><input type='text' value='' name='slider2' /></td>
		<td><input type='text' value='' name='slider3' /></td>
		<td><input type='text' value='' name='slider4' /></td>
		<td><input type='text' value='' name='slider5' /></td>
		<td><input type='text' value='' name='slider6' /></td>
		<td><input type='text' value='' name='slider7' /></td>
	</tr>
</table>
<br />
<input type='submit' name='add' value='add data to table' /> 
</form>
<br />
<span style='font-size:14pt'>***the row colored yellow is the current daily crush/look of the week showing on the homepage</span>
";
mysql_close();
}

?>
</body>
</html>