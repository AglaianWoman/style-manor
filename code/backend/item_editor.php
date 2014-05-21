<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>item editor</title>
	<style type="text/css">
	.container{margin: 30px 0 0 10px}
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

	if (isset($_POST["itemId"])) {
		//sets item id to a variable
		$itemId = $_POST["itemId"];
	}
	
	//if no item id then display error
	else {
			echo "
			<body>
				<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div style='width:500px; margin:0 auto'>
					There was an error because you did not select a collection to update or the programming code is incorrect. <br />
					<div style='width:200px;margin:0 auto'>
						<a href='item_manager.php' target='_top'>back to item&quots list</a>
					</div>
				</div>
			";
			exit;
		}
	$message = "";
	//checks if user clicked the edit item button to update an item
	if (isset($_POST["editItem"])) {
		extract($_POST);
			//these values must not be empty
			if ($itemNameVal == "" || $directoryVal == "" || $linkVal == "" || $orderVal == "" || $priceVal == "") {
				$message .= "could not update values because either the directory, link, order number or price values were empty.<br />";
			
			}
			else {
				//the order number and price for an item must be a number
				if (!is_numeric($orderVal) || !is_numeric($priceVal)) {
					$message .= "the order number and price need to be numbers<br />";
				}
				//if start date are not given them set them to null
				$startDate= "NULL";
				$endDate = "NULL";
				//if start date is given convert it to timestamp format
				if ($startDateVal != "") {
					$startDate = strtotime($startDateVal);
					if ($startDate == false) {
						$message .= "start date is not valid.<br />";
					}
				}
				//if end date is given also convert it
				if ($endDateVal != "") {
					$endDate = strtotime($endDateVal);
					if ($endDate == false) {
						$message .= "end date is not valid.<br />";
					}
				}
				//if there was no message i.e. no error
				if ($message == "") {
					//gets a query for the collection
					$collectionNameQuery = mysql_query("SELECT * FROM collections WHERE id=" . $collectionVal . "");
					$collectionName = mysql_fetch_assoc($collectionNameQuery);
					//update the item
					$updateItem = "UPDATE shop_test2 
					SET item_name='".$itemNameVal."', directory='".$directoryVal."', expire_date=".$endDate.", active='".$activeVal."', link='".$linkVal."', order_number=".$orderVal.", collection_name='".addslashes($collectionName["collection_name"])."', start_time=".$startDate.", price=".$priceVal.", collection_id=".$collectionVal." WHERE item_id=".$itemId."";
					//if it does not update put error message onto our error variable
					if (!mysql_query($updateItem)) {
						$message .= mysql_error();
					}
					else {
						$message = "update successful";
					}
				}
			}
	}
	
	
	
	
	
		$itemQuery = mysql_query("SELECT * FROM shop_test2 WHERE item_id=" . $itemId . "");
		$item = mysql_fetch_assoc($itemQuery);
		//convert the dates to human friendly dates
		$startDate = "";
		$endDate = "";
		if ($item["start_time"] != "" && $item["start_time"] != 0 && $item["start_time"] != "NULL" && $item["start_time"] != null) {$startDate = Date("F j Y", $item["start_time"]);}
		if ($item["expire_date"] != "" && $item["expire_date"] != 0 && $item["expire_date"] != "NULL" && $item["expire_date"] != null) {$endDate = Date("F j Y", $item["expire_date"]);}
		echo "
		<body>
			<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div class='container'>
						<b>*required fields</b>
				<h1>Edit Item:</h1>
				<br />
		
				$message
					<form method='post' action='item_editor.php'>
						<table class='edit'>
							<tr>
								<th>item name*</th>
								<th>directory*</th>
								<th>start date</th>
								<th>end date</th>
								<th>active*</th>
								<th>link*</th>
								<th>collection name*</th>
								<th>order number*</th>
								<th>price*</th>
							</tr>
							
							<tr>
						<td><input type='text' name='itemNameVal' value='".htmlentities($item["item_name"], ENT_QUOTES)."' /></td>
						<td><input type='text' name='directoryVal' value='".htmlentities($item["directory"], ENT_QUOTES)."' /></td>
						<td><input type='text' name='startDateVal' value='".$startDate."' /></td>
						<td><input type='text' name='endDateVal' value='".$endDate."' /></td>
						
						<td>
							<select name='activeVal'>
							";
							$selected = "";
							if ($item["active"] == "yes") {
								$selected = "selected='selected'";
							}
							echo "
								<option value='yes' " . $selected . " >yes</option>
								";
							$selected="";
							if ($item["active"] == "no") {
								$selected = "selected='selected'";
							}
							echo "
								<option value='no' " . $selected . ">no</option>
							</select>
						</td>
						
						<td><input type='text' name='linkVal' value='".$item["link"]."' /></td>
						
						<td>
							<select name='collectionVal'>
							";
							$collectionsQuery = mysql_query("SELECT * FROM collections");
							while ($row = mysql_fetch_assoc($collectionsQuery)) {
								$selected = "";
								if ($item["collection_id"] == $row["id"]) {
									$selected = "selected='selected'";
								}
								echo "
									<option value='" . $row["id"] . "' " . $selected . ">" . $row["collection_name"] . "</option>
								";
							}
							echo "
							</select>
						</td>
						<td><input type='text' name='orderVal' value='".$item["order_number"]."' /></td>
						<td><input type='text' name='priceVal' value='".$item["price"]."' /></td>
					</tr>
						</table>
						<input type='hidden' value='$itemId' name='itemId' />
						<input type='submit' value='Edit Item' name='editItem' />
					</form>
					<br />
					<a href='item_manager.php?id=".$item["collection_id"]."' target='_top'>back to item list</a>
				</div>
			";
	
	


?>
	</body>
</html>