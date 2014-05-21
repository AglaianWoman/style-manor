<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Slider and Bottom Banner Editor</title>
		<style type="text/css">
			.container{margin:30px 0 0 100px}
			table{
			border-style:solid;
			}
			.edit{border-collapse:collapse}

			.edit th, .edit td{border: 1px solid black;}
	
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
	if ($is_not_admin) { 
		echo "
			<body onload=\"document.location.href = '../home.php';\">
			</body>
		</html>
		";
		exit;
	}
	
		include("../protected/dbconnect_auto.php");
		//select database
		mysql_select_db("thesty10_auto-manipulate");
		if (isset($_POST['imageId'])) {
			$id = $_POST['imageId'];
		}
		else {
			echo "
			<body>
				<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div style='width:200px; margin:0 auto'>
					There was an error because you did not select a collection to update or the programming code is incorrect.
						<a href='collection_manager.php' target='_top'>back to collections list</a>
				</div>
			";
			exit;
		}
		$message = "";
		if (isset($_POST["edit_Image"])) {
			extract($_POST);
			
			if ($directoryVal == "" || $linkVal == "" || $orderVal == "") {
				$message .= "could not insert values because either the directory, link or order number were empty.<br />";
			
			}
			else {
				$startDate= "NULL";
				$endDate = "NULL";
				if ($startDateVal!="") {
					$startDate = strtotime($startDateVal);
					if ($startDate == false) {
						$message .= "start date is not valid.<br />";
					}
				}
				
				if ($endDateVal!="") {
					$endDate = strtotime($endDateVal);
					if ($endDate == false) {
						$message .= "end date is not valid.<br />";
					}
				}
				
				if (!is_numeric($orderVal)) {
						$message .= "the order number must be numeric.<br />";
				}
				
				if ($message == "") {
				
					$editImage = "UPDATE images SET directory='$directoryVal', link='$linkVal', start_date=$startDate, end_date=$endDate, active='$activeVal', order_id=$orderVal, image_type='" . $imageTypeVal . "' WHERE image_id=" . $id . "";
					if (!mysql_query($editImage)) {
						$message .= mysql_error();
					}
					else {
						$message = "update successful";
					}
				}
			}
		}
		
		
		$query = mysql_query("SELECT * FROM images WHERE image_id=".$id."");
		$image = mysql_fetch_assoc($query);
		$startDate='';
		$endDate='';
		if($image["start_date"]!="") {$startDate = Date("F j Y",$image["start_date"]);}
		if($image["end_date"]!="") {$endDate = Date("F j Y", $image["end_date"]);}
		
		
echo "
			<body>
				<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div class='container'>
					<p><b>*required fields</b></p>
					<h1>Edit Image:</h1>
					$message
						<form method='post' action='image_editor.php'>
							<table class='edit'>
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
									<td><input type='text' name='directoryVal' value='".htmlentities($image["directory"],ENT_QUOTES)."' /></td>
									<td><input type='text' name='linkVal' value='".htmlentities($image["link"], ENT_QUOTES)."' /></td>
									<td><input type='text' name='startDateVal' value='".$startDate."' /></td>
									<td><input type='text' name='endDateVal' value='".$endDate."' /></td>
									<td>
										<select name='activeVal'>
";
$selected = "";
if ($image["active"] === "yes") {$selected = "selected='selected'";}
echo "
											<option value='yes' ".$selected.">yes</option>
";
$selected = "";
if ($image["active"] === "no") {$selected = "selected='selected'";}
echo "
											<option value='no' ".$selected.">no</option>
										</select>
									</td>
									<td><input type='text' name='orderVal' value='".$image["order_id"]."' /></td>
									<td>
										<select name='imageTypeVal'>
									";
$selected = "";
if ($image["image_type"] === "slider") {$selected = "selected='selected'";}
echo "
											<option value='slider' ".$selected.">slider</option>
";
$selected = "";
if ($image["image_type"] === "bottom banner") {$selected = "selected='selected'";}
echo "
											<option value='bottom banner' ".$selected.">bottom banner</option>
										</select>
									</td>
								</tr>
							</table>
							<input type='hidden' name='imageId' value='" . $id . "' />
							<input type='submit' value='Edit Image' name='edit_Image' />
						</form>
						
						
						<br />
						<a href='slider_manager.php?image-type=".urlencode($image["image_type"])."'> back to images list</a>
					</div>
";
?>

	</body>
</html>
	