<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Slider and Banner Manager</title>
	<style type="text/css">
	table{
	border-style:solid;
	}
	#active, #inactive {border-collapse:collapse}
	#active th,#active td,#inactive th,#inactive td{border: 1px solid black; text-align:center}
	.images {border-style:solid}
	.selection {border-style:solid; border-color:gray; border-bottom-style:none;width:320px}
	
	</style>

	<script type="text/javascript">
		function changeType() {
			document.changeImageType.submit();
			//document.getElementById("")
		}
	</script>
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
if ($is_not_admin) {

	echo "<body onload=\"document.location.href = '../home.php';\">
		</body>
		</html>
	";
	
	exit;
}

	//this file is to connect to the sql server
	include("../protected/dbconnect_auto.php");
	//select database
	mysql_select_db("thesty10_auto-manipulate");
	//default value
	$selectedImgs = array("slider"=>"","bottom banner"=>"");
	$imageType = "slider";
	if(isset($_POST["image_type"]))
	{
		$imageType = $_POST["image_type"];
	}
	else if(isset($_GET["image-type"])) {
			$imageType = $_GET["image-type"];
	}
	$selectedImgs[$imageType]="selected='selected'";
	//create a query to get the images that are active an inactive
	$images_query_active = mysql_query("SELECT * FROM images WHERE active='yes' AND image_type='" . $imageType . "' ORDER BY order_id");
	$images_query_inactive = mysql_query("SELECT * FROM images WHERE active='no' AND image_type='" . $imageType . "' ORDER BY order_id");
	$message="";
	//if submit button was clicked then check values to add to database
	if (isset($_POST["addImageVal"])) {
			extract($_POST);
			
			if ($directoryVal=="" || $linkVal=="" || $orderVal=="") {
				$message .= "could not insert values because either the directory, link or order number were empty.<br />";
			
			}
			else {
				$startDate = "NULL";
				$endDate = "NULL";
				if ($startDateVal != "") {
					$startDate = strtotime($startDateVal);
					if ($startDate == false) {
						$message .= "start date is not valid.<br />";
					}
				}
				
				if ($endDateVal != "") {
					$endDate = strtotime($endDateVal);
					if ($endDate == false) {
						$message .= "end date is not valid.<br />";
					}
				}
				
				if (!is_numeric($orderVal)) {
						$message .= "the order number must be numeric.<br />";
				}
				
				if ($message == "") {
				
					$insertImage = "INSERT INTO images (directory, link, start_date, end_date, active, order_id, image_type)
					VALUES ('".addslashes($directoryVal)."', '$linkVal', $startDate, $endDate, '$activeVal', $orderVal, '$imageTypeVal')";
					if (!mysql_query($insertImage)) {
						$message .= mysql_error();
					}
					else {
						$message = "insertion successful";
					}
				}
			}
	}
echo "
		<body>
			<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
		
		
			<div style='margin-left:100px'>
					This is to edit the images in the slider and the image used in the bottom right corner of the main page.
				
		
		
				<p><b>* this field is required</b></p>
				<h1>insert an image</h1>
				<span style='font-size:14pt'>$message</span>
				<form method='post' action='slider_manager.php'>
					<table>
						<tr>
							<th>directory*</th>
							<th>link*</th>
							<th>start date</th>
							<th>end date</th>
							<th>active*</th>
							<th>order number*</th>
							<th>image type*</th>
						</tr>
						<tr>
							<td><input type='text' name='directoryVal' value='' /></td>
							<td><input type='text' name='linkVal' value='' /></td>
							<td><input type='text' name='startDateVal' value='' /></td>
							<td><input type='text' name='endDateVal' value='' /></td>
							<td>
								<select name='activeVal'>
									<option value='yes'>yes</option>
									<option value='no'>no</option>
								</select>
							</td>
							<td><input type='text' name='orderVal' value='' /></td>
							<td>
								<select name='imageTypeVal'>
									<option value='slider'>slider</option>
									<option value='bottom banner'>bottom banner</option>
								</select>
							</td>
						</tr>
					</table>
					
					<input type='submit' value='add image' name='addImageVal' />
				</form>
				<br />
		
		
<!------------------------------------------------------------------------------>		
				<div class='selection'>
					<table style='border-style:none'>
						<tr>
							<td style='float:left;font-size:14pt'>select image category:<td>
							<td>
								<form method='post' action='slider_manager.php' name='changeImageType'>
									<select name='image_type' onchange='changeType();'>
										<option value='slider' " . $selectedImgs["slider"] . ">slider</option>
										<option value='bottom banner' ". $selectedImgs["bottom banner"] . ">bottom banner</option>
									</select>
								</form>
							</td>
						</tr>
					</table>
				
				</div>
				
<!------------------------------------------------------------------------------>	

				<div class='images'>
					
					<h1>Active Images</h1>
					<table id='active'>
						<tr>
							<th>directory</th>
							<th>link</th>
							<th>start date</th>
							<th>end date</th>
							<th>active</th>
							<th>order number</th>
							<th>image type</th>
							<th></th>
						</tr>
";
	while ($row=mysql_fetch_assoc($images_query_active)) {
		$startImgTime = "";
		$endImgTime = "";
		if($row["start_date"]!="" || $row["start_date"]!=0 || $row["start_date"]!=null) {
			$startImgTime = Date("F j Y", $row["start_date"]) ;
		}
		if($row["end_date"]!="" || $row["end_date"]!=0 || $row["end_date"]!=null) {
			$endImgTime = Date("F j Y", $row["end_date"]);
		}
echo "
						<tr>
							<td>" . $row["directory"] . "</td>
							<td>" . $row["link"] . "</td>
							<td> " . $startImgTime . " </td>
							<td> " . $endImgTime . " </td>
							<td> " . $row["active"] . " </td>
							<td> " . $row["order_id"] . " </td>
							<td> " . $row["image_type"] . " </td>
							<td>
								<form method='post' action='image_editor.php'>
									<input type='hidden' value='" . $row["image_id"] . "' name='imageId' />
									<input type='submit' value='EDIT' name='editImage' />
								</form>
							</td>
						</tr>
";
	}
echo "
					</table>
		
					<h1>Inactive Images</h1>
						<table id='inactive'>
								<tr>
									<th>directory</th>
									<th>link</th>
									<th>start date</th>
									<th>end date</th>
									<th>active</th>
									<th>order number</th>
									<th>image type</th>
									<th></th>
								</tr>
	
";
	
	while ($row = mysql_fetch_assoc($images_query_inactive)) {
		$startImgTime = "";
		$endImgTime = "";
		if ($row["start_date"]!="" || $row["start_date"]!=0 || $row["start_date"]!=null) {
			$startImgTime = Date("F j Y", $row["start_date"]);
		}
		if ($row["end_date"]!="" || $row["end_date"]!=0 || $row["end_date"]!=null) {
			$endImgTime = Date("F j Y", $row["end_date"]);
		}
			echo "
								<tr>
									<td>" . $row["directory"] . "</td>
									<td>" . $row["link"] . "</td>
									<td> " . $startImgTime . " </td>
									<td> " . $endImgTime . " </td>
									<td align='center'> " . $row["active"] . " </td>
									<td> " . $row["order_id"] . " </td>
									<td> " . $row["image_type"] . " </td>
									<td>
										<form method='post' action='image_editor.php'>
											<input type='hidden' value='" . $row["image_id"] . "' name='imageId' />
											<input type='submit' value='EDIT' name='editImage' />
										</form>
									</td>
								</tr>
		";
	}
	
echo "
							</table>
						</div>
					</div>
		
";




?>
</body>
</html>