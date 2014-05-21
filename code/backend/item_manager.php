<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>item manager</title>
	<style type="text/css">
	table{
	border-style:solid;
	}
	.select_collection{border:solid gray; border-bottom-style:none}
	.active, .inactive {border-collapse:collapse}
	.active th,.inactive th{font-size:14pt}
	.active th,.active td,.inactive th,.inactive td{border: 1px solid black;}
	
	.center th{text-align:center}
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
	echo "
			<body onload=\"document.location.href = '../home.php';\">
			</body>
		</html>
	";
	exit;
}

	//this file is to connect to the sql server
	include("../protected/dbconnect_auto.php");
	//select database
	mysql_select_db("thesty10_auto-manipulate");
	//update this if more categories are added
	//$selectedImgs = array("1" => "", "2" => "", "3" => "", "4" =>"");
	//default value
	$categoryId = "1";
	if (isset($_POST["collection_type"])) {
		$categoryId = $_POST["collection_type"];
	}
	else if (isset($_GET["id"])) {
		$categoryId = $_GET["id"];
	}
	
	//to select all categories to print them out for options
	
	$message = "";
	
	//if submit button was clicked to add an item
	if (isset($_POST["addImageVal"])) {
			extract($_POST);
			
			if ($itemNameVal == "" || $directoryVal == "" || $linkVal == "" || $orderVal == "" || $priceVal == "") {
				$message .= "could not insert values because either the directory, link, order number or price values were empty.<br />";
			
			}
			else {
				if (!is_numeric($orderVal) || !is_numeric($priceVal)) {
					$message .= "the order number and price need to be numbers";
				}
				$startDate= "NULL";
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
				
				if ($message == "") {
					$collectionNameQuery = mysql_query("SELECT * FROM collections WHERE id=" . $collectionVal . "");
					$collectionName = mysql_fetch_assoc($collectionNameQuery);
					$insertImage = "INSERT INTO shop_test2 (item_name, directory, expire_date, active, link, order_number, collection_name, start_time, price, collection_id)
					VALUES ('$itemNameVal', '$directoryVal', $endDate, '$activeVal', '$linkVal', $orderVal, '" .addslashes($collectionName["collection_name"]) . "', $startDate, $priceVal, $collectionVal)";
					if (!mysql_query($insertImage)) {
						$message .= mysql_error();
					}
					else {
						$message = "insertion successful";
					}
				}
			}
	}
	
	//if submit button was clicked to add the main picture
	$mainPicError = "";
	if (isset($_POST["addMainPicture"])) {
		extract($_POST);
		if ($mainpDirectory == "") {
			$mainPicError .= "need to supply a directory for the image.<br />";
			
		}
		else {
			$startDate = "NULL";
			$endDate = "NULL";
			if ($mainpStartDate != "") {
				$startDate = strtotime($mainpStartDate);
				if ($startDate == false) {
					$mainPicError .= "the start date is not valid. <br />";
				}
			}
			if ($mainpEndDate != "") {
				$endDate = strtotime($mainpEndDate);
				if ($endDate == false) {
					$mainPicError .= "the end date is not valid. <br />";
				}
			}
			if ($mainPicError == "") {
				//to get the collection name for the image
				$cquery = mysql_query("SELECT * FROM collections where id=".$mainpCollection."");
				$crow = mysql_fetch_assoc($cquery);
				//query to insert the image
				$insertMainImage = "INSERT INTO main_shop_pic (directory, expire_date, active, start_time, collection_name)
				VALUES ('$mainpDirectory', $endDate, '$mainpActive', $startDate, '".addslashes($crow["collection_name"])."')
				";
				if(!mysql_query($insertMainImage)) {
					$mainPicError .=mysql_error();
				}
				else {
					$mainPicError = "insertion successful.";
				}
			}
		}
			
		
	}
	
	
	$categories = "SELECT * FROM collections";
	//gets collection depending on which collection is selected
	$categoryIdQuery = mysql_query("SELECT * FROM collections WHERE id=" . $categoryId . "");
	$selectedCategory = mysql_fetch_assoc($categoryIdQuery);
	
	//create a query to get the items that are active and inactive
	$images_query_active = mysql_query("SELECT * FROM shop_test2 WHERE active='yes' AND collection_name='" . addslashes($selectedCategory["collection_name"]) . "' ORDER BY order_number");
	$images_query_inactive = mysql_query("SELECT * FROM shop_test2 WHERE active='no' AND collection_name='" . addslashes($selectedCategory["collection_name"]) . "' ORDER BY order_number");
	
	//gets a query for active and inactive main images
	$mainPicQueryActive = mysql_query("SELECT * FROM main_shop_pic WHERE active='yes' AND collection_name='" . addslashes($selectedCategory["collection_name"]) . "'");
	$mainPicQueryInactive = mysql_query("SELECT * FROM main_shop_pic WHERE active='no' AND collection_name='" . addslashes($selectedCategory["collection_name"]) . "'");
	
	echo "

		<body>
		<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
		<p><b>* this field is required</b></p>
		
		
		<div style='border-style:solid;margin-top:5px'>
		
			
<!--------------------------------------------------------------------------------------------------------------->
			<!-- this starts the table to insert a new item to the database -->
			<div style='margin-left:10px'>
			<h1>insert a new item:</h1>
			<span>$message</span>
			<!--this is to add a new item to the database-->
			<form method='post' action='item_manager.php'>
				<table class='center'>
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
						<td><input type='text' name='itemNameVal' value='' /></td>
						<td><input type='text' name='directoryVal' value='' /></td>
						<td><input type='text' name='startDateVal' value='' /></td>
						<td><input type='text' name='endDateVal' value='' /></td>
						
						<td>
							<select name='activeVal'>
								<option value='yes'>yes</option>
								<option value='no'>no</option>
							</select>
						</td>
						<td><input type='text' name='linkVal' value='' size='10' /></td>
						
						<td>
							<select name='collectionVal'>
							";
							$category_query=mysql_query($categories);
							while ($row = mysql_fetch_assoc($category_query)) {
							
								echo "
									<option value='" . $row["id"] . "'>" . $row["collection_name"] . "</option>
								";
							}
							echo "
							</select>
						</td>
						<td><input type='text' name='orderVal' value='' size='10' /></td>
						<td><input type='text' name='priceVal' value='' size='10' /></td>
					</tr>
				</table>
				
				<input type='hidden' value='".$categoryId."' name='collection_type' />
				<input type='submit' value='add image' name='addImageVal' />
			</form>
		
<!----------------------------------------------------------------------------------------------------------------->
		
		
		
		
<!--------------------------------------------------------------------------------------------------------------->
			<h1>insert main picture for collection:</h1>
			$mainPicError
		<!--this is to insert a new main picture for the collection-->
		<form method='post' action='item_manager.php'>
				<table class='center'>
					<tr>
						<th>directory*</th>
						<th>start date</th>
						<th>end date</th>
						<th>active*</th>
						<th>collection name*</th>
					</tr>
					<tr>
						<td><input type='text' name='mainpDirectory' value='' /></td>
						<td><input type='text' name='mainpStartDate' value='' /></td>
						<td><input type='text' name='mainpEndDate' value='' /></td>
						<td>
						<select name='mainpActive'>
								<option value='yes'>yes</option>
								<option value='no'>no</option>
							</select>
						</td>
						<td>
							<select name='mainpCollection'>
							";
							$category_query=mysql_query($categories);
							while ($row = mysql_fetch_assoc($category_query)) {
							
								echo "
									<option value='" . $row["id"] . "'>" . $row["collection_name"] . "</option>
								";
							}
						echo "
							</select>
						</td>
					</tr>
				</table>
				<input type='submit' value='add main picture' name='addMainPicture' />
			</form>
			</div>
			<br />
		</div>
			
			<br />
			<br />
<!--------------------------------------------------------------------------------------------------------------->
			
			
			
		<!--this is for the user to be able to select a collection category-->
		<div>
			<table class='select_collection'>
				<tr>
					<td><span style='float:left; font-size:14pt'>select collections category:</span></td>
					<td>
						<form method='post' action='item_manager.php' name='changeImageType'>
							<select name='collection_type' onchange='changeType();'>
							";
							$category_query = mysql_query($categories);
							while ($row = mysql_fetch_assoc($category_query)) {
								$selected = "";
										if ($categoryId == $row["id"]) {
											$selected= "selected='selected'";
										}
											echo "
												<option value='" . $row["id"] . "' " . $selected . ">" . $row["collection_name"] . "</option>
											";
							}
							echo "
							</select>
						</form>
					</td>
				</tr>
			</table>
		</div>
			
<!--------------------------------------------------------------------------------------------------------------->
	
	<div style='width:100%; border-style:solid'>
		<div style='margin-left:10px'>
			<!--list of active items in the store-->
			<h1>Active Items</h1>
			<table class='active'>
				<tr>
						<th>item name</th>
						<th>directory</th>
						<th>link</th>
						<th>start date</th>
						<th>end date</th>
						<th>active</th>
						<th>order <br /> number</th>
						<th>collection <br /> name</th>
						<th>price</th>
						<th></th>
				</tr>
	";
		while ($row = mysql_fetch_assoc($images_query_active)) {
			$startImgTime = "";
			$endImgTime = "";
			if($row["start_time"]!="" || $row["start_time"]!=0 || $row["start_time"]!=null) {
				$startImgTime = Date("F j Y", $row["start_time"]) ;
			}
			if($row["expire_date"]!="" || $row["expire_date"]!=0 || $row["expire_date"]!=null) {
				$endImgTime = Date("F j Y", $row["expire_date"]);
			}
			echo "
				<tr>	
					<td> " . $row["item_name"] . " </td>
					<td>" . $row["directory"] . "</td>
					<td>" . $row["link"] . "</td>
					<td> " . $startImgTime . " </td>
					<td> " . $endImgTime . " </td>
					<td> " . $row["active"] . " </td>
					<td> " . $row["order_number"] . " </td>
					<td> " . $row["collection_name"] . " </td>
					<td> $" . $row["price"] . " </td>
					<td>
						<form method='post' action='item_editor.php'>
							<input type='hidden' value='".$row["item_id"]."' name='itemId' />
							<input type='submit' value='EDIT' />
						</form>
					</td>
				</tr>
			";
		}
	echo "
	
			</table>
		
		
		<h1>Active Main Pictures</h1>
			<table class='active'>
				<tr>
						
						<th>directory</th>
						<th>start date</th>
						<th>end date</th>
						<th>active</th>
						<th>collection <br />name</th>
						<th></th>
						
				</tr>
				";
				while ($row = mysql_fetch_assoc($mainPicQueryActive)) {
					$startImgTime = "";
					$endImgTime = "";
					if ($row["start_time"]!="" || $row["start_time"]!=0 || $row["start_time"]!=null) {
						$startImgTime = Date("F j Y", $row["start_time"]) ;
					}
					if ($row["expire_date"]!="" || $row["expire_date"]!=0 || $row["expire_date"]!=null) {
						$endImgTime = Date("F j Y", $row["expire_date"]);
					}
						echo "
						<tr>
							<td>" . $row["directory"] . "</td>
							<td>" . $startImgTime . "</td>
							<td>" . $endImgTime . "</td>
							<td>" . $row["active"] . "</td>
							<td>" . $row["collection_name"] . "</td>
							<td>
								<form method='post' action='main_pic_editor.php'>
									
									<input type='hidden' value='".$row["id"]."' name='mainPicId' />
									<input type='submit' value='EDIT' />
								</form>
							</td>
						</tr>
						";
				}
				echo "
			</table>
			<br />
		</div>
	</div>
<!--------------------------------------------------------------------------------------------------------------->
	
	<br />
	<div style='width:100%; border-style:solid'>
		<div style='margin-left:10px'>
			<h1>Inactive Items:</h1>
			<table class='inactive'>
				<tr>
						<th>item name</th>
						<th>directory</th>
						<th>link</th>
						<th>start date</th>
						<th>end date</th>
						<th>active</th>
						<th>order <br />number</th>
						<th>collection <br />name</th>
						<th>price</th>
						<th></th>
				</tr>
		
		";
		
	while ($row = mysql_fetch_assoc($images_query_inactive)) {
		$startImgTime = "";
		$endImgTime = "";
	if ($row["start_time"]!="" || $row["start_time"]!=0 || $row["start_time"]!=null) {
		$startImgTime = Date("F j Y", $row["start_time"]) ;
	}
	if ($row["expire_date"]!="" || $row["expire_date"]!=0 || $row["expire_date"]!=null) {
		$endImgTime = Date("F j Y", $row["expire_date"]);
	}
	echo "
				<tr>
					<td> " . $row["item_name"] . " </td>
					<td>" . $row["directory"] . "</td>
					<td>" . $row["link"] . "</td>
					<td> " . $startImgTime . " </td>
					<td> " . $endImgTime . " </td>
					<td> " . $row["active"] . " </td>
					<td> " . $row["order_number"] . " </td>
					<td> " . $row["collection_name"] . " </td>
					<td> $" . $row["price"] . " </td>
					<td>
						<form method='post' action='item_editor.php'>
							
							<input type='hidden' value='".$row["item_id"]."' name='itemId' />
							<input type='submit' value='EDIT' />
						</form>
					</td>
				</tr>
	";
	}
	echo "
			</table>
			
			
			
			<h1>Inactive Main Pictures:</h1>
			<table class='inactive'>
				<tr>
					
						<th>directory</th>
						<th>start date</th>
						<th>end date</th>
						<th>active</th>
						
						<th>collection <br />name</th>
						<th></th>
						
				</tr>
	";
	while ($row = mysql_fetch_assoc($mainPicQueryInactive)) {
	$startImgTime = "";
		$endImgTime = "";
	if ($row["start_time"]!="" || $row["start_time"]!=0 || $row["start_time"]!=null) {
		$startImgTime = Date("F j Y", $row["start_time"]) ;
	}
	if ($row["expire_date"]!="" || $row["expire_date"]!=0 || $row["expire_date"]!=null) {
		$endImgTime = Date("F j Y", $row["expire_date"]);
	}
	echo "
						<tr>
							<td>" . $row["directory"] . "</td>
							<td>" . $startImgTime . "</td>
							<td>" . $endImgTime . "</td>
							<td>" . $row["active"] . "</td>
							<td>" . $row["collection_name"] . "</td>
							<td>
								<form method='post' action='main_pic_editor.php'>
									
									<input type='hidden' value='".$row["id"]."' name='mainPicId' />
									<input type='submit' value='EDIT' />
								</form>
							</td>
						</tr>
	";
	}
	echo "
			</table>
				
			<br	/>
		</div>
	</div>
";



?>
</body>
</html>