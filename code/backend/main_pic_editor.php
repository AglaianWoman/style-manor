<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>item editor</title>
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
	
	//checks if an item id has been poseted to this page
	if (isset($_POST["mainPicId"])) {
		$itemId = $_POST["mainPicId"];
	}
	else {
			echo "
			<body>
				<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div style='width:500px; margin:0 auto'>
					There was an error because you did not select a collection to update or the programming code is incorrect. <br />
					<div style='width:200px;margin:0 auto'>
						<a href='item_manager.php' target='_top'>back to item's list</a>
					</div>
				</div>
			";
			exit;
		}
	$message = "";
	//checks that user clicked the button to edit the main picture for a collection
	if (isset($_POST["editPicItem"])) {
		extract($_POST);
			//these values must not be empty
		if ($directoryVal == "") {
			$message .= "could not update values because the directory was empty.<br />";
		
		}
		else {
				$startDate = "NULL";
				$endDate = "NULL";
			if ($startDateVal != "") {
				$startDate = strtotime($startDateVal);
				if ($startDate == false) {
					$message .= "the start date is not valid. <br />";
				}
			}
			if ($endDateVal != "") {
				$endDate = strtotime($endDateVal);
				if ($endDate == false) {
					$message .= "the end date is not valid. <br />";
				}
			}
			if ($message == "") {
				//to get the collection name for the image
				$cquery = mysql_query("SELECT * FROM collections where id=".$collectionVal."");
				$crow = mysql_fetch_assoc($cquery);
				$updatePic = "UPDATE main_shop_pic SET directory='".$directoryVal."', expire_date=".$endDate.", active='".$activeVal."', start_time=".$startDate.", collection_name='".addslashes($crow["collection_name"])."' WHERE id=".$itemId."";
				
				if (!mysql_query($updatePic)) {
						$message .= mysql_error();
					}
					else {
						$message = "update successful";
					}
			}
		}
	}
	
	
	
		$picQuery = mysql_query("SELECT * FROM main_shop_pic WHERE id=".$itemId."");
		$mainPic = mysql_fetch_assoc($picQuery);
		
		$startDate = "";
		$endDate = "";
		//convert the dates to human friendly dates
		if ($mainPic["start_time"] != "" && $mainPic["start_time"] != 0 && $mainPic["start_time"]!=null) { 
			$startDate = Date("F j Y", $mainPic["start_time"]);
		}
		if ($mainPic["expire_date"] != "" && $mainPic["expire_date"] != 0 && $mainPic["expire_date"]!=null) { 
			$endDate = Date("F j Y", $mainPic["expire_date"]);
		}
		
		echo "
		
		<body>
			<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div class='container'>
				<p><b>*required fields</b></p>
				<h1>Edit Main Picture:</h1>
				
				$message
					<form method='post' action='main_pic_editor.php'>
						<table class='edit'>
							<tr>
								
								<th>directory*</th>
								<th>start date</th>
								<th>end date</th>
								<th>active*</th>				
								<th>collection *<br /> name</th>
							</tr>
							<tr>
								<td><input type='text' name='directoryVal' value='".htmlentities($mainPic["directory"], ENT_QUOTES)."' /></td>
								<td><input type='text' name='startDateVal' value='".$startDate."' /></td>
								<td><input type='text' name='endDateVal' value='".$endDate."' /></td>
								<td>
									<select name='activeVal'>
									";
									$selected = "";
									if ($mainPic["active"] == "yes") {
										$selected = "selected='selected'";
									}
									echo "
										<option value='yes' " . $selected . " >yes</option>
										";
									$selected="";
									if ($mainPic["active"] == "no") {
										$selected = "selected='selected'";
									}
									echo "
										<option value='no' " . $selected . ">no</option>
									</select>
								<td>
									<select name='collectionVal'>
							";
							$collectionsQuery = mysql_query("SELECT * FROM collections");
							while ($row = mysql_fetch_assoc($collectionsQuery)) {
								$selected = "";
								if ($mainPic["collection_name"] == $row["collection_name"]) {
									$collectionId = $row['id'];
									$selected = "selected='selected'";
								}
								echo "
										<option value='" . $row["id"] . "' " . $selected . ">" . $row["collection_name"] . "</option>
								";
							}
							echo "
									</select>
								</td>
							</tr>
						</table>
						<input type='hidden' value='$itemId' name='mainPicId' />
						<input type='submit' value='edit main picture' name='editPicItem' />
					</form>
					<br />
					<a href='item_manager.php?id=".$collectionId."' target='_top'>back to item list</a>
				</div>
		
		
		";
	
	
	
	
	
	?>