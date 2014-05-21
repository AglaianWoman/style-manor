<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
     "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>collection editor</title>
		<style type='text/css'>
		.container {margin-left:50px; margin-top:10px}
			.edit {border-style: solid; border-collapse:collapse}
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
	
		include("../protected/dbconnect_auto.php");
		//select database
		mysql_select_db("thesty10_auto-manipulate");
		if (isset($_POST['collectionId'])) {
			$id = $_POST['collectionId'];
		}
		else {
			echo "<body>
				<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div style='width:200px; margin:0 auto'>
					There was an error because you did not select a collection to update or the programming code is incorrect.
						<a href='collection_manager.php' target='_top'>back to collections list</a>
				</div>
			";
			exit;
		}
		//this will check if the submit button was clicked so that we may update the collection row
		if (isset($_POST["editCollection"])) {
			$message="";
			if(!isset($_POST["collectionNameVal"]) || $_POST["collectionNameVal"] == "")
			{
				$message .= "need a name for the collection.";
			}
			else {
				$update = "UPDATE collections SET collection_name='" . $_POST["collectionNameVal"] . "', active='" . $_POST["activeVal"] . "' WHERE id=".$_POST["collectionId"]."";
				if(!mysql_query($update)) {
					$message .= mysql_error();
				}
				else {
					$message = "update successful";
				}
			}
		
		}
		$collections = mysql_query("SELECT * FROM collections WHERE id=" . $id . "");
		
		$row = mysql_fetch_assoc($collections);
		
			echo "
			<body>
			<iframe frameborder=\"0\" scrolling=\"no\" src=\"backend_header.php\" width=\"100%\" height=\"$backend_header_height"."px\"></iframe>
				<div class='container'>
				<p><b>*required fields</b></p>
				<h1>Edit Collection:</h1>
				$message
					<form method='post' action='collection_editor.php'>
						<table class='edit'>
							<tr>
								<th>collection name*</th>
								<th>active*</th>
							</tr>
							<tr>
							
								<td><input type='text' name='collectionNameVal' value=\"".htmlentities($row["collection_name"], ENT_QUOTES)."\" /></td>
								<td>
									<select name='activeVal'>
										";
										$selected = "";
										if ($row["active"] == "yes") {
											$selected = "selected='selected'";
										}
										
										echo "
											<option value='yes' " . $selected . ">yes</option>
												
										";
										$selected = "";
										if ($row["active"] == "no") {
											$selected = "selected='selected'";
										}
										
										echo "
											<option value='no' " . $selected . ">no</option>

									</select>
								</td>
							</tr>
						</table>
						<input type='hidden' name='collectionId' value='" . $id . "' />
						<input type='submit' name='editCollection' value='edit collection' />
					</form>
				<br />
				<a href='collection_manager.php' target='_top'>back to collections list</a>
				</div>
			";
	
?>
	</body>
</html>